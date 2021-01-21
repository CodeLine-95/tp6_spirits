<?php
namespace app\api\model;
use think\Model;

class WechatMpModel extends Model{
    protected $table = 'wechat_mp';

    // 设置字段信息
    protected $schema = [
        'id'             => 'int',
        'appId'          => 'string',
        'appSecret'      => 'string',
        'mpName'         => 'string',
        'mpThumb'        => 'string',
        'createTime'     => 'datetime',
        'status'         => 'int',
        'isUse'          => 'int',
    ];
}