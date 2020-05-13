<?php /*a:1:{s:74:"E:\phpStudy\WWW\tp51\application\admin\view\modal\assessmentsituation.html";i:1587608160;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>职称考试及考核情况</title>
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
<body style="min-width: 1000px;width:1178px ">
<div >
    <h5>职称考试及考核情况</h5>

    <form id="myform" >
        <table width="100%">
            <input type="hidden" name="exam_id" />
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>日期：</td>
                <td style="width:300px" ><input name="time" class="form-control"  type="date" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>考试种类：</td>
                <td style="width:300px" ><input name="type"  class="form-control" type="text" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>考试科目：</td>
                <td style="width:300px" ><input name="subject"  class="form-control" type="text" value=""></td>
            </tr>
            <tr>
                <td ><span style="color: red">* </span>考试成绩：</td>
                <td><input name="achievement" class="form-control" type="text" value=""></td>
                <td ><span style="color: red">* </span>组织考试部门：</td>
                <td><input name="organization_department" class="form-control" type="text" value=""></td>
            </tr>
        </table>
        <br/>
    </form>
    <div style="height: 54px">
        <div class="float-right" style="margin-right: 20px">
            <a href="<?php echo url('Modal/showWorksAndPapers'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 著作论文及重要技术报告</button></a>
            <button class="btn btn-info" id="submit_form">保存</button>
            <button class="btn btn-danger" id="del">删除</button>
            <a href="/previewPingshen/<?php echo htmlentities($uid); ?>"><button class="btn btn-info">预览提交</button></a>
        </div>
    </div>
    <div style="height: 50px;">
        <table id="table_2" style="width: 100%">
            <tr bgcolor="#b2e2fa">
                <td></td>
                <td><input class="center" id="checked_all" type="checkbox"></td>
                <td>修改</td>
                <td>日期</td>
                <td style="width: 210px">考试种类</td>
                <td style="width: 210px">考试科目</td>
                <td style="width: 210px">考试成绩</td>
                <td style="width: 210px">组织考试部门</td>
            </tr>
            <?php if($data != ""): foreach($data as $v): ?>
            <tr >
                <td>1</td>
                <td><input class="center" name="checked" type="checkbox"></td>
                <td><a href="#" name="bj" myid="<?php echo htmlentities($v['exam_id']); ?>" title="单机"><img width="20px" src="/static/user/img/edit.png" alt=""></a></td>
                <td><?php echo htmlentities($v['time']); ?></td>
                <td><?php echo htmlentities($v['type']); ?></td>
                <td><?php echo htmlentities($v['subject']); ?></td>
                <td><?php echo htmlentities($v['achievement']); ?></td>
                <td><?php echo htmlentities($v['organization_department']); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
<!--客户评审申报所有信息预览 start/-->
<div class="modal fade " id="myModal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1200px" >
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <iframe id="menuFrame2" name="menuFrame2" src="#" style="height:470px;overflow:visible;" scrolling="yes" frameborder="no" width="100%" height="100%"></iframe>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--客户所有信息预览 end-->
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


        $("#submit_form").click(function () {
            layer.confirm("您确定要保存吗",function () {
                var formdata = new FormData(document.getElementById("myform"));
                $.ajax({
                    url:"<?php echo url('Modal/addOrUpdAssessmentSituation'); ?>?uid=<?php echo htmlentities($uid); ?>",
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
                            layer.msg("添加成功");
                            var str = "<tr >" +
                                "<td>1</td>" +
                                "<td><input class='center' name='checked' type='checkbox'></td>" +
                                "<td><a href='#' name='bj' myid='"+data['where']['exam_id']+"' title='单机'><img width='20px' src='/static/user/img/edit.png' alt=''></a></td>" +
                                "<td>"+data['data']['time']+"</td>" +
                                "<td>"+data['data']['type']+"</td>" +
                                "<td>"+data['data']['subject']+"</td>" +
                                "<td>"+data['data']['achievement']+"</td>" +
                                "<td>"+data['data']['organization_department']+"</td>" +
                                "</tr>";
                            $("#table_2 tbody").append(str);
                            numberOrder();
                        }else if(data["type"] == "update"){
                            layer.msg("修改成功");
                            $("[name=bj]").each(function () {
                               if($(this).attr("myid") == data["where"]["exam_id"]){
                                   var obj = $(this).parent();
                                   for(var i in data["data"]){
                                       obj = obj.next();
                                       obj.text(data["data"][i])
                                   }
                               }
                            });
                        }
                    }
                });
            })
        });

        //显示修改信息
        $("[name=bj]").click(function () {
            $.ajax({
                url:"<?php echo url('Modal/showAssessmentSituationone'); ?>",
                type:"post",
                datatype:"json",
                data:{exam_id:$(this).attr("myid")},
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
            layer.confirm("您确定要删除吗",function () {
                var ids = "";
                $("[name=checked]:checked").each(function () {
                    ids = ids + "," + $(this).parent().next().children("a").attr("myid");
                });
                ids = ids.substr(1,ids.length);
                $.ajax({
                    url:"<?php echo url('Modal/delAssessmentSituation'); ?>",
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
                            layer.msg("删除完成");
                            numberOrder();
                        }
                    }
                })
            });
        });

        //预览模态框打开
        $("#preview").click(function () {
            $("#myModal").modal("show");
        })
    });
</script>
</html>