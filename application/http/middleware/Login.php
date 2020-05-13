<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2020/5/8
 * Time: 15:16
 */

namespace app\http\middleware;


use think\Controller;

class Login extends Controller
{
    public function handle($request, \Closure $next)
    {
//        dump(session("admin"));
        if(empty(session("admin"))){
            return $this -> error("请登录后重试","/htmaster");
        }
        return $next($request);
    }
}