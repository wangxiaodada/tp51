<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/13
 * Time: 11:07
 */

namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;
use think\Db;

class Index extends Controller
{
    //显示主页面
    public function index()
    {
        return $this -> fetch("Index/index");
    }

    //
    public function holle()
    {
        return $this -> fetch("Index/holle");
    }

    public function indexError(){
        return $this -> fetch("Index/indexerror");
    }

    //验证码
    public function verify()
    {
        ob_end_clean();
        $captcha = new Captcha();
        return $captcha->entry();
    }



}