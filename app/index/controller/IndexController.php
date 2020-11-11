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
            $requie_id = Db::name('users')->where(['good_requie_id'=>$params['code'],'user_tel'=>$params['tel']])->find();
            if(!$requie_id) {
                Db::name('users')->insert(['user_tel' => $params['tel'], 'good_requie_id' => $params['code'], 'create_time' => date('Y-m-d H:i:s')]);
            }
            return redirect(url('index/index/result',$params));
        }else {
            $get = request()->get();
            $get['domain'] = request()->domain();
            $get['tel'] = isset($get['tel']) && !empty($get['tel']) ? $get['tel'] : '';
            return view('search', ['get' => $get]);
        }
    }

    public function result(){
        if (request()->isPost()){
            $params = request()->post();
            redirect(url('index/index/result',$params));
        }else {
            $get = request()->get();
            $get['domain'] = request()->domain();
            $get['tel'] = isset($get['tel']) && !empty($get['tel']) ? $get['tel'] : '';
            $requie_id = Db::name('users')->where(['good_requie_id'=>$get['code']])->find();
            return view('result', ['get' => $get]);
        }
    }
}