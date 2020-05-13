<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/16
 * Time: 11:05
 */

namespace app\admin\controller;


use function PHPSTORM_META\type;
use think\console\Input;
use think\Controller;
use think\Db;

class Modal extends Controller
{
    protected $middleware = ["Check"];

    //显示模态框的第一个页面（个人基本信息页面）
    public function showBaseInfo()
    {
        $id = input("id");
        $data = Db::name("users")
            -> where("id",$id)
            -> leftJoin("tb_base_info","tb_users.id = tb_base_info.uid")
            -> find();

        /*
         * 所有民族的json数据
         * */
        $data_json_nation_string = file_get_contents('../public/static/admin/json/nation.json');
        $data_json_nation = json_decode($data_json_nation_string,true);
        $this -> assign("data_json_nation",$data_json_nation);
        /*
         * 所有地区(省级)的json数据
         * */
        $data_json_region1_string = file_get_contents('../public/static/admin/json/region1.json');
        $data_json_region1 = json_decode($data_json_region1_string,true);
        $this -> assign("data_json_region1",$data_json_region1);
//        dump($data);

        $this -> assign("uid",$id);
        $this -> assign("data",$data);
        return $this -> fetch("modal/base_info");
    }

    //修改个人基本信息
    public function updBaseInfo()
    {
        $data = [];
        $where = [];
        $sex = "";
        foreach(input() as $k => $v){
            if($k == "sex"){
                $sex = $v;
            }else if($k == "uid"){
                $where[$k] = $v;
            }else if($k != "/admin/modal/updbaseinfo" && $k!= "name"){
                $data[$k] = $v;
            }
        }
        $file = request()->file('');
        if(!empty($file)){
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file['file']->move('./uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $pic = "/uploads/".$info->getSaveName();
                //将图片路径保存到数据库
                $data["pic"] = $pic;
            }
        }
        $m = Db::name("users")
            -> where("id",input("uid"))
            -> update(["name"=>input("name"),"sex" => $sex]);


        $n = Db::name("base_info")
            -> where($where)
            -> update($data);

        if($n > 0 || $m > 0){
            return 1;
        }else{
            return 0;
        }
    }

    //显示模态框第二个页面（教育经历页面）
    public function showEducation()
    {
        $id = input("id");
        $data = Db::name("edu_exp")
            -> where("uid",$id)
            -> join("tb_education","tb_education.id = tb_edu_exp.education")
            -> select();
        $cardid = Db::name("users")
            -> field("cardid")
            -> where("id",$id)
            -> find();
        $this -> assign("data",$data);
        $this -> assign("uid",$id);
        $this -> assign("cardid",$cardid["cardid"]);
        return $this -> fetch("modal/education");
    }

    //（教育经历页面）查询单条数据显示出来
    public function educationShowOne()
    {
        $id = input("id");
        $data = Db::name("edu_exp")
            -> where("tb_ee_id",$id)
            -> find();
        return $data;
    }

    //教育经历上传证书显示
    public function showUploads()
    {
        $edu_exp_id = input("edu_exp_id");
        $this -> assign("edu_exp_id",$edu_exp_id);
        $data = Db::name("education_pic")
            -> where("edu_exp_id",$edu_exp_id)
            -> select();
        $this -> assign("data",$data);
        return $this -> fetch("modal/educationupload");
    }

    //上传证书
    public function uploads()
    {
        $arr = [
            "edu_exp_id" => input("edu_exp_id")
        ];
        $file = request()->file('');
        if(!empty($file)){
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file['file']->move('./uploads');
            if ($info) {
                // 成功上传后 获取上传信息 将图片路径保存到数据库
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $arr["src"] = "/uploads/".$info->getSaveName();
            }
        }
        $data = Db::name("education_pic")
            -> insert($arr);
        return [
            "code" => 1,
            "num" => $data
        ];
    }

    //删除上传的证书
    public function delUploads()
    {
        $edu_pic_id = input("picid");
        $num = Db::name("education_pic")
            -> delete($edu_pic_id);
        return [
            "code" => 1,
            "msg" => $num > 0 ? "删除成功" : "删除失败",
        ];
    }

    //修改或增加教育经历
    public function updEducation()
    {
//        return \input();
        $uid = input("uid");
        $arr = [
            "data" => [],
            "type" => "add",
            "where" => []
        ];
        foreach (input() as $k => $v){
            if($k == "tb_ee_id"){
                $arr["where"][$k] = $v;
            }else if($k != "/admin/modal/updeducation"){
                $arr["data"][$k] = $v;
            }
        }
        $data = Db::name("edu_exp")
            -> where(["uid" => $uid])
            -> where("education",$arr["data"]["education"])
            -> find();

        if($data == ""){
            $arr["data"]["uid"] = $uid;
            $i = Db::name("edu_exp")
                -> insertGetId($arr["data"]);
            $arr["type"] = "add";
            $arr["dada"]["tb_ee_id"] = $i;
        }else{
            $i = Db::name("edu_exp")
                -> where($arr["where"])
                -> update($arr["data"]);
            $arr["type"] = "update";
            array_splice($arr["data"],0,1);
        }
        $arr["data"]["education_name"] = Db::name("education")
        -> where("id",$arr["data"]["education"])
        -> find()["education_name"];
        return $arr;
    }

    //删除教育经历
    public function delEducation()
    {
        $ids = explode(",",input("ids"));
        $i = Db::name("edu_exp")
            -> delete($ids);
        return $i;
    }

    //显示模态框第三个页面（职称评审申请基本信息页面）

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function showAppForAssBaseInfo()
    {
        $id = input("id");

        /*
         * 基本信息
         * */
        $data_userinfo = Db::name("users")
            -> alias("a")
            -> field("cardid,name,oldname,sex,nation,homeplace,work_start_time,physicalcondition,pic")
            -> join("tb_base_info b","a.id = b.uid")
            -> where("a.id",$id)
            -> find();
        $temp = explode(",",$data_userinfo["homeplace"]);
        /*
         * 所有地区的json数据
         * */
        $data_json_region1_string = file_get_contents('../public/static/admin/json/region1.json');
        $data_json_region1 = json_decode($data_json_region1_string,true);
        $data_json_region2_string = file_get_contents('../public/static/admin/json/region2.json');
        $data_json_region2 = json_decode($data_json_region2_string,true);
        if(count($temp) > 1){
            foreach($data_json_region1 as $k => $v){
                if($v["id"] == $temp[0]){
                    $data_userinfo["homeplace"] = $v["name"];
                }
            }
            foreach($data_json_region2 as $k => $v){
                if($v["id"] == $temp[1] && $v["region1_id"] == $temp[0]){
                    $data_userinfo["homeplace"] .= $v["name"];
                }
            }
        }else{
            $data_userinfo["homeplace"] = null;
        }
        $this -> assign("data_userinfo",$data_userinfo);
        /*
         * 最高学历及相关信息
         * */
        $data_education = Db::name("edu_exp")
            -> alias("a")
            -> field("education_name,ed_system,gra_colleges,other_colleges,major,othermajor,gra_time,academicdegree")
            -> where("uid",$id)
            -> join("tb_education b","a.education = b.id")
            -> order("education","desc")
            -> find();
        $this -> assign("data_education",$data_education);


        //显示所有地区
        $data_region = Db::name("region")
            -> select();
        $this -> assign("region",$data_region);

        //职称申请的一些信息
//        $data_other = Db::name("work_units")
//            -> alias("a")
//            -> join("tb_now_position e","e.uid = a.uid")
//            -> join("tb_job_declare f","f.uid = e.uid")
//            -> where("a.uid",$id)
//            -> find();
//        $this -> assign("data_other",$data_other);

        $work_nuits = Db::name("work_units")
            -> where("uid",$id)
            -> find();
        $this -> assign("work_nuits",$work_nuits);

        $now_position = Db::name("now_position")
            -> where("uid",$id)
            -> find();
        $this -> assign("now_position",$now_position);

        $job_declare = Db::name("job_declare")
            -> where("uid",$id)
            -> find();
        $this -> assign("job_declare",$job_declare);

        //评审单位
        $data_accreditation_unit = Db::name("achievement_type")
            -> where("parent_id",0)
            -> select();
        $this -> assign("data_accreditation_unit",$data_accreditation_unit);

        //当该客户的申报专业已经填报时在页面上显示出来
        $declaration_profession = [];
        if($job_declare["accreditation_unit"] != null){
            $declaration_profession =  Db::name("achievement_type")
                -> where("parent_id",$job_declare["accreditation_unit"])
                -> select();
        }
        $this -> assign("declaration_profession",$declaration_profession);

        //当客户的现任专业技术职务名称已经填报时在页面显示出来
        $now_duty_series = [];
        if($now_position["now_duty_series"] != null){
            $data_json_xrzyjszwxl_string = file_get_contents('../public/static/admin/json/xrzyjszwxl.json');
            $data_json_xrzyjszwxl = json_decode($data_json_xrzyjszwxl_string,true);
            foreach($data_json_xrzyjszwxl as $v){
                if($v["id"] == $now_position["now_duty_series"] ){
                    $now_duty_series = $v["position"];
                }
            }
        }
        $this -> assign("now_duty_series",$now_duty_series);

        $this -> assign("uid",$id);
        return $this -> fetch("modal/appforassbaseinfo");
    }

    //评审单位发生改变时查询该单位的专业
    public function selectAchievementType()
    {
        $data = Db::name("achievement_type")
            -> where("parent_id",input("id"))
            -> select();
        return $data;
    }

    //新增或修改（职称申报页面中的工作单位信息）
    public function addOrUpdWorkUnits()
    {
        $uid = input("uid");
        $data = Db::name("work_units")
            -> where("uid",$uid)
            -> find();
        $arr = [
            "uid" => $uid,
            "workunit" => input("workunit"),
            "region" => input("region"),
            "post_type" => input("post_type")
        ];
        if($data == ""){
            $i = Db::name("work_units")
                -> insert($arr);
            $type = "add";
            $num = $i > 0 ? 1 : 2;
        }else{
            $i = Db::name("work_units")
                -> where("uid",$uid)
                -> update($arr);
            $type = "update";
            $num = $i > 0 ? 1 : 2;
        }
        return [
            "code" => $num,
            "type" => $type
        ];
    }

    //新增或修改（职称申报页面中的现任专业技术职务信息）
    public function addOrUpdNowPosition()
    {
        $uid = input("uid");
        $data = Db::name("now_position")
            -> where("uid",$uid)
            -> find();
        $arr = [
            "uid" => $uid,
            "now_duty_series" => input("now_duty_series"),
            "now_job" => input("now_job"),
            "now_job_time" => input("now_job_time")
        ];
        if($data == ""){
            $i = Db::name("now_position")
                -> insert($arr);
            $type = "add";
            $num = $i > 0 ? 1 : 2;
        }else{
            $i = Db::name("now_position")
                -> where("uid",$uid)
                -> update($arr);
            $type = "update";
            $num = $i > 0 ? 1 : 2;
        }
        return [
            "code" => $num,
            "type" => $type
        ];
    }

    //新增或修改（职称申报页面中的职称申报信息）
    public function addOrUpdJobDeclare()
    {
        $uid = input("uid");
        $data = Db::name("job_declare")
            -> where("uid",$uid)
            -> find();
        $arr = [];
        foreach (input() as $k => $v){
            if($k != "/admin/modal/addorupdjobdeclare"){
                $arr[$k] = $v;
            }
        }

        if($data == ""){
            $i = Db::name("job_declare")
                -> insert($arr);
            $type = "add";
            $num = $i > 0 ? 1 : 2;
        }else{
            $i = Db::name("job_declare")
                -> where("uid",$uid)
                -> update($arr);
            $type = "update";
            $num = $i > 0 ? 1 : 2;
        }
        return [
            "code" => $num,
            "type" => $type
        ];
    }

    //显示模态框第四个页面（申报材料上传页面）
    public function showUploadCertificate()
    {
        $id = input("id");
        $data_1 = Db::name("pic")
            -> where("uid",$id)
            -> where("type","营业执照")
            -> find();
        $data_2 = Db::name("pic")
            -> where("uid",$id)
            -> where("type","现有职称证书")
            -> find();
        $this -> assign("data_1",$data_1["src"]);
        $this -> assign("data_2",$data_2["src"]);
        $this -> assign("uid",$id);
        return $this -> fetch("modal/uploadcertificate");
    }

    //上传申报材料（营业执照）
    public function uploadBusinesslicense()
    {

        $arr = [
            "uid" => input("uid"),
            "type" => "营业执照"
        ];
        $data = Db::name("pic")
            -> field("pic_id")
            -> where($arr)
            -> find();
        $file = request()->file('');
        if(!empty($file)){
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file['zc']->move('./uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $pic = "/uploads/".$info->getSaveName();
                //将图片路径保存到数据库
                $arr["src"] = $pic;
            }
        }
        if($data == ""){
            $i = Db::name("pic")
                -> insert($arr);
        }else{
            $i = Db::name("pic")
                -> where($data)
                -> update($arr);
        }
        return $i;
    }

    //上传申报材料（现有职称证书）
    public function uploadCertificate()
    {

        $arr = [
            "uid" => input("uid"),
            "type" => "现有职称证书"
        ];

        $data = Db::name("pic")
            -> field("pic_id")
            -> where($arr)
            -> find();

        $file = request()->file('');
        if(!empty($file)){
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file['zc']->move('./uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $pic = "/uploads/".$info->getSaveName();
                //将图片路径保存到数据库
                $arr["src"] = $pic;
            }
        }
        if($data == ""){
            $i = Db::name("pic")
                -> insert($arr);
        }else{

            $i = Db::name("pic")
                -> where($data)
                -> update($arr);
        }
        return $i;
    }

    //显示模态框第五个页面（学习培训经历页面）
    public function showTrainingExperience()
    {
        $uid = input("id");
        $data = Db::name("study_exp")
            -> where("uid",$uid)
            -> select();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/trainingexperience");
    }

    //新增或修改学习培训经历
    public function addOrUpdTrainingExperience()
    {
        $uid = input("uid");
        $tb_se_id = input("tb_se_id");
        $arr = [
            "start_time" => input("start_time"),
            "end_time" => input("end_time"),
            "witness" => input("witness"),
            "learningplace" => input("learningplace"),
            "major" => input("major"),
            "uid" => $uid
        ];
        $data = [
            "data" => $arr,
            "tb_se_id" => $tb_se_id
        ];
        if($tb_se_id == ""){
            $i = Db::name("study_exp")
                -> insertGetId($arr);
            if($i){
                $data["type"] = "add";
                $data["tb_se_id"] = $i;
            }else{
                $data["type"] = "add error!";
            }
        }else{
            $i = Db::name("study_exp")
                -> where("uid",$uid)
                -> update($arr);
            if($i){
                $data["type"] = "update";
            }else{
                $data["type"] = "update error!";
            }
        }
        return $data;
    }

    //显示单条数据(学习培训经历)
    public function showTrainingExperienceOne()
    {
        $data = Db::name("study_exp")
            -> where("tb_se_id",input("tb_se_id"))
            -> find();
        return $data;
    }

    //删除数据(学习培训经历)
    public function delTrainingExperience()
    {
        $ids = input("ids");
        $i =  Db::name("study_exp")
            -> delete($ids);
        return $i;
    }

    //显示模态框第六个页面（工作经历经历页面）
    public function showWorkExperience()
    {
        $uid = input("id");
        $data = Db::name("work_exp")
            -> where("isdel",0)
            -> where("uid",$uid)
            -> select();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/workexperience");
    }

    //新增或修改工作经历
    public function addOrUpdWorkExperience(){
        $arr = [
            "data" => [],
            "where" => [],
        ];

        $arr["data"] = [
            "workunit" => input("workunit"),
            "start_time" => input("start_time"),
            "end_time" => input("end_time"),
            "professional_work" => input("professional_work"),
            "post" => input("post"),
            "uid" => input("uid")
        ];
        $arr["where"]["tb_we_id"] = input("tb_we_id");

        if($arr["where"]["tb_we_id"] == ""){
            $i= Db::name("work_exp")
                -> insertGetId($arr["data"]);
            $arr["type"] = "add";
            $arr["where"]["tb_we_id"] = $i;
        }else{
            Db::name("work_exp")
                -> where($arr["where"])
                -> update($arr["data"]);
            $arr["type"] = "update";
        }
        return $arr;
    }

    //查询单条数据（工作经历）
    public function showWorkExperienceOne()
    {
        $data = Db::name("work_exp")
            -> field("tb_we_id,start_time,end_time,workunit,professional_work,post")
            -> where("tb_we_id",input("tb_we_id"))
            -> find();
        return $data;
    }

    //删除数据（工作经历）
    public function delWorkExperience()
    {
        $ids = explode(",",input("ids"));
        $i = 0;
        foreach($ids as $k => $v) {
            $i = Db::name("work_exp")
                -> where("tb_we_id", $v)
                -> update(["isdel"=>1]);
        }
        return $i;
    }

    //显示模态框第七个页面（任现职前主要业绩页面）
    public function showOldAchievement()
    {
        $uid = input("id");
        $data = Db::name("past_results")
            -> where("uid",$uid)
            -> order("tb_pr_id")
            -> select();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
//        dump($data);
        return $this -> fetch("modal/oldachievement");
    }

    //修改或添加任现职前主要业绩
    public function addOrUpdOldAchievement()
    {
        $arr = [
            "data" => [],
        ];

        $arr["data"] = [
            "start_time" => input("start_time"),
            "end_time" => input("end_time"),
            "technical_work" => input("technical_work"),
            "work_content" => input("work_content"),
            "ompletion_effect" => input("ompletion_effect"),
            "uid" => input("uid")
        ];
        $arr["where"]["tb_pr_id"] = input("tb_pr_id");

        if($arr["where"]["tb_pr_id"] == ""){
            $arr["data"]["uid"] = input("uid");
            Db::name("past_results")
                -> data($arr["data"])
                -> insert();
            $arr["type"] = "add";
        }else{
            Db::name("past_results")
                -> where($arr["where"])
                -> update($arr["data"]);
            $arr["type"] = "update";
        }
        return $arr;
    }

    //查询单条数据(任现职前主要业绩)
    public function showOldAchievementone()
    {
        $data = Db::name("past_results")
            -> field("tb_pr_id,start_time,end_time,technical_work,work_content,ompletion_effect")
            -> where("tb_pr_id",input("tb_pr_id"))
            -> find();
        return $data;
    }

    //删除数据(任现职前主要业绩)
    public function delOldAchievement(){
        $ids = input("ids");
        $uid = input("uid");
        $i = Db::name("past_results")
            ->delete($ids);
        //该客户所在地区
        $region = Db::name("work_units")
            -> field("region")
            -> where("uid",$uid)
            -> find()["region"];

        $achievementids = explode(",",input("achievementid"));
        foreach($achievementids as $k => $v) {
            if($v != 0){
                Db::name("achievement")
                    -> where("id", $v)
                    ->dec("frequency",1)
                    -> update();
                Db::name("region_achievement")
                    -> where("region_id",$region)
                    -> where("achievement_id",$v)
                    -> dec("useituation",1)
                    -> update();
            }
        }
        return $i;
    }

    //显示模态框第八个页面（任现职后主要业绩页面）
    public function showNewAchievement()
    {
        $uid = input("id");
        $data = Db::name("now_results")
            -> where("uid",$uid)
            -> select();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/newachievement");
    }

    //新增或修改（任现职后主要业绩）
    public function addOrUpdNewAchievement()
    {
        $arr = [];
        $arr["data"] = [
            "start_time" => input("start_time"),
            "end_time" => input("end_time"),
            "technical_work" => input("technical_work"),
            "work_content" => input("work_content"),
            "ompletion_effect" => input("ompletion_effect"),
            "uid" => input("uid")
        ];
        $arr["where"]["tb_nr_id"] = input("tb_nr_id");

        if($arr["where"]["tb_nr_id"] == ""){
            $i = Db::name("now_results")
                -> insertGetId($arr["data"]);
            $arr["type"] = "add";
            $arr["where"]["tb_nr_id"] = $i;
        }else{
            Db::name("now_results")
                -> where($arr["where"])
                -> update($arr["data"]);
            $arr["type"] = "update";
        }
        return $arr;
    }

    //查询单条数据（任现职后主要业绩）
    public function showNewAchievementone()
    {
        $data = Db::name("now_results")
            -> field("tb_nr_id,start_time,end_time,technical_work,work_content,ompletion_effect")
            -> where("tb_nr_id",input("tb_nr_id"))
            -> find();
        return $data;
    }

    //（删除）数据（任现职后主要业绩）
    public function delNewAchievement()
    {
        $ids = input("ids");
        $uid = input("uid");
        $i = Db::name("now_results")
            -> delete($ids);
        //该客户所在地区
        $region = Db::name("work_units")
            -> field("region")
            -> where("uid",$uid)
            -> find()["region"];

        $achievementids = explode(",",input("achievementid"));
        foreach($achievementids as $k => $v) {
            if($v != 0){
                Db::name("achievement")
                    -> where("id", $v)
                    ->dec("frequency",1)
                    -> update();
                Db::name("region_achievement")
                    -> where("region_id",$region)
                    -> where("achievement_id",$v)
                    -> dec("useituation",1)
                    -> update();
            }
        }

        return $i;
    }

    //显示模态框第九个页面（著作、论文及重要技术报告登记页面）
    public function showWorksAndPapers()
    {
        $uid = input("id");
        $data = Db::name("report")
        -> where("isdel",0)
        -> where("uid",$uid)
        -> select();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/workandpapers");
    }

    //新增或修改（著作、论文及重要技术报告登记）
    public function addOrUpdWorksAndPapers()
    {
        $arr = [];

        $arr["data"] = [
            "time" => input("time"),
            "content" => input("content"),
            "com_situation" => input("com_situation"),
            "writing_translation" => input("writing_translation"),
            "uid" => input("uid")
        ];
        $arr["where"]["paper_id"] = input("paper_id");

        if($arr["where"]["paper_id"] == ""){
            $i = Db::name("report")
                -> insertGetId($arr["data"]);
            $arr["where"]["paper_id"] = $i;
            $arr["type"] = "add";
        }else{
            Db::name("report")
                -> where($arr["where"])
                -> update($arr["data"]);
            $arr["type"] = "update";
        }
        return $arr;
    }

    //查询单条数据(著作、论文及重要技术报告登记页面)
    public function showWorksAndPapersone()
    {
        $data = Db::name("report")
            -> field("paper_id,time,content,com_situation,writing_translation")
            -> where("paper_id",input("paper_id"))
            -> find();
        return $data;
    }

    //（删除）数据(著作、论文及重要技术报告登记页面)
    public function delWorksAndPapers()
    {
        $ids = explode(",",input("ids"));
        $i = 0;
        foreach($ids as $k => $v) {
            $i = Db::name("report")
                -> where("paper_id", $v)
                -> update(["isdel"=>1]);
        }
        return $i;
    }

    //显示模态框第十个页面（职称考试及考核情况页面）

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function showAssessmentSituation()
    {
        $uid = input("id");
        $data = Db::name("exam")
            -> where("isdel",0)
            -> where("uid",$uid)
            -> select();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/assessmentsituation");
    }

    //修改或新增数据(职称考试及考核情况)
    public function addOrUpdAssessmentSituation()
    {
        $arr = [
            "data" => [],
            "where" => [
                "exam_id" => ""
            ],
            "type" => "add"
        ];

        $arr["data"] = [
            "time" => input("time"),
            "type" => input("type"),
            "subject" => input("subject"),
            "achievement" => input("achievement"),
            "organization_department" => input("organization_department"),
            "uid" => input("uid")
        ];
        $arr["where"]["exam_id"] = input("exam_id");

        if($arr["where"]["exam_id"] == ""){
            $i = Db::name("exam")
                -> insertGetId($arr["data"]);
            $arr["where"]["exam_id"] = $i;
            $arr["type"] = "add";
        }else{
            Db::name("exam")
                -> where($arr["where"])
                -> update($arr["data"]);
            $arr["type"] = "update";
        }
        return $arr;
    }

    //查询单条数据(职称考试及考核情况)
    public function showAssessmentSituationone()
    {
        $data = Db::name("exam")
            -> field("exam_id,time,type,subject,achievement,organization_department")
            -> where("exam_id",input("exam_id"))
            -> find();
        return $data;
    }

    //删除数据(职称考试及考核情况)
    public function delAssessmentSituation()
    {
        $ids = explode(",",input("ids"));
        $i = 0;
        foreach($ids as $k => $v) {
            $i = Db::name("exam")
                -> where("exam_id", $v)
                -> update(["isdel"=>1]);
        }
        return $i;
    }

    //显示第十一个页面（职称认定基本信息页面）
    public function showProTitleRecBaseInfo()
    {
        $where = [
            "uid" => input("id")
        ];
        $data = Db::name("base_info")
            -> alias("a")
            -> field("cardid,name,sex,oldname,pic,nation,homeplace,work_start_time,physicalcondition")
            -> join("tb_users b","a.uid = b.id")
            -> where($where)
            -> find();
        $temp = explode(",",$data["homeplace"]);
        /*
         * 所有地区的json数据
         * */
        $data_json_region1_string = file_get_contents('../public/static/admin/json/region1.json');
        $data_json_region1 = json_decode($data_json_region1_string,true);
        $data_json_region2_string = file_get_contents('../public/static/admin/json/region2.json');
        $data_json_region2 = json_decode($data_json_region2_string,true);
        if(count($temp) > 1){
            foreach($data_json_region1 as $k => $v){

                if($v["id"] == $temp[0]){
                    $data["homeplace"] = $v["name"];
                }
            }
            foreach($data_json_region2 as $k => $v){
                if($v["id"] == $temp[1] && $v["region1_id"] == $temp[0]){
                    $data["homeplace"] .= $v["name"];
                }
            }
        }else{
            $data["homeplace"] = null;
        }
        $this -> assign("data",$data);

        /*
         * 最高学历
         * */
        $data_edu_exp = Db::name("edu_exp")
            -> field("education,education_name,gra_time,gra_colleges,other_colleges,major,othermajor,ed_system,academicdegree")
            -> join("tb_education","tb_education.id = tb_edu_exp.education")
            -> where($where)
            -> select();
        foreach($data_edu_exp as $k => $v ){
            if($v["education"] == "5") {
                $data_edu_exp = $v;
            }else if($v["education"] == "4") {
                $data_edu_exp = $v;
            }else if($v["education"] == "3") {
                $data_edu_exp = $v;
            }else if($v["education"] == "2") {
                $data_edu_exp = $v;
            }else if($v["education"] == "1") {
                $data_edu_exp = $v;
            }
        };
        $this -> assign("data_edu_exp",$data_edu_exp);

        //职称认定基本信息
        $data_ptr_base_info = Db::name("ptr_base_info")
            -> where($where)
            -> find();
        $this -> assign("data_ptr_base_info",$data_ptr_base_info);


        $data_json_xrzyjszwxl_string = file_get_contents('../public/static/admin/json/xrzyjszwxl.json');
        $data_json_xrzyjszwxl = json_decode($data_json_xrzyjszwxl_string,true);
        //现任专业技术职务名称
        $now_jobs = [];
        foreach($data_json_xrzyjszwxl as $v){
            if($v["id"] == $data_ptr_base_info["now_duty_series"]){
                $now_jobs = $v["position"];
                break;
            }
        }
        $this -> assign("now_jobs",$now_jobs);

        //拟申报职务名称
        $jobtitles = [];
        foreach($data_json_xrzyjszwxl as $v){
            if($v["id"] == $data_ptr_base_info["afpatps"]){
                $jobtitles = $v["position"];
                break;
            }
        }
        $this -> assign("jobtitles",$jobtitles);

        //工作单位信息
        $data_region = Db::name("region")
            -> select();
        $this -> assign("data_region",$data_region);

        $this -> assign("uid",input("id"));

        return $this -> fetch("modal/protitlerecbaseinfo");
    }

    //新增或修改(职称认定基本信息)
    public function addOrUpdProTitleRecBaseInfo()
    {
        $uid = input("uid");
        $arr = [
            "data" => []
        ];
        foreach(input() as $k => $v){
            $arr["data"][$k] = $v;
        }
        $data = Db::name("ptr_base_info")
            -> where("uid",$uid)
            -> find();
        if($data == ""){
            $i = Db::name("ptr_base_info")
                -> data($arr["data"])
                -> insert();
        }else{
            $i = Db::name("ptr_base_info")
                -> where("uid",$uid)
                -> update($arr["data"]);
        }
        return $i;
    }

    //显示第十二个页面（认定材料上传页面）
    public function showProTitleRecIdentifying()
    {
        $uid = input("id");
        $data = Db::name("ptr_pic")
            -> where("uid",$uid)
            -> select();
        $zc = "";
        $zczs = "";
        foreach ($data as $k => $v){
            if($v["type"] == "营业执照"){
                $zc = $v;
            }else if($v["type"] == "其他材料"){
                $zczs = $v;
            }
        }
        $this -> assign("zc",$zc);
        $this -> assign("zczs",$zczs);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/protitlerecidentifyingmaterials");
    }

    //添加或修改认定材料
    public function addOrUpdProTitleRecIdentifying()
    {
        $uid = input("uid");
        $file = request() -> file("");
        if(!empty($file)){
            $info = $file['zc']->move('./uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $pic = "/uploads/".$info->getSaveName();
                //将图片路径保存到数据库
                $arr = [
                    "src" => $pic,
                    "uid" => $uid,
                    "type" => input("type")
                ];
                $data = Db::name("ptr_pic")
                    -> where("uid",$uid)
                    -> where("type",input("type"))
                    -> find();
                if($data != ""){
                    $i = Db::name("ptr_pic")
                        -> where("uid",$uid)
                        -> where("type",input("type"))
                        -> update(["src" => $pic]);
                }else{
                    $i = Db::name("ptr_pic")
                        -> data($arr)
                        -> insert();
                }
            }
        }
        return $i;
    }

    //显示第十三个页面（职称认定的见习工作情况页面）
    public function showProTitleRecProbation()
    {
        $uid = input("id");
        $data = Db::name("ptr_probation_work_ituation")
            -> field("id,start_time,end_time,post,job_content")
            -> where("uid",$uid)
            -> where("isdel",0)
            -> select();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/protitlerecprobationwork");
    }

    //新增或修改（职称认定的见习工作情况)
    public function addOrUpdProTitleRecProbation()
    {
        $arr = [];
        $uid = input("uid");
        $arr["data"] = [
            "start_time" => input("start_time"),
            "end_time" => input("end_time"),
            "post" => input("post"),
            "job_content" => input("job_content"),
            "uid" => $uid,
        ];
        $arr["where"]["id"] = input("id");

        if($arr["where"]["id"] != ""){
            Db::name("ptr_probation_work_ituation")
                -> where($arr["where"])
                -> update($arr["data"]);
            $type = "update";
        }else{
            $arr["data"]["uid"] = $uid;
            Db::name("ptr_probation_work_ituation")
                -> data($arr["data"])
                -> insert();
            $type = "add";
        }
        return [
            "code" => 1,
            "type" => $type,
            "data" => $arr["data"],
            "id" => input("id"),
            "a" => \input()
        ];
    }

    //查询单条数据（职称认定的见习工作情况)
    public function showProTitleRecProbationone()
    {
        $data = Db::name("ptr_probation_work_ituation")
            -> field("id,start_time,end_time,post,job_content")
            -> where("id",input("id"))
            -> where("isdel",0)
            -> find();
        return $data;
    }

    //（删除）数据（职称认定的见习工作情况)
    public function delProTitleRecProbation()
    {
        $ids = explode(",",input("ids"));
        $i = 0;
        foreach ($ids as $v){
            $i = Db::name("ptr_probation_work_ituation")
                -> where("id",$v)
                -> update(["isdel" => 1]);
        }
        return $i;
    }

    //显示第十四个页面（职称认定的见习工作总结页面）
    public function showProTitleRecSummary()
    {
        $uid = input("id");
        $data = Db::name("ptr_summary")
            -> where("uid",$uid)
            -> find();
        $this -> assign("data",$data);
        $this -> assign("uid",$uid);
        return $this -> fetch("modal/protitlerecsummary");
    }

    //新增或修改见习工作总结
    public function addOrUpdProTitleRecSummary()
    {
        $uid = input("uid");
        $main_achievements = input("main_achievements");
        $summary_of_work = input("summary_of_work");
        $arr = [
            "main_achievements" => $main_achievements,
            "summary_of_work" => $summary_of_work
        ];
        $data = Db::name("ptr_summary")
            -> where("uid",$uid)
            -> find();
        if($data == ""){
            $arr["uid"] = $uid;
            Db::name("ptr_summary")
                -> data($arr)
                -> insert();
            $type = "add";
        }else{
            Db::name("ptr_summary")
                -> where("uid",$uid)
                -> update($arr);
            $type = "update";
        }
        return $type;
    }

}