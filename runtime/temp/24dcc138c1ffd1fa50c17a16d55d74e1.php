<?php /*a:1:{s:60:"E:\phpStudy\WWW\tp51\application\user\view\html\rending.html";i:1588926815;}*/ ?>
<!DOCTYPE html>
<html xmlns:v-on="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<title>填报认定信息</title>
	</head>
    <link rel="stylesheet" href="/static/test-demo2/css/rending.css"/>
    <link rel="stylesheet" href="/static/test-demo2/css/layui.css"/>
    <script type="text/javascript" src="/static/jquery.min.js"></script>
	<script src="/static/test-demo2/js/vue.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/static/test-demo2/layui.js"></script>
    <body>
        <form id="rendingForm">
            <?php echo token(); ?>
            <div id="rending" v-cloak>
            <!-- 申报材料 -->
            <div id="yyzz" class="paper_A4_auto">
                <div class="pager_content_auto">
                    <div class="studyinfo-title">申 报 材 料</div>
                    <div id="img" style="text-align: center;">
                        <ul style="text-align: center;margin-bottom:20px ">
                            <div><span>*营业执照(点击下方图片上传)</span></div>
                            <div title="上传营业执照">
                                <img src="/static/test-demo2/assets/upload-btn-add.png" class="businessLicense">
                                <input class="uploadImg file1" style="opacity: 0" type="file" name="file01">
                            </div>
                        </ul>
                        <ul>
                            <div><span style="color: #000000;">*其他材料(点击下方图片上传)</span></div>
                            <div title="上传其他材料">
                                <img src="/static/test-demo2/assets/upload-btn-add.png" class="businessLicense">
                                <input class="uploadImg file1" style="opacity: 0" type="file" name="file02">
                            </div>
                        </ul>
                    </div>
                    <!-- 申报材料图片 -->
                </div>
            </div>
            <!-- 基本信息 -->
            <div id="baseinfo" class="paper_A4 baseinfo">
                <div class="pager_content">
                    <div class="baseinfo-title">基&nbsp;&nbsp;本&nbsp;&nbsp;情&nbsp;&nbsp;况</div>
                    <table id="table01" class="baseinfo-table1" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="width: 14%">
                                <span>*</span>姓名
                            </td>
                            <td style="width: 14%">
                                <input name="name" type="text" value="<?php echo htmlentities((app('session')->get('user01.name') ?: '')); ?>"/>
                            </td>
                            <td style="width: 14%">
                                <span>*</span>性别
                            </td>
                            <td style="width: 14%">
                                <select name="sex">
                                    <option :value="i" v-for="i in sex">{{i}}</option>
                                </select>
                            </td>
                            <td style="width: 14%">
                                <span>*</span>出生日期
                            </td>
                            <td style="width: 14%">
                                <input type="text" class="time" id="birthday" readonly="readonly">
                            </td>
                            <td style="width: 16%;" rowspan="3">
                                <div title="点击上传头像">
                                    <img src="" style="" alt="">
                                    <input type="file" style="opacity: 0;position: relative" name="file03" /> <!-- 头像 -->
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 14%">
                                <span>*</span>出生地
                            </td>
                            <td style="width: 42%" colspan="3">
                                <select style="width: 45%;" id="pid" v-on:change="getC()">
                                    <option>请选择省</option>
                                    <option v-for="i in provinces" :value="i.id">{{i.name}}</option>
                                </select>
                                <select style="width: 45%;">
                                    <option>请选择市</option>
                                    <option v-for="i in cities"  :value="i.city_id">{{i.city_name}}</option>
                                </select>
                            </td>
                            <td style="width: 14%">
                                <span>*</span>民族
                            </td>
                            <td style="width: 14%">
                                <input type="text" name="nation" value="" list="nation" />
                                <datalist id="nation">
                                    <option v-for="i in nations">{{i.name}}</option>
                                </datalist>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 14%">
                                <span>*</span>政治面貌
                            </td>
                            <td style="width: 14%">
                                <select name="politicaloutlook">
                                    <option value="" >请选择</option>
                                    <option v-for="i in politics">{{i.name}}</option>
                                </select></td>
                            <td style="width: 14%">标准工资</td>
                            <td style="width: 14%">
                                <input name="wages" type="text"/>
                            </td>
                            <td style="width: 14%">
                                <span>*</span>身体状况
                            </td>
                            <td style="width: 14%">
                                <select name="physicalcondition">
                                    <option>请选择</option>
                                    <option v-for="i in physical">{{i.name}}</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table id="table02" class="baseinfo-table1" cellspacing="0" cellpadding="0" style="border-top:0;margin-top: 0px;">
                        <tr>
                            <td style="height: 100px;">
                                <div>外</div>
                                <div>语</div>
                                <div>程</div>
                                <div>度</div>
                            </td>
                            <td colspan="2" style="height: 100px;text-align: left;vertical-align: top;padding: 10px;">
                                <textarea class="tips" :title="tips" :placeholder="tips" name="language_level"></textarea>
                            </td>
                            <td style="height: 100px;">参加学术团体及社会兼职情况</td>
                            <td colspan="2" style="height: 100px;text-align: left;vertical-align: top;padding: 10px;">
                                <textarea class="tips" :title="tips" :placeholder="tips" name="socialappointments"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="9">
                                <span>*</span>
                                <div style="height: 25px;">主</div>
                                <div style="height: 25px;">要</div>
                                <div style="height: 25px;">学</div>
                                <div style="height: 25px;">习</div>
                                <div style="height: 25px;">经</div>
                                <div>历</div>
                            </td>
                            <td>学历类别</td>
                            <td>毕业学院</td>
                            <td>所学专业</td>
                            <td>毕业时间</td>
                            <td>学制</td>
                        </tr>

                        <?php $__FOR_START_3817__=0;$__FOR_END_3817__=6;for($i=$__FOR_START_3817__;$i < $__FOR_END_3817__;$i+=1){ ?>
                        <tr>
                            <td>
                                <select data-name="education">
                                    <option value="">请选择</option>
                                    <option v-for="i in academic">{{i.name}}</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" data-name="gra_colleges" value="" list="college" />
                                <datalist id="college">
                                    <option v-for="i in colleges">{{i.name}}</option>
                                </datalist>
                            </td>
                            <td>
                                <input type="text" data-name="major" value="" list="major" />
                                <datalist id="major">
                                    <option :value="i.id" v-for="i in majors">{{i.name}}</option>
                                </datalist>
                            </td>
                            <td>
                                <input type="text" data-name="gra_time" class="time" readonly="readonly">
                            </td>
                            <td>
                                <input data-name="ed_system" type="text">
                            </td>
                        </tr>
                        <?php } ?>

                        <tr>
                            <td style="height: 130px;">
                                <div>有何</div>
                                <div>特长</div>
                            </td>
                            <td colspan="5" style="height:130px; text-align: left;vertical-align: top;padding: 10px;">
                                <textarea name="speciality" :title="tips" :placeholder="tips"></textarea>
                            </td>
                            <!-- 特长 -->
                        </tr>
                    </table>
                    <span>带“*”表示必填项</span>
                </div>
            </div>
            <!-- 见习工作情况 -->
            <div id="traineeinfo" class="paper_A4_auto baseinfo">
                <div class="pager_content_auto">
                    <div class="studyinfo-title">见习工作情况</div>
                    <table id="table03" class="zc07info-table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th style="width: 30%;">起止时间</th>
                                <th style="width: 30%;">工作部门及岗位</th>
                                <th style="width: 40%;">主要工作内容</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__FOR_START_8948__=0;$__FOR_END_8948__=5;for($i=$__FOR_START_8948__;$i < $__FOR_END_8948__;$i+=1){ ?>
                            <tr>
                                <td style="width: 30%;">
                                    <input type="text" class="time" data-name="start_time" readonly="readonly"/>
                                    至
                                    <input type="text" class="time" data-name="end_time" readonly='readonly'/>
                                </td>
                                <td style="width: 30%;">
                                    <textarea data-name="post"></textarea>
                                </td>
                                <td style="width: 40%;">
                                    <textarea data-name="job_content"></textarea>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <table id="table04" class="zc07info-table" cellspacing="0" cellpadding="0" style="margin-top: 0px;border-top: 0;">
                        <tr>
                            <td style="width: 10%;" id="trainee_jcqk">
                                <div>主</div>
                                <div>要</div>
                                <div>工</div>
                                <div>作</div>
                                <div>成</div>
                                <div>绩</div>
                                <div>及</div>
                                <div>奖</div>
                                <div>惩</div>
                                <div>情</div>
                                <div>况</div>
                            </td>
                            <td style="width: 90%;text-align: left;vertical-align: top;text-indent: 2em;" >
                                <textarea name="main_achievements" style="width: 37.5rem; height: 25rem; margin-left: -1.25rem;"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- 见习期工作小结 -->
            <div id="traineeinfo" class="paper_A4_auto baseinfo">
            <div class="pager_content_auto">
                <div class="studyinfo-title">见习期工作小结</div>
                <table id="table05" class="zc06info-table" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align: left;vertical-align: top;text-indent: 2em;height: 800px;">
                            <textarea name="summary_of_work" style="margin-left: -1.5625rem;"></textarea>
                        </td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            <div class="opbtn" style="display:block;bottom:0px;right:1px!important;right:18px;width:205px;line-height:30px;position:fixed;text-align:center;color:#fff;">
                <input type="hidden" id="hidden_session_id" value="<?php echo htmlentities(app('session')->get('user01.id')); ?>">
                <input type="button" class="btn-submit" style="width: 80px;border-radius: 4px;text-align: center" @click="s();" value="返回">
                <input type="button" id="btnSubmit" class="btn-submit" style="width: 80px;border-radius: 4px"   @click='btn_submit()' value="提交">
            </div>
        </div>
        </form>

    </body>
    <script src="/static/test-demo2/js/rending.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("[name=sex]").val("<?php echo htmlentities(app('session')->get('user01.name')); ?>");
            var birthday =("<?php echo htmlentities(app('session')->get('user01.cardid')); ?>".substr(6,4)+"-"+"<?php echo htmlentities(app('session')->get('user01.cardid')); ?>".substr(10,2)+"-"+"<?php echo htmlentities(app('session')->get('user01.cardid')); ?>".substr(12,2));
            $("#birthday").val(birthday);


            function ss(){
                window.history.go(-1);
            }

            $("[name=file03]").prev().width($("[name=file03]").parent().parent().width());
            $("[name=file03]").prev().height($("[name=file03]").parent().parent().height());
            $("[name=file03]").prev().prop("src","/uploads/addpic.png");

            function input_file_width_height(elementName){
                $("[name="+elementName+"]").width($("[name="+elementName+"]").prev().width());
                $("[name="+elementName+"]").height($("[name="+elementName+"]").prev().height());
                $("[name="+elementName+"]").css({"top":-$("[name="+elementName+"]").prev().height(),"position":"relative"});
                $("[name="+elementName+"]").parent().height($("[name="+elementName+"]").prev().height());
            }
            input_file_width_height("file01");
            input_file_width_height("file02");
            input_file_width_height("file03");
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
                    var max_width = $file.prop("name") != "file03" ? $(".pager_content_auto").width() : $file.parent().parent().width()-10;  //上传图片后的最大
                    image.onload = function(){
                        var width = image.width;
                        var height = image.height;
                        if(width > max_width){
                            var i = max_width/width;
                            height = i*height;
                            width = max_width;
                            console.log(i)
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
