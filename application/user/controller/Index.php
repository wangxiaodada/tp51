<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2020/4/7
 * Time: 17:34
 */

namespace app\user\controller;


use think\Controller;
use think\Db;

class Index extends Controller
{
    //显示登录页面
    public function index()
    {
        return $this -> fetch("Index/index");
    }

    //显示第一个页面
    public function one()
    {
        return $this -> fetch("html/info");
    }

    //跳转到填写评审信息
    public function showWritePingshen()
    {
        return $this -> fetch("html/pingshen");
    }

    //收集评审信息
    public function writePingshen()
    {
//        return input();
        $file = request()->file('');
        if(!empty($file)){
            foreach ($file as $k => $v){
                // 移动到框架应用根目录/uploads/ 目录下
                $info = $v->move('./uploads/');
                if ($info) {
                    // 成功上传后 获取上传信息
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $pic[$k] = "/uploads/".$info->getSaveName();   //file01(现有职称证书)  file02(寸照)
                    //将图片路径保存到数据库
                }
            }
        }

        $uid = session("user01")["id"];
        $temp = Db::name("users")
            -> where("id",$uid)
            -> find();
        if($temp["useriswritepingshen"] > 0){
            return [
                "code" => 2,
                "info" => "已经填写过了"
            ];
        }

        $pic_data = [
            "uid" => $uid,
            "src" => $pic["file01"],
            "type" => "现有职称证书"
        ];
        Db::name("pic")
            -> insert($pic_data);

        //基础信息
        $baseinfo = [
            "nation" => input("nation"),
            "oldname" => input("oldname"),
            "homeplace" => input("homeplace"),
            "physicalcondition" => input("physicalcondition"),
            "work_start_time" => input("work_start_time"),
            "pic" => $pic["file02"]
        ];

        Db::name("base_info")
            -> where("uid",$uid)
            -> update($baseinfo);


        //学历
        $edu_exp = [
            "uid" => $uid,
            "education" => input("education"),
            "gra_time" => input("gra_time"),
            "gra_colleges" => input("gra_colleges"),
            "major" => input("major"),
            "ed_system" => input("ed_system"),
            "academicdegree" => input("academicdegree")

        ];
        Db::name("edu_exp")
            -> insert($edu_exp);

        $now_position = [
            "uid" => $uid,
            "now_job" => input("now_job"),
            "now_job_time" => input("now_job_time")
        ];
        Db::name("now_position")
            -> insert($now_position);

        $job_declare = [
            "approval_office" => input("approval_office"),
            "duties_and_time" => input("duties_and_time"),
            "communist_job" => input("communist_job"),
            "other_party_job_time" => input("other_party_job_time"),
            "academic_organization_job_time" => input("academic_organization_job_time"),
            "language_level" => input("language_level")
        ];
        Db::name("job_declare")
            -> where("uid",$uid)
            -> fetchSql()
            -> update($job_declare);

        $study_exp = [];
        foreach(json_decode(input("study_exp")) as $v){
            $temp = [
                "uid" => $uid
            ];
            foreach ($v as $m => $n){
                $temp[$m] = $n;
            }
            $study_exp[] = $temp;
        }
        Db::name("study_exp")
            -> insertAll($study_exp);

        $work_exp = [];
        foreach(json_decode(input("work_exp")) as $v){
            $temp = [
                "uid" => $uid
            ];
            foreach ($v as $m => $n){
                $temp[$m] = $n;
            }
            $work_exp[] = $temp;
        }
        Db::name("work_exp")
            -> insertAll($work_exp);

        $past_results = [];
        foreach(json_decode(input("past_results")) as $v){
            $temp = [
                "uid" => $uid
            ];
            foreach ($v as $m => $n){
                $temp[$m] = $n;
            }
            $past_results[] = $temp;
        }
        Db::name("past_results")
            -> insertAll($past_results);

        $now_results = [];
        foreach(json_decode(input("now_results")) as $v){
            $temp = [
                "uid" => $uid
            ];
            foreach ($v as $m => $n){
                $temp[$m] = $n;
            }
            $now_results[] = $temp;
        }
        Db::name("now_results")
            -> insertAll($now_results);

        $now_results = [];
        foreach(json_decode(input("now_results")) as $v){
            $temp = [
                "uid" => $uid
            ];
            foreach ($v as $m => $n){
                $temp[$m] = $n;
            }
            $now_results[] = $temp;
        }
        Db::name("now_results")
            -> insertAll($now_results);

        $report = [];
        foreach(json_decode(input("report")) as $v){
            $temp = [
                "uid" => $uid
            ];
            foreach ($v as $m => $n){
                $temp[$m] = $n;
            }
            $report[] = $temp;
        }
        Db::name("report")
            -> insertAll($report);

        $exam = [];
        foreach(json_decode(input("exam")) as $v){
            $temp = [
                "uid" => $uid
            ];
            foreach ($v as $m => $n){
                $temp[$m] = $n;
            }
            $exam[] = $temp;
        }
        Db::name("exam")
            -> insertAll($exam);

        Db::name("users")
            ->where('id', $uid)
            ->setInc('useriswritepingshen',1);

        return [
            "code" => 1
        ];
    }

    //跳转填到认定信息填写页面
    public function showWriteRending()
    {
        return $this -> fetch("html/rending");
    }


    //收集认定信息
    public function writeRending()
    {

        $file = request()->file('');
        if(!empty($file)){
            foreach ($file as $k => $v){
                // 移动到框架应用根目录/uploads/ 目录下
                $info = $v->move('./uploads/');
                if ($info) {
                    // 成功上传后 获取上传信息
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $pic[$k] = "/uploads/".$info->getSaveName();   //file01(营业执照)  file02(其他材料)  file03(寸照)
                    //将图片路径保存到数据库
                }
            }
        }

        $uid = session("user01")["id"];

        $temp = Db::name("users")
            -> where("id",$uid)
            -> find();
        if($temp["useriswriterending"] > 0){
            return [
                "code" => 2,
                "info" => "已经填写过了"
            ];
        }

        $baseInfo = [
            "uid" => $uid,
            "homeplace" => input("homeplace"),
            "nation" => input("nation"),
            "politicaloutlook" => input("politicaloutlook"),
            "wages" => input("wages"),
            "physicalcondition" => input("physicalcondition"),
            "pic" => $pic["file03"]
        ];
        Db::name("base_info")
            -> where("uid",$uid)
            -> update($baseInfo);

        $ptr_base_info = [
            "language_level" => input("language_level"),
            "socialappointments" => input("socialappointments"),
            "speciality" => input("speciality")
        ];
        Db::name("ptr_base_info")
            -> where("uid",$uid)
            -> update($ptr_base_info);

        $edu_exp = [];
        foreach(json_decode(input("edu_exp")) as $v){
            foreach ($v as $m => $n){
                $edu_exp[$m] = $n;
            }
            $edu_exp["uid"] = $uid;
            Db::name("edu_exp")
                -> insert($edu_exp);
        }

        $ptr_pic = [
            [
                "src" => $pic["file01"],
                "type" => "营业执照"
            ],[
                "src" => $pic["file02"],
                "type" => "其他材料"
            ]
        ];
        Db::name("ptr_pic")
            ->insertAll($ptr_pic);

        $ptr_probation_work_ituation = [];
        foreach(json_decode(input("probation_work_ituation")) as $v){
            foreach ($v as $m => $n){
                $ptr_probation_work_ituation[$m] = $n;
            }
            $ptr_probation_work_ituation["uid"] = $uid;
            Db::name("ptr_probation_work_ituation")
                -> insert($ptr_probation_work_ituation);
        }

        $ptr_summary = [
            "uid" => $uid,
            "main_achievements" => input("main_achievements"),
            "summary_of_work" => input("summary_of_work")
        ];
        Db::name("ptr_summary")
            -> insert($ptr_summary);

        Db::name("users")
            ->where('id', $uid)
            ->setInc('useriswriterending');

        return [
            "code" => 1
        ];
    }
}