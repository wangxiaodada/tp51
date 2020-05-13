<?php /*a:1:{s:64:"E:\phpStudy\WWW\tp51\application\admin\view\modal\education.html";i:1586232207;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>教育经历</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/user/css/all.css">
<style>
    #table_2 td{
        padding: 0 20px;
        text-align: center;
    }
</style>
<script type="text/javascript">
    function checkbox_xz() {
        $("[name=checkbox]").each(function () {
            $(this).click();
        })
    };

    function order() {
        $("#table_2 tr:not(:eq(0))").each(function () {
            $(this).children("td").eq(0).text($(this).index());
        })
    }
</script>
<body style="min-width: 1000px">
    <div style="width: 1190px">
        <h5>教育经历</h5>

        <form id="myform" >
            <table>
                <input type="hidden" name="tb_ee_id" id="tb_ee_id" value=""/>
                <tr>
                    <td style="width: 120px"><span style="color: red">* </span>证件编号：</td>
                    <td style="width: 250px"><input disabled class="form-control" type="text" value="<?php echo htmlentities($cardid); ?>"></td>
                    <td style="width: 120px"><span style="color: red">* </span>学历：</td>
                    <td style="width: 250px">
                        <select name="education" id="education">
                            <option value=""></option>
                            <option value="1">中专</option>
                            <option value="2">大专</option>
                            <option value="3">本科</option>
                            <option value="4">硕士研究生</option>
                            <option value="5">博士研究研究生</option>

                        </select>
                    </td>
                    <td style="width: 120px"><span style="color: red">* </span>毕业学院：</td>
                    <td style="width: 250px">
                        <select name="gra_colleges">
                            <option value="广职院">广职院</option>
                            <option value="其他院校名称">其他院校名称</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>其他毕业院校：</td>
                    <td><input class="form-control" readonly name="other_colleges" type="text" value=""></td>
                    <td><span style="color: red">* </span>所学专业：</td>
                    <td>
                        <select name="major">
                            <option value=""> -- 请选择 -- </option>
                            <option value="计算机软件">计算机软件</option>
                            <option value="其他专业">其他专业</option>
                        </select>
                    </td>
                    <td>其他专业名称：</td>
                    <td><input class="form-control" readonly name="othermajor" type="text"></td>
                </tr>
                <tr>
                    <td><span style="color: red">* </span>毕业时间：</td>
                    <td><input type="date" name="gra_time" class="form-control" ></td>
                    <td><span style="color: red">* </span>毕业证编号：</td>
                    <td><input type="text" name="diploma_id" class="form-control" ></td>
                    <td><span style="color: red">* </span>学制：</td>
                    <td><input class="form-control" name="ed_system" type="text"></td>
                </tr>
                <tr>
                    <td><span style="color: red">* </span>获得学位：</td>
                    <td>
                        <select name="academicdegree" id="academicdegree">
                            <option value=""></option>
                            <option value="无">无</option>
                            <option value="学士">学士</option>
                            <option value="硕士">硕士</option>
                            <option value="博士">博士</option>
                        </select>
                    </td>
                    <td>学位证编号：</td>
                    <td><input class="form-control"  name="degreecertificate_no" type="text"></td>
                    <td>备注：</td>
                    <td><input class="form-control" name="remark" type="text"></td>
                </tr>

            </table>
            <br/>
        </form>
        <div style="height: 54px;width: 1100px">
            <div class="float-left" style="color: red;width: 700px;margin-left: 60px">
                注意：教育经历必须上传毕业证书，否则将不能进行职称认定和评审业务办理，保存教育经历信息后请务必在下方表格中点击上传证书按钮进行证书上传
            </div >
            <div class="float-right bottom_div">
                <a href="<?php echo url('Modal/showBaseInfo'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 返回基本信息</button></a>
                <button class="btn btn-success" id="submit_form">保存</button>
                <button class="btn btn-danger" id="del">删除</button>
            </div>
        </div>
        <div style="height: 50px;width: 1750px">
            <table id="table_2" >
                <tr bgcolor="#b2e2fa">
                    <td></td>
                    <td><input class="center" onclick="checkbox_xz();" type="checkbox"></td>
                    <td>编辑</td>
                    <td>上传证书</td>
                    <td>回退申请</td>
                    <td>证件编号</td>
                    <td>学历类别</td>
                    <td>毕业学院</td>
                    <td>其他毕业学院名称</td>
                    <td>专业</td>
                    <td>其他专业名称</td>
                    <td>毕业时间</td>
                    <td>毕业证编号</td>
                    <td>学制</td>
                    <td>获得学位</td>
                    <td>学位证编号</td>
                    <td >备注</td>
                </tr>
                <?php if($data != ""): foreach($data as $v): ?>
                <tr >
                    <td>1</td>
                    <td><input name="checkbox" class="center" type="checkbox"></td>
                    <td><a href="#" name="bj" myid="<?php echo htmlentities($v['tb_ee_id']); ?>" title="单机"><img width="20px" src="/static/user/img/edit.png" alt=""></a></td>
                    <td><img name="uploads"  myid="<?php echo htmlentities($v['tb_ee_id']); ?>" title="单机"  width="20px" src="/static/user/img/upload.png" alt=""></td>
                    <td><a href="#" title="单机"><img width="20px" src="/static/user/img/return.png" alt=""></a></td>
                    <td><?php echo htmlentities($cardid); ?></td>
                    <td><?php echo htmlentities($v['education_name']); ?></td>
                    <td><?php echo htmlentities($v['gra_colleges']); ?></td>
                    <td><?php echo htmlentities($v['other_colleges']); ?></td>
                    <td><?php echo htmlentities($v['major']); ?></td>
                    <td><?php echo htmlentities($v['othermajor']); ?></td>
                    <td><?php echo htmlentities($v['gra_time']); ?></td>
                    <td><?php echo htmlentities($v['diploma_id']); ?></td>
                    <td><?php echo htmlentities($v['ed_system']); ?></td>
                    <td><?php echo htmlentities($v['academicdegree']); ?></td>
                    <td><?php echo htmlentities($v['degreecertificate_no']); ?></td>
                    <td ><?php echo htmlentities($v['remark']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function () {
        order();

        $("select").each(function () {
            $(this).addClass("form-control");
        });

        $("[name=gra_colleges]").change(function () {
            if($(this).val() == "其他院校名称"){
                $("[name=other_colleges]").prop("readonly",false);
            }else {
                $("[name=other_colleges]").val("");
                $("[name=other_colleges]").prop("readonly",true);
            }
        });

        $("[name=major]").change(function () {
            if($(this).val() == "其他专业"){
                $("[name=othermajor]").prop("readonly",false);
            }else {
                $("[name=othermajor]").val("");
                $("[name=othermajor]").prop("readonly",true);
            }
        });

        $("[name=academicdegree]").change(function () {
            if($(this).val() == "无"){
                $("[name=degreecertificate_no]").val("");
                $("[name=degreecertificate_no]").prop("readonly",true);
            }else {
                $("[name=degreecertificate_no]").val("");
                $("[name=degreecertificate_no]").prop("readonly",false);
            }
        });
        
        //提交
        $("#submit_form").click(function () {
            layer.confirm("您确定要保存吗？",{
                btn:["确定","取消"]
            },function () {
                var formdata = new FormData(document.getElementById("myform"));
                $.ajax({
                    url:"<?php echo url('Modal/updEducation'); ?>?uid="+"<?php echo htmlentities($uid); ?>",
                    type:"post",
                    datatype:"json",
                    data:formdata,
                    cache: false,                      // 不缓存
                    processData: false,                // jQuery不要去处理发送的数据
                    contentType: false,                // jQuery不要去设置Content-Type请求头
                    success:function (data) {
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }
                        if(data["type"] == "add"){
                            var str = "<tr >" +
                                "<td>1</td>" +
                                "<td><input class='center' name='checkbox' type='checkbox'></td>" +
                                "<td><a href='#'  name='bj' myid='"+data['dada']['tb_ee_id']+"' title='单机'><img width='20px' src='/static/user/img/edit.png' alt=''></a></td>" +
                                "<td><a href='#' title='单机'><img width='20px' src='/static/user/img/upload.png' alt=''></a></td>" +
                                "<td><a href='#' title='单机'><img width='20px' src='/static/user/img/return.png' alt=''></a></td>" +
                                "<td><?php echo htmlentities($cardid); ?></td>" +
                                "<td>"+data['data']['education_name']+"</td>" +
                                "<td>"+data['data']['gra_colleges']+"</td>" +
                                "<td>"+data['data']['other_colleges']+"</td>" +
                                "<td>"+data['data']['major']+"</td>" +
                                "<td>"+data['data']['othermajor']+"</td>" +
                                "<td>"+data['data']['gra_time']+"</td>" +
                                "<td>"+data['data']['diploma_id']+"</td>" +
                                "<td>"+data['data']['ed_system']+"</td>" +
                                "<td>"+data['data']['academicdegree']+"</td>" +
                                "<td>"+data['data']['degreecertificate_no']+"</td>" +
                                "<td >"+data['data']['remark']+"</td>" +
                                "</tr>"
                            $("#table_2").append(str);
                            order();
                            layer.msg("添加成功");
                        }else if(data["type"] == "update"){
                            $("[name=bj]").each(function () {
                                if($(this).attr("myid") == data["where"]["tb_ee_id"]) {
                                   var obj = $(this).parent().next().next().next();
                                   obj.text("<?php echo htmlentities($cardid); ?>");
                                    for (var i in data["data"]){
                                        if(i == "education"){
                                            obj = obj.next();
                                            obj.text(data["data"]["education_name"]);
                                        }else{
                                            obj = obj.next();
                                            obj.text(data["data"][i]);
                                        }

                                    }
                                }
                            });
                            layer.msg("修改成功");
                        }
                    }
                });
            });

        });

        //编辑
        $("body").on("click","[name=bj]",function () {
            var id = $(this).attr("myid");
            $.ajax({
                url:"<?php echo url('Modal/educationShowOne'); ?>",
                type:"post",
                dataType:"json",
                data:{"id":id},
                success:function (data) {
                    if(data["code"] == 0){
                        layer.msg("权限不足");
                        return false;
                    }

                    $("#tb_ee_id").val(id);
                    $("#education").val(data["education"]);
                    $("[name=gra_colleges]").val(data["gra_colleges"]);
                    $("[name=other_colleges]").val(data["other_colleges"]);
                    $("[name=other_colleges]").prop("readonly",data["other_colleges"] == "");
                    $("[name=major]").val(data["major"]);
                    $("[name=othermajor]").val(data["othermajor"]);
                    $("[name=othermajor]").prop("readonly",data["othermajor"] == "");
                    $("[name=gra_time]").val(data["gra_time"]);
                    $("[name=diploma_id]").val(data["diploma_id"]);
                    $("[name=ed_system]").val(data["ed_system"]);
                    $("[name=academicdegree]").val(data["academicdegree"]);
                    $("[name=degreecertificate_no]").val(data["degreecertificate_no"]);
                    $("[name=degreecertificate_no]").prop("readonly",data["degreecertificate_no"] == "");
                    $("[name=remark]").val(data["remark"]);
                }
            })
        });

        //上传证书
        $("[name=uploads]").click(function () {
            var edu_exp_id = $(this).attr("myid");
            layer.open({
                type: 2,
                title:'上传证书',
                area: ['1100px', '450px'],
                maxmin: true,
                content: "/modal/showUploads/"+edu_exp_id
            });
        });


        //多删除
        $("#del").click(function () {
            layer.confirm("您确定要删除吗?",{
                btn:["确定","取消"]
            },function () {
                var ids = "";
                $("[name=checkbox]").each(function () {
                    if ($(this).prop("checked") == true) {
                        ids += "," + $(this).parent().next().children("a").attr("myid");
                    }
                });
                ids = ids.substr(1, ids.length);
                $.ajax({
                    url: "<?php echo url('Modal/delEducation'); ?>",
                    type: "post",
                    dataType: "json",
                    data: {"ids": ids},
                    success: function (data) {
                        console.log(data);
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }
                        if(data > 0){
                            $("[name=checkbox]:checked").parent().parent().remove();
                            order();
                            layer.msg("删除完成");
                        }

                    }
                });
            });
        });


    });
</script>
</html>