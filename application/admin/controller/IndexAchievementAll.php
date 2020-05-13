<?php

namespace app\admin\controller;


use think\Controller;
use think\Db;
use PHPExcel;
use PHPExcel_IOFactorye;

class IndexAchievementAll extends Controller
{
    //显示所有的业绩
    public function index()
    {
        $time = input("time");
        $data = Db::name("achievement")
            -> alias("a")
            -> field("time,name,technical_work,work_content,ompletion_effect,a.id")
            -> join("tb_achievement_type b","a.type_id = b.id");
        $num = [
            "零" => 0,
            "一" => 1,
            "壹" => 1,
            "二" => 2,
            "两" => 2,
            "贰" => 2,
            "三" => 3,
            "叁" => 3,
            "四" => 4,
            "肆" => 4,
            "五" => 5,
            "伍" => 5,
            "六" => 6,
            "陆" => 6,
            "七" => 7,
            "柒" => 7,
            "八" => 8,
            "捌" => 8,
            "九" => 9,
            "玖" => 9,
        ];
        if(!empty($time)){
            $this -> assign("time",$time);
            $time = mb_substr($time,0,1,"utf-8");
            foreach ($num as $k => $v ){
//                dump($k."-".$v);
                if($time == $k){
                    $time = $v;
                }
            }
            $data = $data -> where("time","gt",$time)
                          -> where("time","<",$time+1);
        }

        $data = $data -> where("isdel",0) -> paginate(10);
        $this -> assign("data",$data);

        //查询所有地区
        $data_region = Db::name("region")
            -> select();
        $this -> assign("data_region",$data_region);
        return $this -> fetch("Index/Achievement/all");
    }

    //查询单条业绩得详细信息
    public function showAchievementone()
    {
        $id = input("id");
        $data = Db::name("achievement")
            -> alias("a")
            -> field("a.id,time,name,technical_work,work_content,ompletion_effect,frequency")
            -> join("tb_achievement_type b","b.id = a.type_id")
            -> where("a.id",$id)
            -> find();
        return $data;
    }

    //查询某条业绩在某个地区的使用情况
    public function useSituation()
    {
        $region_id = input("region_id");
        $achievement_id = input("achievement_id");
        $data = Db::name("region_achievement")
            -> field("name,useituation")
            -> join("tb_region","tb_region.id = tb_region_achievement.region_id")
            -> where([
                "region_id" => $region_id,
                "achievement_id" => $achievement_id
            ])
            -> find();
        if($data == ""){
            $data["name"] = Db::name("region")
                -> where("id",$region_id)
                -> find()["name"];

            $data["useituation"] = 0;
        }
        return $data;
    }

    //跳转到新增业绩页面
    public function showInsertAchievement($parent_id = 0)
    {
        $data = Db::name("achievement_type")
            -> select();
        $this -> assign("data",$this -> allChildren($data,$parent_id));
//        dump($this -> allChildren($data,$parent_id));
        return $this -> fetch("Index/Achievement/insert");
    }

    //递归得到无限级分类树
    private function allChildren($data,$parent_id)
    {
        $arr = [];
        foreach($data as $k => $v){
            if($v["parent_id"] == $parent_id){
                $v["children"] = $this -> allChildren($data,$v["id"]);
                if ($v['children'] == null){
                    unset($v['children']);
                }
                $arr[] = $v;
            }
        }
        return $arr;
    }

    //查询下级
    public function selectNext()
    {
        $data = Db::name("achievement_type")
            -> where("parent_id",input("type_id"))
            -> select();
        return $data;
    }

    //添加业绩
    public function insertAchievement()
    {
        $arr = [
            "data" => [],
        ];
        $arr["data"] = [
            "time" => input("time"),
            "type_id" => input("type_id"),
            "technical_work" => input("technical_work"),
            "work_content" => input("work_content"),
            "ompletion_effect" => input("ompletion_effect")
        ];
        $i = Db::name("achievement")
            -> data($arr["data"])
            -> insert();
        return $i;
    }

    //删除业绩
    public function deleteAchievement()
    {
        $i = Db::name("region_achievement")
            -> where("achievement_id",input("id"))
            -> delete();
        $i = Db::name("achievement")
            -> where("id",input("id"))
            -> delete();
        return $i;
    }


}