var id;
var url = window.location.search;
if(url.indexOf("?") != -1){
	id = url.substr(url.indexOf("=")+1);
	console.log(id)
	}else{
		 // window.location.href = '../index.html'
	}
/**
 *	日历控件 
 */
layui.use('laydate', function(){
	lay('.time').each(function(){
		var laydate = layui.laydate;
		laydate.render({
			elem: this
			,trigger: 'click'
		})
	})
})

new Vue({
	el:'#rending #img',
	mounted(){
		
	}
})

/**
 * 基本信息
 */
var baseinfo = new Vue({
	el:'#rending #baseinfo',
	data:{
		tips:'无内容时请填写无',
        sex:["请选择","男","女"],
		provinces:[],
		cities:[],
		nations:[],
		politics:[],
		physical:[],
		academic:[],
		colleges:[],
		majors:[]
	},
	mounted(){
		this.getP();
		this.getN();
		this.getPo();
		this.getPh();
		this.getA();
		this.getCo();
		this.getM();
	},
	methods:{


		/**
		 * 省
		 */
		getP:function(){
			$.getJSON("/static/test-demo2/assets/json/provinces.json", function(result){
				for(i = 0; i < result.length; i++) {
					baseinfo.provinces.push(result[i]);
				}
			})
		},
		/**
		 * 市
		 */
		getC:function(){
			var pida = $('#pid').val();
			this.cities = [];
			$.getJSON("/static/test-demo2/assets/json/cities.json", function(result){
				for(i = 0; i < result.length; i++) {
					if(result[i].pid == pida){
						baseinfo.cities.push(result[i]);
					}
				}
			})
		},
		/**
		 * 民族
		 */
		getN:function(){
			$.getJSON("/static/test-demo2/assets/json/nation.json", function(result){
				for(i = 0; i < result.length; i++) {
					baseinfo.nations.push(result[i]);
				}
			})
		},
		/**
		 * 政治面貌
		 */
		getPo:function(){
			$.getJSON("/static/test-demo2/assets/json/politics.json", function(result){
				for(i = 0; i < result.length; i++) {
					baseinfo.politics.push(result[i]);
				}
			})
		},
		/**
		 * 身体状况
		 */
		getPh:function(){
			$.getJSON("/static/test-demo2/assets/json/physical_condition.json", function(result){
				for(i = 0; i < result.length; i++) {
					baseinfo.physical.push(result[i]);
				}
			})
		},
		/**
		 * 学历类别
		 */
		getA:function(){
			$.getJSON("/static/test-demo2/assets/json/education.json", function(result){
				for(i = 0; i < result.length; i++) {
					baseinfo.academic.push(result[i]);
				}
			})
		},
		/**
		 * 毕业学院
		 */
		getCo:function(){
			$.getJSON("/static/test-demo2/assets/json/school.json", function(result){
				for(i = 0; i < result.length; i++) {
					baseinfo.colleges.push(result[i]);
				}
			})			
		},
		/**
		 * 所学专业
		 */
		getM:function(){
			$.getJSON("/static/test-demo2/assets/json/major.json", function(result){
				for(i = 0; i < result.length; i++) {
					baseinfo.majors.push(result[i]);
				}
			})
		}
	}
})



/**
 * 提交按钮
 */
new Vue({
	el:'#rending .opbtn',
	methods:{
		btn_submit:function(){
            layui.use('layer', function(){
                console.log(11)
                var layer = layui.layer;
                layer.confirm("提交后就不能修改，确定要提交吗",function () {
                    var formdata = new FormData(document.getElementById("rendingForm"));
                    //所有教育经历
                    var edu_exp = [];
                    $("#table02 tr:gt(1):not(:last)").each(function () {
                        var temp = {};
                        var tempnum = 0;
                        $(this).children().each(function () {
                            temp[$(this).children().attr("data-name")] = $(this).children().val();
                            // temp.push($(this).children().val());
                            $(this).children().val() =='' ? tempnum +=1 : "" ;
                        });
                        !(tempnum == 5) ? edu_exp.push(temp) : "";
                    });
                    formdata.append("edu_exp",JSON.stringify(edu_exp));

                    //所有见习工作情况
                    var probation_work_ituation = [];
                    $("#table03 tbody tr").each(function () {
                        var temp = {};
                        var tempnum = 0;
                        $(this).children().each(function () {
                            $(this).children().each(function () {
                                temp[$(this).attr("data-name")] = $(this).val();
                                $(this).val() == "" ? tempnum +=1 : "" ;
                            })
                        });
                        !(tempnum == 4) ? probation_work_ituation.push(temp) : "";
                    })
                    formdata.append("probation_work_ituation",JSON.stringify(probation_work_ituation));

                    var homeplace = $("#pid").val() + "," + $("#pid").next().val();
                    formdata.append("homeplace", homeplace);

                    formdata.append("id",$("#hidden_session_id").val());
                    $.ajax({
                        url: "/WriteRending",
                        type: "post",
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        data: formdata,
                        success: function (data) {
                        	if(data["code"] == 2){
                        		layer.msg(data["error"])
							}else if(data["code"] == 1){
                                layer.msg("提交成功")
							}
                        }
                    })
                });
            });
		}
	}
			
})



