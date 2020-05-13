// var info;
// var id;
// var url = window.location.search;
// if(url.indexOf("?") != -1){
// 	id = url.substr(url.indexOf("=")+1);
// 	}else{
// 		 window.location.href = '../index.html'
// 	}


new Vue({
	el:'#swipper',
	data:{
		imgs:["/static/test-demo2/img/test1.jpg","/static/test-demo2/img/test2.jpg","/static/test-demo2/img/test3.jpg","/static/test-demo2/img/test4.jpg","/static/test-demo2/img/test5.jpg"]
	},
	mounted() {
		layui.use('carousel', function(){
		  var carousel = layui.carousel;
		  //建造实例
		  carousel.render({
		    elem: '#swipper'
		    ,width: '100%' //设置容器宽度
			,height: '400px'
		    ,arrow: 'always' //始终显示箭头
		    //,anim: 'updown' //切换动画方式
			,interval: 3000
		  });
		});
	}
})

new Vue({
	el:'#container',
	data:{
		list:[
			{"href":"/showWritePingshen","img":"/static/test-demo2/assets/pingshen.png"}, //显示填写评审信息
			{"href":"/previewPingshen","img":"/static/test-demo2/assets/info-pingshen.png"},
			{"href":"/showWriteRending","img":"/static/test-demo2/assets/rending.png"},//显示填写认定信息
			{"href":"/previewRending","img":"/static/test-demo2/assets/info-rending.png"}
		]
	}
})