<?php
namespace app\Admin\Controller;
use think\Controller;
class Category extends Controller
{
//    初始化常用的
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Category');
    }

    public function index(){
        //获取首页数据
        $parentid = input('get.parent_id',0,'intval');//首页获取子级栏目
       $categorys = $this->obj->getFirstCategorys($parentid);
        return $this->fetch('',[
            'categorys' => $categorys,
        ]);
    }

//    添加
    public function add(){
        $categorys = $this->obj->getNormalFirstCategory();
//        print_r($categorys);exit;
        return $this->fetch('',[
            'categorys' => $categorys,
        ]);
    }

//    添加分类
    public function save(){
//        var_dump(input('post.')); var_dump(request()->post);
//严格逻辑
        if(!request()->isPost()){
            $this->error('获取失败');
        }
        $data = input('post.');
//        $data['status'] = 1; 测试验证
        $validate = validate('Category');//助手函数实例化验证器
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }

        //更新分类 分类id比为空时
        if(!empty($data['id'])){
             return $this->update($data);
        }

//        添加分类
        $res = $this->obj->add($data);
        if($res){
            $this->success('新增成功!');
        }else{
            $this->error('新增失败');
        }
    }

//    编译
    public function edit($id){
        $category = $this->obj->get($id); //get方法 获取所有信息 id必须为主键ID
        $categorys = $this->obj->getNormalFirstCategory(); //获取父类

        return $this->fetch('',[
            'category' => $category,
            'categorys' => $categorys,
        ]);
    }

    public function update($data){
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
//        $resif = $res ? "更新成功" : "更新失败";
        if($res){
            $this->success("更新成功");
        }else{
            $this->error("更新失败");
        }

    }

}