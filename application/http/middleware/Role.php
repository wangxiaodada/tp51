<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/20
 * Time: 15:48
 */

namespace app\http\middleware;


use think\Controller;

class Role extends Controller
{
    public function handle($request,\Closure $next)
    {
        if(empty(session("user"))){
            return redirect("error");
        }
        return $next($request);
    }

}