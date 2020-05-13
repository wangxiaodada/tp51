<?php /*a:1:{s:73:"E:\phpStudy\WWW\tp51\application\admin\view\Index\Admin\jurisdiction.html";i:1577946490;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>权限管理</title>
</head>
<link rel="stylesheet" href="/static/bootstrap-3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/admin/css/all.css">
<script type="text/javascript">
    function showmodal(){
        $("[name=checkbox]").prop("checked",false);
        $("#hidden_id").val("");
        $("#myModalLabel").text("添加岗位");
        $("#name").parent().show();
        $("#myModal").modal("show");
    }

    //新增或者修改岗位所具有的权限
    function submit_form() {
        var post_id = $("#hidden_id").val();
        var post_name = $("#name").val();
        var ids = "";
        $("[name=checkbox]:checked").each(function () {
            ids += "," + $(this).attr("myid");
        });
        ids = ids.substr(1,ids.length);
        if(post_id == "") {
            $.ajax({
                url: "<?php echo url('IndexAdminJurisdiction/insertPost'); ?>",
                type: "post",
                dataType: "json",
                data: {post_name: post_name,ids:ids},
                success: function (data) {
                    if (data > 0) {
                        layer.msg("添加成功!", {
                            time: 1000, end: function () {
                                location.reload();
                            }
                        });
                    }
                }
            });
        }else {
            $.ajax({
                url: "<?php echo url('IndexAdminJurisdiction/updatePost'); ?>",
                type: "post",
                dataType: "json",
                data: {post_id: post_id,ids:ids},
                success: function (data) {
                    if (data > 0) {
                        layer.msg("修改成功!", {time: 1000});
                    }
                }
            });
        }
    }
</script>
<body>
<btn class="btn btn-info btn-sm" onclick="showmodal();" style="margin: 12px 0 0 12px">添加</btn>
<table class="admin_table" style="width: 100%">
    <tr>
        <td style="width: 150px">编号</td>
        <td>岗位</td>
        <td style="width: 300px">操作</td>
    </tr>
    <?php foreach($data as $v): ?>
    <tr>
        <td><?php echo htmlentities($v['id']); ?></td>
        <td><?php echo htmlentities($v['name']); ?></td>
        <td>
            <but name="seerole" myid="<?php echo htmlentities($v['id']); ?>" class="btn btn-primary btn-xs">点击查看权限</but>
            <but name="delete" class="btn btn-danger btn-xs">删除</but>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<!--//新增岗位的模态框-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">添加</h4>
            </div>
            <form id="from_modal" >
                <div style="width: 400px;margin: 10px " >
                    岗位名称：<input type="text" id="name" name="name" style="width: 300px;height: 33px;display: inline-block" class="form-control" placeholder="请输入岗位名称">
                </div>
                <div style="margin: 10px " >
                    赋予权限：
                    <input type="hidden" id="hidden_id" value="">
                    <ul>
                        <?php foreach($role as $v): ?>
                        <li style="list-style: none;width: 300px;float: left" >
                            <label >
                                <input myid="<?php echo htmlentities($v['id']); ?>" name="checkbox" style="vertical-align:middle;" type="checkbox"  >
                                <span style="vertical-align:middle;font-size: 13px"><?php echo htmlentities($v['name']); ?></span>
                            </label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  data-dismiss="modal">关闭</button>
                <button type="button" onclick="submit_form();" class="btn btn-primary">保存</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--新增岗位的模态框 end-->
</body>
<script type="text/javascript">
    $(function () {
        $("#from_modal").css("height",Math.ceil("<?php echo htmlentities($countRole); ?>"/2)*39+60);

        //查看岗位所拥有权限
        $("[name=seerole]").click(function () {
            var post_id = $(this).attr("myid");
            $("#name").parent().hide();
            var obj = $(this);
            $.ajax({
                url:"<?php echo url('IndexAdminJurisdiction/selectRole'); ?>" ,
                type:"post",
                dataType: "json",
                data:{post_id:post_id},
                success:function (data) {
                    $("[name=checkbox]").prop("checked",false);
                    if(data != ""){
                        $("[name=checkbox]").each(function () {
                            for(var i in data){
                                if(data[i]["id"] == $(this).attr("myid")){
                                    $(this).prop("checked",true);
                                    continue;
                                }
                            }
                        });
                    }
                    $("#hidden_id").val(post_id);
                    $("#myModalLabel").text("岗位 -- "+obj.parent().prev().text());
                }
            });
            $("#myModal").modal("show");
        });

        //删除
        $("[name=delete]").click(function () {
            var obj = $(this);
            var post_id = $(this).prev().attr("myid");
            layer.confirm("您确定要删除吗？",function () {
                $.ajax({
                    url:"<?php echo url('IndexAdminJurisdiction/deletePost'); ?>",
                    type:"post",
                    dataType:"json",
                    data:{post_id:post_id},
                    success:function (data) {
                        if(data > 0){
                            layer.msg("删除成功",{time:1000,end:function () {
                                    obj.parent().parent().remove();
                                }})
                        }
                    }
                });
            })

        });
    })
</script>

</html>