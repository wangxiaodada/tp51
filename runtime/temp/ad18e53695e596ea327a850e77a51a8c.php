<?php /*a:1:{s:73:"E:\phpStudy\WWW\tp51\application\admin\view\Preview\userInfo_rending.html";i:1586243258;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>预览</title>
		<link rel="stylesheet" href="/static/admin/css/info_rending.css"/>
	</head>
	<body>
		<div id="app_rending">
		<!-- 封面 -->
		<div id="cover" class="paper_A4">
			<div class="pager_content">
				<div class="cover_title">初聘专业技术职务呈报表</div>
				<table class="cover_table">
					<tr>
						<td class="cover_lefttd">单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位：</td>
						<td class="cover_righttd"><?php echo htmlentities((isset($baseInfo["workunit"]) && ($baseInfo["workunit"] !== '')?$baseInfo["workunit"]:"")); ?></td>
					</tr>
					<tr>
						<td class="cover_lefttd">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
						<td class="cover_righttd"><?php echo htmlentities((isset($baseInfo["name"]) && ($baseInfo["name"] !== '')?$baseInfo["name"]:"")); ?></td>
					</tr>
					<tr>
						<td class="cover_lefttd">拟聘职务：</td>
						<td class="cover_righttd"><?php echo htmlentities((isset($baseInfo["jobtitle"]) && ($baseInfo["jobtitle"] !== '')?$baseInfo["jobtitle"]:"")); ?></td>
					</tr>
				</table>
				<div class="cover_date">填表时间:  年  月  日</div>
				<div class="cover_footer">中华人民共和国人事部制</div>
				<div class="cover_footer2">成都市职称改革工作领导小组办公室 翻印</div>
				<div class="cover_footer3">重要提示：本初聘表是证明任职资格的重要证据，请妥善保管。</div>
			</div>
		</div>
		<!-- 职称申报诚信承诺书 -->
		<div id="undertaking" class="paper_A4">
			<div class="pager_content">
				<div class="undertaking-title">职称申报诚信承诺书</div>
				<div class="undertaking-text">
					<p>
						本人系 <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
						（单位）从事专业技术工作的人员，现郑重承诺：职称申报所提供的个人信息和申报材料（包括学历证书、职称证书、论文、业绩证明等）均真实、准确、有效。对因提供有关信息、证件不实造成的后果，责任自负，并按有关规定接受相关处罚。 
					</p>
				</div>
				<table style="width: 100%;font-size: 21px;margin-top: 30px;">
					<tr>
						<td style="width: 50%;height: 40px;"></td>
						<td>申报人（签名）<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					</tr>
					<tr>
						<td style="width: 50%;height: 40px;"></td>
						<td>个人联系电话：<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
					</tr>
					<tr>
						<td style="width: 50%;height: 40px;"></td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日</td>
					</tr>
				</table>
					<div class="undertaking-text">
					<p>
						 <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
					</p>
				</div>
				<div class="undertaking-text">
					<p>
						承诺我单位推荐的申报人员（姓名） <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
						的个人信息和所有材料真实准确有效，同意上报。 
						   
					</p>
					<p>
						 负责人（签名） <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
					</p>
					<p>
						单位联系电话 <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
					</p>
				</div>
				<table style="width: 100%;font-size: 21px;margin-top: 30px;">
					<tr>
						<td style="width: 50%;height: 40px;"></td>
						<td>工作单位（公章）</td>
					</tr>
					<tr>
						<td style="width: 50%;height: 40px;"></td>
						<td>年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日</td>
					</tr>
				</table>
				<div style="position: absolute;left: 0;bottom: 0px;">
					<p style="font-weight: bold;line-height: 30px;">说明：</p>
					<p style="line-height: 30px;">1.诚信承诺书必须由申报人本人签名，不得代签。</p>
					<p style="line-height: 30px;">2.请将诚信承诺书装订在《初聘专业技术职务呈报表》封面与第1页之间，随申报材料一同上报。</p>
				</div>
			</div>
		</div>	
		<!-- 填表说明 -->
		<div id="undertaking" class="paper_A4">
			<div class="pager_content">
				<div class="undertaking-title">填&nbsp;&nbsp;表&nbsp;&nbsp;说&nbsp;&nbsp;明</div>
				<div class="undertaking-text">
					<div class="serial-item">
						<div class="serial-number">1、</div>
						<div class="serial-content">本表供国家教委承认的正规大、中专院校毕业生（含毕业研究生）见习期满初次聘任专业技术职务使用。1-3页由本人填写，第4页由人事组织部门填写。填写内容应经人事组织部门审核认可。</div>
					</div>
					<div class="serial-item">
						<div class="serial-number">2、</div>
						<div class="serial-content">如填写内容较多，可另加附页。</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 申报材料 -->
		<div id="yyzz" class="paper_A4_auto">
			<div class="pager_content_auto">
				<div class="studyinfo-title">申 报 材 料</div>
				<?php if(count($ptr_pic) > 0): foreach($ptr_pic as $v): ?>
				<img class="businessLicense" src="<?php echo htmlentities($v['src']); ?>" />
				<?php endforeach; ?>
				<?php endif; ?>
				<!-- 申报材料图片 -->
			</div>
		</div>
		<!-- 基本信息 -->
		<div id="baseinfo" class="paper_A4 baseinfo">
			<div class="pager_content">
				<div class="baseinfo-title">基&nbsp;&nbsp;本&nbsp;&nbsp;情&nbsp;&nbsp;况</div>
				<table class="baseinfo-table1" cellspacing="0" cellpadding="0">
					<tr>
						<td style="width: 14%">姓名</td>
						<td style="width: 14%"><?php echo htmlentities((isset($baseInfo['name']) && ($baseInfo['name'] !== '')?$baseInfo['name']:"")); ?></td>
						<td style="width: 14%">性别</td>
						<td style="width: 14%"><?php echo htmlentities((isset($baseInfo['sex']) && ($baseInfo['sex'] !== '')?$baseInfo['sex']:"")); ?></td>
						<td style="width: 14%">出生日期</td>
						<td style="width: 14%"><?php echo htmlentities((isset($baseInfo["birthday"]) && ($baseInfo["birthday"] !== '')?$baseInfo["birthday"]:"")); ?></td>
						<td style="width: 16%;" rowspan="3">
							<?php if(count($ptr_pic) > 0): ?>
							 <img src="<?php echo htmlentities((isset($baseInfo['pic']) && ($baseInfo['pic'] !== '')?$baseInfo['pic']:'')); ?>" style="width: 100%;" /> <!-- 头像 -->
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td style="width: 14%">出生地</td>
						<td style="width: 42%" colspan="3"><?php echo htmlentities((isset($baseInfo['homeplace']) && ($baseInfo['homeplace'] !== '')?$baseInfo['homeplace']:"")); ?></td>
						<td style="width: 14%">民族</td>
						<td style="width: 14%"><?php echo htmlentities((isset($baseInfo['nation']) && ($baseInfo['nation'] !== '')?$baseInfo['nation']:"")); ?></td>
					</tr>
					<tr>
						<td style="width: 14%">政治面貌</td>
						<td style="width: 14%"><?php echo htmlentities((isset($baseInfo['politicaloutlook']) && ($baseInfo['politicaloutlook'] !== '')?$baseInfo['politicaloutlook']:"")); ?></td>
						<td style="width: 14%">标准工资</td>
						<td style="width: 14%"><?php echo htmlentities((isset($baseInfo['wages']) && ($baseInfo['wages'] !== '')?$baseInfo['wages']:"")); ?></td>
						<td style="width: 14%">身体状况</td>
						<td style="width: 14%"><?php echo htmlentities((isset($baseInfo['physicalcondition']) && ($baseInfo['physicalcondition'] !== '')?$baseInfo['physicalcondition']:"")); ?></td>
					</tr>
				</table>
				<table class="baseinfo-table1" cellspacing="0" cellpadding="0" style="border-top:0;margin-top: 0px;">
					<tr>
						<td style="width: 10%;" rowspan="2">
							<div>最</div>
							<div>高</div>
							<div>学</div>
							<div>历</div>
						</td>
						<td style="width: 18%;">毕（肆、结）业时间</td>
						<td style="width: 18%;">学 校</td>
						<td style="width: 18%;">专 业</td>
						<td style="width: 18%;">学 制</td>
						<td style="width: 18%;">学 位</td>
					</tr>
					<tr>
						<td style="width: 18%;"><?php echo htmlentities((isset($education["gra_time"]) && ($education["gra_time"] !== '')?$education["gra_time"]:"")); ?></td>
						<td style="width: 18%;"><?php echo htmlentities((isset($education["gra_colleges"]) && ($education["gra_colleges"] !== '')?$education["gra_colleges"]:"")); ?></td>
						<td style="width: 18%;"><?php echo htmlentities((isset($education["major"]) && ($education["major"] !== '')?$education["major"]:"")); ?></td>
						<td style="width: 18%;"><?php echo htmlentities((isset($education["ed_system"]) && ($education["ed_system"] !== '')?$education["ed_system"]:"")); ?></td>
						<td style="width: 18%;"><?php echo htmlentities((isset($education["academicdegree"]) && ($education["academicdegree"] !== '')?$education["academicdegree"]:"")); ?></td>
					</tr>
					<tr>
						<td style="height: 100px;">
							<div>外</div>
							<div>语</div>
							<div>程</div>
							<div>度</div>
						</td>
						<td colspan="2" style="height: 100px;text-align: left;vertical-align: top;padding: 10px;"><?php echo htmlentities((isset($baseInfo['language_level']) && ($baseInfo['language_level'] !== '')?$baseInfo['language_level']:"")); ?></td>
						<td style="height: 100px;">参加学术团体及社会兼职情况</td>
						<td colspan="2" style="height: 100px;text-align: left;vertical-align: top;padding: 10px;"><?php echo htmlentities((isset($baseInfo['socialappointments']) && ($baseInfo['socialappointments'] !== '')?$baseInfo['socialappointments']:"")); ?></td>
					</tr>
					<tr>
						<td rowspan="9">
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
					<?php foreach($alleducation as $v): ?>
					<tr>
						<td><?php echo htmlentities($v['education_name']); ?></td> <!-- 学历类别 -->
						<td><?php echo $v["gra_colleges"]=="其他院校名称" ? htmlentities($v["other_colleges"]) : htmlentities($v["gra_colleges"]); ?></td><!-- 毕业学院 -->
						<td><?php echo $v["major"]=="其他专 业" ? htmlentities($v["othermajor"]) : htmlentities($v["major"]); ?></td><!-- 所学专业 -->
						<td><?php echo htmlentities($v['gra_time']); ?></td><!-- 毕业时间 -->
						<td><?php echo htmlentities($v['ed_system']); ?></td><!-- 学制 -->
					</tr>
					<?php endforeach; $__FOR_START_2458__=count($alleducation);$__FOR_END_2458__=5;for($i=$__FOR_START_2458__;$i < $__FOR_END_2458__;$i+=1){ ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php } ?>

					
					<tr>
						<td style="height: 130px;">
							<div>有何</div>
							<div>特长</div>
						</td>
						<td colspan="5" style="height:130px; text-align: left;vertical-align: top;padding: 10px;"><?php echo htmlentities((isset($baseInfo['speciality']) && ($baseInfo['speciality'] !== '')?$baseInfo['speciality']:"")); ?></td>
						<!-- 特长 -->
					</tr>
				</table>
			</div>
		</div>
		<!-- 见习工作情况 -->
		<div id="traineeinfo" class="paper_A4_auto baseinfo">
			<div class="pager_content_auto">
				<div class="studyinfo-title">见习工作情况</div>
				<table class="zc06info-table" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th style="width: 30%;">起止时间</th>
							<th style="width: 30%;">工作部门及岗位</th>
							<th style="width: 40%;">主要工作内容</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($ptr_probation_work_ituation as $v): ?>
						<tr>
							<td style="width: 30%;"><?php echo htmlentities($v['start_time']."~".$v['end_time']); ?></td>
							<td style="width: 30%;"><?php echo htmlentities($v['post']); ?></td>
							<td style="width: 40%;"><?php echo htmlentities($v['job_content']); ?></td>
						</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
				<table class="zc06info-table" cellspacing="0" cellpadding="0" style="margin-top: 0px;border-top: 0;">
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
						<td style="width: 90%;text-align: left;vertical-align: top;text-indent: 2em;">
							<?php foreach($ptr_summary['main_achievements'] as $v): ?>
							<p><?php echo htmlentities($v); ?></p><br/>
							<?php endforeach; ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<!-- 见习期工作小结 -->
		<div id="traineeinfo" class="paper_A4_auto baseinfo">
			<div class="pager_content_auto">
				<div class="studyinfo-title">见习期工作小结</div>
				<table class="zc06info-table" cellspacing="0" cellpadding="0">
					<tr>
						<td style="text-align: left;vertical-align: top;text-indent: 2em;height: 800px;"><?php echo htmlentities((isset($ptr_summary['summary_of_work']) && ($ptr_summary['summary_of_work'] !== '')?$ptr_summary['summary_of_work']:"")); ?></td>
						</td>
					</tr>
					<tr>
						<td style="position: relative;">
							<div style="position: absolute;left: 50px;">本人签字：</div>
							<div style="position: absolute;right: 50px;">年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	
		<!-- endpage -->
		<div id="endpage" class="paper_A4 baseinfo">
			<div class="pager_content">
				<table class="zc08info-table" cellspacing="0" cellpadding="0" style="margin-top: 0px;">
					<tr>
						<td style="width: 10%;height: 330px;">
							<div style="height: 20px;">所在</div>
							<div style="height: 20px;">部门</div>
							<div style="height: 20px;">考核</div>
							<div style="height: 20px;">鉴定</div>
							<div style="height: 20px;">意见</div>
						</td>
						<td style="width: 90%;height: 330px;position: relative;" colspan="3">
							<div style="position: absolute;right: 55px;bottom: 60px;">公&nbsp;&nbsp;&nbsp;&nbsp;章</div>
							<div style="position: absolute;right: 30px;bottom: 10px;">年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</div>
						</td>
					</tr>
					<tr>
						<td style="width: 10%;height: 330px;">
							<div style="height: 20px;">呈报</div>
							<div style="height: 20px;">单位</div>
							<div style="height: 20px;">考核</div>
							<div style="height: 20px;">审查</div>
							<div style="height: 20px;">意见</div>
						</td>
						<td style="width: 90%;height: 330px;position: relative;" colspan="3">
							<div style="position: absolute;right: 55px;bottom: 60px;">公&nbsp;&nbsp;&nbsp;&nbsp;章</div>
							<div style="position: absolute;right: 30px;bottom: 10px;">年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</div>
						</td>
					</tr>
					<tr>
						<td style="width: 10%;height: 300px;">
							<div style="height: 20px;">区</div>
							<div style="height: 20px;">（市）</div>
							<div style="height: 20px;">县职</div>
							<div style="height: 20px;">改办、</div>
							<div style="height: 20px;">市级</div>
							<div style="height: 20px;">主管</div>
							<div style="height: 20px;">部门</div>
							<div style="height: 20px;">意见</div>
						</td>
						<td style="width: 40%;height: 300px;position: relative;">
							<div style="position: absolute;right: 55px;bottom: 60px;">公&nbsp;&nbsp;&nbsp;&nbsp;章</div>
							<div style="position: absolute;right: 30px;bottom: 10px;">年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</div>
	
						</td>
						<td style="width: 10%;height: 300px;">
							<div style="height: 20px;">上</div>
							<div style="height: 20px;">级</div>
							<div style="height: 20px;">职</div>
							<div style="height: 20px;">改</div>
							<div style="height: 20px;">部</div>
							<div style="height: 20px;">门</div>
							<div style="height: 20px;">意</div>
							<div style="height: 20px;">见</div>
						</td>
						<td style="width: 40%;height: 300px;position: relative;">
							<div style="position: absolute;right: 55px;bottom: 60px;">公&nbsp;&nbsp;&nbsp;&nbsp;章</div>
							<div style="position: absolute;right: 30px;bottom: 10px;">年&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;日</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		</div>
	</body>
</html>
