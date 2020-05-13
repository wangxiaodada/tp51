<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/13
 * Time: 10:37
 */
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Login extends Controller
{
    //显示登录页面
    public function show()
    {
        return $this -> fetch("Login/login");
    }

    //验证
    public function login()
    {
        $name = input("name");
        $password = input("password");
        $yzm = input("yzm");
        $error = "";
        $data = Db::name("admin")
            -> where("name",$name)
            ->find();
        if($data != ""){
            if($data["password"] == md5($password)){
                if(!captcha_check($yzm))
                {
                    $error = "验证码错误";
                }else {
                    //存session
                    session("admin", $data);
                    $post = Db::name("admin_post")
                        -> where("admin_id",$data["id"])
                        -> find();
                    session("post", $post);
                }
            }else{
                $error = "密码错误";
            }
        }else{
            $error = "账户不存在";
        }
        return $error;
    }

    //退出登录
    public function cancellation()
    {
        session("admin","");
        $login = new Login();
        return $login -> show();
    }



}