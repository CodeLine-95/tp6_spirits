<?php
namespace app\admin\controller\base;

use app\BaseController;

class CommonController extends BaseController{
    public $user;
    public function initialize()
    {
        $this->user = session('user');
    }
}