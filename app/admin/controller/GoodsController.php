<?php
namespace app\admin\controller;

use app\admin\controller\base\CommonController;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Filesystem;

class GoodsController extends CommonController {
    public function index(){
        return view('index');
    }

    /*
     * 列表数据
     */
    public function goodsList(){
        try {
            $params = request()->get();
            if (!isset($params['page']) || $params['page'] <= 0){
                $params['page'] = 1;
            }
            if (!isset($params['pageSize']) || $params['pageSize'] <= 0){
                $params['page'] = 10;
            }
            $totalCount = Db::name('goods')->count();
            $lastPage = ceil($totalCount / $params['pageSize']);
            if ($params['page'] > $lastPage && $lastPage > 0){
                $params['page'] = $lastPage;
            }
            $nextLimit = ($params['page']-1) * $params['pageSize'];
            $goodsList = Db::name('goods')->order('create_time','desc')->limit($nextLimit,$params['pageSize'])->select()->toArray();
            return json(['code'=>0,'msg'=>'','count'=>$totalCount,'data'=>$goodsList]);
        }catch (\Exception $e){
            return json(['msg'=>$e->getMessage(),'code'=>-1]);
        }
    }

    /**
     * 添加
     */
    public function add(){
        if (request()->isPost()){
            $params = array_filter(request()->post());
            $params['requie_id'] = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $params['create_time'] = date('Y-m-d H:i:s');
            $params['update_time'] = date('Y-m-d H:i:s');
            return (Db::name('goods')->save($params)) ? json(['msg'=>'保存成功','code'=>0]) : json(['msg'=>'保存失败','code'=>-1]);
        }else {
            return view('add');
        }
    }

    public function edit(){
        if (request()->isPost()){
            $params = array_filter(request()->post());
            $params['update_time'] = date('Y-m-d H:i:s');
            return (Db::name('goods')->update($params)) ? json(['msg'=>'保存成功','code'=>0]) : json(['msg'=>'保存失败','code'=>-1]);
        }else {
            $params = request()->get();
            $field = Db::name('goods')->where(['id'=>$params['id']])->find();
            return view('edit',[
                'field'=>$field
            ]);
        }
    }

    //删除
    public function del(){
        try{
            $params = request()->get();
            if (Db::name('goods')->where(['id'=>$params['id']])->delete()){
                return json(['msg'=>'ok','code'=>0]);
            }else{
                return json(['mssg'=>'error','code'=>-1,'message'=>'删除失败']);
            }
        }catch (\Exception $e){
            return json(['mssg'=>'error','code'=>-1,'message'=>$e->getMessage()]);
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
                $file = request()->file('file');
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
                    return json(['code'=>0,'msg'=>'上传成功','src'=>$disk['url'].'/'.$savename]);
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

    /**
     * 二维码
     */
    public function recode(){
        return view('recode');
    }

    /*
     * 二维码列表数据
     */
    public function recodeList(){
        try {
            $params = request()->get();
            if (!isset($params['page']) || $params['page'] <= 0){
                $params['page'] = 1;
            }
            if (!isset($params['pageSize']) || $params['pageSize'] <= 0){
                $params['page'] = 10;
            }
            $totalCount = Db::name('goods')->count();
            $lastPage = ceil($totalCount / $params['pageSize']);
            if ($params['page'] > $lastPage && $lastPage > 0){
                $params['page'] = $lastPage;
            }
            $nextLimit = ($params['page']-1) * $params['pageSize'];

            $options = (new QROptions([
                'version'    => 5,                             //二维码版本
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,      //生成图片
                'eccLevel'   => QRCode::ECC_H,                 //错误级别
                'scale'      => 10,                            //二维码大小
            ]));
            $goodsList = Db::name('goods')->order('create_time','desc')->limit($nextLimit,$params['pageSize'])->select()->toArray();
            foreach ($goodsList as $k=>$g){
                $qrcode = new QRCode($options);
                $data = $g['requie_id'];
                $goodsList[$k]['qrcodeUrl'] = $qrcode->render($data);
            }
            return json(['code'=>0,'msg'=>'','count'=>$totalCount,'data'=>$goodsList]);
        }catch (\Exception $e){
            return json(['msg'=>$e->getMessage(),'code'=>-1]);
        }
    }

}