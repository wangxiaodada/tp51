<?php /*a:1:{s:61:"E:\phpStudy\WWW\tp51\application\user\view\html\pingshen.html";i:1588991602;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>评审预览</title>
		<link rel="stylesheet" href="/static/test-demo2/css/pingshen.css"/>
		<script src="/static/test-demo2/js/jquery-3.4.1.js"></script>
		<script src="/static/test-demo2/layui.js"></script>
		<script src="/static/test-demo2/js/vue.min.js"></script>
	</head>
	<body>
        <form action="" id="form01">
		    <div id="pingshen" v-cloak>
			<!-- 营业执照 -->
			<div id="yyzz" class="paper_A4_auto">
				<div class="pager_content_auto">
					<div class="studyinfo-title">现有职称证书</div>
					<div id="img" style="text-align: center" title="点击上传现有职称证书">
						<img src="/static/test-demo2/assets/upload-btn-add.png" class="businessLicense">
						<input class="uploadImg file1" style="opacity: 0;" type="file" name="file01">
					</div>
				</div>
			</div>
			<!-- 基本信息 -->
			<div id="baseinfo" class="paper_A4 baseinfo">
				<div class="pager_content">
					<div class="baseinfo-title">基&nbsp;&nbsp;本&nbsp;&nbsp;情&nbsp;&nbsp;况</div>
					<table class="baseinfo-table1" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="2">姓 名</td>
							<td>
								<span>*</span>
								现名
							</td>
							<td><input type="text" name="name" value="<?php echo htmlentities(app('session')->get('user01.name')); ?>"/></td>
							<td><span>*</span>性别</td>
							<td>
								<select name="sex">
									<option v-for="i in sex">{{i}}</option>
								</select>
							</td>
							<td><span>*</span>民族</td>
							<td>
								<input type="text" name="nation" value="" list="nation"/>
								<datalist id="nation">
									<option v-for="i in nations">{{i.name}}</option>
								</datalist>
							</td>
							<td colspan="2" rowspan="4" style="width: 23%;">
								<div title="点击上传头像">
									<img src="/uploads/addpic.png" class="businessLicense">
									<input class="uploadImg file1" style="opacity: 0;" type="file" name="file02">
								</div>
								<!-- 头像 -->
							</td>
						</tr>
						<tr>
							<td>曾用名</td>
							<td><input name="oldname" type="text"/></td>
							<td><span>*</span>身份证号码</td>
							<td colspan="3" style="width: 33%;">
								<input type="text" name="cardid"  value="<?php echo htmlentities((app('session')->get('user01.cardid') ?: '')); ?>"/>
							</td>
						</tr>
						<tr>
							<td>出生地</td>
							<td colspan="3" style="width: 33%;">
								<select style="width: 45%;" id="pid" @click="getC">
									<option>请选择省</option>
									<option v-for="i in provinces" :value="i.id">{{i.name}}</option>
								</select>
								<select style="width: 45%;">
									<option>请选择市</option>
									<option v-for="i in cities" :value="i.city_id">{{i.city_name}}</option>
								</select>
							</td>
							<td>出生年月</td>
							<td colspan="2" style="width: 22%">
								<input type="text" class="time" readonly="readonly" id="birthday">
							</td>
						</tr>
						<tr>
							<td colspan="2" style="width: 22%;"><span>*</span>参加工作时间</td>
							<td colspan="2" style="width: 22%;">
								<input type="text" class="time" readonly="readonly" name="work_start_time">
							</td>
							<td><span>*</span>身体状况</td>
							<td colspan="2" style="width: 22%;">
								<select name="physicalcondition">
									<option>请选择</option>
									<option v-for="i in physical">{{i.name}}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><span>*</span>学历</td>
							<td colspan="2" style="width: 22%;">毕（肄、结）业时间</td>
							<td colspan="2" style="width: 22%;">学校</td>
							<td colspan="2" style="width: 22%;">专业</td>
							<td>学制</td>
							<td>学位</td>
						</tr>
						<tr>
                            <td >
                                <select name="education">
                                    <option></option>
                                    <option :value="i.id" v-for="i in education">{{i.name}}</option>
                                </select>
                            </td>
							<td colspan="2" style="width: 22%;">
								<input type="text" class="time" readonly="readonly" name="gra_time">
							</td>
							<td colspan="2" style="width: 22%;">
								<input type="text" name="gra_colleges" value="" list="college" />
								<datalist id="college">
									<option v-for="i in colleges">{{i.name}}</option>
								</datalist>
							</td>
							<td colspan="2" style="width: 22%;">
								<input type="text" name="major" value="" list="major" />
								<datalist id="major">
									<option v-for="i in majors">{{i.name}}</option>
								</datalist>
							</td>
							<td><input type="text" name="ed_system"/></td>
							<td>
								<select name="academicdegree">
									<option></option>
									<option v-for="i in degree">{{i}}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 90px;">现任专业技术职务的任职时间</td>
							<td colspan="2" style="height: 90px;">
								<input type="text" class="time" readonly="readonly" name="now_job_time">
							</td>
							<td colspan="3" style="height: 90px;">现从事何种专业技术工作</td>
							<td colspan="2" style="height: 90px;">
								<input type="text" name="now_job">
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 90px;">专业技术职务任职资格审批机关</td>
							<td colspan="7" style="height: 90px;">
								<textarea name="approval_office"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 90px;">现（兼）任行政职务及任职时间</td>
							<td colspan="7" style="height: 90px;">
								<textarea name="duties_and_time"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 90px;">何时加入中国共产党任何职务</td>
							<td colspan="7" style="height: 90px;">
								<textarea name="communist_job"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 90px;">何时何地参加何种民主党派任何职务</td>
							<td colspan="7" style="height: 90px;">
								<textarea name="other_party_job_time"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 90px;">参加何种学术团体、任何种职务有何社会兼职</td>
							<td colspan="7" style="height: 90px;">
								<textarea name="academic_organization_job_time"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 90px;">懂何种外语达到何种程度</td>
							<td colspan="7" style="height: 90px;">
								<textarea name="language_level"></textarea>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!-- 学习培训经历 -->
			<div id="studyinfo" class="paper_A4_auto baseinfo">
				<div class="pager_content_auto">
					<div class="studyinfo-title">学&nbsp;习&nbsp;培&nbsp;训&nbsp;经&nbsp;历</div>
					<div class="studyinfo-subtitle">（包括参加专业学习、培训、国内外进修）</div>
					<div class="studyinfo-tab">
						<div class="studyinfo-tab-tr-hd">
							<div>
								起止时间
							</div>
							<div>
								专业或主要内容
							</div>
							<div>
								学习地点
							</div>
							<div>
								证明人
							</div>
						</div>
						<div v-for="i in 8" class="studyinfo-tab-tr" name="study_exp">
							<div>
								<input class="time" readonly="readonly" my_data_name="start_time" style="height: 2.375rem;"/>
								至
								<input class="time" readonly="readonly" my_data_name="end_time" style="height: 2.375rem;"/>
							</div>
							<div>
								<textarea my_data_name="major" style="width: 90%;"></textarea>
							</div>
							<div><textarea my_data_name="learningplace" style="width: 90%;"></textarea></div>
							<div><textarea my_data_name="witness" style="width: 90%;"></textarea></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 工作经历 -->
			<div id="workexpinfo" class="paper_A4_auto baseinfo">
				<div class="pager_content_auto">
					<div class="studyinfo-title">工&nbsp;&nbsp;作&nbsp;&nbsp;经&nbsp;&nbsp;历</div>
					<div class="studyinfo-tab">
						<div class="studyinfo-tab-tr-hd">
							<div>
								起止时间
							</div>
							<div>
								单&nbsp;&nbsp;&nbsp;&nbsp;位
							</div>
							<div>
								从事何专业技术工作
							</div>
							<div>
								职&nbsp;&nbsp;&nbsp;&nbsp;务
							</div>
						</div>	
						<div v-for="i in 8" class="studyinfo-tab-tr" name="work_exp">
							<div>
								<input class="time" readonly="readonly" my_data_name="start_time" style="height: 2.375rem;"/>
								至
								<input class="time" readonly="readonly" my_data_name="end_time" style="height: 2.375rem;"/>
							</div>
							<div>
								<textarea my_data_name="workunit" style="width: 90%;"></textarea>
							</div>
							<div><textarea my_data_name="professional_work" style="width: 90%;"></textarea></div>
							<div><textarea my_data_name="post" style="width: 90%;"></textarea></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 任现职前主要专业技术工作业绩登记 -->
			<div id="zc06beforeinfo" class="paper_A4_auto baseinfo">
				<div class="pager_content_auto">
					<div class="studyinfo-title">任现职前主要专业技术工作业绩登记</div>
					<div class="studyinfo-tab">
						<div class="studyinfo-tab-tr-hd">
							<div>
								起止时间
							</div>
							<div>
								专业技术工作名称（项目、课题、成果）等
							</div>
							<div>
								工作内容，本人起何作用（主持、参与、独立）
							</div>
							<div>
								完成情况及效果（获何奖励效益或专利）
							</div>
						</div>	
						<div v-for="i in 8" class="studyinfo-tab-tr" name="past_results">
							<div>
								<input class="time" readonly="readonly" my_data_name="start_time" style="height: 2.375rem;"/>
								至
								<input class="time" readonly="readonly" my_data_name="end_time" style="height: 2.375rem;"/>
							</div>
							<div>
								<textarea my_data_name="technical_work" style="width: 90%;"></textarea>
							</div>
							<div><textarea my_data_name="work_content" style="width: 90%;"></textarea></div>
							<div><textarea my_data_name="achievement_id" style="width: 90%;"></textarea></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 任现职后主要专业技术工作业绩登记 -->
			<div id="zc06afterinfo" class="paper_A4_auto baseinfo">
				<div class="pager_content_auto">
					<div class="studyinfo-title">任现职后主要专业技术工作业绩登记</div>
					<div class="studyinfo-tab">
						<div class="studyinfo-tab-tr-hd">
							<div>
								起止时间
							</div>
							<div>
								专业技术工作名称（项目、课题、成果）等
							</div>
							<div>
								工作内容，本人起何作用（主持、参与、独立）
							</div>
							<div>
								完成情况及效果（获何奖励效益或专利）
							</div>
						</div>	
						<div v-for="i in 8" class="studyinfo-tab-tr" name="now_results">
							<div>
								<input class="time" my_data_name="start_time" readonly="readonly" style="height: 2.375rem;"/>
								至
								<input class="time" my_data_name="end_time" readonly="readonly" style="height: 2.375rem;"/>
							</div>
							<div>
								<textarea my_data_name="technical_work" style="width: 90%;"></textarea>
							</div>
							<div><textarea my_data_name="work_content" style="width: 90%;"></textarea></div>
							<div><textarea my_data_name="ompletion_effect" style="width: 90%;"></textarea></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 著作、论文及重要技术报告登记 -->
			<div id="zc07info" class="paper_A4_auto baseinfo">
				<div class="pager_content_auto">
					<div class="studyinfo-title">著作、论文及重要技术报告登记</div>
					<div class="studyinfo-tab">
						<div class="studyinfo-tab-tr-hd">
							<div>
								日&nbsp;&nbsp;&nbsp;&nbsp;期
							</div>
							<div>
								名称及内容提要
							</div>
							<div>
								出版、登载获奖或在学术会议上交流情况
							</div>
							<div>
								全（独）著、译
							</div>
						</div>	
						<div v-for="i in 8" class="studyinfo-tab-tr" name="report">
							<div>
								<input class="time" my_data_name="time" readonly="readonly" style="height: 2.375rem;"/>
							</div>
							<div>
								<textarea  my_data_name="content" style="width: 90%;"></textarea>
							</div>
							<div><textarea  my_data_name="com_situation" style="width: 90%;"></textarea></div>
							<div><textarea  my_data_name="writing_translation" style="width: 90%;"></textarea></div>
						</div>
					</div>
				</div>
			</div>
			<!-- 职称考试及考核情况 -->
			<div id="zc08info" class="paper_A4_auto baseinfo">
				<div class="pager_content_auto">
					<div class="studyinfo-title">职称考试及考核情况记</div>
					<div class="studyinfo-tab">
						<div class="studyinfo-tab-tr-hd">
							<div style="width: 13%;">
								日期
							</div>
							<div style="width: 13%;">
								考试种类
							</div>
							<div style="width: 13%;">
								考试科目
							</div>
							<div style="width: 13%;">
								考试成绩
							</div>
							<div style="width: 35%;">
								组织考试部门
							</div>
						</div>	
						<div v-for="i in 8" class="studyinfo-tab-tr" name="exam">
							<div style="width: 13%; height: 1.875rem;">
								<input class="time" readonly="readonly" my_data_name="time" style="height: 95%;"/>
							</div>
							<div style="width: 13%; height: 1.875rem;">
								<input type="text" my_data_name="type" style="height: 95%;"/>
							</div>
							<div style="width: 13%; height: 1.875rem;"><input type="text"style="height: 95%;" my_data_name="subject"/></div>
							<div style="width: 13%; height: 1.875rem;"><input type="text"style="height: 95%;" my_data_name="achievement" /></div>
							<div style="width: 17%; height: 1.875rem;"><input type="text"style="height: 95%;" my_data_name="organization_department" /></div>
							<div style="width: 18%; height: 1.875rem;"><input type="text"style="height: 95%;"/></div>
						</div>
					</div>
				</div>
			</div>
			<div class="opbtn" style="display:block;bottom:0px;right:1px!important;right:18px;width:205px;line-height:30px;position:fixed;text-align:center;color:#fff;">
				<input type="button" class="btn-submit" style="width: 80px;border-radius: 4px;text-align: center" @click="ss();" value="返回">
                <input type="button" id="btnSubmit" class="btn-submit" style="width: 80px;border-radius: 4px" @click="btn_submit()" value="提交">
			</div>
		</div>
        </form>
    </body>
    <script src="/static/test-demo2/js/pingshen.js"></script>
    <script type="text/javascript">
		var cardid = "<?php echo htmlentities(app('session')->get('user01.cardid')); ?>";
		var birthday = cardid.substr(6,4) + "-" + cardid.substr(10,2) + "-" + cardid.substr(12,2);
		$("#birthday").val(birthday)

        function ss(){
            window.history.go(-1);
		}

		$(function () {
            $("[name=file02]").prev().width($("[name=file02]").parent().parent().width());
            $("[name=file02]").prev().height($("[name=file02]").parent().parent().height());

            function input_file_width_height(elementName){
                $("[name="+elementName+"]").width($("[name="+elementName+"]").prev().width());
                $("[name="+elementName+"]").height($("[name="+elementName+"]").prev().height());
                $("[name="+elementName+"]").css({"top":-$("[name="+elementName+"]").prev().height(),"position":"relative"});
                $("[name="+elementName+"]").parent().height($("[name="+elementName+"]").prev().height());
            }
            input_file_width_height("file01");
            input_file_width_height("file02");

            /**
             * 将上传的图片显示出来
             * */
            $("input:file").change(function () {
                var $file=$(this);
                var fileobj=$file[0];
                var windowUrl=window.URL || window.webkitURL;
                var dataURL;
                var $img=$file.prev();
                if (fileobj && fileobj.files&&fileobj.files[0]){
                    dataURL=windowUrl.createObjectURL(fileobj.files[0]);
                    $img.prop('src',dataURL);
                    //获取上传图片的真实高度和宽度
                    var image = new Image();
                    image.src = dataURL;
                    var max_width = $file.prop("name") != "file02" ? $(".pager_content_auto").width() : $file.parent().parent().width()-10;  //上传图片后的最大
                    image.onload = function(){
                        var width = image.width;
                        var height = image.height;
                        if(width > max_width){
                            var i = max_width/width;
                            height = i*height;
                            width = max_width;
                        }
                        if($file.prop("name") == "file02") {
                            if (height > $file.parent().parent().height()) {
                                height = $file.parent().parent().height();
                                width = height / $file.parent().parent().height() * width;
                                console.log(height);
                                console.log(width);
                            }
                        }
                        $file.width(width);
                        $file.height(height);
                        $img.width(width);
                        $img.height(height);
                        $file.css({"top":-height})
                        $file.parent().height(height);
                    };
                }
            });
        })
    </script>
</html>
