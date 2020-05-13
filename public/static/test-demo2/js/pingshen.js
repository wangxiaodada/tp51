// var id;
// var url = window.location.search;
// if(url.indexOf("?") != -1){
// 	id = url.substr(url.indexOf("=")+1);
// 	console.log(id)
// 	}else{
// 		 // window.location.href = '../index.html'
// 	}
/**
 *	日历控件 
 */
layui.use('laydate', function(){
	lay('.time').each(function(){
		const laydate = layui.laydate;
		laydate.render({
			elem: this
			,trigger: 'click'
		})
	})
})

new Vue({
	el:'#pingshen #img',
	mounted(){
		
	}
})

/**
 * 基本信息
 */
const baseinfoq = new Vue({
	el: '#pingshen #baseinfo',
	data() {
		return {
			tips: '无内容时请填写无',
			sex: ["请选择","男","女"],
			provinces: [],
			cities: [],
			nations: [],
			politics: [],
			physical: [],
			academic: [],
            education: [{"id":1,"name":"中专"},{"id":2,"name":"大专"},{"id":3,"name":"本科"},{"id":44,"name":"硕士研究生"},{"id":5,"name":"博士研究研究生"},],
			colleges: [],
			majors: [],
			degree: ['无', '学士', '硕士', '博士'],
		}
	},
	mounted() {
		this.getP();
		this.getN();
		this.getPo();
		this.getPh();
		this.getA();
		this.getCo();
		this.getM();
		// console.log(this.$data)
	},
	methods: {

		/**
		 * 省
		 */
		getP:function(){
			$.getJSON("/static/test-demo2//assets/json/provinces.json", function(result){
				baseinfoq.provinces = result;
			})
		},
		/**
		 * 市
		 */
		getC:function(){
			var pida = $('#pid').val();
			this.cities = [];
			$.getJSON("/static/test-demo2//assets/json/cities.json", function(result){
				for(i = 0; i < result.length; i++) {
					if(result[i].pid == pida){
						baseinfoq.cities.push(result[i]);
					}
				}
			})
		},
		/**=
		 * 民族
		 */
		getN:function(){
			$.getJSON("/static/test-demo2//assets/json/nation.json", function(result){
				baseinfoq.nations = result;
			})
		},
		/**
		 * 政治面貌
		 */
		getPo:function(){
			$.getJSON("/static/test-demo2/assets/json/politics.json", function(result){
				baseinfoq.politics = result;
			})
		},
		/**
		 * 身体状况
		 */
		getPh:function(){
			$.getJSON("/static/test-demo2//assets/json/physical_condition.json", function(result){
				baseinfoq.physical = result;
			})
		},
		/**
		 * 学历类别
		 */
		getA:function(){
			$.getJSON("/static/test-demo2//assets/json/education.json", function(result){
				baseinfoq.academic = result;
			})
		},
		/**
		 * 毕业学院
		 */
		getCo:function(){
			$.getJSON("/static/test-demo2//assets/json/school.json", function(result){
				baseinfoq.colleges = result;
			})
		},
		/**
		 * 所学专业
		 */
		getM:function(){
			$.getJSON("/static/test-demo2/assets/json/major.json", function(result){
				baseinfoq.majors = result;
			})
		}

	}
});


new Vue({
	el:'#pingshen #studyinfo'
})

new Vue({
	el:'#pingshen #workexpinfo'
})

new Vue({
	el:'#pingshen #zc06beforeinfo'
})

new Vue({
	el:'#pingshen #zc06afterinfo'
})

new Vue({
	el:'#pingshen #zc07info'
})

new Vue({
	el:'#pingshen #zc08info'
})

/**
 * 提交按钮
 */
new Vue({
	el:'#pingshen .opbtn',
	data:{
	},
	methods:{
		btn_submit:function(){
			layui.use('layer', function(){
				var layer = layui.layer;
				layer.confirm('提交后不可修改，若要修改请联系工作人员', {title:'提示'},function(index){
					var formdata = new FormData(document.getElementById("form01"));
					var homeplace = $("#pid").val()+","+$("#pid").next().val();
					formdata.append("homeplace",homeplace);
					formdata.append("study_exp",JSON.stringify(getTableData("study_exp")));
					formdata.append("work_exp",JSON.stringify(getTableData("work_exp")));
                    formdata.append("past_results",JSON.stringify(getTableData("past_results")));
                    formdata.append("now_results",JSON.stringify(getTableData("now_results")));
                    formdata.append("report",JSON.stringify(getTableData("report")));
                    formdata.append("exam",JSON.stringify(getTableData("exam")));
					$.ajax({
						url:"/pingshen",
						type:"post",
						dataType:"json",
						data:formdata,
                        processData: false,
                        contentType: false,
						success:function (data) {
                            if(data["code"] == 2){
                                layer.msg(data["error"])
                            }else if(data["code"] == 1){
                                layer.msg("提交成功")
                            }
						}
					})
				  layer.close(index);
				});
			})
			
		}
	}
			
})

function getTableData(name) {
    var data = [];
    $("[name="+name+"]").each(function () {
        var temp = {};
        var tempnum = 0;
        $(this).children().each(function () {
            $(this).children().each(function () {
            	if(typeof($(this).attr("my_data_name")) != "undefined") {
                    temp[$(this).attr("my_data_name")] = $(this).val();
                    $(this).val() == "" ? tempnum++ : "";
                }
            })
        })
        var n = 0;
        for(var i in temp){
            n++;
        }
        tempnum != n ? data.push(temp) : "" ;
    })
    return data;
}
