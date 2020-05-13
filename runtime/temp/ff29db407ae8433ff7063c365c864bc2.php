<?php /*a:1:{s:68:"E:\phpStudy\WWW\tp51\application\admin\view\modal\workandpapers.html";i:1587608083;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>著作、论文及重要技术报告登记</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/admin/css/all.css">
<style type="text/css">
    #table_2 td{
        text-align: center;
        padding: 0 15px;
    }

</style>
<body style="min-width: 1000px">
<div >
    <h5>著作、论文及重要技术报告登记</h5>
    <form id="myform" >
        <table>
            <input type="hidden" name="paper_id"/>
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>日期：</td>
                <td style="width:300px" ><input name="time" class="form-control"  type="date" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>名称及内容提要：</td>
                <td colspan="3"><input name="content"  class="form-control" type="text" value=""></td>
            </tr>
            <tr>
                <td ><span style="color: red">* </span>出版登载获奖或在学术会议上交流情况：</td>
                <td colspan="3" ><textarea name="com_situation" class="form-control-plaintext"></textarea></td>
                <td style="width: 120px"><span style="color: red">* </span>全（独）著、译 ：</td>
                <td style="width:400px"><textarea name="writing_translation" class="form-control-plaintext"></textarea></td>
            </tr>
        </table>
        <br/>
    </form>
    <div style="height: 54px">
        <div class="float-right" style="margin-right: 20px">
            <a href="<?php echo url('Modal/showNewAchievement'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 任现职后主要工作业绩</button></a>
            <button class="btn btn-info" id="submit_form">保存</button>
            <button class="btn btn-danger" id="del">删除</button>
            <a href="<?php echo url('Modal/showAssessmentSituation'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info">职称考试及考核情况 >></button></a>
        </div>
    </div>
    <div style="height: 50px;">
        <table id="table_2" >
            <tr bgcolor="#b2e2fa">
                <td></td>
                <td><input class="center" id="checked_all" type="checkbox"></td>
                <td width="80px">修改</td>
                <td style="width: 120px">日期</td>
                <td style="width: 369px">名称及内容提要</td>
                <td style="width: 368px">出版登载获奖或在学术会议上交流情况</td>
                <td style="width: 318px">全（独）著、译</td>
            </tr>
            <?php if($data != ""): foreach($data as $v): ?>
            <tr >
                <td>1</td>
                <td><input class="center" name="checked" type="checkbox"></td>
                <td><a href="#" name="bj" myid="<?php echo htmlentities($v['paper_id']); ?>" title="单机"><img width="20px" src="/static/user/img/edit.png" alt=""></a></td>
                <td><?php echo htmlentities($v['time']); ?></td>
                <td><?php echo htmlentities($v['content']); ?></td>
                <td><?php echo htmlentities($v['com_situation']); ?></td>
                <td><?php echo htmlentities($v['writing_translation']); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {

        //有序的排列每条业绩的编号顺序
        function numberOrder(){
            $("#table_2 tbody tr:gt(0)").each(function () {
                $(this).children("td:eq(0)").text($(this).index());
            })
        }
        numberOrder();

        $("textarea").each(function () {
            $(this).css("border","1px solid #ced4da")
            $(this).css("background","white")
        })

        //修改或删除
        $("#submit_form").click(function () {
            layer.confirm("您确定要保存吗",function () {
                var formdata = new FormData(document.getElementById("myform"));
                $.ajax({
                    url:"<?php echo url('Modal/addOrUpdWorksAndPapers'); ?>?uid=<?php echo htmlentities($uid); ?>",
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
                            layer.msg("添加成功")
                            var str = " <tr >" +
                                "<td></td>" +
                                "<td><input class='center' name='checked' type='checkbox'></td>" +
                                "<td><a href='#' name='bj' myid='"+data['where']['paper_id']+"' title='单机'><img width='20px' src='/static/user/img/edit.png' alt=''></a></td>" +
                                "<td>"+data['data']['time']+"</td>" +
                                "<td>"+data['data']['content']+"</td>" +
                                "<td>"+data['data']['com_situation']+"</td>" +
                                "<td>"+data['data']['writing_translation']+"</td>" +
                                "</tr>";
                            $("#table_2 tbody").append(str);
                            numberOrder();
                        }else if(data["type"] == "update"){
                            layer.msg("修改成功");
                            $("[name=bj]").each(function () {
                               if($(this).attr("myid") == data["where"]["paper_id"]){
                                   var obj = $(this).parent();
                                   for(var i in data["data"]){
                                       obj = obj.next();
                                       obj.text(data["data"][i]);
                                   }
                               }
                            });
                        }
                    }
                });
            });
        });

        //显示修改信息
        $("[name=bj]").click(function () {
            $.ajax({
                url:"<?php echo url('Modal/showWorksAndPapersone'); ?>",
                type:"post",
                datatype:"json",
                data:{paper_id:$(this).attr("myid")},
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

        //选中全部
        $("#checked_all").click(function () {
            $("[name=checked]").click();
        });

        //删除
        $("#del").click(function () {
            layer.confirm("您确定要删除吗？",function () {
                var ids = "";
                $("[name=checked]:checked").each(function () {
                    ids = ids + "," + $(this).parent().next().children("a").attr("myid");
                });
                ids = ids.substr(1,ids.length);
                $.ajax({
                    url:"<?php echo url('Modal/delWorksAndPapers'); ?>",
                    type:"post",
                    datatype:"json",
                    data:{ids:ids},
                    success:function (data) {
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }

                        if(data > 0){
                            $("[name=checked]:checked").parent().parent().remove();
                            numberOrder();
                            layer.msg("删除完成");
                        }
                    }
                })
            })
        });
    });
</script>
</html>