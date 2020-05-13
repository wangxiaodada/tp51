<?php /*a:1:{s:73:"E:\phpStudy\WWW\tp51\application\admin\view\modal\trainingexperience.html";i:1587608041;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学习培训经历</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/admin/css/all.css">
<style type="text/css">
    #table_2  td{
        padding: 0 20px;
        text-align: center;
    }
</style>
<body style="min-width: 1000px">
<div >
    <h5>学习培训经历</h5>

    <form id="myform" >
        <input type="hidden" name="tb_se_id" value="">
        <table>
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>培训开始时间：</td>
                <td style="width: 270px"><input  class="form-control" name="start_time" type="date" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>培训结束时间：</td>
                <td style="width: 270px"><input  class="form-control" name="end_time" type="date" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>证明人：</td>
                <td style="width: 270px"><input class="form-control" name="witness" type="text"></td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>学习地点：</td>
                <td><textarea class="form-control-plaintext" name="learningplace"></textarea></td>
                <td><span style="color: red">* </span>专业或主要内容：</td>
                <td colspan="3"><textarea name="major" class="form-control-plaintext"></textarea></td>
            </tr>
        </table>
        <br/>
    </form>
    <div style="height: 54px">
        <div class="float-right bottom_div">
            <a href="<?php echo url('Modal/showUploadCertificate'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 申报材料上传</button></a>
            <button class="btn btn-info" id="submit_form">保存</button>
            <button class="btn btn-danger" id="del">删除</button>
            <a href="<?php echo url('Modal/showWorkExperience'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info">工作经历 >></button></a>
        </div>
    </div>
    <div style="height: 50px;">
        <table id="table_2" >
            <tr bgcolor="#b2e2fa">
                <td></td>
                <td><input class="center" id="checkbox_all" type="checkbox"></td>
                <td>修改</td>
                <td style="width: 120px">培训开始时间</td>
                <td style="width: 120px">培训结束时间</td>
                <td style="width: 100px">证明人</td>
                <td style="width: 250px">学习地点</td>
                <td style="width: 440px">专业或主要学习内容</td>
            </tr>
            <?php if($data != ""): foreach($data as $v): ?>
            <tr >
                <td>1</td>
                <td><input class="center" name="checkbox" type="checkbox"></td>
                <td><a href="#" myid="<?php echo htmlentities($v['tb_se_id']); ?>" name="bj" title="单机"><img width="20px" src="/static/user/img/edit.png" alt=""></a></td>
                <td><?php echo htmlentities($v["start_time"]); ?></td>
                <td><?php echo htmlentities($v["end_time"]); ?></td>
                <td><?php echo htmlentities($v["witness"]); ?></td>
                <td><?php echo htmlentities($v["learningplace"]); ?></td>
                <td><?php echo htmlentities($v["major"]); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {
        $("select").each(function () {
            $(this).addClass("form-control");
        })

        $("#table_2 tr:gt(0)").each(function () {
            $(this).children("td:eq(0)").text($(this).index())
        })

        $("textarea").each(function () {
            $(this).css("border","1px solid #ced4da")
            $(this).css("background","white")
        })

        //提交保存
        $("#submit_form").click(function () {
            var formdata = new FormData(document.getElementById("myform"));
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdTrainingExperience'); ?>?uid=<?php echo htmlentities($uid); ?>",
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
                            "<td><a href='#' myid='"+data['tb_se_id']+"' name='bj' title='单机'><img width='20px' src='/static/user/img/edit.png' alt=''></a></td>" +
                            "<td>"+data["data"]['start_time']+"</td>" +
                            "<td>"+data["data"]['end_time']+"</td>" +
                            "<td>"+data["data"]['witness']+"</td>" +
                            "<td>"+data["data"]['learningplace']+"</td>" +
                            "<td>"+data["data"]['major']+"</td>" +
                            "</tr>";
                        $("#table_2 tbody").append(str);
                        layer.msg("保存成功");
                    }else if(data["type"] == "update"){
                        $("[name=bj]").each(function () {
                            if($(this).attr("myid") == data["tb_se_id"]){
                                var obj = $(this).parent();
                                for(var i in data["data"]){
                                    obj = obj.next();
                                    obj.text(data["data"][i]);
                                }
                            }
                        })
                        layer.msg("修改成功");
                    }
                }
            });
        });

        $("body").on("click","[name = bj]",function () {
            $.ajax({
                url:"<?php echo url('Modal/showTrainingExperienceOne'); ?>",
                type:"post",
                datatype:"json",
                data:{"tb_se_id":$(this).attr("myid")},
                success:function (data) {
                    if(data["code"] == 0){
                        layer.msg("权限不足");
                        return false;
                    }

                    for(var i in data){
                        $("[name="+i+"]").val(data[i]);
                    }
                }
            });
        });

        //删除多条
        $("#del").click(function () {
            var ids = "";
            $("[name=checkbox]").each(function () {
                if($(this).prop("checked")){
                    ids = ids + "," + $(this).parent().next().children("a").attr("myid");
                }
            });
            ids = ids.substr(1,ids.length);
            layer.confirm("您确定要删除吗",{btn:["确定","取消"]},function () {
                $.ajax({
                    url:"<?php echo url('Modal/delTrainingExperience'); ?>",
                    type:"post",
                    datatype:"json",
                    data:{ids:ids},
                    success:function (data) {
                        console.log(data)
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }
                        if(data > 0){
                            $("[name=checkbox]").each(function () {
                                if($(this).prop("checked")){
                                    $(this).parent().parent().remove();
                                    layer.msg("删除完成")
                                }
                            });
                        }
                    }
                })
            })
        });

        //全选
        $("#checkbox_all").click(function () {
           $("[name=checkbox]").click();
        });

    });
</script>
</html>