var info;
var id;
var url = window.location.search;
var pics = new Array();
if(url.indexOf("?") != -1){
	id = url.substr(url.indexOf("=")+1);
	}
$.get('https://cdhrss.cdpx.org/showuserall/' + id,function(data){
	for(i = 0; i < data.ptr_pic.length; i++){
		pics.push('https://cdhrss.cdpx.org' + data.ptr_pic[i].src);
	}
	console.log(data)
})
console.log(id)

/**
 * 申报材料
 */
var yyzz = new Vue({
	el:'#rending #yyzz',
	data:{
		aaa:'ad',
		pics:pics
	}
})

/**
 * 基本信息
 */
