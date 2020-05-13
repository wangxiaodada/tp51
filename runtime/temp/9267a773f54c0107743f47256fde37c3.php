<?php /*a:1:{s:60:"D:\phpStudy1\WWW\tp51\application\user\view\Index\index.html";i:1586248713;}*/ ?>
<!DOCTYPE html>
<html xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<title></title>

	</head>
	<script src="/static/test-demo2/js/vue.js" type="text/javascript" charset="utf-8"></script>
	<script src="https://cdn.bootcss.com/vue-resource/1.5.1/vue-resource.js"></script>
	<script src="/static/jquery.min.js"></script>
	<link rel="stylesheet" href="/static/test-demo2/css/layui.css" media="all"/>
	<script type="text/javascript" src="/static/test-demo2/layui.js"></script>
	<!--  -->
	<link rel="stylesheet" href="/static/test-demo2/css/login.css">
	<body>		
		<div class="wrap">
			<div class="container">
				<h1>{{title}}</h1>
				<form>
					<input type="text" name="" id="userid" value="" v-bind:placeholder="placeholder1" v-model="user"/>
					<p id="info">{{tips}}</p>
					<input type="password" name="" id="password" value="" v-bind:placeholder="placeholder2" v-model="password"/>
					<p id="info2">{{tips2}}</p>
					<!-- <span>{{tips2}}</span> -->
					<input type="button" id="submit" v-bind:value="btn_text" v-on:click="login()"/>
					
				</form>
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
		<script src="/static/test-demo2/js/login_page.js" type="text/javascript"></script>
	</body>
</html>
