<?php
namespace app\common\model;
use think\Model;
class Category extends Model{

    protected $autoWriteTimestamp = true; //写入创建时间戳 或者在配置文件里打开该功能

    public function add($data){
        $data['status'] = 1;
//        $data['create_time'] = time();
        return $this->save($data);
    }

    //选择分类
    public function getNormalFirstCategory(){
        $data = [
            'status' => 1,
            'parent_id' => 0,
        ];
        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)->order($order)->select();
    }

//    生活服务类首页数据展示
    public function getFirstCategorys($parentid = 0){
        $data = [
            'parent_id' => $parentid,
            'status' => ['neq',-1],
        ];

        $order = [
            'listorder' => 'desc',
        ];
        $result = $this->where($data)->order($order)->paginate(10);
//        echo $this->getLastSql(); //输出sql语句
        return $result;
    }


}