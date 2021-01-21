<?php
namespace app\api\model;

use think\Model;

class MpUserModel extends Model
{
    protected $table = 'mp_user';

    // 设置字段信息
    protected $schema = [
        'id'             => 'int',
        'userId'          => 'string',
        'openId'      => 'string',
        'nickName'         => 'string',
        'gender'        => 'int',
        'avatarUrl'         => 'string',
        'createTime'     => 'datetime'
    ];
}