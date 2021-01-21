<?php
namespace app\api\model;
use think\Model;

class StoryModel extends Model{
    protected $table = 'story';
    protected $json = ['picList'];
}