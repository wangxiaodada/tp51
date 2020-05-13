<?php
/**
 * Created by PhpStorm.
 * User: 16665
 * Date: 2020/3/26
 * Time: 16:48
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\Validate;
use think\facade\Config;



class Api extends Controller
{
    //获取用户所有数据
    public function showUserAll($cardid)
    {
        //客户的基本信息
        $users = Db::name("users")
            -> where("cardid",$cardid)
            -> find();
        $where = ["uid" => $users["id"]];

        //客户基本信息
        $base_info = Db::name("base_info")
            -> where($where)
            -> find();

        //教育经历
        $education = Db::name("edu_exp")
            ->alias("a")
            -> leftJoin("education_pic b","a.tb_ee_id = b.edu_exp_id")
            -> join("tb_education c","a.education = c.id")
            -> where($where)
            -> select();

        //工作单位信息
        $work_units = Db::name("work_units")
            -> where($where)
            -> find();

        //现任专业技术职务信息
        $now_position = Db::name("now_position")
            -> where($where)
            -> find();

        //客户的职称申报信息
        $job_declare = Db::name("job_declare")
            -> where($where)
            -> find();

        //申报材料
        $pic = Db::name("pic")
            -> where($where)
            ->select();

        //学习培训经历
        $study_exp = Db::name("study_exp")
            -> where($where)
            -> select();

        //工作经历
        $work_exp = Db::name("work_exp")
            -> where($where)
            -> select();

        //任现职前主要专业技术工作业绩
        $past_results = Db::name("past_results")
            -> where($where)
            -> select();

        //任现职后主要专业技术工作业绩
        $now_results = Db::name("now_results")
            -> where($where)
            -> select();

        //著作、论文及重要技术报告登记
        $report = Db::name("report")
            -> where($where)
            -> select();

        //职称考试及考核情况
        $exam = Db::name("exam")
            -> where($where)
            -> select();

        //认定基本信息
        $ptr_base_info = Db::name("ptr_base_info")
            -> where($where)
            -> find();

        //认定的所需图片
        $ptr_pic = Db::name("ptr_pic")
            -> where($where)
            -> select();

        //认定的见习工作情况
        $ptr_probation_work_ituation = Db::name("ptr_probation_work_ituation")
            -> where($where)
            -> select();

        //认定的见习工作总结
        $ptr_summary = Db::name("ptr_summary")
            -> where($where)
            -> find();

        return json([
                "users" => $users,
                "base_info" => $base_info,
                "education" =>$education,
                "work_units" => $work_units,
                "now_position" => $now_position,
                "job_declare" => $job_declare,
                "pic" => $pic,
                "study_exp" => $study_exp,
                "work_exp" => $work_exp,
                "past_results" => $past_results,
                "now_results" => $now_results,
                "report" => $report,
                "exam" => $exam,
                "ptr_base_info" => $ptr_base_info,
                "ptr_pic" => $ptr_pic,
                "ptr_probation_work_ituation" => $ptr_probation_work_ituation,
                "ptr_summary" => $ptr_summary
            ]);

    }

    //登录
    public function login()
    {
        $cardid = input("cardid");
        $password = input('password');
        $data = Db::name("users")
            ->where("cardid", $cardid)
            ->find();
//        return json(["bool" => is_array($data)]);
        if (is_array($data)) {
            if (count($data) == 0) {
                return json(["error" => "用户不存在","code" => 3]);
            } else {
                if ($password != $data["password_1"]) {
                    return json(["error" => "密码错误","code" => 2]);
                } else {
                    session("user01",$data);
                    return json(["error" => null,"code" => 1]);
                }
            }
        } else {
            return json(["error" => "用户不存在","code" => 3]);
        }
    }

    // 设置能访问收集表单的域名
    static public $originarr = [
        'http://collect.com:990',
        'http://locahost',
        'http://127.0.0.1'
    ];
    //单独的表单收集
    public function collect()
    {
        // 获取当前跨域域名
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        if (in_array($origin, self::$originarr)) {
            // 允许 $originarr 数组内的 域名跨域访问
            header('Access-Control-Allow-Origin:' . $origin);
            // 响应类型
            header('Access-Control-Allow-Methods:POST,GET');
            // 带 cookie 的跨域访问
            header('Access-Control-Allow-Credentials: true');
            // 响应头设置
            header('Access-Control-Allow-Headers:x-requested-with,Content-Type,X-CSRF-Token');
        }
        $tables = $this -> selTable();
        $sub_str01 = $tables[count($tables)-1]["table_name"];
        $strpos_str01 = strpos($sub_str01,"_");
        $tablename = ($strpos_str01 != false ? substr($sub_str01,0,$strpos_str01+1).(substr($sub_str01,$strpos_str01+1,strlen($sub_str01)-$strpos_str01)+1) : $sub_str01."_1");
        foreach ( $tables as $v ){
            $tables_data = Db::query("SHOW FULL COLUMNS FROM ".$v["table_name"]);
            $temp = [];
            foreach ( $tables_data as $k ){
               $temp[] = $k["Field"];
            }

            if(count($temp)-1 == count(input())){
                $num = 0;
                foreach( $temp as $m ){
                    if($m == "id"){
                        continue;
                    }
                    foreach(input() as $n => $i){
                        if($m == $n){
                            $num += 1;
                        }
                        $bb[]= $n;
                    }
                }
                if($num == count(input())){
                    $tablename = $v["table_name"];
                    $zd[$v["table_name"]] = $temp;
                    break;
                }
            }
        }
        $data = input();
        unset($data['hash']);
//        $rule = [
//            'name' => 'require|max:20|token:hash'
//        ];
//        $message =[
//            'name.require' => "名称不能为空",
//            'name.max' => "不能超过20个字符"
//        ];
//        $check = new Validate($rule,$message);
//        if(!$check -> check(["name" => input("name"),"hash" => input("hash")])){
//            return json([
//                "code" => 3,
//                "error" => $check -> getError() == "令牌数据无效" ? "请勿重复提交" : $check -> getError()
//            ]);
//        };
        $table = "`id` int(11) NOT NULL AUTO_INCREMENT,";
        foreach ($data as $k => $v){
            $table .= $k." varchar(255) not null,";
        }
        $table.="PRIMARY KEY (`id`)";
        $this -> createTable($tablename,$table);
        $num = Db::table($tablename)
            -> insert($data);
        $code = $num > 0 ? 1 : 2;
        $arr = [
            "code" => $code,
            "data" => input(),
        ];
        return json($arr);
    }

    //新增数据表
    public function createTable($tablename,$table){
        $sql = "CREATE TABLE IF NOT EXISTS `".$tablename."`(".$table.")
        ENGINE=InnoDB
        DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
        CHECKSUM=0
        ROW_FORMAT=DYNAMIC
        DELAY_KEY_WRITE=0";
        Db::execute($sql);
    }

    //查询数据库有多少自定义的表
    public function selTable()
    {
        $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema='".Config::get('database.database')."' AND table_type='base table' AND TABLE_NAME LIKE 'collect%'";
        return Db::query($sql);
    }

}