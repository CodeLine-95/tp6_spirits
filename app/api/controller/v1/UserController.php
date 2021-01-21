<?php

namespace app\api\controller\v1;

use app\api\model\MpUserModel;
use app\BaseController;
use think\facade\Log;
use think\helper\Str;

class UserController extends BaseController{
    private $appid = 'wx6da3c72afe9a3244';
    private $secret = 'b07e0ee1d194306af2bfeea7e2a0f6f7';

    /**
     * 获取微信小程序openId
     * @return \think\response\Json
     */
    public function userInfo(){
        $params = request()->get();
        if(!isset($params['code']) || empty($params['code'])){
            return json(['code'=>-1,'msg'=>'code不能为空']);
        }
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$this->appid.'&secret='.$this->secret.'&js_code='.$params['code'].'&grant_type=authorization_code';
        $res = json_decode(curl_request($url),true);
        if(isset($res['errcode'])){
            return json(['code'=>-1,'msg'=>$res['errmsg']]);
        }
        return json(['code'=>0,'openId'=>$res['openid']]);
    }

    /**
     * 保存微信用户
     * @return \think\response\Json
     */
    public function addUser(){
        try {
            if(request()->isPost()){
                $params = request()->post();
                if (!isset($params['openId']) || empty($params['openId'])){
                    return json(['code'=>-1,'msg'=>'openId不能为空']);
                }
                $find = json_decode(json_encode((new MpUserModel())->where(['openId'=>$params['openId']])->find()),true);
                if ($find){
                    return json(['code'=>0,'msg'=>'用户已保存']);
                }
                $params['userId'] = Str::random(32,2);
                $params['createTime'] = date('Y-m-d H:i:s');
                $insertId = (new MpUserModel)->save($params);
                Log::info('小程序用户信息：'.json_encode($params));
                if ($insertId){
                    return json(['code'=>0,'msg'=>'用户保存成功']);
                }else{
                    return json(['code'=>-1,'msg'=>'用户保存失败']);
                }
            }else{
                return json(['code'=>-1,'msg'=>'请求错误']);
            }
        }catch (\Exception $e){
            Log::error('小程序用户信息保存：'.$e->getMessage());
            return json(['code'=>-1,'msg'=>$e->getMessage()]);
        }
    }
}