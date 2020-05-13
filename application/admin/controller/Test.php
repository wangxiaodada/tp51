<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2020/5/11
 * Time: 16:17
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Test extends Controller
{
    public function test()
    {
        $message="删除失败";
        $imgurl=Db::name('pic')->where('pic_id',66)->value('src');
//        return $imgurl;
        if (empty($imgurl)) {
            # code...
        } else{
            $url=$_SERVER["DOCUMENT_ROOT"].$imgurl;
            // halt($url);
//            return $url;
            unlink($url);
            $message="已删除";
//            if(model('Imgfile')->destroy($id)){
//                unlink($url);
//                $message="已删除";
////            }
        }
        return $message;
    }

    public function ss(){
        $data = Db::name("pic")
            -> where("uid",1)
            -> select();
        return $data;
    }

}