<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/30
 * Time: 14:53
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class IndexAdminAchievementType extends Controller
{
    private static $parents = array();
    //显示业绩分类管理页面
    public function showAchievementType($parent_id = 0)
    {
        $data = Db::name("achievement_type")
            -> where("parent_id",$parent_id)
            -> order("id")
            -> paginate(10,false,['query' => request()->param()]);
        $this -> assign("data",$data);
        $this -> assign("parent_id",$parent_id);
        $arr = Db::name("achievement_type")
            -> order("id")
            -> select();
        $this -> selectParents($arr,$parent_id);
        $this -> assign("parents",array_reverse(self::$parents));
        $alldata = Db::name("achievement_type")
            -> where("parent_id",$parent_id)
            -> order("id")
            -> select();
        $this -> assign("alldata",$alldata);
        return $this -> fetch("Index/Admin/achievementtype");
    }

    //查询上级目录
    public function selectParents($data = [],$parent_id = 0)
    {
        foreach($data as $k => $v){
            if($v["id"] == $parent_id){
                array_push(self::$parents,$v);
//                dump(self::$parents);
                $this -> selectParents($data,$v["parent_id"]);
            }
        }
    }

    //查询下一级
    public function selectNext()
    {
        $parent_id = input("parent_id");
        $data = Db::name("achievement_type")
            -> where("parent_id",$parent_id)
            -> order("id asc")
            -> select();
        return $data;
    }

    //保存新的业绩分类
    public function preservation()
    {
        $data =  [
            "parent_id" => input("parent_id"),
            "name" => input("name")
        ];
        $i = Db::name("achievement_type")
            -> insertGetId($data);
        return $i;
    }

    //显示单条业绩类别信息
    public function showAchievementTypeOne()
    {
        $arr = Db::name("achievement_type")
            -> select();
        $this -> parent($arr,input("id"));
        $data = [
            0 => array_reverse(self::$parent),
            1 => array_reverse(self::$borther),
        ];
        return $data;
    }

    private static $parent = array();
    private static $borther = array();
    //递归查询父级
    private function parent($data,$parent_id)
    {
//        $temp[] = [];
        foreach($data as $k => $v){
            if($parent_id == $v["id"]){
                foreach($data as $m => $n) {
                    if($v["parent_id"] == $n["parent_id"]){
                        $temp[] = $n;
                    }
                }
                self::$borther[] = $temp;
                array_push(self::$parent,$v);
                if($v["parent_id"] == 0){
                    break;
                }else{
                    $this -> parent($data,$v["parent_id"]);
                }
            }
        }
    }

    //删除业绩分类
    public function del()
    {
        $data = Db::name("achievement_type")
            -> select();
        self::getNextId($data,input("id"));
        array_push(self::$children,(int)input("id"));
        $i = Db::name("achievement_type")
            -> delete(self::$children);
        return [
            "code" => 1, //状态码
            "num"  => $i, //删除的数量
            "dataId" => self::$children //删除的数据的id
        ];
    }
    private static $children = [];  //所有的下级分类的id
    //查询所有的下级分类id
    private function getNextId($data,$id = 0)
    {
        foreach ($data as $k => $v){
            if($v["parent_id"] == $id){
                array_push(self::$children,$v["id"]);
                self::getNextId($data,$v["id"]);
            }
        }
    }
}