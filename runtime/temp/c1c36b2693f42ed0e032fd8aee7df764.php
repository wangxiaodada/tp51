<?php /*a:1:{s:74:"E:\phpStudy\WWW\tp51\application\admin\view\modal\protitlerecbaseinfo.html";i:1586748197;}*/ ?>
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
<body style="min-width: 1000px;">
<div style="width: 1170px">
    <form id="myform" >
        <h5>基本信息</h5>
        <table >
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>证件编号：</td>
                <td style="width: 250px"><input name="gj" readonly class="form-control" type="text" value="<?php echo htmlentities((isset($data['cardid']) && ($data['cardid'] !== '')?$data['cardid']:'')); ?>"></td>
                <td style="width: 120px"><span style="color: red">* </span>姓名：</td>
                <td style="width: 250px"><input name="idcard" readonly class="form-control"  type="text" value="<?php echo htmlentities((isset($data['name']) && ($data['name'] !== '')?$data['name']:'')); ?>"></td>
                <td style="width: 120px">曾用名：</td>
                <td style="width: 250px"><input name="idcard" readonly class="form-control"  type="text" value="<?php echo htmlentities((isset($data['oldname']) && ($data['oldname'] !== '')?$data['oldname']:'')); ?>"></td>
                <td style="width: 250px" rowspan="4">
                    <div style="width: 120px;height: 150px;margin: auto">
                        <img width="120px" height="150px" src="<?php echo htmlentities((isset($data['pic']) && ($data['pic'] !== '')?$data['pic']:'/static/user/img/camera.png')); ?>" alt="">
                    </div>
                </td>
            </tr>
            <tr>
                <td>性别：</td>
                <td><input class="form-control" readonly name="sex" type="text" value="<?php echo htmlentities((isset($data['sex']) && ($data['sex'] !== '')?$data['sex']:'')); ?>"></td>
                <td>民族：</td>
                <td><input class="form-control" readonly name="nation" type="text" value="<?php echo htmlentities((isset($data['nation']) && ($data['nation'] !== '')?$data['nation']:'')); ?>"></td>
                <td>出生地：</td>
                <td><input class="form-control" readonly name="homeplace" type="text" value="<?php echo htmlentities((isset($data['homeplace']) && ($data['homeplace'] !== '')?$data['homeplace']:'')); ?>" ></td>
            </tr>
            <tr>
                <td>出生日期：</td>
                <td><input class="form-control" readonly name="birthday" type="text" value=""></td>
                <td>参加工作日期：</td>
                <td><input class="form-control" readonly name="work_start_time" type="text" value="<?php echo htmlentities((isset($data['work_start_time']) && ($data['work_start_time'] !== '')?$data['work_start_time']:'')); ?>"></td>
                <td>身体状况：</td>
                <td><input class="form-control" readonly name="physicalcondition" type="text" value="<?php echo htmlentities((isset($data['physicalcondition']) && ($data['physicalcondition'] !== '')?$data['physicalcondition']:'')); ?>"></td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>最高学历：</td>
                <td><input class="form-control" readonly type="text" name="education_name" value="<?php echo htmlentities((isset($data_edu_exp['education_name']) && ($data_edu_exp['education_name'] !== '')?$data_edu_exp['education_name']:'')); ?>"></td>
                <td><span style="color: red">* </span>毕业时间：</td>
                <td><input class="form-control" readonly name="gra_time" type="text" value="<?php echo htmlentities((isset($data_edu_exp['gra_time']) && ($data_edu_exp['gra_time'] !== '')?$data_edu_exp['gra_time']:'')); ?>"></td>
                <td><span style="color: red">* </span>毕业院校：</td>
                <td><input class="form-control" readonly type="text" name="gra_colleges" value="<?php echo $data_edu_exp==null ? ''  : htmlentities($data_edu_exp['gra_colleges'] == '其他院校名称' ? $data_edu_exp['other_colleges'] : $data_edu_exp['gra_colleges']); ?>"></td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>专业：</td>
                <td><input class="form-control" readonly type="text" name="major" value="<?php echo $data_edu_exp==null ? ''  : htmlentities($data_edu_exp['major'] == '其他专业' ? $data_edu_exp['othermajor'] : $data_edu_exp['major']); ?>"></td>
                <td><span style="color: red">* </span>学制：</td>
                <td><input class="form-control" readonly name="ed_system" type="text" value="<?php echo htmlentities((isset($data_edu_exp['ed_system']) && ($data_edu_exp['ed_system'] !== '')?$data_edu_exp['ed_system']:'')); ?>"></td>
                <td><span style="color: red">* </span>学位：</td>
                <td><input class="form-control" readonly type="text" name="academicdegree" value="<?php echo htmlentities((isset($data_edu_exp['academicdegree']) && ($data_edu_exp['academicdegree'] !== '')?$data_edu_exp['academicdegree']:'')); ?>"></td>
            </tr>

        </table><br/>
    </form>
    <form action="" id="myform2">
        <h5>工作单位信息</h5>
        <table   >
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>工作单位：</td>
                <td style="width: 250px;"><input class="form-control" name="workunit" type="text" value="<?php echo htmlentities((isset($data_ptr_base_info['workunit']) && ($data_ptr_base_info['workunit'] !== '')?$data_ptr_base_info['workunit']:'')); ?>"></td>
                <td style="width: 120px;"><span style="color: red">* </span>所属区域：</td>
                <td style="width: 250px;">
                    <select name="region" id="region" value="">
                        <option value=""></option>
                        <?php foreach($data_region as $v): ?>
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
        <h5>现任专业技术职务信息</h5>
        <table id="table_3"  >
            <tr>
                <td style="width: 210px;"><span style="color: red">* </span>现任专业技术职务系列 ：</td>
                <td style="width: 250px;">
                    <select name="now_duty_series" >
                        <option value=""></option>
                    </select>
                </td>
                <td style="width: 170px;"><span style="color: red">* </span>现任专业技术职务名称：</td>
                <td style="width: 250px;">
                    <select name="now_job">
                        <?php foreach($now_jobs as $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                        <!--<option value="">暂无匹配项</option>-->
                    </select>
                </td>
                <td style="width: 170px;"><span style="color: red">* </span>现任专业技术职务等级：</td>
                <td style="width: 250px;"><input readonly class="form-control" type="text"></td>
            </tr>
            <tr>
                <td ><span style="color: red">* </span>现任专业技术职务的任职时间 ：</td>
                <td ><input class="form-control" name="now_job_time" type="date" value="<?php echo htmlentities((isset($data_ptr_base_info['now_job_time']) && ($data_ptr_base_info['now_job_time'] !== '')?$data_ptr_base_info['now_job_time']:'')); ?>"></td>
            </tr>
        </table>
    <br/>
        <h5>职称申报信息</h5>
        <table id="table_4" >
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>拟申报专业技术职务系列：</td>
                <td style="width: 250px;">
                    <select name="afpatps">
                        <option value=""></option>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>拟申报职务名称：</td>
                <td style="width: 250px;" colspan="2">
                    <select name="jobtitle">
                        <?php foreach($jobtitles as $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>拟申报职务等级 ：</td>
                <td style="width: 250px;"><input type="text" class="form-control" readonly></td>
            </tr>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>申报专业 ：</td>
                <td style="width: 350px;">
                    <select name="declarationprofession">
                        <option value=""></option>
                        <option value="工程技术人员">工程技术人员</option>
                        <option value="护理（非医药专业）">护理（非医药专业）</option>
                    </select>
                </td>
                <td style="width: 120px;"><span style="color: red">* </span>主管单位 ：</td>
                <td style="width: 300px;" colspan="2">
                    <select name="competentunit">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>参加何种学术团体任何种职务有何社会兼职：</td>
                <td colspan="2"><textarea name="socialappointments" title="无内容填写时请填写无"  class="form-control-plaintext"></textarea></td>
                <td style="width: 120px;"><span style="color: red">* </span> 懂何种外语达到何种程度：</td>
                <td colspan="3"><textarea name="language_level" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
            </tr>
            <tr>
                <td style="width: 120px;"><span style="color: red">* </span>有何特长 ：</td>
                <td colspan="2"><textarea name="speciality" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
                <td style="width: 120px;"><span style="color: red">* </span>备注 ：</td>
                <td colspan="3"><textarea name="remake" title="无内容填写时请填写无" class="form-control-plaintext"></textarea></td>
            </tr>
        </table>
    </form>
    <div style="height: 54px;margin-top: 20px;">
        <div class="float-right">
            <!--<a href="<?php echo url('Index/index'); ?>"><button class="btn btn-info"> << 返回查询</button></a>-->
            <button class="btn btn-info" id="submit_form">保存</button>
            <a href="<?php echo url('Modal/showProTitleRecIdentifying'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info" id="next">申报资料上传 >></button></a>
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

        $("#region").val("<?php echo htmlentities($data_ptr_base_info['region']); ?>");
        $("[name=post_type]").val("<?php echo htmlentities($data_ptr_base_info['post_type']); ?>");

        $("[name=now_duty_series]").val("<?php echo htmlentities($data_ptr_base_info['now_duty_series']); ?>");
        $("[name=now_job]").val("<?php echo htmlentities($data_ptr_base_info['now_job']); ?>");
        //当客户有现任专业技术职务等级时显示在页面上
        "<?php foreach($now_jobs as $v): ?>"
        if("<?php echo htmlentities($v['id'] == $data_ptr_base_info['now_job']); ?>"){
            $("[name=now_job]").parent().next().next().children("input:text").val("<?php echo htmlentities($v['level']); ?>")
        }
        "<?php endforeach; ?>"

        $("[name=afpatps]").val("<?php echo htmlentities($data_ptr_base_info['afpatps']); ?>");
        $("[name=jobtitle]").val("<?php echo htmlentities($data_ptr_base_info['jobtitle']); ?>");
        //当客户有拟申报职务等级时显示在页面上
        "<?php foreach($jobtitles as $v): ?>"
        if("<?php echo htmlentities($v['id'] == $data_ptr_base_info['jobtitle']); ?>"){
            $("[name=jobtitle]").parent().next().next().children("input:text").val("<?php echo htmlentities($v['level']); ?>")
        }
        "<?php endforeach; ?>"

        $("[name=declarationprofession]").val("<?php echo htmlentities($data_ptr_base_info['declarationprofession']); ?>");
        $("[name=socialappointments]").val("<?php echo htmlentities($data_ptr_base_info['socialappointments']); ?>");

        $("[name=language_level]").val("<?php echo htmlentities($data_ptr_base_info['language_level']); ?>");
        $("[name=speciality]").val("<?php echo htmlentities($data_ptr_base_info['speciality']); ?>");
        $("[name=remake]").val("<?php echo htmlentities($data_ptr_base_info['remake']); ?>");

        //读取json文件,往工作单位信息中的岗位类别添加数据
        $.getJSON("/static/admin/json/postType.json",function(data) {
            //each循环 使用$.each方法遍历返回的数据date
            $.each(data, function(i, item) {
                //拼接标签
                var isselected = "<?php echo htmlentities($data_ptr_base_info['post_type']); ?>" == item.name ? 'selected' : "";
                var str = "<option value='"+item.name+"' pid='"+item.pId+"'"+isselected+">"+item.name+"</option>";
                //添加可选项
                $("[name=post_type]").append(str);
            })
        });

        //读取json文件,往现任专业技术职务信息中的现任专业技术职务系列和职称申报信息中的拟申报专业技术职务系列添加数据
        $.getJSON("/static/admin/json/xrzyjszwxl.json",function(data) {　
            //each循环 使用$.each方法遍历返回的数据date
            $.each(data, function(i, item) {
                //拼接标签
                var str = "<option value='"+item.id+"' py='"+item.py+"' >"+item.name+"</option>";
                //添加可选项
                $("[name=now_duty_series]").append(str);
                $("[name=now_duty_series] option").each(function () {
                    if($(this).val() == "<?php echo htmlentities($data_ptr_base_info['now_duty_series']); ?>"){
                        $(this).prop("selected",true);
                    }
                });
                if(item.name != "无"){
                    $("[name=afpatps]").append(str);
                    $("[name=afpatps] option").each(function () {
                        if($(this).val() == "<?php echo htmlentities($data_ptr_base_info['afpatps']); ?>"){
                            $(this).prop("selected",true);
                        }
                    });
                }
            })
        });

        //现任专业技术职务信息中的现任专业技术职务系列改变内容时
        $("[name=now_duty_series]").change(function () {
            $("[name=now_job] option").remove();
            var id = $(this).val();
            var str = "<option></option>";
            $("[name=now_job]").append(str);
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

        //拟申报专业技术职务系列改变内容时
        $("[name=afpatps]").change(function () {
            var obj = $(this);
            obj.children("option").each(function () {
                if($(this).val() == ""){
                    $(this).remove();
                }
            });
            $("[name=jobtitle] option").remove();
            $.getJSON("/static/admin/json/xrzyjszwxl.json",function(data) {
                //each循环 使用$.each方法遍历返回的数据date
                var str = "<option></option>";
                $.each(data, function(i, item) {
                    if(item.id == obj.val()){
                        $.each(item.position,function (n, m) {
                            str += "<option value='"+m.id+"' py='"+m.py+"' level='"+m.level+"' >"+m.name+"</option>";
                        })
                    }
                });
                $("[name=jobtitle]").append(str);
            });
            //等级清空
            $(this).parent().siblings().last().children("input:text").val("");
        });

        //主管单位下拉框内容
        $.getJSON("/static/admin/json/company.json",function(data) {
            //each循环 使用$.each方法遍历返回的数据date
            var str = "";
            $.each(data, function(i, item) {
                if(item.name == "<?php echo htmlentities($data_ptr_base_info['competentunit']); ?>"){
                    str += "<option value='"+item.name+"' py='"+item.py+"' selected >"+item.name+"</option>";
                }else{
                    str += "<option value='"+item.name+"' py='"+item.py+"' >"+item.name+"</option>";
                }

            });
            $("[name=competentunit]").append(str);
        });

        //现任专业技术职务信息中的现任专业技术职务名称改变内容时
        $("[name=now_job]").change(function () {
            var level = $(this).children("option:selected").attr("level");
            $(this).parent().siblings().last().children("input:text").val(level);
        });

        //职称申报信息中的拟申报职务名称改变内容时
        $("[name=jobtitle]").change(function () {
            var level = $(this).children("option:selected").attr("level");
            $(this).parent().siblings().last().children("input:text").val(level);
        });

        //职称申报信息中的申报专业添加信息
        $.getJSON("/static/admin/json/declare-major.json",function(data) {
            //each循环 使用$.each方法遍历返回的数据date
            var str = "";
            $.each(data, function(i, item) {
                if(item.id == "<?php echo htmlentities($data_ptr_base_info['declarationprofession']); ?>"){
                    str += "<option value='"+item.id+"' py='"+item.py+"' selected >"+item.name+"</option>";
                }else{
                    str += "<option value='"+item.id+"' py='"+item.py+"' >"+item.name+"</option>";
                }

            });
            $("[name=declarationprofession]").append(str);
        });

        //显示出生日期
        var birthday = "<?php echo htmlentities($data['cardid']); ?>";
        birthday = birthday.substr(6,4)+"-"+birthday.substr(10,2)+"-"+birthday.substr(12,2);
        $("[name=birthday]").val(birthday);

        //新增或修改
        $("#submit_form").click(function () {
            var formdata2 = new FormData(document.getElementById("myform2"));
            // 工作单位信息
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdProTitleRecBaseInfo'); ?>?uid=<?php echo htmlentities($uid); ?>",
                type:"post",
                datatype:"json",
                data:formdata2,
                cache: false,                      // 不缓存
                processData: false,                // jQuery不要去处理发送的数据
                contentType: false,                // jQuery不要去设置Content-Type请求头
                success:function (data) {
                    console.log(data)
                    if(data["code"] == 0){
                        layer.msg("权限不足");
                        return false;
                    }
                }
            });
        });


    });
</script>
</html>