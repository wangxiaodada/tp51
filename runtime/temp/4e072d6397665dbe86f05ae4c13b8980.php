<?php /*a:1:{s:72:"E:\phpStudy\WWW\tp51\application\admin\view\modal\appforassbaseinfo.html";i:1589204408;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>职称评审基本信息</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/user/css/all.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<script type="text/javascript">
    function declaration_job_name(data) {
        var str = "";
        switch(data){
            case "正高级工程师" :
                str = "高级";
                break;
            case "高级工程师" :
                str = "副高级";
                break;
            case "工程师" :
                str = "中级";
                break;
            case "助理工程师" :
                str = "初级";
                break;
            case "技术员" :
                str = "员级";
                break;
            default:
                break;
        }
        $("[name=declaration_job_name]").parent().next().next().children("input:text").val(str);
    }
</script>
<body style="min-width: 1000px;">
<div style="width: 1170px">
    <form id="myform" >
        <h5>个人基础信息</h5>
        <table >
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>证件编号：</td>
                <td style="width: 200px"><input name="gj" readonly class="form-control" type="text" value="<?php echo htmlentities($data_userinfo['cardid']); ?>"></td>
                <td style="width: 120px"><span style="color: red">* </span>姓名：</td>
                <td style="width: 200px"><input name="idcard" readonly class="form-control"  type="text" value="<?php echo htmlentities($data_userinfo['name']); ?>"></td>
                <td style="width: 120px">曾用名：</td>
                <td style="width: 200px"><input name="idcard" readonly class="form-control"  type="text" value="<?php echo htmlentities((isset($data_userinfo['oldname']) && ($data_userinfo['oldname'] !== '')?$data_userinfo['oldname']:'')); ?>"></td>
                <td style="width: 200px" rowspan="4">
                    <div style="width: 120px;height: 150px;margin: auto">
                        <img width="120px" height="150px" src="<?php echo htmlentities((isset($data_userinfo['pic']) && ($data_userinfo['pic'] !== '')?$data_userinfo['pic']:'/static/user/img/camera.png')); ?>" alt="">
                    </div>
                </td>
            </tr>
            <tr>
                <td>性别：</td>
                <td><input class="form-control" readonly name="sex" type="text" value="<?php echo htmlentities((isset($data_userinfo['sex']) && ($data_userinfo['sex'] !== '')?$data_userinfo['sex']:'')); ?>"></td>
                <td>民族：</td>
                <td><input class="form-control" readonly name="nation" type="text" value="<?php echo htmlentities((isset($data_userinfo['nation']) && ($data_userinfo['nation'] !== '')?$data_userinfo['nation']:'')); ?>"></td>
                <td>出生地：</td>
                <td><input class="form-control" readonly name="homeplace" type="text" value="<?php echo htmlentities((isset($data_userinfo['homeplace']) && ($data_userinfo['homeplace'] !== '')?$data_userinfo['homeplace']:'')); ?>" ></td>
            </tr>
            <tr>
                <td>出生日期：</td>
                <td><input class="form-control" readonly name="birthday" type="text" value=""></td>
                <td>参加工作日期：</td>
                <td><input class="form-control" readonly name="work_start_time" type="text" value="<?php echo htmlentities((isset($data_userinfo['work_start_time']) && ($data_userinfo['work_start_time'] !== '')?$data_userinfo['work_start_time']:'')); ?>"></td>
                <td>身体状况：</td>
                <td><input class="form-control" readonly name="physicalcondition" type="text" value="<?php echo htmlentities((isset($data_userinfo['physicalcondition']) && ($data_userinfo['physicalcondition'] !== '')?$data_userinfo['physicalcondition']:'')); ?>"></td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>最高学历：</td>
                <td><input class="form-control" readonly type="text" name="education_name" value="<?php echo htmlentities((isset($data_education['education_name']) && ($data_education['education_name'] !== '')?$data_education['education_name']:'')); ?>"></td>
                <td><span style="color: red">* </span>毕业时间：</td>
                <td><input class="form-control" readonly name="gra_time" type="text" value="<?php echo htmlentities((isset($data_education['gra_time']) && ($data_education['gra_time'] !== '')?$data_education['gra_time']:'')); ?>"></td>
                <td><span style="color: red">* </span>毕业院校：</td>
                <td><input class="form-control" readonly type="text" name="gra_colleges" value="<?php echo $data_education['gra_colleges']=='其他院校名称' ? htmlentities($data_education['other_colleges']) : htmlentities((isset($data_education['gra_colleges']) && ($data_education['gra_colleges'] !== '')?$data_education['gra_colleges']:'')); ?>"></td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>专业：</td>
                <td><input class="form-control" readonly type="text" name="major" value="<?php echo $data_education['major']=='其他专业' ? htmlentities($data_education['othermajor']) : htmlentities((isset($data_education['major']) && ($data_education['major'] !== '')?$data_education['major']:'')); ?>"></td>
                <td><span style="color: red">* </span>学制：</td>
                <td><input class="form-control" readonly name="ed_system" type="text" value="<?php echo htmlentities($data_education['ed_system']); ?>"></td>
                <td><span style="color: red">* </span>学位：</td>
                <td><input class="form-control" readonly type="text" name="academicdegree" value="<?php echo htmlentities($data_education['academicdegree']); ?>"></td>
            </tr>

        </table><br/>
    </form>
    <form action="" id="myform2">
        <h5>工作单位信息</h5>
        <table>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>工作单位：</td>
                <td style="width: 250px;"><input class="form-control" name="workunit" type="text" value="<?php echo htmlentities((isset($work_nuits['workunit']) && ($work_nuits['workunit'] !== '')?$work_nuits['workunit']:'')); ?>"></td>
                <td style="width: 120px;"><span style="color: red">* </span>所属区域：</td>
                <td style="width: 250px;">
                    <select name="region" id="region" value="">
                        <option value=""></option>
                        <?php foreach($region as $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>" py="<?php echo htmlentities($v['py']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>岗位类别：</td>
                <td style="width: 250px;">
                    <select name="post_type">
                    </select>
                </td>
            </tr>
        </table>
    </form><br/>
    <form action="" id="myform3">
        <h5>现任专业技术职务信息</h5>
        <table id="table_3"  >
            <tr>
                <td style="width: 210px;"><span style="color: red">* </span>现任专业技术职务系列 ：</td>
                <td style="width: 200px;">
                    <select name="now_duty_series" >
                        <option value=""></option>
                    </select>
                </td>
                <td style="width: 170px;"><span style="color: red">* </span>现任专业技术职务名称：</td>
                <td style="width: 200px;">
                    <select name="now_job">
                        <?php if(count($now_duty_series) == 0): ?>
                        <option value=""></option>
                        <option value="">暂无可选项</option>
                        <?php else: foreach($now_duty_series as $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>" py="<?php echo htmlentities($v['py']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </td>
                <td style="width: 170px;"><span style="color: red">* </span>现任专业技术职务等级：</td>
                <td style="width: 200px;"><input readonly class="form-control" type="text"></td>
            </tr>
            <tr>
                <td ><span style="color: red">* </span>现任专业技术职务的任职时间 ：</td>
                <td ><input class="form-control" name="now_job_time" type="date" value="<?php echo htmlentities((isset($now_position['now_job_time']) && ($now_position['now_job_time'] !== '')?$now_position['now_job_time']:'')); ?>"></td>
            </tr>
        </table>
    </form>
    <br/>
    <form action="" id="myform4">
        <h5>职称申报信息</h5>
        <table id="table_4" >
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>评审单位：</td>
                <td style="width: 230px;">
                    <select name="accreditation_unit">
                        <option value="">-</option>
                        <?php foreach($data_accreditation_unit as $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>" myid="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>主管单位：</td>
                <td style="width: 190px;" colspan="2">
                    <select name="competent_unit">
                        <option value=""></option>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>申报专业：</td>
                <td style="width: 190px;">
                    <select name="declaration_profession">
                        <?php foreach($declaration_profession as $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>拟申报专业技术职务系列 ：</td>
                <td style="width: 350px;">
                    <select name="declaration_duty_series">
                        <option value=""></option>
                        <option value="工程技术人员">工程技术人员</option>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>拟申报专业技术职务名称 ：</td>
                <td style="width: 300px;" colspan="2">
                    <select name="declaration_job_name">
                        <option value=""></option>
                        <option value="正高级工程师">正高级工程师</option>
                        <option value="高级工程师">高级工程师</option>
                        <option value="工程师">工程师</option>
                        <option value="助理工程师">助理工程师</option>
                        <option value="技术员">技术员</option>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>拟申报专业技术职务等级：</td>
                <td style="width: 300px;"><input class="form-control" readonly type="text"></td>
            </tr>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>专业技术职务任职资格审批机关 ：</td>
                <td colspan="2"><textarea name="approval_office" title="无内容填写时请填写无"  class="form-control-plaintext"></textarea></td>
                <td style="width: 120px;"><span style="color: red">* </span>现（兼）任行政职务及任职时间 ：</td>
                <td colspan="3"><textarea name="duties_and_time" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
            </tr>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>何时加入中国共产党任何职务 ：</td>
                <td colspan="2"><textarea name="communist_job" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
                <td style="width: 120px;"><span style="color: red">* </span>何时何地参加何种民族党派任何职务 ：</td>
                <td colspan="3"><textarea name="other_party_job_time" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
            </tr>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>参加何种学术团体任何种职务有何社会兼职 ：</td>
                <td colspan="2"><textarea name="academic_organization_job_time" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
                <td style="width: 120px;"><span style="color: red">* </span>懂何种外语达到何种程度 ：</td>
                <td colspan="3"><textarea name="language_level" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
            </tr>
        </table>
    </form>
    <div style="height: 54px;margin-top: 20px;">
        <div class="float-right">
            <!--<a href="<?php echo url('Index/index'); ?>"><button class="btn btn-info">编辑</button></a>-->
            <button class="btn btn-info" id="submit_form">保存</button>
            <a href="<?php echo url('Modal/showUploadCertificate'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info" id="next">上传现有职称证书 >></button></a>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {
        $("select").each(function () {
            $(this).addClass("form-control");
        })
        $("#table_2 td input").each(function () {
            $(this).css("height","31px")
        })

        $("textarea").each(function () {
            $(this).css("border","1px solid #ced4da")
            $(this).css("background","white")
        })

        $("#region").val("<?php echo htmlentities($work_nuits['region']); ?>");
        $("#post_type").val("<?php echo htmlentities($work_nuits['post_type']); ?>");

        $("[name=now_duty_series]").val("<?php echo htmlentities($now_position['now_duty_series']); ?>");
        $("[name=now_job]").val("<?php echo htmlentities($now_position['now_job']); ?>");
        //当用户有现任专业技术职务等级时在页面中显示出来
        "<?php foreach($now_duty_series as $v): ?>"
        if("<?php echo htmlentities($v['id'] == $now_position['now_job']); ?>"){
            $('[name=now_job]').parent().next().next().children('input:text').val("<?php echo htmlentities($v['level']); ?>")
        }
        "<?php endforeach; ?>"


        $("[name=accreditation_unit]").val("<?php echo htmlentities($job_declare['accreditation_unit']); ?>");
        $("[name=competent_unit]").val("<?php echo htmlentities($job_declare['competent_unit']); ?>");
        $("[name=declaration_profession]").val("<?php echo htmlentities($job_declare['declaration_profession']); ?>");
        $("[name=declaration_duty_series]").val("<?php echo htmlentities($job_declare['declaration_duty_series']); ?>");
        $("[name=declaration_job_name]").val("<?php echo htmlentities($job_declare['declaration_job_name']); ?>");


        declaration_job_name("<?php echo htmlentities($job_declare['declaration_job_name']); ?>");

        $("[name=approval_office]").val("<?php echo htmlentities($job_declare['approval_office']); ?>");
        $("[name=duties_and_time]").val("<?php echo htmlentities($job_declare['duties_and_time']); ?>");
        $("[name=communist_job]").val("<?php echo htmlentities($job_declare['communist_job']); ?>");
        $("[name=other_party_job_time]").val("<?php echo htmlentities($job_declare['other_party_job_time']); ?>");
        $("[name=academic_organization_job_time]").val("<?php echo htmlentities($job_declare['academic_organization_job_time']); ?>");
        $("[name=language_level]").val("<?php echo htmlentities($job_declare['language_level']); ?>");

        //读取json文件,往工作单位信息中的岗位类别添加数据
        $.getJSON("/static/admin/json/postType.json",function(data) {
            //each循环 使用$.each方法遍历返回的数据date
            $.each(data, function(i, item) {
                //拼接标签
                var isselected = "<?php echo htmlentities($work_nuits['post_type']); ?>" == item.name ? 'selected' : "";
                var str = "<option value='"+item.name+"' pid='"+item.pId+"'"+isselected+">"+item.name+"</option>";
                //添加可选项
                $("[name=post_type]").append(str);
            })
        });

        //读取json文件,往现任专业技术职务信息中的现任专业技术职务系列添加数据
        $.getJSON("/static/admin/json/xrzyjszwxl.json",function(data) {
            //each循环 使用$.each方法遍历返回的数据date
            var str = "";
            $.each(data, function(i, item) {
                //拼接标签
                if(item.id == "<?php echo htmlentities($now_position['now_duty_series']); ?>"){
                    str += "<option value='"+item.id+"' py='"+item.py+"' selected >"+item.name+"</option>";
                }else{
                    str += "<option value='"+item.id+"' py='"+item.py+"' >"+item.name+"</option>";
                }
            });
            //添加可选项
            $("[name=now_duty_series]").append(str);
        });

        //现任专业技术职务信息中的现任专业技术职务系列改变内容时
        $("[name=now_duty_series]").change(function () {
            $("[name=now_job] option").remove();
            var str = "<option></option>";
            $("[name=now_job]").append(str);
            var id = $(this).val();
            $.getJSON("/static/admin/json/xrzyjszwxl.json",function(data) {
                //each循环 使用$.each方法遍历返回的数据date
                $.each(data, function(i, item) {
                    if(item.id == id){
                        $.each(item.position,function (n, m) {
                            var str = "<option value='"+m.id+"' py='"+m.py+"' level='"+m.level+"' >"+m.name+"</option>";
                            $("[name=now_job]").append(str);
                        })
                    }
                })
            });
            //等级清空
            $(this).parent().siblings().last().children("input:text").val("");
        });

        //现任专业技术职务信息中的现任专业技术职务名称改变内容时
        $("[name=now_job]").change(function () {
            var level = $(this).children("option:selected").attr("level");
            $(this).parent().siblings().last().children("input:text").val(level);
        });


        //显示出生日期
        var birthday = "<?php echo htmlentities($data_userinfo['cardid']); ?>";
        birthday = birthday.substr(6,4)+"-"+birthday.substr(10,2)+"-"+birthday.substr(12,2);
        $("[name=birthday]").val(birthday);
        var info = "";
        $("#submit_form").click(function () {
            var formdata2 = new FormData(document.getElementById("myform2"));
            var formdata3 = new FormData(document.getElementById("myform3"));
            var formdata4 = new FormData(document.getElementById("myform4"));
            // 工作单位信息
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdWorkUnits'); ?>?uid=<?php echo htmlentities($uid); ?>",
                type:"post",
                dataType:"json",
                data:formdata2,
                async: false,
                cache: false,                      // 不缓存
                processData: false,                // jQuery不要去处理发送的数据
                contentType: false,                // jQuery不要去设置Content-Type请求头
                success:function (data) {
                    console.log(data)
                    if(data["code"] == 0){
                        layer.msg("权限不足");
                        return false;
                    }else if (data["code"] == 2){
                        info += data["type"] == "add" ? "工作单位信息添加失败" : "";
                    }else if(data["code"] == 1){
                        info = "修改完成";
                    }
                }
            });
            //现任专业技术职务信息
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdNowPosition'); ?>?uid=<?php echo htmlentities($uid); ?>",
                type:"post",
                datatype:"json",
                data:formdata3,
                async: false,
                cache: false,                      // 不缓存
                processData: false,                // jQuery不要去处理发送的数据
                contentType: false,                // jQuery不要去设置Content-Type请求头
                success:function (data) {
                    console.log(data)
                    if(data["code"] == 0){
                        layer.msg("权限不足");
                        return false;
                    }else if (data["code"] == 2){
                        info += data["type"] == "add" ? "现任专业技术职务信息添加失败" : "";
                    }else if(data["code"] == 1){
                        info = "修改完成";
                    }
                }
            });
            //职称申报信息
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdJobDeclare'); ?>?uid=<?php echo htmlentities($uid); ?>",
                type:"post",
                datatype:"json",
                data:formdata4,
                async: false,
                cache: false,                      // 不缓存
                processData: false,                // jQuery不要去处理发送的数据
                contentType: false,                // jQuery不要去设置Content-Type请求头
                success:function (data) {
                    console.log(data)
                    if(data["code"] == 0){
                        layer.msg("权限不足");
                        return false;
                    }else if (data["code"] == 2){
                        info += data["type"] == "add" ? "职称申报信息添加失败" : "";
                    }else if(data["code"] == 1){
                        info = "修改完成";
                    }
                }
            });
            layer.msg(info != "" ? info : "没有做出修改");
        });

        //评审单位改变时
        $("[name=accreditation_unit]").change(function () {
            $(this).attr("myid",$("[name=accreditation_unit] option:selected").attr("myid"));
            var id= $(this).attr("myid");
            $(this).children("option").each(function () {
                if($(this).val() == ""){
                    $(this).remove();
                }
            })
            $.ajax({
                url:"<?php echo url('Modal/selectAchievementType'); ?>",
                type:"post",
                dataType:"json",
                data:{id:id},
                success:function (data) {
                    console.log(data)
                    if(data["code"] != 0){
                        var str = "<option>-</option>";
                        for(var i in data){
                            str += "<option value='"+data[i].id+"' myid='"+data[i].id+"'>"+data[i].name+"</option>";
                        }
                        $("[name=declaration_profession] option").remove();
                        $("[name=declaration_profession]").append(str);
                    }
                }
            })
        });

        //主管单位下拉框内容
        $.getJSON("/static/admin/json/company.json",function(data) {
            //each循环 使用$.each方法遍历返回的数据date
            var str = "";
            $.each(data, function(i, item) {
                if(item.id == "<?php echo htmlentities($job_declare['competent_unit']); ?>"){
                    str += "<option value='"+item.id+"' py='"+item.py+"' selected >"+item.name+"</option>";
                }else{
                    str += "<option value='"+item.id+"' py='"+item.py+"'>"+item.name+"</option>";
                }
            });
            $("[name=competent_unit]").append(str);
        });

        //拟申报专业技术职务名称发生改变时
        $("[name=declaration_job_name]").change(function () {
            declaration_job_name($(this).val());
        });
    });
</script>
</html>