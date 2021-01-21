<?php

namespace app\api\controller\v1;
use app\api\model\WechatMpModel;
use app\BaseController;
use think\exception\ValidateException;
use think\facade\Filesystem;

class CommonController extends BaseController
{
    public function GetWechatMpMessage(){
        try{
            $params = request()->get();
            if (!isset($params['appId']) || empty($params['appId'])){
                return json(['code'=>-1,'msg'=>'appId is not null']);
            }
            $wechatMp = (new WechatMpModel())->where(['appId'=>$params['appId']])->find()->toArray();
            return json(['code'=>0,'msg'=>'获取成功','data'=>$wechatMp]);
        }catch (\Exception $e){
            return json(['code'=>-1,'msg'=>$e->getMessage()]);
        }
    }

    /**
     * 图片上传
     * @return \think\response\Json
     */
    public function uploadImg(){
        try{
            if (request()->isPost()) {
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('image');
                try {
                    validate([
                        'file'=>[
                            'fileSize' => 52428800,
                            'fileExt' => 'jpg,jpeg,png,gif',
                            'fileMime' => 'image/jpeg,image/png,image/gif', //这个一定要加上，很重要我认为！
                        ]
                    ])->check(['file' => $file]);
                    //获取磁盘保存目录
                    $disk = Filesystem::getDiskConfig('public');
                    //保存图片到本地服务器
                    $savename = Filesystem::disk('public')->putFile( 'admin', $file);
                    return json(['code'=>0,'msg'=>'ok','src'=>request()->domain().$disk['url'].'/'.$savename,'location'=>$disk['url'].'/'.$savename]);
                } catch (ValidateException $v) {
                    return json(['code'=>-1,'msg'=>$v->getMessage()]);
                }
            }else{
                return json(['code'=>-1,'msg'=>'请求错误']);
            }
        }catch (\Exception $e){
            return json(['code'=>-1,'msg'=>$e->getMessage()]);
        }
    }
}