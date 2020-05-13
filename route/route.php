<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

//验证
Route::post("login","admin/Login/login");
//客户前端登录页面显示
Route::get("htmaster","admin/Login/show");
//显示主页面
Route::get("show","admin/Index/index") -> middleware(\app\http\middleware\Login::class);
//注销登录
Route::get("Login/cancellation","admin/Login/cancellation");
//新增员工
Route::post("IndexAdminAll/insertAdmin","admin/IndexAdminAll/insertAdmin") -> middleware(\app\http\middleware\Check::class);

//新增客户
Route::post("IndexUserAll/insertUser","admin/IndexUserAll/insertUser") -> middleware(\app\http\middleware\Check::class);
//生成客户职称认定业绩
Route::post("IndexUserAll/generateAchievement","admin/IndexUserAll/generateAchievement") -> middleware(\app\http\middleware\Check::class);
//删除客户
//Route::post("IndexUserAll/del","admin/IndexUserAll/del") -> middleware(\app\http\middleware\Check::class);
//教育经历里面的上传证书页面打开
Route::get("modal/showUploads/:edu_exp_id","admin/Modal/showUploads");
//上传证书
Route::post("modal/uploads","admin/Modal/uploads");
//删除上传证书
Route::post("modal/delUploads","admin/Modal/delUploads");



//查询客户所有资料
Route::get("showUserAll/:cardid","admin/Api/showUserAll");
//客户登录
Route::post("userLogin","admin/Api/login");
//客户前端登录成功后第一个页面显示
Route::get("userOne","user/Index/one");
//跳转到评审资料预览
Route::get("previewPingshen/:uid","admin/Preview/declarePreview");
//跳转到填写评审资料
Route::get("showWritePingshen","user/Index/showWritePingshen");
//收集职称评审资料
Route::post("pingshen","user/Index/writePingshen");
//跳转到认定信息预览
Route::get("previewRending/:uid","admin/Preview/preview");
//跳转到填写认定信息
Route::get("showWriteRending","user/Index/showWriteRending");
//收集职称认定资料
Route::post("WriteRending","user/Index/writeRending");


return [

];
