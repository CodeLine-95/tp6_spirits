<?php
namespace app\index\controller;

use app\BaseController;
use think\exception\ValidateException;
use think\facade\Db;

class IndexController extends BaseController
{
    public function index(){
        $get = request()->get();
        $get['domain'] = request()->domain();
        return view('index',['get'=>$get]);
    }

    public function search(){
        if (request()->isPost()){
            $params = request()->post();
            $check = request()->checkToken('__token__',$params);
            if(false === $check) {
                throw new ValidateException('invalid token');
            }
            unset($params['__token__']);
            $params['tel'] = encrypt($params['tel']);
            $requie_id = Db::name('buy_history')->where(['good_requie_id'=>$params['code'],'user_tel'=>$params['tel']])->find();
            if(!$requie_id) {
                Db::name('buy_history')->insert(['user_tel' => $params['tel'], 'good_requie_id' => $params['code'], 'create_time' => date('Y-m-d H:i:s')]);
            }
            return redirect(url('index/index/result',$params));
        }else {
            $get = request()->get();
            $get['domain'] = request()->domain();
            $get['tel'] = isset($get['tel']) && !empty($get['tel']) ? decrypt($get['tel']) : '';
            return view('search', ['get' => $get]);
        }
    }

    public function result(){
        if (request()->isPost()){
            $params = request()->post();
            $requie_id = Db::name('buy_history')->where(['good_requie_id'=>$params['code'],'user_tel'=>$params['tel']])->find();
            if ($requie_id){
                $params['result_two'] = "您所查询的酒，在【时间/".$requie_id['create_time']."】被查询，谨防假冒！";
            }
            $good = Db::name('goods')->where(['requie_id'=>$params['code']])->find();
            if(!$good){
                $good = [];
                $params['result_two'] = "该产品并未售卖，请联系商家！";
            }else{
                $good['buy_time'] = $requie_id['create_time'];
            }
            return view('result', ['get' => $params,'good'=>$good]);
        }else {
            $get = request()->get();
            $get['domain'] = request()->domain();
            $get['tel'] = isset($get['tel']) && !empty($get['tel']) ? $get['tel'] : '';
            return view('result', ['get' => $get]);
        }
    }
}