<?php

namespace app\http\middleware;

use think\Controller;
use think\Db;
use think\Error;
use think\facade\Request;

class Check extends Controller
{
    public function handle($request, \Closure $next)
    {
        if(empty(session("admin"))){
           return $this -> error("请登录后重试","Login/login");
        }

        //获取当前模块名
        $module = request()->module();
        //获取当前控制器名
        $controller = request()->controller();
        //获取当前方法名
        $action=request()->action();
        $url = $module."/".$controller."/".$action;

        //查询是否自定义了权限
        $data = Db::name("admin_role")
            -> where("admin_id",session("admin")["id"])
            -> select();
        if(count($data) > 0){
            $data = Db::name("admin_role")
                -> alias("a")
                -> join("tb_role b","a.role_id = b.id")
                -> where("admin_id",session("admin")["id"])
                -> where("b.function",$url)
                -> find();
        }else{
            //查询岗位表，管理员表，权限表判断是否具有权限
            $data =  Db::name("admin_post")
                -> alias("a")
                -> join("tb_post_role b","a.post_id = b.post_id")
                -> join("tb_role c","b.role_id = c.id")
                -> where("admin_id",session("admin")["id"])
                -> where("function",$url)
                -> find();
        }
        if($data == null){
            if(Request::isGet()) {
                return redirect("Index/indexerror");
            }else{
                return $this -> error("没有权限","");
            }
        }
        return $next($request);
    }
}
