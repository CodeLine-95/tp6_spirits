<?php
namespace app\admin\controller;

use app\admin\controller\base\CommonController;
use think\facade\Db;

class UserController extends CommonController
{
    public function index(){
        return view('index');
    }

    public function userList(){
        try {
            $params = request()->get();
            if (!isset($params['page']) || $params['page'] <= 0){
                $params['page'] = 1;
            }
            if (!isset($params['pageSize']) || $params['pageSize'] <= 0){
                $params['page'] = 10;
            }
            $totalCount = Db::name('users')->count();
            $lastPage = ceil($totalCount / $params['pageSize']);
            if ($params['page'] > $lastPage && $lastPage > 0){
                $params['page'] = $lastPage;
            }
            $nextLimit = ($params['page']-1) * $params['pageSize'];
            $usersList = Db::name('users')->order('create_time','desc')->limit($nextLimit,$params['pageSize'])->select()->toArray();

            return json(['code'=>0,'msg'=>'','count'=>$totalCount,'data'=>$usersList]);
        }catch (\Exception $e){
            return json(['msg'=>$e->getMessage(),'code'=>-1]);
        }
    }
}