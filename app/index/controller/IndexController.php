<?php
namespace app\index\controller;

use app\BaseController;
use think\exception\ValidateException;

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
            $get['result_two'] = '您所查询的编码已经被查询,首次查询时间：'.date('Y-m-d H:i:s').',谨防假冒!';
            return view('result', ['get' => $get]);
        }
    }
}