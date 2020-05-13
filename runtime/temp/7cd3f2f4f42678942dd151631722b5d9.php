<?php /*a:1:{s:64:"E:\phpStudy\WWW\tp51\application\admin\view\modal\base_info.html";i:1587452881;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新生报名表</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/admin/css/all.css">
<!--<link rel="stylesheet" href="/static/admin/css/textSelect.css">-->
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<!--<script type="text/javascript" src="/static/admin/js/textSelect.js"></script>-->

<body style="min-width: 1000px">
    <h5>个人基本信息</h5>

    <form id="myform" >
        <table>
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>国籍：</td>
                <td style="width: 150px"><input disabled class="form-control" type="text" value="中国"></td>
                <td style="width: 120px"><span style="color: red">* </span>证件类型：</td>
                <td style="width: 150px"><input  class="form-control" disabled type="text" value="居民身份证"></td>
                <td style="width: 120px"><span style="color: red">* </span>证件编号：</td>
                <td style="width: 170px"><input  disabled class="form-control" type="text" value="<?php echo htmlentities($data['cardid']); ?>"></td>
                <td rowspan="5" style="width: 180px" >
                    <div style="width: 120px;height: 150px;margin: auto">
                        <input type="hidden" value="<?php echo htmlentities((isset($data['pic']) && ($data['pic'] !== '')?$data['pic']:'')); ?>" name="pic">
                        <img src="<?php echo htmlentities((isset($data['pic']) && ($data['pic'] !== '')?$data['pic']:'/uploads/pic.png')); ?>" width="120px" height="150px" id="showfile"  width="100%" >
                    </div>
                    <div style="width: 72px;overflow: hidden;margin: auto;margin-top: 4px">
                        <input type="file" id="file" name="file"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>姓名：</td>
                <td><input class="form-control" name="name" id="name" type="text" value="<?php echo htmlentities($data['name']); ?>"></td>
                <td>曾用名：</td>
                <td><input class="form-control" name="oldname" type="text" value="<?php echo htmlentities((isset($data['oldname']) && ($data['oldname'] !== '')?$data['oldname']:'')); ?>"></td>
                <td><span style="color: red">* </span>性别：</td>
                <td><input class="form-control" id="sex" name="sex" type="text" value="<?php echo htmlentities($data['sex']); ?>"></td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>出生日期：</td>
                <td><input class="form-control" disabled id="birthday" type="text" value=""></td>

                <td><span style="color: red">* </span>民族：</td>
                <td>
                    <select name="nation" id="nation" size="1">
                        <option value=""> -- 请选择 -- </option>
                        <?php foreach($data_json_nation as $v): ?>
                        <option value="<?php echo htmlentities($v['name']); ?>" myid="<?php echo htmlentities($v['id']); ?>" py="<?php echo htmlentities($v['py']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <td><span style="color: red">* </span>政治面貌：</td>
                <td>
                    <select  name="politicaloutlook" id="politicaloutlook" >
                        <option value=""> -- 请选择 -- </option>
                        <option value="群众">群众</option>
                        <option value="中共党员">中共党员</option>
                        <option value="中共预备党员">中共预备党员</option>
                        <option value="共青团员">共青团员</option>
                        <option value="民革会员">民革会员</option>
                        <option value="民盟盟员">民盟盟员</option>
                        <option value="民建会员">民建会员</option>
                        <option value="民进会员">民进会员</option>
                        <option value="农工党党员">农工党党员</option>
                        <option value="致公党党员">致公党党员</option>
                        <option value="九三学社社员">九三学社社员</option>
                        <option value="台盟盟员">台盟盟员</option>
                        <option value="无党派民主人士">无党派民主人士</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>户口性质：</td>
                <td>
                    <select name="accountcharacter" id="accountcharacter" class="form-control">
                        <option value=""> -- 请选择 -- </option>
                        <option value="农村">农村</option>
                        <option value="城镇">城镇</option>
                    </select>
                </td>
                <td><span style="color: red">* </span>出生地：</td>
                <td>
                    <select id="sheng" style="width: 150px">
                        <option value=""> -- 请选择 -- </option>
                        <?php foreach($data_json_region1 as $v): ?>
                        <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><span style="color: red">* </span>：</td>
                <td>
                    <select id="shi" style="width: 150px">
                        <option value=""> -- 请选择 -- </option>
                        <option value="">暂无可选列</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>婚姻情况：</td>
                <td>
                    <select name="maritaltatus" id="maritaltatus">
                        <option value=""> -- 请选择 -- </option>
                        <option value="未婚">未婚</option>
                        <option value="已婚">已婚</option>
                        <option value="离婚">离婚</option>
                        <option value="丧偶">丧偶</option>
                    </select>
                </td>
                <td><span style="color: red">* </span>联系电话：</td>
                <td><input class="form-control" name="phone" type="text" value="<?php echo htmlentities((isset($data['phone']) && ($data['phone'] !== '')?$data['phone']:'')); ?>"></td>
                <td><span style="color: red">* </span>身体状况：</td>
                <td>
                    <select name="physicalcondition"  id="physicalcondition">
                        <option value=""> -- 请选择 -- </option>
                        <option value="健康或良好">健康或良好</option>
                        <option value="一般或脆弱">一般或脆弱</option>
                        <option value="有病">有病</option>
                        <option value="有生理缺陷">有生理缺陷</option>
                        <option value="有残疾">有残疾</option>
                        <option value="其他">其他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>参加工作日期：</td>
                <td><input class="form-control" name="work_start_time" type="date" value="<?php echo htmlentities((isset($data['work_start_time']) && ($data['work_start_time'] !== '')?$data['work_start_time']:'')); ?>"></td>
                <td>现居住地：</td>
                <td colspan="4"><input class="form-control" name="now_address" type="text" value="<?php echo htmlentities((isset($data['now_address']) && ($data['now_address'] !== '')?$data['now_address']:'')); ?>"></td>
            </tr>
            <tr>
                <td>工资：</td>
                <td><input class="form-control" name="wages" type="text" value="<?php echo htmlentities((isset($data['wages']) && ($data['wages'] !== '')?$data['wages']:'')); ?>"></td>
                <td>备注：</td>
                <td colspan="4"><input class="form-control" name="remark" type="text" value="<?php echo htmlentities((isset($data['remark']) && ($data['remark'] !== '')?$data['remark']:'')); ?>"></td>
            </tr>
        </table>
    </form>
    <div class="float-right bottom_div">
        <button class="btn btn-success" id="edit">编辑</button>
        <button class="btn btn-success" id="submit_form">保存</button>
        <a href="<?php echo url('Modal/showEducation'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info" id="next">教育经历 >> </button></a>
    </div>
</body>
<script type="text/javascript">
    $(function () {
        $("select").each(function () {
            $(this).addClass("form-control");
        });
        
        $("select").change(function () {
            $(this).children("option").each(function () {
                if($(this).val() == ""){
                    $(this).remove();
                    return false;
                }
            });
        })

        $("#sheng").change(function () {
            var id = $(this).val();
            shengchange(id);
        });
        function shengchange(id,shiid = 0){
            $.getJSON("/static/admin/json/region2.json",function (data) {
                if(data.length > 0 ) {
                    $("#shi option").remove();
                    $("#shi").append("<option> -- 请选择 -- </option>")
                    for (var i in data) {
                        if (data[i]["region1_id"] == id) {
                            $("#shi").append("<option value='"+ data[i]['id'] +"'" + (shiid == data[i]['id'] ? 'selected' : '') +">" + data[i]['name'] + "</option>")
                        }
                    }
                }
            });
        }

        $("#shi").change(function () {
            $(this).children("option").each(function () {
                if($(this).val == ""){
                    $(this).remove();
                }
            })
        });


        //显示出生日
        var birthday = "<?php echo htmlentities($data['cardid']); ?>";
        birthday = birthday.substr(6,4)+"-"+birthday.substr(10,2)+"-"+birthday.substr(12,2);
        $("#birthday").val(birthday);

        //显示下拉框中选中的值
        $("#nation").val("<?php echo htmlentities($data['nation']); ?>");
        $("#politicaloutlook").val("<?php echo htmlentities($data['politicaloutlook']); ?>");
        $("#accountcharacter").val("<?php echo htmlentities($data['accountcharacter']); ?>");
        $("#maritaltatus").val("<?php echo htmlentities($data['maritaltatus']); ?>");
        $("#physicalcondition").val("<?php echo htmlentities($data['physicalcondition']); ?>");
        var homeplace = "<?php echo htmlentities($data['homeplace']); ?>";
        var arr_homeplace = homeplace.split(",");
        $("#sheng").val(arr_homeplace[0]);
        if(arr_homeplace[0] != ""){
            shengchange(arr_homeplace[0],arr_homeplace[1]);
        }



        var bool = true;
        //是否可编辑
        function isEditable(){
            $("select").each(function () {
                $(this).prop("disabled",bool);
            });
            $("#name").prop("disabled",bool);
            $("#sex").prop("disabled",bool);
            $("[name=oldname]").prop("disabled",bool);
            $("[name=phone]").prop("disabled",bool);
            $("[name=work_start_time]").prop("disabled",bool);
            $("[name=now_address]").prop("disabled",bool);
            $("[name=wages]").prop("disabled",bool);
            $("[name=remark]").prop("disabled",bool);
            $("#file").prop("disabled",bool);
            $("#submit_form").prop("disabled",bool);
            bool = !bool;
            $("#edit").prop("disabled",bool);
        }
        isEditable();

        //管理员修改数据
        $("#submit_form").click(function () {
            var sheng = $("#sheng").val();
            var shi = $("#shi").val();
            if($("[name=work_start_time]").val() == ""){
                layer.msg("工参加工作日期必填");
                return false;
            }
            var formdata = new FormData(document.getElementById("myform"));
            formdata.append("homeplace",sheng+","+shi);
            formdata.append("uid","<?php echo htmlentities($uid); ?>");
            layer.confirm("您确定要修改吗?",{
                btn:["确定","取消"]
            },function () {
                $.ajax({
                    url:"<?php echo url('Modal/updBaseInfo'); ?>",
                    type:"post",
                    dataType:"json",
                    data:formdata,
                    cache: false,                      // 不缓存
                    processData: false,                // jQuery不要去处理发送的数据
                    contentType: false,                // jQuery不要去设置Content-Type请求头
                    success:function (data) {
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }
                        if(data > 0){
                            layer.msg("修改成功");
                            isEditable();
                        }else{
                            layer.msg("没有做出修改");
                        }
                    }
                });
            });
        });

        //编辑
        $("#edit").click(function () {
            isEditable();
        });

        //将上传的图片显示出来
        $("#file").change(function () {
            var $file=$(this);
            var fileobj=$file[0];
            var windowUrl=window.URL || window.webkitURL;
            var dataURL;
            var $img=$("#showfile");
            if (fileobj && fileobj.files&&fileobj.files[0]){
                dataURL=windowUrl.createObjectURL(fileobj.files[0]);
                $img.prop('src',dataURL);
            }else {
                dataURL=$file.val();
                $img.prop('src',dataURL);
            }
        })
    });
</script>
</html>