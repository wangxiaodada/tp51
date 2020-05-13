<?php /*a:1:{s:63:"E:\phpStudy\WWW\tp51\application\admin\view\Index\User\all.html";i:1589338394;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>所有客户</title>
</head>
<link rel="stylesheet" href="/static/bootstrap-3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="/static/jquery.min.js"></script>
<script type="text/javascript" src="/static/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script>
<style type="text/css">
    td{
        font-size: 13px;
        text-align: center;
        border: 1px solid black;
        padding: 5px 10px ;
    }

    .form_widtn{
        width: 200px;
        display: inline-block;
    }

    #modal_ul li{
        font-size: 13px;
    }

    .div_img{
        width: 200px;
        height:130px;
        margin: 0 auto;
        position: relative;
        top: 20px;
    }

    .div_opacity{
        text-align: center;
        position: relative;
        background: whitesmoke;
        width: 200px;
        height: 20px;
        margin: 0 auto;
        opacity: 0.4;
        display: none;
    }

    .div_img_opacity{
        width: 240px;
        height:170px;
        float: left;
    }

    .div_inline_block{
        display: inline-block;
    }

    .null_css{
        opacity:0.6;
        font-style: oblique;
    }

    #insertuserform input,#insertuserform{
        font-size: 13px;
    }

    #insertuserform input{
        height: 25px;
        width: 100%;
        margin-bottom: 5px;
    }

    #insertuserform select{
        font-size: 12px;
        height: 25px;
        width: 25%;
        margin: 0 5px 5px 0;
    }

    .select_major{
        outline: none;
        border-radius: 5px ;
    }

    .select_xiaoshou{
        outline: none;
        border-radius: 5px ;
    }

    .selection{
        background: #e1e1e1;
    }

    .btn_click{
        background: #e1e1e1;
    }

    #table tbody tr td img{
        margin-right: 5px;
        cursor:pointer
    }
</style>
<script type="text/javascript">
    var hrefarr = [];
    function gethref() {
        $("#modal_ul li a").each(function () {
            hrefarr.push($(this).prop("href"));
        });
        return hrefarr;
    }

    function changehref(obj) {
        var id = obj.getAttribute("myid");
        var i = 0;
        $("#modal_ul li a").each(function () {
            $(this).prop("href",hrefarr[i]+"?id="+id);
            i++;
        });
        $("#menuFrame2").prop("src","<?php echo url('Modal/showBaseInfo'); ?>?id="+id);
        $("#myModal").modal("show");
    }

    //新增客户
    function insert_submit() {
        console.log()
        var cardid = $("[name=cardid]").val();
        var formdata = new FormData(document.getElementById("insertuserform"));
        formdata.append("accreditation_unit",$(".select_major:first").val());
        formdata.append("declaration_profession",$(".select_major:last").val());
        if(!isCardId(cardid)){
            layer.msg("身份证格式不正确，请检查修改后再提交");
            return false;
        }
        $.ajax({
            url:"/IndexUserAll/insertUser",
            type:"post",
            dataType:"json",
            data:formdata,
            cache:false,                        //不缓存
            processData: false,                // jQuery不要去处理发送的数据
            contentType: false,                // jQuery不要去设置Content-Type请求头
            success:function (data) {
                console.log(data)
                if(data["code"] == 0){
                    layer.msg("权限不足");
                    return false;
                }else if(data["code"] == 200){
                    layer.msg("添加成功",{time:1000,end:function () {
                            $('#Modal_insert').modal('hide');
                            location.reload();  //刷新当前页面
                        }});
                }else if(data["code"] == 201){
                    for (var i in data["null"]){
                        $("[name="+i+"]").prop("placeholder","不能为空");
                        $("[name="+i+"]").addClass("null_css");
                    }
                }else if(data["code"] == 202){
                    layer.msg(data["error"]);
                }
            }
        })
    }

    //身份证验证
    function isCardId(cardid) {
        {
            // 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X
            var reg = /^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/;
            // var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            if(reg.test(cardid) === false) {
                return false;
            }
            return true
        }
    }

    function del_show() {
        $(".div_img").parent().children("div").hover(function () {
            $(this).parent().children("div").eq(1).show();
        }, function () {
            $(this).parent().children("div").eq(1).hide();
        });
    }
</script>
<body>
<form class="form-inline" style="margin-bottom: 5px" action="<?php echo url('IndexUserAll/index'); ?>" id="myform" role="form">
    <div  class="form-group div_inline_block input-group-sm">
        <label class="" style="font-weight:normal;font-size: 13px" for="condition">条件类型:</label>
        <!--<input type="text" class="form-control form_widtn" id="condition" placeholder="请输入名称">&nbsp;-->
        <select  class="form-control form_widtn" name="condition" id="condition">
            <option value=""></option>
        </select>
    </div>
    <div class="form-group div_inline_block input-group-sm">
        <label class="" style="font-weight:normal;font-size: 13px" for="name">检索条件:</label>
        <?php if($condition == "unpaid_expenses"): ?>
        <select  class="form-control form_widtn" name="name" id="name">
            <option value="1">已经缴费完成</option>
            <option value="0">未缴费用</option>
        </select>
        <?php else: ?>
        <input type="text" class="form-control form_widtn" id="name" name="name"  placeholder="请输入名称">
        <?php endif; ?>
        <button type="submit" style="margin-left: 5px" id="submit" class="btn btn-info btn-sm">查询</button>
    </div>
    &nbsp;<btn id="insert" class="btn btn-info btn-sm">新增</btn>
</form>
<table id="table" width="100%">
    <tr>
        <td>编号</td>
        <td my="cardid">证件编号</td>
        <td my="a.name">姓名</td>
        <td my="unpaid_expenses">缴费情况</td>
        <td my="phone">联系电话</td>
        <?php if(session("admin")["id"] == 1): ?>
        <td my="nick_name">所属销售</td>
        <td style="width: 250px">操作</td>
        <?php endif; ?>
    </tr>
    <?php if(count($data) != 0): foreach($data as $v): ?>
    <tr>
        <td></td>
        <td><?php echo htmlentities($v['cardid']); ?></td>
        <td><?php echo htmlentities($v['username']); ?></td>
        <td>已缴费用：<?php echo htmlentities($v['paid_expenses']); ?>￥  未缴费用：<?php echo htmlentities($v['unpaid_expenses']); ?>￥</td>
        <td><?php echo htmlentities($v['phone']); ?></td>
        <?php if(app('session')->get('post.post_id') != 3): ?>
        <td><?php echo htmlentities($v['nick_name']); ?></td>
        <td>
            <img src="/uploads/enclosure.png" width="22" name="enclosure" title="附件">
            <img src="/uploads/details.png" width="22" myid="<?php echo htmlentities($v['userid']); ?>" onclick="changehref(this);" name="detailed" title="详情">
            <img src="/uploads/preview.png" width="22" name="yulan" title="预览">
            <img src="/uploads/generate.png" width="22" myid="<?php echo htmlentities($v['userid']); ?>" name="generate" title="生成业绩">
            <img src="/uploads/pay.png" width="22" name="updatepay" paid_expenses="<?php echo htmlentities($v['paid_expenses']); ?>" unpaid_expenses="<?php echo htmlentities($v['unpaid_expenses']); ?>" title="修改缴费情况">
            <img src="/uploads/delete.png" width="22" name="del" title="删除">
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; else: ?>
    <td style="display: none"></td>
    <td colspan="7">没有查询到有关数据</td>
    <?php endif; ?>
</table>
<?php if(count($data) != 0): ?>
<div style="margin-top: -18px">
    <?php echo $data; ?>
</div>
<?php endif; ?>
<!--附件上传 start-->
<div class="modal fade" id="EnclosureModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 777px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="EnclosureModalLabel">附件上传</h4>
            </div>
            <form action="" id="myform1">
                <div id="div_form_max" style="border: 1px solid #b2e2fa;margin: 2px;padding: 20px">

                    <div id="addpic" class="div_img_opacity">
                        <div style="width: 100px;height:100px;margin: 0 auto;position: relative;top: 35px;" >
                            <img src="/uploads/addpic.png" style="margin: 0 auto" height="100px" >
                        </div>
                        <div style="width: 100px;height:100px;margin: 0 auto;position: relative;top: -65px;">
                            <input title="点击上传图片" type="file" name="file" id="file" style="width: 100px;height:100px;margin: 0 auto;position: relative;top:-35px;opacity: 0">
                        </div>
                    </div>

                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" name="exportPuts" class="btn btn-primary">打印</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--附件上传 end-->

<!--新增客户 start-->
<div class="modal fade" id="Modal_insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">新增用户</h4>
            </div>
            <div class="modal-body">
                <form action="" id="insertuserform">
                    姓名:<input class="form-control" name="khname" type="text" >
                    身份证号码:<input class="form-control" name="cardid" type="text">
                    电话:<input class="form-control" name="phone" type="text" >
                    申报专业:
                    <div>
                        <select class="select_major">
                            <option value="">-</option>
                            <?php foreach($achievement_type as $v): ?>
                            <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    已缴费用:<input class="form-control" name="paid_expenses" type="text" >
                    未缴费用:<input class="form-control" name="unpaid_expenses" type="text">
                    <?php if(app('session')->get('post.post_id') == 1): ?>
                    所属销售:
                    <div>
                        <select name="admin_id" class="select_xiaoshou">
                            <option value="">-</option>
                            <?php foreach($data_post as $v): ?>
                            <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['nick_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" onclick="insert_submit();" class="btn btn-primary">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--新增客户 end-->

<!--客户详细信息模型层 start/-->
<div class="modal fade " id="myModal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1200px" >
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <ul id="modal_ul" class="nav nav-tabs ">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            基础信息
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('Modal/showBaseInfo'); ?>" target="menuFrame2">基础信息</a></li>
                            <li><a href="<?php echo url('Modal/showEducation'); ?>" target="menuFrame2">教育经历</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            职称申报申请
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('Modal/showAppForAssBaseInfo'); ?>" target="menuFrame2">职称评审申请基本信息</a></li>
                            <li><a href="<?php echo url('Modal/showUploadCertificate'); ?>" target="menuFrame2">申报材料上传</a></li>
                            <li><a href="<?php echo url('Modal/showTrainingExperience'); ?>" target="menuFrame2">学习培训经历</a></li>
                            <li><a href="<?php echo url('Modal/showWorkExperience'); ?>" target="menuFrame2">工作经历</a></li>
                            <li><a href="<?php echo url('Modal/showOldAchievement'); ?>" target="menuFrame2">任现职前主要工作业绩</a></li>
                            <li><a href="<?php echo url('Modal/showNewAchievement'); ?>" target="menuFrame2">任现职后主要工作业绩</a></li>
                            <li><a href="<?php echo url('Modal/showWorksAndPapers'); ?>" target="menuFrame2">著作论文及重要技术报告</a></li>
                            <li><a href="<?php echo url('Modal/showAssessmentSituation'); ?>" target="menuFrame2">职称考试及考核情况</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            职称认定
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('Modal/showProTitleRecBaseInfo'); ?>" target="menuFrame2">职称认定基本信息</a></li>
                            <li><a href="<?php echo url('Modal/showProTitleRecIdentifying'); ?>" target="menuFrame2">认定材料上传</a></li>
                            <li><a href="<?php echo url('Modal/showProTitleRecProbation'); ?>" target="menuFrame2">见习工作情况</a></li>
                            <li><a href="<?php echo url('Modal/showProTitleRecSummary'); ?>" target="menuFrame2">见习工作总结</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <iframe id="menuFrame2" name="menuFrame2" src="" style="height:470px;overflow:visible;" scrolling="yes" frameborder="no" width="100%" height="100%"></iframe>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--客户详细信息模型层 end-->

<!--自动或手动生成 start-->
<div class="modal fade" id="Automatic" tabindex="-1" role="dialog" aria-labelledby="AutomaticLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 1100px;">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="AutomaticModalLabel">自动或手动生成业绩</h4>
            </div>
            <div id="div_choice" style="text-align: center;margin:10px 0">
                <button type="button" name="automaticbtn" class="btn btn-default" mytype="past_results" >自动生成任职前业绩</button>
                <button type="button" name="manualbtn" class="btn btn-default" mytype="past_results" >选择生成任职前业绩</button>
                <button type="button"  name="automaticbtn" class="btn btn-default" mytype="now_results" >自动生成任职后业绩</button>
                <button type="button" name="manualbtn" class="btn btn-default" mytype="now_results" >选择生成任职后业绩</button>
                <button type="button"  name="automaticbtn" class="btn btn-default" mytype="ptr_summary" >自动生成认定业绩</button>
                <button type="button" name="manualbtn" class="btn btn-default" mytype="ptr_summary" >选择生成认定业绩</button>
            </div>
            <form id="scree">
            <div style="display: none;padding:0 15px 15px 15px;height: 40px">
                <div style="float: left;line-height: 30px">
                    筛选条件：
                </div>
                <select style="height: 30px;width: 170px;float: left;font-size: 13px;outline: none;border: 1px solid #C6C4C4;border-radius: 4px" name="screeachievement" id="">
                    <option value=""></option>
                    <option value="time">完成时间</option>
                    <option value="technical_work">专业技术工作名称</option>
                    <option value="work_content">工作内容本人起何作用</option>
                    <option value="ompletion_effect">完成情况及效果</option>
                    <option value="frequency">使用次数</option>
                </select>
                <input type="text" style="margin-left:5px;height: 30px;width: 60%;float: left;font-size: 13px;outline: none;border: 1px solid #C6C4C4;border-radius: 4px" placeholder="" name="screecontent" value="">
                <div class="btn btn-info" name="scree" style="height: 30px;float: left;width: 60px;margin-left: 5px">搜索</div>
            </div>
            </form>
            <table id="achievement" style="display: none;margin: 0 10px">
                <tr>
                    <td width="60">编号</td>
                    <td width="80">完成时间</td>
                    <td width="299">专业技术工作名称</td>
                    <td width="299">工作内容本人起何作用</td>
                    <td width="253">完成情况及效果</td>
                    <td width="80">使用次数</td>
                    <td width="60">操作</td>
                </tr>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" name="generate_tj" class="btn btn-primary">提交</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--自动或手动生成 end-->

<!--修改缴费情况 start-->
<div class="modal fade" id="updatePayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="updatePayModalLabel">缴费情况修改</h4>
            </div>
            <form action="" id="myform2">
                <div style="padding: 20px">
                    <div style="text-align: center;margin-bottom: 20px">
                        已缴费用：<input style="border-radius: 5px;border: 1px solid white" name="updatePaidExpenses" type="text" value="">
                    </div>
                    <div style="text-align: center">
                        未缴费用：<input style="border-radius: 5px;border: 1px solid white" name="updateUnPaidExpenses" type="text" value="">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" id="updatepay" class="btn btn-primary">修改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--修改缴费情况 end-->

<!--预览 start-->
<div class="modal fade" id="yulanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 900px;" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <ul id="modal_ul02" class="nav nav-tabs ">
                    <li><a href="/previewPingshen/" target="iframe02" >评审信息</a></li>
                    <li><a href="/previewRending/" target="iframe02" >认定信息</a></li>
                </ul>
            </div>
            <iframe id="iframe02" name="iframe02" src="" style="height:430px;overflow:visible;" scrolling="yes" frameborder="no" width="100%" height="100%"></iframe>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!--预览 end-->

<!--startprint-->
<div id="div_print_hide" style="display: none">

</div>
<!--endprint-->

</body>
<script type="text/javascript">
    $(function () {

        $("[name=yulan]").click(function () {
            var id = $(this).prev().attr("myid");
            $("#iframe02").prop("src","/previewPingshen/"+id);
            $("#yulanModal").modal("show");
            $("#modal_ul02 li a").each(function () {
                var href = $(this).prop("href").substr(0,$(this).prop("href").lastIndexOf('/')+1);
                $(this).prop("href",href+id);
            })
        });
        
        //新增模态框中的下拉框改变内容时
        $("body").on("change",".select_major",function () {
            //删除空白选项
            $(this).children("option").each(function () {
                if($(this).val() == ""){
                    $(this).remove();
                }
            })
            var type_id = $(this).val();
            var obj = $(this);
            obj.nextAll().remove();
            if(obj.val() == obj.prev().val()){
                return false;
            }
            $.ajax({
                url:"<?php echo url('IndexUserAll/selAllType'); ?>",
                type:"post",
                dataType:"json",
                data:{type_id:type_id},
                success:function (data) {
                    if(data != ""){
                        var str = "<select class='select_major'>" ;
                        str += "<option value='"+type_id+"'>添加到上级目录</option>";
                        for(var i in data){
                            str += "<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>"
                        }
                        str += "</select>";
                        obj.after(str);
                    }
                }
            })
        });


        gethref();

        $(" #table tr").eq(0).nextAll().each(function () {
            $(this).children("td").eq(0).text($(this).index());
        });

        $("#table tr").eq(0).children("td").eq(0).nextAll().each(function () {
            if($(this).text() != "操作"){
                var str = "<option value='"+$(this).attr('my')+"' >"+$(this).text()+"</option>";
                $("#condition").append(str);
            }
        });

        if("<?php echo htmlentities($condition); ?>" != ""){
            $("#condition option").each(function () {
                if($(this).val() == "<?php echo htmlentities($condition); ?>"){
                    $(this).prop("selected",true);
                }
            });
        };

        $("[name=name]").val("<?php echo htmlentities((isset($name) && ($name !== '')?$name:'')); ?>");

        $("#insertuserform input").on("input",function () {
            if($(this).val() == ""){
                $(this).addClass("null_css");
                $(this).prop("placeholder","不能为空");
            }else{
                $(this).removeClass("null_css");
            }
        })


        //去掉下拉框中的空格
        $("#condition").change(function () {
            $("#name").remove();
            $(this).children("option").each(function () {
                if($(this).text() == ""){
                    $(this).remove();
                }
            });
            if($(this).val() == "unpaid_expenses"){
                var str = "<select  class='form-control form_widtn' name='name' id='name'>" +
                    "<option value='1'>已经缴完费用</option>" +
                    "<option value='0'>尚未缴完费用</option>" +
                    "</select>";
            }else{
                var str = "<input type='text' class='form-control form_widtn' id='name' name='name'  placeholder='请输入名称'>";
            }
            $("#submit").before(str);
        });

        //开启修改缴费情况模态框
        $("[name=updatepay]").click(function () {
            $("[name=updatePaidExpenses]").val($(this).attr("paid_expenses")+"￥");
            $("[name=updateUnPaidExpenses]").val($(this).attr("unpaid_expenses") + "￥");
            $("#updatePayModal").modal("show");
            $("#updatepay").attr("myid",$(this).prev().prev().attr("myid"));

        });

        $("[name=updatePaidExpenses]").focus(function () {
            var str = $(this).val();
            str = str.substr(0,str.length-1)
            $(this).val(str);
        })
        $("[name=updatePaidExpenses]").blur(function () {
            var str = $(this).val();
            $(this).val(str+"￥");
        })

        $("[name=updateUnPaidExpenses]").focus(function () {
            var str = $(this).val();
            str = str.substr(0,str.length-1)
            $(this).val(str);
        })
        $("[name=updateUnPaidExpenses]").blur(function () {
            var str = $(this).val();
            $(this).val(str+"￥");
        })

        //修改缴费情况
        $("#updatepay").click(function () {
            var updatePaidExpenses = $("[name=updatePaidExpenses]").val();
            var updateUnPaidExpenses = $("[name=updateUnPaidExpenses]").val();
            var userid = $(this).attr("myid");
            $.ajax({
                url:"<?php echo url('IndexUserAll/updatePay'); ?>",
                type:"post",
                dataType:"json",
                data:{updatePaidExpenses:updatePaidExpenses.substr(0,updatePaidExpenses.length-1),updateUnPaidExpenses:updateUnPaidExpenses.substr(0,updateUnPaidExpenses.length-1),userid:userid},
                success:function (data) {
                    if(data > 0){
                        layer.msg("修改完成");
                    }
                }
            })
        });


        //开启新增模态框
        $("#insert").click(function () {
            $('#Modal_insert').modal('show');
        });

        //上传附件
        $("[name=enclosure]").click(function () {
            var uid = $(this).next().attr("myid");
            $("#file").attr("myid",uid);
           $.ajax({
               url:"<?php echo url('IndexUserAll/selectEnclosure'); ?>",
               type:"post",
               dataType:"json",
               data:{uid:uid},
               success:function (data) {
                   $("[name=pic]").parent().parent().remove();
                   for(var i in data) {
                       var str = "<div class='div_img_opacity'>" +
                           "<div class='div_img'>" +
                           "<img name='pic' src='" + data[i]['src'] + "' title='" + data[i]['type'] + "' width='200px'  height='130px' alt=''>" +
                           "</div>" +
                           "<div class='div_opacity' myid='" + data[i]['pic_id'] + "'  >删除</div>" +
                           "</div>";
                       $("#addpic").before(str);
                   }
                   del_show();
                   $("#div_form_max").css("height",Math.ceil(($(".div_img_opacity:last").index()+1)/3)*170+40);
               }
           })
           $("#EnclosureModal").modal("show");
        });

        $("#div_form_max").css("height",Math.ceil(($(".div_img_opacity:last").index()+1)/3)*170+40);

        // 显示或隐藏图片上的删除两个字
        del_show();

        //将上传的营业执照图片显示出来
        $("#file").change(function () {
            var $file=$(this);
            var fileobj=$file[0];
            var windowUrl=window.URL || window.webkitURL;
            var dataURL;
            var $img=$("#file");
            var formdata = new FormData(document.getElementById("myform1"));
            if (fileobj && fileobj.files&&fileobj.files[0]){
                dataURL=windowUrl.createObjectURL(fileobj.files[0]);
                $.ajax({
                    url:"<?php echo url('IndexUserAll/uploadEnclosure'); ?>?uid="+$file.attr("myid"),
                    type:"post",
                    dataType:"json",
                    data:formdata,
                    cache: false,                      // 不缓存
                    processData: false,                // jQuery不要去处理发送的数据
                    contentType: false,                // jQuery不要去设置Content-Type请求头
                    success:function (data) {
                        console.log(data);
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }
                        if(data > 0){
                            var index = $(".div_img_opacity:last").index()-1;
                            var str = "<div class='div_img_opacity'>" +
                                "<div class='div_img'><img name='pic' src='' width='200px' height='130px' title='附件' alt=''></div>" +
                                "<div class='div_opacity' myid='"+data+"'>删除</div>" +
                                "</div>";
                            $(".div_img_opacity").eq(index).after(str);
                            $(".div_img_opacity").eq(index+1).children("div").eq(0).children("img").prop('src',dataURL);
                            del_show();
                            $("#div_form_max").css("height",Math.ceil(($(".div_img_opacity:last").index()+1)/3)*170+40);
                        }
                    }
                });
            }
        });

        //删除图片
        $("body").on("click",".div_opacity",function () {
            var obj = $(this);
            layer.confirm("您确定要删除这张图片吗!",function () {
                $.ajax({
                    url:"<?php echo url('IndexUserAll/deleteEnclosure'); ?>",
                    type:"post",
                    dataType:"json",
                    data:{"id":obj.attr("myid")},
                    success:function (data) {
                        if(data > 0){
                            layer.msg("好的，已经删除了");
                            obj.parent().remove();
                            $("#div_form_max").css("height",Math.ceil(($(".div_img_opacity:last").index()+1)/3)*170+40);
                        }
                    }
                })
            });
        });

        //删除客户
        $("[name=del]").click(function () {
            var obj = $(this);
            var id = obj.siblings().eq(1).attr("myid");
            var username = obj.parent().siblings().eq(2).text();
            layer.confirm("您确定要删除 "+username+" 吗",function () {
                $.ajax({
                    url:"<?php echo url('IndexUserAll/del'); ?>",
                    type:"post",
                    datatype:"json",
                    data:{id:id},
                    success:function (data) {
                        if(data["code"] == 0){
                            layer.msg("权限不足");
                            return false;
                        }
                        if(data == 1 || data == "1"){
                            layer.msg("删除完成");
                            obj.parent().parent().remove();
                            $("#table tr").eq(0).nextAll().each(function () {
                                $(this).children("td").eq(0).text($(this).index());
                            });
                        }
                    }
                });
            });
        });

        //给提交过去的业绩添加标识
        $("#div_choice button").click(function () {
            var oldcss = $(".btn_click").attr("mytype");
            $(this).siblings().removeClass("btn_click");
            $(this).addClass("btn_click");
            var nowcss = $(".btn_click").attr("mytype");
            if(oldcss != nowcss){
                $("#achievement tbody tr:gt(0)").remove();
            }
        })


        //自动或手动生成打开模态框
        $("[name=generate]").click(function () {
            $("[name=automaticbtn]").attr("myid",$(this).attr("myid"));
            $("[name=manualbtn]").attr("myid",$(this).attr("myid"));
            $("[name=generate_tj]").attr("myid",$(this).attr("myid"));
            $("#Automatic").modal("show");
        });
        
        //关闭模态框事件
        $("#Automatic").on("hidden.bs.modal",function () {
            $("#scree").hide();
            $("[name=screecontent]").val("");
            $("#div_choice button").removeClass("btn_click");
            $("#achievement tbody tr").remove();
        })

        //自动生成业绩
        $("[name=automaticbtn]").click(function () {
            var obj = $(this);
            $.ajax({
                url:"<?php echo url('IndexUserAll/getAchievementid'); ?>",
                type:"post",
                dataType:"json",
                data:{userid:obj.attr("myid")},
                success:function (data) {
                    if(data["code"] == 202){
                        layer.msg(data["error"]);
                    }else if(data["code"] == 200){
                        var str = ""
                        if(data["data"] == null){
                            str += "<tr><td colspan='7'>没有查询到相关数据</td></tr>";
                        }else{
                            for ( var i = 0 ; i < data.data.length ; i++ ){
                                str += "<tr>" +
                                    "<td my='id'>"+data['data'][i]['id']+"</td>" +
                                    "<td my='time'>"+data['data'][i]['time']+"</td>" +
                                    "<td my='technical_work'>"+data['data'][i]['technical_work']+"</td>" +
                                    "<td my='work_content'>"+data['data'][i]['work_content']+"</td>" +
                                    "<td my='ompletion_effect'>"+data['data'][i]['ompletion_effect']+"</td>" +
                                    "<td my='frequency'>"+data['data'][i]['frequency']+"</td>" +
                                    "<td><button name='delAchievement' class='btn btn-xs btn-danger'>删除</button></td>" +
                                    "</tr>";
                            }
                        }
                        $("#achievement").show();
                        $("#achievement").append(str);
                    }
                }
            })
        });

        //删除此条业绩
        $("body").on("click","[name=delAchievement]",function () {
            $(this).parent().parent().remove();
        });

        //选择生成评审业绩
        $("[name=manualbtn]").click(function () {
            var obj = $(this);
            $.ajax({
                url:"<?php echo url('IndexUserAll/getUserDeclarationProfession'); ?>",
                type:"post",
                dataType:"json",
                data:{userid:obj.attr("myid")},
                success:function (data) {
                    if(data == undefined ||data.declaration_profession == null){
                        layer.msg("该客户尚未选择专业，请选择专业后重试");
                    }else{
                        $("#scree div").show();
                        $("[name=scree]").attr("myid",obj.attr("myid"));
                    }
                }
            })
        });

        //选中业绩时添加标识
        $("#achievement tbody").on("click","tr:gt(0)",function () {
            $(this).toggleClass("selection");
        });

        //筛选业绩
        $("[name=scree]").click(function () {
            var formdata = new FormData(document.getElementById("scree"));
            formdata.append("uid",$(this).attr("myid"));
            $.ajax({
                url:"<?php echo url('IndexUserAll/screeAchievement'); ?>",
                type:"post",
                dataType:"json",
                data:formdata,
                cache: false,
                processData: false,
                contentType: false,
                success:function (data) {
                    var str = "";
                    if(data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            str += "<tr>" +
                                "<td my='id'>" + data[i]['id'] + "</td>" +
                                "<td my='time'>" + data[i]['time'] + "</td>" +
                                "<td my='technical_work'>" + data[i]['technical_work'] + "</td>" +
                                "<td my='work_content'>" + data[i]['work_content'] + "</td>" +
                                "<td my='ompletion_effect'>" + data[i]['ompletion_effect'] + "</td>" +
                                "<td my='frequency'>" + data[i]['frequency'] + "</td>" +
                                "<td ><button name='delAchievement' class='btn btn-xs btn-danger'>删除</button></td>" +
                                "</tr>";
                        }
                    }else{
                        str += "<tr><td colspan='7'>没有查询到相关数据</td></tr>"
                    }
                    $("#achievement").show();
                    $("#achievement tbody tr:gt(0)").remove();
                    $("#achievement").append(str);
                }
            })
        });

        //业绩的提交
        $("[name=generate_tj]").click(function () {
            var temp = [];
            $("#achievement tbody tr").each(function () {
                if($(this).hasClass("selection")){
                    temp.push($(this).children("td:eq(0)").text());
                }
            });
            var btn_click_css = $(".btn_click").attr("mytype");
            var uid = $(this).attr("myid");
            switch(btn_click_css){
                //提交生成任职前业绩
                case "past_results":
                    $.ajax({
                        url:"<?php echo url('IndexUserAll/insertGenerateAchievementPast'); ?>",
                        type:"post",
                        dataType:"json",
                        data:{ids:temp,uid:uid},
                        success:function (data) {
                            console.log(data)
                            if(data["code"] == 2){
                                layer.msg(data["error"])
                            }else{
                                layer.msg(data["info"])
                            }
                        }
                    });
                    break;
                //提交生成任职后业绩
                case "now_results":
                    $.ajax({
                        url:"<?php echo url('IndexUserAll/insertGenerateAchievementNow'); ?>",
                        type:"post",
                        dataType:"json",
                        data:{ids:temp,uid:uid},
                        success:function (data) {
                            if(data["code"] == 2){
                                layer.msg(data["error"])
                            }else{
                                layer.msg(data["info"])
                            }
                        }
                    });
                    break;
                //提交生成认定业绩
                case "ptr_summary":
                    $.ajax({
                        url:"<?php echo url('IndexUserAll/insertGenerateAchievementPtrSummary'); ?>",
                        type:"post",
                        dataType:"json",
                        data:{ids:temp,uid:uid},
                        success:function (data) {
                            if(data["code"] == 2){
                                layer.msg(data["error"])
                            }else{
                                layer.msg(data["info"])
                            }
                        }
                    });
                    break;
                default:
                    break;
            }
        });

        $("[name=exportPuts]").click(function () {
            $.ajax({
                url:"<?php echo url('admin/Test/ss'); ?>",
                type:"post",
                dataType:"json",
                data:{"id":1},
                success:function (data) {
                    console.log(data);
                    var str = "";
                    for (var i in data){
                        str+="<img src='"+data[i]['src']+"' >"
                    }
                    console.log(str)
                    $("#div_print_hide").show()
                    $("#div_print_hide").append(str);

                    bdhtml=window.document.body.innerHTML;
                    sprnstr="<!--startprint-->";//必须在页面添加<!--startprint-->和<!--endprint-->而且需要打印的内容必须在它们之间
                    eprnstr="<!--endprint-->";
                    prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+18);
                    prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));
                    var newWin= window.open("");//新打开一个空窗口
                    newWin.document.body.innerHTML=prnhtml;
                    newWin.document.close();//在IE浏览器中使用必须添加这一句
                    newWin.focus();//在IE浏览器中使用必须添加这一句
                    newWin.print();//打印
                    newWin.close();//关闭窗口
                }
            })
        });
    });
</script>
</html>