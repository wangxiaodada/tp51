<?php /*a:1:{s:69:"E:\phpStudy\WWW\tp51\application\admin\view\modal\newachievement.html";i:1587608042;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>任现职后主要专业技术工作业绩</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/admin/css/all.css">
<style type="text/css">
    #table_2  td{
        text-align: center;
        padding: 0 15px;
    }
</style>
<body style="min-width: 1000px;width: 1178px">
<div >
    <h5>任现职后主要专业技术工作业绩</h5>

    <form id="myform" >
        <table>
            <input type="hidden" name="tb_nr_id">
            <tr>
                <td style="width: 120px"><span style="color: red">* </span>开始时间：</td>
                <td colspan="3"><input name="start_time" class="form-control"  type="date" value=""></td>
                <td style="width: 120px"><span style="color: red">* </span>结束时间：</td>
                <td colspan="3"><input name="end_time"  class="form-control" type="date" value=""></td>
            </tr>
            <tr>
                <td ><span style="color: red">* </span>专业技术工作名称(项目、课题、成果)等 作 ：</td>
                <td style="width: 250px" ><textarea name="technical_work" class="form-control-plaintext"></textarea></td>
                <td style="width: 120px"><span style="color: red">* </span>工作内容本人起何作用（主持参与、独立）：</td>
                <td colspan="3" style="width: 250px"><textarea name="work_content" class="form-control-plaintext"></textarea></td>
                <td style="width: 120px"><span style="color: red">* </span>完成情况及效果（获何奖励效益或专利）：</td>
                <td style="width: 250px"><textarea name="ompletion_effect" class="form-control-plaintext"></textarea></td>
            </tr>
        </table>
        <br/>
    </form>
    <div style="height: 54px">
        <div class="float-right" style="margin-right: 20px">
            <a href="<?php echo url('Modal/showOldAchievement'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 任现职前主要工作业绩</button></a>
            <button class="btn btn-info" id="submit_form">保存</button>
            <button class="btn btn-danger" id="del">删除</button>
            <a href="<?php echo url('Modal/showWorksAndPapers'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info">著作、论文及重要技术报告登记 >></button></a>
        </div>
    </div>
    <div style="height: 50px;">
        <table id="table_2" >
            <tr bgcolor="#b2e2fa">
                <td></td>
                <td><input class="center" id="checked_all" type="checkbox"></td>
                <td width="80px">修改</td>
                <td style="width: 120px">开始时间</td>
                <td style="width: 120px">结束时间</td>
                <td style="width: 260px">专业技术工作名称(项目、课题、成果)等</td>
                <td style="width: 260px">工作内容本人起何作用（主持参与、独立）</td>
                <td style="width: 300px">完成情况及效果（获何奖励效益或专利）</td>
            </tr>
            <?php if($data != ""): foreach($data as $v): ?>
            <tr >
                <td>1</td>
                <td><input class="center" name="checked" type="checkbox"></td>
                <td><a href="#" name="bj" myid="<?php echo htmlentities($v['tb_nr_id']); ?>" myachievementid="<?php echo htmlentities($v['achievement_id']); ?>" title="单机"><img width="20px" src="/static/user/img/edit.png" alt=""></a></td>
                <td><?php echo htmlentities($v['start_time']); ?></td>
                <td><?php echo htmlentities($v['end_time']); ?></td>
                <td><div style="width: 200px;height:19.2px;overflow:hidden;"><?php echo htmlentities($v['technical_work']); ?></div></td>
                <td><div style="width: 230px;height:19.2px;overflow:hidden;"><?php echo htmlentities($v['work_content']); ?></div></td>
                <td><div style="width: 270px;height:19.2px;overflow:hidden;"><?php echo htmlentities($v['ompletion_effect']); ?></div></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {

        $("textarea").each(function () {
            $(this).css("border","1px solid #ced4da")
            $(this).css("background","white")
        })

        //有序的排列每条业绩的编号顺序
        function numberOrder(){
            $("#table_2 tr:gt(0)").each(function () {
                $(this).children("td:eq(0)").text($(this).index());
            })
        }
        numberOrder();

        //新增或修改
        $("#submit_form").click(function () {
            var formdata = new FormData(document.getElementById("myform"));
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdNewAchievement'); ?>?uid=<?php echo htmlentities($uid); ?>",
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
                            "<td><input class='center' name='checkbox' type='checkbox'></td>" +
                            "<td><a href='#' name='bj' myid='"+data['where']['tb_nr_id']+"' title='单机'><img width='20px' src='/static/user/img/edit.png' alt=''></a></td>" +
                            "<td>"+data['data']['start_time']+"</td>" +
                            "<td>"+data['data']['end_time']+"</td>" +
                            "<td><div style='width:200px;height:19.2px;overflow: hidden'>"+data['data']['technical_work']+"</div></td>" +
                            "<td><div style='width:230px;height:19.2px;overflow: hidden'>"+data['data']['work_content']+"</div></td>" +
                            "<td><div style='width:270px;height:19.2px;overflow: hidden'>"+data['data']['ompletion_effect']+"</div></td>" +
                            "</tr>"
                        $("#table_2 tbody").append(str);
                        numberOrder();
                    }else if(data["type"] == "update"){
                        layer.msg("修改成功")
                        $("[name=bj]").each(function () {
                            if($(this).attr("myid") == data["where"]["tb_nr_id"]){
                                var obj = $(this).parent();
                                for (var i in data["data"]){
                                    obj = obj.next();
                                    obj.text(data["data"][i])
                                }
                            }
                        });
                    }
                }
            });
        });

        //显示修改信息
        $("[name=bj]").click(function () {
            $.ajax({
                url:"<?php echo url('Modal/showNewAchievementone'); ?>",
                type:"post",
                datatype:"json",
                data:{tb_nr_id:$(this).attr("myid")},
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
            var ids = "";
            $("[name=checked]:checked").each(function () {
                ids = ids + "," + $(this).parent().next().children("a").attr("myid");
            });
            ids = ids.substr(1,ids.length);
            var achievementid = "";
            $("[name=checked]:checked").each(function () {
                achievementid = achievementid + "," + $(this).parent().next().children("a").attr("myachievementid");
            });
            achievementid = achievementid.substr(1,achievementid.length);
            layer.confirm("您确定要删除吗",function () {
                $.ajax({
                    url:"<?php echo url('Modal/delNewAchievement'); ?>?uid=<?php echo htmlentities($uid); ?>",
                    type:"post",
                    datatype:"json",
                    data:{ids:ids,achievementid:achievementid},
                    success:function (data) {
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }

                        if(data > 0){
                            $("[name=checked]:checked").parent().parent().remove();
                            layer.msg("删除成功")
                            numberOrder();
                        }
                    }
                })
            })
        });
    });
</script>
</html>