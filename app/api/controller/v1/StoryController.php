<?php
namespace app\api\controller\v1;

use app\api\model\MpUserModel;
use app\api\model\StoryModel;
use app\BaseController;

class StoryController extends BaseController{
    /**
     * 故事列表
     */
    public function StoryList(){
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
            $storyList[$k]['user_tel'] = !empty($l['user_tel']) ? decrypt($l['user_tel']) : $l['user_tel'];
            $storyList[$k]['create_time'] = format_time($l['create_time']);
        }
        return json(['code'=>0,'msg'=>'','count'=>$totalCount, 'pageCount'=>$lastPage, 'page'=>$params['page'], 'pageSize'=>$params['pageSize'],'data'=>$storyList]);
    }


    /**
     * 添加故事
     * @return \think\response\Json
     */
    public function AddStory(){
        try {
            if (request()->isPost()){
                $params = request()->post();
                $storyModel = new StoryModel();
                $storyModel->content = $params['content'];
                $storyModel->openId = $params['openId'];
                $storyModel->address = $params['address'];
                $storyModel->picList = $params['picList'];
                $storyModel->story_type = $params['story_type'];
                if ($storyModel->save()){
                    return json(['code'=>0,'msg'=>'success']);
                }else{
                    return json(['code'=>-1,'msg'=>'fail']);
                }
            }else{
                return json(['code'=>-1,'msg'=>'请求错误']);
            }
        }catch (\Exception $e){
            return json(['code'=>-1,'msg'=>$e->getMessage()]);
        }
    }

    /**
     * 故事详情
     * @return \think\response\Json
     */
    public function ShowStory(){
        try {
            if (request()->isPost()){
                $params = request()->post();
                $storyModel = new StoryModel();
                $field = $storyModel->alias('s')->field('s.*,m.nickName,m.avatarUrl')
                    ->leftJoin((new MpUserModel())->getTable(). ' m','s.openId = m.openId')
                    ->where(['s.id'=>$params['id']])->find()->toArray();
                if ($field){
                    return json(['code'=>0,'msg'=>'success','data'=>$field]);
                }else{
                    return json(['code'=>-1,'msg'=>'fail']);
                }
            }else{
                return json(['code'=>-1,'msg'=>'请求错误']);
            }
        }catch (\Exception $e){
            return json(['code'=>-1,'msg'=>$e->getMessage()]);
        }
    }
}