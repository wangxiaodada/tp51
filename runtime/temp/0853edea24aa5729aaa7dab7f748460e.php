<?php /*a:1:{s:60:"E:\phpStudy\WWW\tp51\application\admin\view\Index\holle.html";i:1589275806;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>你好</title>
</head>
<script type="text/javascript" src="/static/jquery.min.js"></script>
<style type="text/css">
    img{width: 150px;height: 150px;position: absolute;left: 0px;top: 0px;}
</style>
<body>
    你好 ! <?php echo htmlentities(app('session')->get('admin.nick_name')); ?>
    <!--&#45;&#45; <?php echo htmlentities(app('session')->get('post.post_id')); ?>-->
    <!--<?php foreach(app('session')->get('admin') as $v): ?>-->
    <!--<?php echo htmlentities($v); ?>-->
    <!--<?php endforeach; ?>-->


</body>
</html>