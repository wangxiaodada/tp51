<?php /*a:1:{s:57:"E:\phpStudy\WWW\tp51\application\user\view\html\info.html";i:1587952879;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>信息填报系统</title>
		<link rel="stylesheet" href="/static/test-demo2/css/info.css"/>
		<link rel="stylesheet" href="/static/test-demo2/css/layui.css"/>
		<script type="text/javascript" src="/static/jquery.min.js"></script>
		<script src="/static/test-demo2/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/static/test-demo2/layui.js"></script>
	</head>
	<body>
		<div class="wrap" v-cloak>
			<div class="head">
				<div class="page_title">
					<p>信息填报系统</p>
				</div>
				<div class="contact">
					
				</div>
			</div>
			
			<div class="layui-carousel" id="swipper">
			  <div carousel-item>
			    <div v-for="img in imgs">
					<img :src="img"/>
				</div>
			  </div>
			</div>
			
			<div class="container" id="container">
				<div v-for="i in list" class="inner">
					<a :href="i.href">
						<img :src="i.img">
					</a>
				</div>
			</div>
			
			<ul>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
</body>
<script src="/static/test-demo2/js/mainPage.js"></script>
<script type="text/javascript">
	$(function () {
	    console.log("/<?php echo htmlentities(app('session')->get('user01.id')); ?>")

		$("#container div a").each(function(){
			$(this).prop("href", $(this).prop("href")+"/<?php echo htmlentities(app('session')->get('user01.id')); ?>")
		})
    })
</script>
</html>
