<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/13
 * Time: 14:45
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class IndexAdminAll extends Controller
{
    //显示所有管理员
    public function index()
    {
        $data = Db::name("admin")
            -> alias("a")
            -> field("a.id,a.name as 'admin_name',nick_name,c.name AS 'post_name',c.id AS 'post_id'")
            -> join("admin_post b ","a.id = b.admin_id")
            -> join("post c ","c.id = b.post_id")
            -> group("a.id","desc")
            -> select();
        $this -> assign("data",$data);

        //所有权限
        $data_role = Db::name("role")
            -> order("id","asc")
            -> select();
        $this -> assign("data_role",$data_role);

        $post = Db::name("post")
            -> select();
        $this -> assign("post",$post);
        $this -> assign("data",$data);
        $this -> assign("countRole",count($data_role));
        return $this -> fetch("Index/Admin/all");
    }

    //查看员工具有的权限
    public function selectRole(){
        $id = input("id");

        $data["data"] = Db::name("admin_role")
            -> alias("a")
            -> join("tb_role b","a.role_id = b.id")
            -> where("a.admin_id",$id)
            -> select();
        if(!count($data["data"])){
            $data["data"] = Db::name("admin")
                -> alias("a")
                -> field("d.id")
                -> join("tb_admin_post b","a.id = b.admin_id")
                -> join("tb_post_role c","b.post_id = c.post_id")
                -> join("tb_role d","d.id = c.role_id")
                -> where("a.id","$id")
                -> select();
        }
        $data["nick_name"] = Db::name("admin")
            -> where("id",$id)
            -> find()["nick_name"];
        return $data;
    }

    //添加或修改员工
    public function insertAdmin()
    {
        $arr = [
            "name" => input("name"),
            "nick_name" => input("admin_name"),
            "password" => md5(input("password"))
        ];
        $i = Db::name("admin")
            -> insertGetId($arr);
        $data = Db::name("admin_post")
            -> insert(["admin_id" => $i,"post_id"=>input("post_id")]);
        return $data;
    }

    //自定义权限
    public function storageNewRole()
    {
        $arr = explode(",",input("ids"));
        $data = [];
        foreach($arr as $k => $v){
            $tamp = [
                "admin_id" => input("id"),
                "role_id" => $v
            ];
            $data[] = $tamp;
        }
        Db::name("admin_role")
            -> where(["admin_id" => input("id")])
            -> delete();
        $i = Db::name("admin_role")
            -> insertAll($data);
        return $i;
    }

    //删除员工
    public function del()
    {
        $id = input("id");
        Db::name("admin_post")
            -> delete(["admin_id"=>$id]);

        $i = Db::name("admin")
            -> delete(["id"=>$id]);

        return $i;
    }

    /*
     * 修改岗位
     * */
    public function updatePost()
    {
        $admin_id = input("admin_id");
        $post_id = input("post_id");
        $i = Db::name("admin_post")
            -> where("admin_id",$admin_id)
            -> update(["post_id" => $post_id]);
        return $i;
    }

    /**
     * 修改密码
     */
    public function updatePwd()
    {
        $id = input("id");
        $pwd01 = input("pwd01");
        $pwd02 = input("pwd02");
        if($pwd01 != "" && $pwd02 != "" && $pwd01 != null && $pwd02 != null){
            if($pwd01 == $pwd02){
                $pwd = Db::name("admin")
                    -> where("id",$id)
                    -> value("password");
                if($pwd != md5($pwd01)){
                    Db::name("admin")
                        -> where("id",$id)
                        -> update(["password" => md5($pwd01)]);
                    $code = 1;
                    $msg = "修改完成";
                }else{
                    $code = 2;
                    $msg = "新旧密码相同";
                }
            }else{
                $code = 2;
                $msg = "两次输入密码不相同";
            }
        }else{
            $code = 2;
            $msg = "两次密码不能为空";
        }
        return json([
            "code" => $code,
            "msg" => $msg
        ]);
    }
}