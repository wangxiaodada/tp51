<?php /*a:1:{s:79:"E:\phpStudy\WWW\tp51\application\admin\view\modal\protitlerecprobationwork.html";i:1587609118;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>见习工作情况</title>
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
<body style="min-width: 1000px;width: 1178px">
<div >
    <h5>见习工作情况</h5>

    <form id="myform" >
        <input type="hidden" name="id" value="">
        <table>
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>开始时间：</td>
                <td style="width: 270px"><input  class="form-control" name="start_time" type="date" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>结束时间：</td>
                <td style="width: 270px"><input  class="form-control" name="end_time" type="date" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>工作部门及岗位：</td>
                <td style="width: 270px"><input class="form-control" name="post" type="text"></td>
            </tr>
            <tr>
                <td><span style="color: red">* </span>主要工作内容：</td>
                <td colspan="5"><input type="text" name="job_content" class="form-control"></td>
            </tr>
        </table>
        <br/>
    </form>
    <div style="height: 54px">
        <div class="float-right bottom_div">
            <a href="<?php echo url('Modal/showProTitleRecIdentifying'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 申报材料上传</button></a>
            <button class="btn btn-info" id="submit_form">保存</button>
            <button class="btn btn-danger" id="del">删除</button>
            <a href="<?php echo url('Modal/showProTitleRecSummary'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info">见习工作总结 >></button></a>
        </div>
    </div>
    <div style="height: 50px;">
        <table id="table_2" >
            <tr bgcolor="#b2e2fa">
                <td></td>
                <td><input class="center" id="checkbox_all" type="checkbox"></td>
                <td style="width: 70px">修改</td>
                <td style="width: 120px">开始时间</td>
                <td style="width: 120px">结束时间</td>
                <td style="width: 300px">工作部门及岗位</td>
                <td style="width: 600px">主要工作内容</td>
            </tr>
            <?php if($data != ""): foreach($data as $v): ?>
            <tr >
                <td>1</td>
                <td><input class="center" name="checkbox" type="checkbox"></td>
                <td><a href="#" myid="<?php echo htmlentities($v['id']); ?>" name="bj" title="单机"><img width="20px" src="/static/user/img/edit.png" alt=""></a></td>
                <td><?php echo htmlentities($v["start_time"]); ?></td>
                <td><?php echo htmlentities($v["end_time"]); ?></td>
                <td><?php echo htmlentities($v["post"]); ?></td>
                <td><?php echo htmlentities($v["job_content"]); ?></td>
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

        $("select").each(function () {
            $(this).addClass("form-control");
        })

        $("textarea").each(function () {
            $(this).css("border","1px solid #ced4da")
            $(this).css("background","white")
        })


        $("#submit_form").click(function () {
            var formdata = new FormData(document.getElementById("myform"));
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdProTitleRecProbation'); ?>?uid=<?php echo htmlentities($uid); ?>",
                type:"post",
                datatype:"json",
                data:formdata,
                cache: false,                      // 不缓存
                processData: false,                // jQuery不要去处理发送的数据
                contentType: false,                // jQuery不要去设置Content-Type请求头
                success:function (data) {
                    if (data["code"] == 0) {
                        layer.msg("权限不足");
                        return false;
                    } else if (data["code"] == 1) {
                        if (data["type"] == "add") {
                            var str = "<tr >" +
                                "<td></td>" +
                                "<td><input class='center' name='checkbox' type='checkbox'></td>" +
                                "<td><a href='#' myid='" + data['id'] + "' name='bj' title='单机'><img width='20px' src='/static/user/img/edit.png' alt=''></a></td>" +
                                "<td>" + data["data"]['start_time'] + "</td>" +
                                "<td>" + data["data"]['end_time'] + "</td>" +
                                "<td>" + data["data"]['post'] + "</td>" +
                                "<td>" + data["data"]['job_content'] + "</td>" +
                                "</tr>";
                            $("#table_2 tbody").append(str);
                            numberOrder();
                            layer.msg("添加成功");
                        } else if (data["type"] == "update") {
                            $("[name=bj]").each(function () {
                                if ($(this).attr("myid") == data["id"]) {
                                    var obj = $(this).parent();
                                    for (var i in data["data"]) {
                                        obj = obj.next();
                                        obj.text(data["data"][i]);
                                    }
                                }
                            })
                            layer.msg("修改成功")
                        }
                    }
                }
            });
        });

        //编辑（查询单条数据）
        $("body").on("click","[name = bj]",function () {
            $.ajax({
                url:"<?php echo url('modal/showProTitleRecProbationone'); ?>",
                type:"post",
                datatype:"json",
                data:{"id":$(this).attr("myid")},
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
            layer.confirm("您确定要删除吗",function () {
                $.ajax({
                    url:"<?php echo url('modal/delProTitleRecProbation'); ?>",
                    type:"post",
                    datatype:"json",
                    data:{ids:ids},
                    success:function (data) {
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }
                        if(data > 0){
                            $("[name=checkbox]").each(function () {
                                if($(this).prop("checked")){
                                    $(this).parent().parent().remove();
                                    numberOrder();
                                    layer.msg('删除成功');
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