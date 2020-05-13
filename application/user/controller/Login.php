<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2020/4/7
 * Time: 15:25
 */

namespace app\user\controller;


use think\Controller;

class Login extends Controller
{
    public function login()
    {
        return $this -> fetch("Index/index");
    }
}