<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/13
 * Time: 14:48
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class IndexAdminJurisdiction extends Controller
{

    //显示权限管理页面
    public function index()
    {
        $data = Db::name("post")
            -> select();
        $role = Db::name("role")
            -> order("id","asc")
            -> select();
        $this -> assign("data",$data);
        $this -> assign("role",$role);
        $this -> assign("countRole",count($role));
        return $this -> fetch("Index/Admin/jurisdiction");
    }

    //添加新岗位
    public function insertPost()
    {
        $name = input("post_name");
        $arr = [];
        $post_id = Db::name("post")
            -> insertGetId(["name" => $name]);
        $ids = explode(",",input("ids"));
        foreach ($ids as $k => $v){
            $temp = [
                "post_id" => $post_id,
                "role_id" => $v
            ];
            $arr["data"][] = $temp;
        }
        $i = Db::name("post_role")
            -> insertAll($arr["data"]);
        return $i;
    }

    //修改岗位
    public function updatePost()
    {
        $arr = [];
        $ids = explode(",",input("ids"));
        foreach ($ids as $k => $v){
            $temp = [
                "post_id" => input("post_id"),
                "role_id" => $v
            ];
            $arr["data"][] = $temp;
        }
        Db::name("post_role")
            -> where("post_id",input("post_id"))
            -> delete();
        $i = Db::name("post_role")
            -> insertAll($arr["data"]);
        return $i;
    }

    //查看某个岗位具有的权限
    public function selectRole()
    {
        $data = Db::name("post_role")
            -> alias("a")
            -> join("tb_role b","a.role_id = b.id")
            -> where("a.post_id",input("post_id"))
            -> select();
        $data["a"] = input();
        return $data;
    }

    //删除
    public function deletePost()
    {
        $i = Db::name("post")
            -> where("id",input("post_id"))
            -> delete();
        if($i){
            $i = Db::name("post_role")
                -> where("post_id",input("post_id"))
                -> delete();
        }else{
            return 222;
        }
        return $i;
    }
}