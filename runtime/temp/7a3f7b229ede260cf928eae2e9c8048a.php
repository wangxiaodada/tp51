<?php /*a:1:{s:70:"E:\phpStudy\WWW\tp51\application\admin\view\Index\Achievement\all.html";i:1586328905;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>所有业绩</title>
</head>
<link rel="stylesheet" href="/static/bootstrap-3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/admin/css/all.css">
<style type="text/css">
    body{
        padding: 10px 0 0 5px;
    }
    td{
        font-size: 13px;
        text-align: center;
        border: 1px solid black;
        padding: 5px 10px ;
    }

    .form_widtn{
        width: 200px;
        display: inline-block;
    }

    #modal_ul li{
        list-style-type: square;
        line-height: 33px;

        /*font-size: 13px;*/
    }

    .div_inline_block{
        display: inline-block;
    }
</style>
<script type="text/javascript">
    //设置编号
    function setNum() {
        $("#table tr").eq(0).nextAll().each(function () {
            $(this).children("td").eq(0).text($(this).index());
        })
    }
</script>
<body>
<table id="table" width="100%">
    <form class="form-inline" action="<?php echo url('IndexAchievementAll/index'); ?>" id="myform" role="form">
        <div  class="form-group div_inline_block input-group-sm">
            <label class="" style="font-weight:normal;font-size: 13px" for="time">完成时间:</label>
            <input type="text" class="form-control form_widtn" id="time" name="time" value="<?php echo htmlentities((isset($time) && ($time !== '')?$time:'')); ?>" placeholder="搜索输入示例：n个月">
        </div>
        <button class="btn btn-info btn-sm">查询</button>
        &nbsp;<btn id="insert" class="btn btn-info btn-sm">新增</btn>
    </form>
    <tr>
        <td style="width: 48px">编号</td>
        <td style="width: 78px" my="time">完成时间(月)</td>
        <td style="width: 158px" my="time">业绩类别</td>
        <td style="width: 260px" my="technical_work">专业技术工作名称(项目、课题、成果)等</td>
        <td style="width: 286px" my="work_content">工作内容本人起何作用（主持参与、独立）</td>
        <td style="width: 270px" my="ompletion_effect">完成情况及效果（获何奖励效益或专利）</td>
        <td>操作</td>
    </tr>
    <?php if(count($data) != 0): foreach($data as $v): ?>
    <tr>
        <td></td>
        <td><?php echo htmlentities($v['time']); ?></td>
        <td><?php echo htmlentities($v['name']); ?></td>
        <td><div style="width: 250px;overflow:hidden;"><?php echo htmlentities($v['technical_work']); ?></div></td>
        <td><div style="width: 256px;overflow:hidden;"><?php echo htmlentities($v['work_content']); ?></div></td>
        <td><div style="width: 260px;overflow:hidden;"><?php echo htmlentities($v['ompletion_effect']); ?></div></td>
        <td>
            <button class="btn btn-primary btn-xs" myid="<?php echo htmlentities($v['id']); ?>"  name="detailed">详情</button>
            <!--<button class="btn btn-primary btn-xs">修改</button>-->
            <button name="del" class="btn btn-danger btn-xs">删除</button>
        </td>
    </tr>
    <?php endforeach; else: ?>
        <td style="display: none"></td>
        <td colspan="7">没有查询到数据</td>
    <?php endif; ?>
</table>
<?php if(count($data) != 0): ?>
<div style="margin-top: -15px">
    <?php echo $data; ?>
</div>
<?php endif; ?>
<!--新增业绩 start-->
<div class="modal fade" id="Modalallachievement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"style="width: 900px;">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalallachievementLabel">业绩详情</h4>
            </div>
            <div>
                <iframe id="menuFrame" name="menuFrame" src="<?php echo url('IndexAchievementAll/showInsertAchievement'); ?>" style="overflow:visible;height: 460px" scrolling="yes" frameborder="no" width="100%" height="100%"></iframe>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--新增业绩 end-->

<!--业绩详情 start-->
<div class="modal fade" id="Modaldetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModaldetailsLabel">业绩详情</h4>
            </div>
            <ul id="modal_ul">
                <li id="starttimemodal">完成时间：<div style="display: inline-block"></div>个月</li>
                <li>业绩类别：<div style="display: inline-block"></div></li>
                <li>专业技术工作名称（项目、课题、成果）等：<div style="width: 500px;white-space:normal;word-break:break-all;word-wrap:break-word;"></div></li>
                <li>工作内容本人起何作用（主持参与、独立）：<div style="width: 500px;white-space:normal;word-break:break-all;word-wrap:break-word;"></div></li>
                <li>完成情况及效果（获何奖励效益或专利）：<div style="width: 500px;white-space:normal;word-break:break-all;word-wrap:break-word;"></div></li>
                <li >使用过的次数：<div style="display: inline-block"></div></li>
                <li style="list-style: none">
                    <div class="form-group div_inline_block input-group-sm">
                        <label class="" style="font-weight:normal;font-size: 13px" for="region">查看该在某个地区的使用次数：</label>
                        <select class="form-control form_widtn" name="" id="region">
                            <option value=""></option>
                            <?php foreach($data_region as $v): ?>
                            <option value="<?php echo htmlentities($v['id']); ?>" mypy="<?php echo htmlentities($v['py']); ?>"><?php echo htmlentities($v['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <btn class="btn btn-info btn-sm" myid="" style="margin-top: -4px" name="query">查询</btn>
                    </div>
                </li>
            </ul>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <!--<button type="button" onclick="insert_submit();" class="btn btn-primary">提交</button>-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--业绩详情 end-->
</body>
<script type="text/javascript">
    $(function () {
        setNum();

        //新增业绩
        $("#insert").click(function () {
            $("#Modalallachievement").modal("show");
        });

        //详情按钮点击事件
        $("[name=detailed]").click(function () {
            var id = $(this).attr("myid");
            $.ajax({
                url:"<?php echo url('IndexAchievementAll/showAchievementone'); ?>",
                type:"post",
                dataType:"json",
                data:{id:id},
                success:function (data) {
                    var obj = $("ul li").eq(0);
                    for(var i in data){
                        if(i != "id") {
                            obj.children("div").text(data[i]);
                            obj = obj.next();
                        }
                    }
                    $("[name=query]").attr("myid",data['id']);
                }
            });
            $("#Modaldetails").modal("show");   /*模态框开启*/
        });

        //详情模态框关闭
        $('#Modaldetails').on('hidden.bs.modal', function () {
            $("#modal_ul li").eq(6).nextAll().each(function () {
                $(this).remove();
            })
            // 执行一些动作...
        })

        //删除地区下拉框中的空
        $("#region").change(function () {
            $(this).children("option").each(function () {
                if($(this).val() == ""){
                    $(this).remove();
                }
            });
        });

        //查询某条业绩在某个地区的使用情况
        $("[name=query]").click(function () {
            var region_id = $("#region").val();
            if(region_id == ""){
                layer.msg("请先选择地区")
                return false;
            }
            var achievement_id = $(this).attr("myid");
            console.log(achievement_id);
            $.ajax({
                url:"<?php echo url('IndexAchievementAll/useSituation'); ?>",
                type:"post",
                dataType:"json",
                data:{region_id:region_id,achievement_id:achievement_id},
                success:function (data) {
                    var str = "<li style='list-style-type: disc'>此条业绩在"+data['name']+"使用过"+data['useituation']+"次</li>";
                    $("#modal_ul").append(str);
                }
            })
        });

        //删除业绩
        $("[name=del]").click(function () {
            layer.confirm("您确定要删除吗？",function () {
                $.ajax({
                    url:"<?php echo url('IndexAchievementAll/deleteAchievement'); ?>",
                    type:"post",
                    dataType:"json",
                    data:{id:$(this).siblings().eq(0).attr("myid")},
                    success:function (data) {
                        console.log(data)
                        if(data > 0){
                            layer.msg("删除完成",{time:2000,end:function () {
                                    location.reload();
                                }});
                        }
                    }
                });
            });
        });

    });
</script>
</html>