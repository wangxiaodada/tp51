<?php /*a:1:{s:60:"E:\phpStudy\WWW\tp51\application\admin\view\Login\login.html";i:1586486533;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=UTF-8">
    <title>欢迎登录</title>
</head>
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/static/user/login/css/login.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<script type="text/javascript">
    function tj() {


        var name = $("#name").val();
        var password = $("#password").val();
        var yzm = $("#yzm").val();
        if(name == ""){
            layer.alert("请输入帐号");
            return false;
        }
        if(password == ""){
            layer.alert("请输入密码");
            return false;
        }
        if(yzm == ""){
            layer.alert("请输入验证码");
            return false;
        }

        $.ajax({
            url:"/login",
            type:"post",
            dataType:"json",
            data:{name:name,password:password,yzm:yzm},
            success:function (data) {
                console.log(data)
                // return false;
                if(data != ""){
                    layer.msg(data);
                    $("#captcha").prop("src","<?php echo url('Index/verify'); ?>");
                }else{
                    layer.msg("登录成功");
                    // window.location.href="<?php echo url('Index/index'); ?>";
                    window.location.href="/show";
                }
            }
        });
    }

</script>
<body class="login">
    <div class="login_border" id="login_div">
        <form class="form-inline">
            <div class="div">
                <label for="name" >账号:</label>
                <input type="text" id="name"  name="name" class="form-control" value="" placeholder="请输入帐号">
            </div>

            <div class="div">
                <label for="password" >密码:</label>
                <input type="password" name="password" id="password" class="form-control " value="" placeholder="请输入密码">
            </div>

            <div class="float-left div">
                <label for="yzm" style="display: inline-block" >验证码:</label>
                <input type="text" name="yzm" id="yzm" class="form-control yzm" value="" >
                <img width="80px" height="38px" src="<?php echo url('Index/verify'); ?>" id="captcha"  alt="验证码">
            </div>
        </form>
        <div class="button_div">
            <button id="submit" class="btn btn-primary btn-sm button_sub">登录</button>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function () {
        $(document).keydown(function (event) {
            switch (event.keyCode) {
                case 13:
                    tj();
                    break;
                default: break;
            }
        });

        $("#captcha").click(function () {
            $(this).prop("src","<?php echo url('Index/verify'); ?>");
        });

        // 提交登录
        $("#submit").click(function () {
            tj();
        });
    });
</script>
</html>