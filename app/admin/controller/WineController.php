<?php
namespace app\admin\controller;
use app\admin\controller\base\CommonController;
use app\api\model\MpUserModel;
use app\api\model\StoryModel;
use think\facade\Db;

class WineController extends CommonController{
    public function story(){
        return view('story');
    }

    public function storyList(){
        try {
            $params = request()->get();
            if (!isset($params['page']) || $params['page'] <= 0){
                $params['page'] = 1;
            }
            if (!isset($params['pageSize']) || $params['pageSize'] <= 0){
                $params['page'] = 10;
            }
            $storyModel = new StoryModel();
            $totalCount = $storyModel->count();
            $lastPage = ceil($totalCount / $params['pageSize']);
            if ($params['page'] > $lastPage && $lastPage > 0){
                $params['page'] = $lastPage;
            }
            $offset = ($params['page']-1) * $params['pageSize'];
            $storyList = $storyModel->alias('s')->field('s.*,m.nickName,m.avatarUrl')
                ->leftJoin((new MpUserModel())->getTable(). ' m','s.openId = m.openId')
                ->order('s.create_time','desc')
                ->limit($offset,$params['pageSize'])
                ->select()->toArray();
            foreach ($storyList as $k=>$l){
                switch ($l['story_type']){
                    case 0:
                        $stroyType = '图文';
                        break;
                    case 1:
                        $stroyType = '视频';
                        break;
                    case 2:
                        $stroyType = '其他';
                        break;
                }
                $storyList[$k]['story_type'] = $stroyType;
                $storyList[$k]['user_tel'] = !empty($l['user_tel']) ? decrypt($l['user_tel']) : $l['user_tel'];
                $storyList[$k]['create_time'] = format_time($l['create_time']);
                $storyList[$k]['picList'] = json_decode(json_encode($l['picList']),true);
            }
            return json(['code'=>0,'msg'=>'','count'=>$totalCount,'data'=>$storyList]);
        }catch (\Exception $e){
            return json(['msg'=>$e->getMessage(),'code'=>-1]);
        }
    }

    public function Add(){
        if (request()->isPost()){
            $params = array_filter(request()->post());
            $params['create_time'] = date('Y-m-d H:i:s');
            if (isset($params['goods_pic'])){
                $params['goods_pic']  = json_encode($params['goods_pic']);
            }
            return (Db::name('stroy')->save($params)) ? json(['msg'=>'保存成功','code'=>0]) : json(['msg'=>'保存失败','code'=>-1]);
        }else {
            return view('add');
        }
    }
}