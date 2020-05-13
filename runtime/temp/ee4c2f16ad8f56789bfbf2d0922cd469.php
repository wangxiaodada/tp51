<?php /*a:1:{s:86:"E:\phpStudy\WWW\tp51\application\admin\view\modal\protitlerecidentifyingmaterials.html";i:1577949446;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传现有职称证书</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/admin/css/all.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<body>
    <h5 style="color: red"><span style="color: black">可预览的文件(点击文件可放大查看)</span>注意：营业执照为必须上传材料</h5>
    <div style="border: 1px solid #b2e2fa;margin-top: 1px;height: 300px" id="allpic">
        <div style="width: 250px;height: 150px;margin: 30px 0 20px 100px;display: inline-block">
            <img src="<?php echo htmlentities((isset($zc['src']) && ($zc['src'] !== '')?$zc['src']:'/static/user/img/camera.png')); ?>" id="showzc" width="250" height="150px" alt="">
            <div class="text-center">
                营业执照
            </div>
        </div>

        <div style="width: 250px;height: 150px;margin: 30px 0 20px 100px;display: inline-block">
            <img src="<?php echo htmlentities((isset($zczs['src']) && ($zczs['src'] !== '')?$zczs['src']:'/static/user/img/camera.png')); ?>" id="showzczs" width="250" height="150px" alt="">
            <div class="text-center">
                其他材料
            </div>
        </div>
    </div>
    <div style="height: 54px;margin-top: 20px;">
        <div class="float-right bottom_div">
            <a href="<?php echo url('Modal/showProTitleRecBaseInfo'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info"> << 申报基本信息</button></a>
            <form action="" id="myform1" style="display: inline-block">
            <div class="btn btn-info"  style="height: 31px;width: 105px;overflow: hidden" id="uploadzc">
                <div style="position: relative;">
                    上传营业执照
                </div>
                <div>
                    <input style="position: relative;bottom:25px;right: 10px;height: 31px;opacity: 0" id="zc" name="zc" type="file">
                </div>
            </div>
            </form>
            <form style="display: inline-block" action="" id="myform2">
            <div class="btn btn-info" style="height: 31px;width: 125px;overflow: hidden" id="uploadzczs">
                <div style="position: relative;">
                    上传其他材料
                </div>
                <div>
                    <input style="position: relative;bottom:25px;right: 10px;height: 31px;opacity: 0" id="zczs" name="zc" type="file">
                </div>
            </div>
            </form>
            <a href="<?php echo url('Modal/showProTitleRecProbation'); ?>?id=<?php echo htmlentities($uid); ?>"><button class="btn btn-info" id="next">见习工作情况 >></button></a>
        </div>
    </div>

    <form action="">

    </form>

</body>
<script type="text/javascript">
    $(function () {
        //将上传的营业执照图片显示出来
        $("#zc").change(function () {
            var $file=$(this);
            var fileobj=$file[0];
            var windowUrl=window.URL || window.webkitURL;
            var dataURL;
            var $img=$("#showzc");
            var formdata = new FormData(document.getElementById("myform1"));
            formdata.append("type","营业执照")
            if (fileobj && fileobj.files&&fileobj.files[0]){
                dataURL=windowUrl.createObjectURL(fileobj.files[0]);
                $img.prop('src',dataURL);
                $.ajax({
                    url:"<?php echo url('Modal/addOrUpdProTitleRecIdentifying'); ?>?uid=<?php echo htmlentities($uid); ?>",
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

                        if(data > 0){
                            layer.msg("上传成功")
                        }
                    }
                });
            }
        });

        //将上传的其他材料图片显示出来
        $("#zczs").change(function () {
            var str = "";
            $("#allpic").append(str);
            var $file=$(this);
            var fileobj=$file[0];
            var windowUrl=window.URL || window.webkitURL;
            var dataURL;
            var $img=$("#showzczs");
            if (fileobj && fileobj.files&&fileobj.files[0]) {
                dataURL = windowUrl.createObjectURL(fileobj.files[0]);
                $img.prop('src', dataURL);
                var formdata = new FormData(document.getElementById("myform2"));
                formdata.append("type", "其他材料")
                if (fileobj && fileobj.files && fileobj.files[0]) {
                    dataURL = windowUrl.createObjectURL(fileobj.files[0]);
                    $img.prop('src', dataURL);
                    $.ajax({
                        url: "<?php echo url('Modal/addOrUpdProTitleRecIdentifying'); ?>?uid=<?php echo htmlentities($uid); ?>",
                        type: "post",
                        datatype: "json",
                        data: formdata,
                        cache: false,                      // 不缓存
                        processData: false,                // jQuery不要去处理发送的数据
                        contentType: false,                // jQuery不要去设置Content-Type请求头
                        success: function (data) {
                            if(data["code"] == 0){
                                layer.msg("权限不足");
                                return false;
                            }

                            if (data > 0) {
                                layer.msg("上传成功")
                            }
                        }
                    });
                }
            }
        });
    });
</script>
</html>