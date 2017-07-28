<?php
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
    protected $rule = [
        //需要用到验证的字段罗列出来,再使用场景设置分配
        ['name','require|max:10','分类名不能为空|长度不能超过10'],
//        'name' => 'require|min:2|max:10',
        ['parent_id','number','id必须为数字'],
        ['id','number','id必须为数字'],
        ['status','number|in:-1,0,1','状态必须为数字|状态范围不合法'],
        ['listorder','number'],
    ];

//    场景分配$scene固定写法
    protected $scene = [
        'add' => ['name','parent_id'], //为add方法添加验证字段
    ];
}