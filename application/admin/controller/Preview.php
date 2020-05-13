<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2020/3/31
 * Time: 17:40
 */

namespace app\admin\controller;


use function PHPSTORM_META\type;
use think\Controller;
use think\Db;

class Preview extends Controller
{
    //显示职称申报的预览提交
    public function declarePreview($uid)
    {
        //基础信息
        $baseInfo = Db::name("base_info")
            -> alias("a")
            -> field("name,sex,nation,pic,oldname,cardid,homeplace,work_start_time,physicalcondition")
            -> join("tb_users b","a.uid = b.id")
            -> where("a.uid",$uid)
            -> find();
        //生日
        $baseInfo["birthday"] = substr($baseInfo["cardid"],6,4)."年".substr($baseInfo["cardid"],10,2)."月".substr($baseInfo["cardid"],12,2)."日";
        //参加工作时间
        $baseInfo["work_start_time"] =  substr($baseInfo["work_start_time"],0,4)."年".substr($baseInfo["work_start_time"],5,2)."月".substr($baseInfo["work_start_time"],8,2)."日";
        //出生地
        $data_json_region1_string = file_get_contents('../public/static/admin/json/region1.json');
        $data_json_region1 = json_decode($data_json_region1_string,true);
        $data_json_region2_string = file_get_contents('../public/static/admin/json/region2.json');
        $data_json_region2 = json_decode($data_json_region2_string,true);
        $homeplace = explode(",",$baseInfo["homeplace"]);
        if(count($homeplace) >= 2){
            $num = 0;
            foreach($data_json_region1 as $v){
                if($v["id"] == $homeplace[0]){
                    $str = $v["name"];
                    $num++;
                }
            }
            foreach($data_json_region2 as $v){
                if($v["id"] == $homeplace[1]){
                    $str .= $v["name"];
                    $num++;
                }
            }
            if($num > 0){
                $baseInfo["homeplace"] = $str;
            }

        }
        $this -> assign("baseInfo",$baseInfo);

        //最高学历和所有学历
        $maxeducation = Db::name("edu_exp")
            -> where("uid",$uid)
            -> max("education");
        $education = Db::name("edu_exp")
            -> alias("a")
            -> join("tb_education b","a.education = b.id")
            -> where("uid",$uid)
            -> where("education",$maxeducation)
            -> find();
        $alleducation = Db::name("edu_exp")
            -> alias("a")
            -> join("tb_education b","a.education = b.id")
            -> where("uid",$uid)
            -> select();
        $education["gra_time"] = isset($education["gra_time"]) ? substr($education["gra_time"],0,4)."年".substr($education["gra_time"],5,2)."月".substr($education["gra_time"],8,2)."日" : "";
        $education["gra_colleges"] = isset($education["gra_colleges"])? $education["gra_colleges"] == "其他院校名称" ? $education["gra_colleges"] : $education["other_colleges"] : "";
        $education["major"] = isset($education["major"])? $education["major"] == "其他专业" ? $education["major"] : $education["othermajor"] : "";
        $this -> assign("education",$education);
        $this -> assign("alleducation",$alleducation);

        //现有职称证书
        $pic = Db::name("pic")
            -> where("uid",$uid)
            -> where("type","现有职称证书")
            -> find();
        $this -> assign("pic",$pic);

        //工作单位
        $work_units = Db::name("work_units")
            -> where("uid",$uid)
            -> find();
        $this -> assign("work_units",$work_units);

        //现任专业职务技术信息
        $now_position = Db::name("now_position")
            -> where("uid",$uid)
            ->find();
        //现任专业技术职务
        $data_json_xrzyjszwxl_string = file_get_contents('../public/static/admin/json/xrzyjszwxl.json');
        $data_json_xrzyjszwxl = json_decode($data_json_xrzyjszwxl_string,true);
        foreach($data_json_xrzyjszwxl as $v){
            if($v["id"] == $now_position["now_duty_series"]){
                $now_position["now_duty_series"] = $v["name"];
                foreach($v["position"] as $k){
                    if($k["id"] == $now_position["now_job"]){
                        $now_position["now_job"] = $k["name"];
                    }
                }
            }
        }
        $now_position["now_job_time"] = substr($now_position["now_job_time"],0,4)."年".substr($now_position["now_job_time"],5,2)."月".substr($now_position["now_job_time"],8,2)."日";
        $this -> assign("now_position",$now_position);

        //职称申报信息
        $job_declare = Db::name("job_declare")
            -> field("name as nowJobName,declaration_job_name,approval_office,duties_and_time,communist_job,other_party_job_time,academic_organization_job_time,language_level")
            -> join("tb_achievement_type","tb_achievement_type.id = tb_job_declare.declaration_profession")
            -> where("uid",$uid)
            -> find();
        $this -> assign("job_declare",$job_declare);

        //学习培训经历
        $study_exp = Db::name("study_exp")
            -> where("uid",$uid)
            -> select();
        $this -> assign("study_exp",$study_exp);

        //工作经历
        $work_exp = Db::name("work_exp")
            -> where("uid",$uid)
            -> select();
        $this -> assign("work_exp",$work_exp);

        //任现职前主要专业技术工作业绩
        $past_results = Db::name("past_results")
            -> where("uid",$uid)
            -> select();
        $this -> assign("past_results",$past_results);

        //任现职后主要专业技术工作业绩
        $now_results = Db::name("now_results")
            -> where("uid",$uid)
            -> select();
        $this -> assign("now_results",$now_results);

        //著作、论文及重要技术报告登记
        $report = Db::name("report")
            -> where("uid",$uid)
            -> where("isdel",0)
            -> select();
        $this -> assign("report",$report);

        //职称考试及考核情况
        $exam = Db::name("exam")
            -> where("uid",$uid)
            -> select();
        $this -> assign("exam",$exam);

        return $this -> fetch("Preview/userInfo_pingshen");
    }

    //显示职称认定的预览提交
    public function preview()
    {
        $uid =  input("uid");
        //基本信息
        $baseInfo = Db::name("ptr_base_info")
            -> alias("a")
            -> join("tb_users b","a.uid = b.id")
            -> join("tb_base_info d","b.id = d.uid")
            -> field("workunit,name,afpatps,jobtitle,sex,cardid,pic,homeplace,nation,politicaloutlook,wages,physicalcondition,language_level,socialappointments,speciality")
            -> where("b.id",$uid)
            -> find();
        if(!isset($baseInfo)){
//            $this -> assign("url","Modal/showProTitleRecBaseInfo");
            return $this -> error("请将职称认定基本信息填写并保存后重试","Modal/showProTitleRecBaseInfo?id=".$uid,"1");
//            return $this -> redirect("Modal/showProTitleRecBaseInfo",["id" => $uid],"1",["aa" => 22]);
        }

        //拟聘职务
        $data_json_xrzyjszwxl_string = file_get_contents('../public/static/admin/json/xrzyjszwxl.json');
        $data_json_xrzyjszwxl = json_decode($data_json_xrzyjszwxl_string,true);
        foreach($data_json_xrzyjszwxl as $v){
            if($v["id"] == $baseInfo["afpatps"]){
                foreach($v["position"] as $k){
                    if($k["id"] == $baseInfo["jobtitle"]){
                        $baseInfo["jobtitle"] = $k["name"];
                    }
                }
            }
        }
        //生日
        $baseInfo["birthday"] = substr($baseInfo["cardid"],6,4)."年".substr($baseInfo["cardid"],10,2)."月".substr($baseInfo["cardid"],12,2)."日";
        //出生地
        $data_json_region1_string = file_get_contents('../public/static/admin/json/region1.json');
        $data_json_region1 = json_decode($data_json_region1_string,true);
        $data_json_region2_string = file_get_contents('../public/static/admin/json/region2.json');
        $data_json_region2 = json_decode($data_json_region2_string,true);
        $homeplace = explode(",",$baseInfo["homeplace"]);
        if(count($homeplace) > 2){
            foreach($data_json_region1 as $v){
                if($v["id"] == $homeplace[0]){
                    $str = $v["name"];
                }
            }
            foreach($data_json_region2 as $v){
                if($v["id"] == $homeplace[1]){
                    $str .= $v["name"];
                }
            }
            $baseInfo["homeplace"] = $str;
        }
        $this -> assign("baseInfo",$baseInfo);

        //申报材料
        $ptr_pic = Db::name("ptr_pic")
            -> where("uid",$uid)
            -> select();
        $this -> assign("ptr_pic",$ptr_pic);

        //最高学历和所有学历
        $maxeducation = Db::name("edu_exp")
            -> where("uid",$uid)
            -> max("education");
        $education = Db::name("edu_exp")
            -> alias("a")
            -> join("tb_education b","a.education = b.id")
            -> where("uid",$uid)
            -> where("education",$maxeducation)
            -> find();
        $alleducation = Db::name("edu_exp")
            -> alias("a")
            -> join("tb_education b","a.education = b.id")
            -> where("uid",$uid)
            -> select();

        $education["gra_time"] = isset($education["gra_time"]) ? substr($education["gra_time"],0,4)."年".substr($education["gra_time"],5,2)."月".substr($education["gra_time"],8,2)."日" : "";
        $education["gra_colleges"] = isset($education["gra_colleges"])? $education["gra_colleges"] == "其他院校名称" ? $education["gra_colleges"] : $education["other_colleges"] : "";
        $education["major"] = isset($education["major"])? $education["major"] == "其他专业" ? $education["major"] : $education["othermajor"] : "";
        $this -> assign("education",$education);
        $this -> assign("alleducation",$alleducation);

        //见习工作情况
        $ptr_probation_work_ituation = Db::name("ptr_probation_work_ituation")
            -> where("uid",$uid)
            -> select();
        $this -> assign("ptr_probation_work_ituation",$ptr_probation_work_ituation);

        //
        $ptr_summary = Db::name("ptr_summary")
            -> where("uid",$uid)
            -> find();

        $ptr_summary["main_achievements"] = explode(";",$ptr_summary["main_achievements"]);
        $this -> assign("ptr_summary",$ptr_summary);
        return $this -> fetch("Preview/userInfo_rending");
    }
}