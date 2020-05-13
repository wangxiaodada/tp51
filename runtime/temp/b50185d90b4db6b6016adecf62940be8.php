<?php /*a:1:{s:76:"E:\phpStudy\WWW\tp51\application\admin\view\Index\Admin\achievementtype.html";i:1587893189;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>业绩分类管理</title>
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

    .widthAndDisplay{
        width: 175px;
        display: inline-block;
    }

    label{
        display: inline-block;
    }

    .modal_div{
        margin-bottom: 10px;
    }

    ul li{
        list-style: none;
        float: left;
    }

    .top_ul{
        height: 18px;
        background: white;
    }


</style>
<body>
<table id="table" width="100%">
    <ul id="top_ul" class="top_ul">
        <li><a href="<?php echo url('IndexAdminAchievementType/showAchievementType'); ?>">顶级分类</a></li>
        <?php foreach($parents as $v): ?>
        <li>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo url('IndexAdminAchievementType/showAchievementType'); ?>?parent_id=<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <btn id="insert" style="margin-bottom: 10px" class="btn btn-info btn-sm">新增</btn>
    <tr>
        <td style="width: 100px">分类编号</td>
        <td >业绩分类名称</td>
        <td style="width: 200px">操作</td>
    </tr>
    <?php if(count($data) != 0): foreach($data as $v): ?>
    <tr>
        <td><?php echo htmlentities($v['id']); ?></td>
        <td><?php echo htmlentities($v['name']); ?></td>
        <td>
            <a href="<?php echo url('IndexAdminAchievementType/showAchievementType'); ?>?parent_id=<?php echo htmlentities($v['id']); ?>"><button class="btn btn-primary btn-xs">查询下级</button></a>
            <button name="updatetype" class="btn btn-primary btn-xs">修改</button>
            <button name="del" myid="<?php echo htmlentities($v['id']); ?>" class="btn btn-danger btn-xs">删除</button>
        </td>
    </tr>
    <?php endforeach; else: ?>
    <td style="display: none"></td>
    <td colspan="7">没有查询到数据</td>
    <?php endif; ?>
</table>
<div style="margin-top: -25px">
    <?php echo $data; ?>
</div>
<!--新增业绩 start-->
<div class="modal fade" id="Modalallachievement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="modal_one_div" class="modal-dialog"style="width: 675px;">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalallachievementLabel">业绩类别</h4>
            </div>
            <div style="padding: 20px">
                <form id="myform" action="">
                    <div class="modal_div">
                        <span id="parent_span">父类名称：</span>
                        <select class="form-control widthAndDisplay" name="parent_id">
                            <option value="0">顶级分类</option>
                            <?php foreach($data as $v): ?>
                            <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <span>业绩分类名称：</span>
                        <input type="text" name="name" style="width: 82%" class="form-control widthAndDisplay"  >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" updid="" id="submit_form" class="btn btn-primary">保存</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--新增业绩 end-->

</body>
<script type="text/javascript">
    $(function () {
        // setNum();

        //新增业绩类别
        $("#insert").click(function () {
            $("[name=parent_id]").remove();
            var str = "<select class='form-control widthAndDisplay' name='parent_id'>" +
                "<option value='0'>顶级分类</option>" +
                "<?php foreach($alldata as $v): ?>" +
                "<option value='<?php echo htmlentities($v['id']); ?>'><?php echo htmlentities($v['name']); ?></option>" +
                "<?php endforeach; ?>" +
                "</select>";
            $("#parent_span").append(str);
            $("[name = name]").val();
            $("#submit_form").attr("updid","");
            $("#Modalallachievement").modal("show");
        });


        // 查询下一级
        $("body").on("change","[name=parent_id]",function () {
            var obj = $(this);
            obj.nextAll().remove();
            if(obj.val() == 0 || obj.val() == obj.prev().val()){
                return false;
            };
            $.ajax({
                url:"<?php echo url('IndexAdminAchievementType/selectNext'); ?>",
                type:"post",
                dataType:"json",
                data:{"parent_id":$(this).val()},
                success:function (data) {
                    if(data != ""){
                        var str = "<select class='form-control widthAndDisplay' name='parent_id' id=''>";
                        str += "<option value='"+obj.val()+"'>添加到上级分类目录</option>";
                        for(var i in data){
                            str += "<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";
                        }
                        str += "</select>";
                        obj.after(str);
                        if(obj.index() > 2){
                            $("#modal_one_div").css("width",(obj.index()-2)*175+675);
                        }
                    }
                }
            });
        });

        //业绩保存（修改或新增）
        $("#submit_form").click(function () {
            $.ajax({
                url:"<?php echo url('IndexAdminAchievementType/preservation'); ?>",
                type:"post",
                dataType:"json",
                data:{parent_id:$("[name=parent_id]:last").val(),name:$("[name=name]").val()},
                success:function (data) {
                    layer.msg("添加成功",{time:1000,end:function () {
                            location.reload();
                        }});
                }
            });
        });

        //显示修改页面
        $("[name=updatetype]").click(function () {
            var id = $(this).parent().prev().prev().text();
            $("#submit_form").attr("updid",id);
            $.ajax({
                url:"<?php echo url('IndexAdminAchievementType/showAchievementTypeOne'); ?>",
                type:"post",
                dataType:"json",
                data:{id:id},
                success:function (data) {
                    $("[name = name]").val(data[0][data[0].length-1]["name"]);
                    $("[name = parent_id]").remove();
                    var str = "";
                    for(var i in data[1]){
                        if(i != data[1].length-1 || data[1].length == 1) {
                            str += "<select class='form-control widthAndDisplay' name='parent_id'>";
                            if (i == 0) {
                                str += "<option value='0'>顶级分类</option>";
                            } else {
                                str += "<option value='" + data[1][i][0]['parent_id'] + "'>添加到上级分类</option>";
                            }
                            for (var a in data[1][i]) {
                                if (data[0][i]["id"] == data[1][i][a]['id'] && data[1].length > 1) {
                                    str += "<option selected value='" + data[1][i][a]['id'] + "'>" + data[1][i][a]['name'] + "</option>";
                                } else {
                                    str += "<option value='" + data[1][i][a]['id'] + "'>" + data[1][i][a]['name'] + "</option>";
                                }
                            }
                            str += "</select>";
                        }
                    }
                    $("#parent_span").append(str);
                }
            })

            $("#Modalallachievement").modal("show");
        });

        $("[name=del]").click(function () {
            console.log($(this).attr("myid"))
            var obj = $(this);
            var id = obj.attr("myid");
            layer.confirm("您确定要删除吗",{btn:["确定","取消"]},function () {
                $.ajax({
                    url:"<?php echo url('IndexAdminAchievementType/del'); ?>",
                    type:"post",
                    dataType:"json",
                    data:{id:id},
                    success:function (data) {
                        if(data["code"] == 1){
                            if(data["num"] > 0){
                                layer.msg("删除成功");
                                obj.parent().parent().remove();
                            }else{
                                layer.msg("没有删除数据，请刷新后查看此条数据是否还存在");
                            }
                        }
                    }
                })
            })
        })
    });
</script>
</html>