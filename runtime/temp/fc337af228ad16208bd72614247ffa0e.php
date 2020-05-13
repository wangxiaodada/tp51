<?php /*a:1:{s:73:"E:\phpStudy\WWW\tp51\application\admin\view\modal\protitlerecsummary.html";i:1586744060;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传现有职称证书</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/user/css/all.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<style type="text/css">
    textarea{
        border: 1px solid #ced4da !important;
        background: white !important;
    }
</style>
<body >
    <h5 style="color: red"><span style="color: black">见习期主要工作业绩及奖惩情况及见习期工作小结</span></h5>

    <div style="border: 1px solid #b2e2fa;margin-top: 1px;margin-left:5px;height: 480px;padding: 10px 0 0 2px" id="allpic">
        <form action="" id="myform">
        见习期主要工作业绩及奖惩情况：
        <div style="height: 180px">
            <textarea style="height: 170px" name="main_achievements" class="form-control-plaintext"><?php echo htmlentities($data["main_achievements"]); ?></textarea>
        </div>
        见习期工作小结：
        <div style="height: 170px">
            <textarea style="height: 170px" name="summary_of_work" class="form-control-plaintext"><?php echo htmlentities($data["summary_of_work"]); ?></textarea>
        </div>
        </form>
        <div style="height: 54px;margin-top: 20px;">
            <div style="height: 54px">
                <div class="float-right">
                    <a href="<?php echo url('Modal/showProTitleRecProbation'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 见习工作情况</button></a>
                    <button class="btn btn-info" id="submit_form">保存</button>
                    <a href="/previewRending/<?php echo htmlentities($uid); ?>"><button id="preview" class="btn btn-info">预览提交 >></button></a>
                    <!--<a data-toggle="modal" href="<?php echo url('Preview/preview'); ?>" data-target="#myModal" rel="noopener noreferrer"><button id="preview" class="btn btn-info">预览提交 >></button></a>-->
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function () {
        $("#submit_form").click(function () {
            var formdata = new FormData(document.getElementById("myform"));
            $.ajax({
                url:"<?php echo url('Modal/addOrUpdProTitleRecSummary'); ?>?uid=<?php echo htmlentities($uid); ?>",
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

                    if(data == "add"){
                        layer.msg("添加成功");
                    }else if(data == "update"){
                        layer.msg("修改成功");
                    }
                }
            });
        });
        //
        // //预览模态框打开
        // $("#preview").click(function () {
        //     $("#myModal").modal("show");
        // });
    });
</script>
</html>