<?php /*a:1:{s:70:"E:\phpStudy\WWW\tp51\application\admin\view\modal\educationupload.html";i:1587457399;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>教育经历上传证书</title>
</head>
<link rel="stylesheet" href="/static/bootstrap-3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<link rel="stylesheet" href="/static/admin/css/educationUpload.css">
<body>
        <div id="div_max" class="div01">
            <?php foreach($data as $v): ?>
            <div class="div_img_opacity">
                <div class="div_div_img" >
                    <img myid="<?php echo htmlentities($v['edu_pic_id']); ?>" src="<?php echo htmlentities($v['src']); ?>" height="100" width="100px" >
                </div>
                <div class="div_div_03" style="background: white;height: 20px;top: 15px;opacity: 0.5;text-align: center;font-size: 13px;display: none"  >
                    删除
                </div>
            </div>
            <?php endforeach; ?>
            <div class="div_img_opacity">
                <div class="div_div_img" >
                    <img src="/uploads/addpic.png" height="100" width="100px" >
                </div>
                <form action="" id="uploadForm">
                    <div class="div_div_file">
                        <input title="点击上传图片" type="file" class="file" name="file" id="file">
                    </div>
                </form>
            </div>
        </div>
</body>
<script type="text/javascript">
    $(function () {
        //将上传的毕业证书显示出来
        $("#file").change(function () {
            var $file=$(this);
            var fileobj=$file[0];
            var windowUrl=window.URL || window.webkitURL;
            var dataURL;
            var $img=$("#file");
            if (fileobj && fileobj.files && fileobj.files[0]){
                dataURL=windowUrl.createObjectURL(fileobj.files[0]);
                var formdata = new FormData(document.getElementById("uploadForm"));
                formdata.append("edu_exp_id","<?php echo htmlentities($edu_exp_id); ?>");
                $.ajax({
                    url:"/modal/uploads",
                    type:"post",
                    dataType:"json",
                    data:formdata,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success:function (data) {
                        //上传成功在前面显示一张缩略图
                        if(data["code"] == 1){
                            layer.msg("上传成功");
                            var str = "<div class='div_img_opacity'>" +
                                "<div class='div_div_img'>" +
                                "<img src='"+dataURL+"' height='100' width='100px'>" +
                                "</div>" +
                                "<div class='div_div_03' style='background: white;height: 20px;top: 15px;opacity: 0.5;text-align: center;font-size: 13px;display: none'  >" +
                                "删除" +
                                "</div>" +
                                "</div>";
                            $file.parent().parent().parent().before(str);
                        }
                    }
                })
            }
        });

        $("body").on("mouseover",".div_img_opacity",function () {
            $(this).children(".div_div_03").show();
        }).on("mouseout",".div_img_opacity",function () {
            $(this).children(".div_div_03").hide();
        });

        $(".div_div_03").click(function () {
            var obj = $(this);
            var picid = obj.prev().children("img").attr("myid");
            layer.confirm("您确定要删除这张图片吗",{
                btn:["确定","取消"]
            },function () {
                $.ajax({
                    url:"/modal/delUploads",
                    type: "post",
                    dataType:"json",
                    data:{"picid":picid},
                    success:function (data) {
                        console.log(data);return false
                        if(data["code"] == 0){
                            layer.msg(data["msg"]);
                        }else if(data["code"] == 1){
                            layer.msg(data["msg"]);
                            obj.parent().remove();
                        }
                    }
                })
            })

        });

    })
</script>
</html>