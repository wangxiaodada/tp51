<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2019/12/13
 * Time: 11:58
 */

namespace app\admin\controller;

use think\Controller;
use think\Db;

class IndexUserAll extends Controller
{
    //这个控制器都使用Check中间件
    protected $middleware = ["Check"];

    /*
     * $condition 模糊搜索的字段
     * $name 模糊搜索的条件
     * 显示所有客户信息*/
    public function index()
    {
        $condition = input("condition");
        $name = input("name");
        $data = Db::name("users")
            -> alias("a")
            -> field("a.id as userid,a.name as username,phone,nick_name,cardid,paid_expenses,unpaid_expenses")
            -> join("tb_base_info b","b.uid = a.id")
            -> join ("tb_admin c","c.id = a.admin_id");
        if(session("admin")["admin_role_id"] != 1){
            $data = $data -> where("admin_id",session("admin")["id"]);
        }
        //是否提交条件
        if(!empty($condition)){
            if($condition == "unpaid_expenses"){
                if($name){
                    $data = $data -> where("$condition","eq",0);
                }else{
                    $data = $data -> where("$condition","gt",0);
                }
            }else{
                $data = $data -> where($condition,"like","%".$name."%");
            }
            $this -> assign("name",$name);
        }else{
            $condition = "";
        }
        $data = $data -> order("a.id","desc") -> where("a.isdel",0)  -> paginate(15);
        $this -> assign("condition",$condition);
        $this -> assign("data",$data);
        //显示所有的附件
        $pic = [];
        foreach($data as $k => $v){
            $temp = Db::name("pic")
                -> where("uid",$v["userid"])
                -> select();
            if (count($temp)){
                $pic[$v["userid"]] = $temp;
            }
        }
        $this -> assign("pic",$pic);

        //显示新增模态框中所有的行业、专业
        $achievement_type = Db::name("achievement_type")
            -> where("parent_id",0)
            -> select();
        $all_type = Db::name("achievement_type")
            -> select();
        $this -> assign("achievement_type",$achievement_type);
        $this -> assign("all_type",json_encode($all_type));

        $data_post= Db::name("admin")
            -> alias("a")
            -> join("tb_admin_post b","a.id=b.admin_id")
            -> where("post_id",3)
            -> select();
        $this -> assign("data_post",$data_post);

        return $this -> fetch("Index/User/all");
    }

    //查询行业
    public function selAllType()
    {
        $parent_id = input("type_id");
        $data = Db::name("achievement_type")
            -> where("parent_id",$parent_id)
            -> select();
        return $data;
    }

    //查询客户的附件
    public function selectEnclosure(){
        $data = Db::name("pic")
            -> where("uid",input("uid"))
            -> select();
        return $data;
    }

    //上传附件
    public function uploadEnclosure()
    {
        $file = request()->file('');
        if(!empty($file)){
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file['file']->move('./uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $pic = "/uploads/".$info->getSaveName();
                //将图片路径保存到数据库
            }
        }
        $arr = [
            "uid" => input("uid"),
            "src" => $pic,
            "type" => "附件"
        ];
        $id = Db::name("pic")
            -> insertGetId($arr);
        return $id;
    }

    //删除附件
    public function deleteEnclosure()
    {
        $imgurl = Db::name("pic")
            -> where("pic_id",input("id"))
            -> value("src");
        $url=$_SERVER["DOCUMENT_ROOT"].$imgurl;
        unlink($url);
        $i = Db::name("pic")
            -> where("pic_id",input("id"))
            -> delete();
        return $i;
    }

    //新增用户信息
    public function insertUser()
    {
        $sex = substr(input("cardid"),strlen(input("cardid"))-2,1);
        $arr = [
            "cardid" => input("cardid"),
            "name" => input("khname"),
            "sex" => ($sex%2) != 0 ? "男" : "女",
            "admin_id" => !empty(input("admin_id")) ? input("admin_id") == "" ? session("admin")["id"] : input("admin_id") : session("admin")["id"],
            "paid_expenses" => input("paid_expenses"),
            "unpaid_expenses" => input("unpaid_expenses")
        ];
        $phone = input("phone");
        foreach (input() as $k => $v){
            if($k != "admin_id") {
                if ($v == "") {
                    $null[$k] = $v;
                }
            }
        }
        if($phone == ""){
            $null["phone"] = "";
        }
        if(!empty($null)){
            return [
                "code" => 201,
                "null" => $null
            ];
        }

        $data = Db::name("users")
            -> where("cardid",input("cardid"))
            -> find();
        if($data != ""){
            return [
                "code" => 202,
                "error" => "已存在的客户"
            ];
        }

        //添加这个客户
        $i = Db::name("users")
            -> insertGetId($arr);
        //往基础信息表中添加信息
        Db::name("base_info")
            -> insert(["uid" => $i,"phone" => $phone]);
        //添加客户的专业
        $tb_job_declare_data = [
            "uid" => $i,
            "accreditation_unit" => input("accreditation_unit"),
            "declaration_profession" => input("declaration_profession")
        ];
        $k = Db::name("job_declare")
            -> insert($tb_job_declare_data);
        return [
            "code" => 200,
            "i" => $k
        ];
    }

    //删除客户
    public function del(){
        $id = input("id");
        $i = Db::name("users")
            -> delete($id);

        //基本信息
        Db::name("base_info")
            -> where("uid",$id)
            -> delete();
        //教育经历
        $edu_exp = Db::name("edu_exp")
            -> where("uid",$id)
            -> select();
        Db::name("edu_exp")
            -> where("uid",$id)
            -> delete();
        //教育经历证书
        foreach ($edu_exp as $v){
            Db::name("education_pic")
                -> where("edu_exp_id",$v["tb_ee_id"])
                -> delete();
        }
        //
        Db::name("work_nuits")
            -> where("uid",$id)
            -> delete();
        Db::name("now_position")
            -> where("uid",$id)
            -> delete();
        Db::name("job_declare")
            -> where("uid",$id)
            -> delete();
        //申报材料以及附件
        Db::name("pic")
            -> where("uid",$id)
            -> delete();
        //学习培训经历
        Db::name("study_exp")
            -> where("uid",$id)
            -> delete();
        //任现职前主要专业技术工作业绩
        Db::name("past_results")
            -> where("uid",$id)
            -> delete();
        //任现职后主要专业技术工作业绩
        Db::name("now_results")
            -> where("uid",$id)
            -> delete();
        //著作、论文及重要技术报告登记
        Db::name("report")
            -> where("uid",$id)
            -> delete();
        //职称考试及考核情况
        Db::name("exam")
            -> where("uid",$id)
            -> delete();
        //认定基本
        Db::name("ptr_base_info")
            -> where("uid",$id)
            -> delete();
        //认定基本
        Db::name("ptr_base_info")
            -> where("uid",$id)
            -> delete();
        //认定基本
        Db::name("ptr_base_info")
            -> where("uid",$id)
            -> delete();
        //认定基本
        Db::name("ptr_pic")
            -> where("uid",$id)
            -> delete();
        //认定基本
        Db::name("ptr_probation_work_ituation")
            -> where("uid",$id)
            -> delete();
        //认定基本
        Db::name("ptr_summary")
            -> where("uid",$id)
            -> delete();

        return $i;
    }

    //修改缴费情况
    public function updatePay(){
//        return input();
        $paid_expenses = input("updatePaidExpenses");
        $unpaid_expenses = input("updateUnPaidExpenses");
        $arr = [
            "paid_expenses" => $paid_expenses,
            "unpaid_expenses" => $unpaid_expenses,
            "id" => input("userid")
        ];
        $data = Db::name("users")
            -> update($arr);
        return $data;
    }

    //获取用户的专业
    public function getAchievementid(){

        $userid = input("userid");  //客户id
        //获取需要生成业绩的人的专业
        $declaration_profession = $this -> getUserDeclarationProfession($userid);
        if($declaration_profession["declaration_profession"] == null){
            return [
                "code" => "202",
                "error" => "该客户尚未选择申报专业"
            ];
        }

        $data = Db::name("achievement")
            -> where("type_id",$declaration_profession["declaration_profession"])
            -> select();
        if(count($data) > 0){
            $num = count($data) >= 6 ? 6 :count($data);
            for( $i = 0 ; $i < $num ; $i++ ) {
                $rand = mt_rand(0,count($data));
                $arr [] = $data[$rand];
            }
            return [
                "code" => 200,
                "data" => $arr
            ];
        }else{
            return [
                "code" => 200,
                "data" => null
            ];
        }
    }

    //获取需要生成业绩的人的专业
    public function getUserDeclarationProfession($userid){
        $data = Db::name("job_declare")
            -> field("declaration_profession")
            -> where("uid",$userid)
            -> find();
        return $data;
    }

    //筛选业绩
    public function screeAchievement()
    {
        $userid = input("uid");
        $screeachievement = input("screeachievement");
        $screecontent = input("screecontent");
        $declaration_profession = $this -> getUserDeclarationProfession($userid);
        if($declaration_profession["declaration_profession"] == null){
            return [
                "code" => "202",
                "error" => "该客户尚未选择申报专业"
            ];
        }
        $data = Db::name("achievement")
            -> where($screeachievement,"like","%".$screecontent."%")
            -> where("type_id",$declaration_profession["declaration_profession"])
            -> select();
        return $data;
    }

    //查询工作经历
    private function work_exp($uid)
    {
        $data = Db::name("work_exp")
            -> where("uid",$uid)
            -> group("start_time","desc")
            -> select();
        return $data;
    }

    //插入任职前业绩数据
    public function insertGenerateAchievementPast()
    {
        $a = 0;
        $uid = input("uid");//用户的id
        $ids = input("ids");//所有要添加到客户业绩中的业绩id
        //查询客户的参加工作时间
        $work_start_time = Db::name("base_info")
            -> where("uid",$uid)
            -> value("work_start_time");
        //查询客户的所属地区
        $region = Db::name("work_units")
            -> where("uid",$uid)
            -> value("region");
        if($region == null){
            return [
                "code" => 2,
                "error" => "请选择客户所在地区"
            ];
        }
        return [
            "a" => $uid,
            "work_exp" => self::work_exp($uid)
        ];
        //根据提交过来的ids查询到所有要插入的业绩
        foreach($ids as $v){
            $temp = Db::name("achievement")
                -> where("id",$v)
                -> find();
            $start_time = date("Y-m-d",strtotime($work_start_time."+".rand(100,365)."day"));  //工作开始时间后随机100~365天后作为第一条添加业绩的开始时间
            $end_time = date("Y-m-d",strtotime($start_time."+".ceil($temp["time"]*30)."day"));
            $achievement = [
                "uid" => $uid,
                "start_time" => $start_time,
                "end_time" => $end_time,
                "technical_work" => $temp["technical_work"],
                "work_content" => $temp["work_content"],
                "ompletion_effect" => $temp["ompletion_effect"],
                "achievement_id" => $temp["id"]
            ];
            $work_start_time = $end_time; //此条业绩的完成时间作为下一条业绩的开始时间
            //往任职前主要业绩表中添加数据
//            $i = Db::name("past_results")
//                -> insert($achievement);
            //客户添加业绩时修改业绩的使用次数，以及在该客户所在地区此条业绩的使用次数
//            if($i > 0){
//                $i += self::updateAchievementNum($region,$v);
//            }
            $a++;
        }
        return [
            "code" => 1,
            "info" => "已经为您成功生成了选中的".$a."条业绩",
            'data' => $achievement
        ];
    }

    //插入任职后业绩数据
    public function insertGenerateAchievementNow()
    {
        $a = 0;
        $uid = input("uid");//用户的id
        $ids = input("ids");//所有要添加到客户业绩中的业绩id
        //查询客户的现任专业技术职务的任职时间
        $time = Db::name("now_position")
            -> where("uid",$uid)
            ->find()["now_job_time"];
        //查询客户的所属地区
        $region = Db::name("work_units")
            -> where("uid",$uid)
            -> find()["region"];
        if($region == null){
            return [
                "code" => 2,
                "error" => "请选择客户所在地区"
            ];
        }
        //根据提交过来的ids查询到所有要插入的业绩
        foreach($ids as $v){
            $temp = Db::name("achievement")
                -> where("id",$v)
                -> find();
            $start_time = date("Y-m-d",strtotime($time."+".rand(100,130)."day"));  //现任专业技术职务的任职时间后随机60~100天后作为第一条添加业绩的开始时间
            $end_time = date("Y-m-d",strtotime($start_time."+".ceil($temp["time"]*30)."day"));
            $achievement = [
                "uid" => $uid,
                "start_time" => $start_time,
                "end_time" => $end_time,
                "technical_work" => $temp["technical_work"],
                "work_content" => $temp["work_content"],
                "ompletion_effect" => $temp["ompletion_effect"],
                "achievement_id" => $temp["id"]
            ];
            $time = $end_time; //此条业绩的完成时间作为下一条业绩的开始时间
            //往任职后主要业绩表中添加数据
            $i = Db::name("now_results")
                -> insert($achievement);
            //客户添加业绩时修改业绩的使用次数，以及在该客户所在地区此条业绩的使用次数
            if($i > 0){
                $i += self::updateAchievementNum($region,$v);
            }
            $a++;
        }
        return [
            "code" => 1,
            "info" => "已经为您成功生成了选中的".$a."条业绩"
        ];
    }

    //插入认定业绩
    public function insertGenerateAchievementPtrSummary()
    {
        $uid = input("uid");//用户的id
        $ids = input("ids");//所有要添加到客户业绩中的业绩id

        //查询客户的所属地区
        $ptr_base_info = Db::name("ptr_base_info")
            -> where("uid",$uid)
            -> find();
        $region = $ptr_base_info["region"];
        $time = $ptr_base_info["now_job_time"];
        if($region == null){
            return [
                "code" => 2,
                "error" => "请选择客户所属地区"
            ];
        }
        //根据提交过来的ids查询到所有要插入的业绩
        $main_achievements = "";
        foreach($ids as $v){
            $temp = Db::name("achievement")
                -> where("id",$v)
                -> find();
            $start_time = (string)date("Y-m-d",strtotime($time."+".rand(100,130)."day"));  //毕业时间后随机60~100天后作为第一条添加业绩的开始时间
            $end_time = (string)date("Y-m-d",strtotime($start_time."+".ceil($temp["time"]*30)."day"));
            //拼接业绩
            $main_achievements .= substr($start_time,0,4)."年".substr($start_time,5,2)."月".substr($start_time,8,2)."日"."至".substr($end_time,0,4)."年".substr($end_time,5,2)."月".substr($end_time,8,2)."日".",".$temp["technical_work"].$temp["work_content"].$temp["ompletion_effect"].";\n";
            $time = $end_time; //此条业绩的完成时间作为下一条业绩的开始时间
        }
        $ptr_summary_data = [
            "uid" => $uid,
            "main_achievements" => $main_achievements
        ];
        $ptr_summary = Db::name("ptr_summary")
            -> where("uid",$uid)
            -> find();
        //往认定见习期主要工作业绩及奖惩情况中添加数据
        if(count($ptr_summary) == 0){
            $i = Db::name("ptr_summary")
                -> insert($ptr_summary_data);
        }else{
            $i = Db::name("ptr_summary")
                -> update($ptr_summary_data);
        }
        //客户添加业绩时修改业绩的使用次数，以及在该客户所在地区此条业绩的使用次数
        if($i > 0){
            foreach($ids as $v) {
                $i += self::updateAchievementNum($region,$v);
            }
        }
        return [
            "code" => 1,
            "info" => "已经为您成功生成了选中的".count($ids)."条业绩"
        ];
    }

    //修改业绩的使用次数
    private function updateAchievementNum($region,$achievement_id)
    {
        $num = Db::name("region_achievement")
            -> where("region_id",$region)
            -> where("achievement_id",$achievement_id)
            -> find();
        if($num == null){
            Db::name("region_achievement")
                -> insert(["region_id" => $region,"achievement_id" => $achievement_id]);
        }else {
            Db::name("region_achievement")
                -> where("region_id", $region)
                -> where("achievement_id", $achievement_id)
                -> setInc("useituation");
        }
        $i = Db::name("achievement")
            ->where("id", $achievement_id)
            ->setInc("frequency");
        return $i;
    }

    //查询客户有多少条业绩
    public function selectAchievement()
    {
        $uid = input("uid");
        $data = Db::name("past_results")
            -> where("uid",$uid)
            -> select();
        return $data;
    }

}