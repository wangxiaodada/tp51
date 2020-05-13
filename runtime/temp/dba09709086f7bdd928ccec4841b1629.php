<?php /*a:1:{s:73:"E:\phpStudy\WWW\tp51\application\admin\view\Index\Achievement\insert.html";i:1586329737;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新增业绩</title>
</head>
<link rel="stylesheet" href="/static/bootstrap-3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/admin/css/all.css">
<style type="text/css">
    ul{
        width: 890px;
    }
    .form_inline{
        height: 25px;
        display: inline-block;
        /*width: 200px;*/
        border-radius:4px;/*适配所有浏览器*/
        border: 1px solid #C6C4C4;
        outline: none;
    }
</style>
<body style="width: 880px;padding: 10px 0 0 10px;min-width: 880px">
<form id="myform" >
    <div style="margin: 0 0 10px 0;width: 400px">
        <label for="time">完成时间：</label>
        <input name="time" id="time" class="form_inline"  type="text" value="">个月
    </div>

    <div style="margin:0 10px 10px 0">
        <label for="type_id">业绩类别：</label>
        <select name="type_id" id="type_id" class="form_inline">
            <option value="">-</option>
            <?php if($data != ""): foreach($data as $v): ?>
            <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
            <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div style="height: 100px;margin-bottom: 15px">
        <label for="technical_work">专业技术工作名称(项目、课题、成果)等 作:</label><br>
        <textarea name="technical_work" id="technical_work" style="vertical-align:top;width: 99%;height: 80px" class=""></textarea>
    </div>

    <div style="height: 100px;margin-bottom: 15px">
        <label for="work_content">工作内容本人起何作用（主持参与、独立）:</label><br>
        <textarea name="work_content" id="work_content" style="vertical-align:top;width: 99%;height: 80px" class=""></textarea>
    </div>

    <div style="height: 100px;margin-bottom: 15px">
        <label for="ompletion_effect">完成情况及效果（获何奖励效益或专利）:</label><br>
        <textarea name="ompletion_effect" id="ompletion_effect" name="ompletion_effect" style="vertical-align:top;width: 99%;height: 80px" class=""></textarea>
    </div>

</form>
<div style="height: 54px;width: 850px">
    <div style="float: right" >
        <button class="btn btn-info" id="submit_form">保存</button>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {

        $("#submit_form").click(function () {
            var formdata = new FormData(document.getElementById("myform"));
            $.ajax({
                url:"<?php echo url('IndexAchievementAll/insertAchievement'); ?>",
                type:"post",
                dataType:"json",
                data:formdata,
                cache: false,                      // 不缓存
                processData: false,                // jQuery不要去处理发送的数据
                contentType: false,                // jQuery不要去设置Content-Type请求头
                success:function (data) {
                    if(data == 1){
                        layer.msg("添加成功");
                    }
                }
            });
        });

        $("body").on("change","[name=type_id]",function () {
            var obj = $(this);
            obj.nextAll().remove();
            if(obj.val() == obj.prev().val()){
                return false;
            }
            $.ajax({
                url:"<?php echo url('IndexAchievementAll/selectNext'); ?>",
                type: "post",
                dataType:"json",
                data:{type_id:obj.val()},
                success:function (data) {
                    if(data != ""){
                        var str = "<select name='type_id' class='form_inline'>"
                        str += "<option value='"+obj.val()+"'>添加到上级分类目录</option>";
                        for ( var i in data ) {
                            str += "<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>"
                        }
                        str += "</select>";
                        obj.after(str);
                    }
                }
            });
        });
    });
</script>
</html>