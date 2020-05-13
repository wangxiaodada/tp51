<?php /*a:1:{s:60:"E:\phpStudy\WWW\tp51\application\admin\view\Index\index.html";i:1587548535;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>

<link rel="stylesheet" href="/static/user/css/index.css" type="text/css" media="screen" />

<script type="text/javascript" src="/static/user/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/user/js/tendina.min.js"></script>
<script type="text/javascript" src="/static/user/js/common.js"></script>

</head>
<body>
    <!--顶部-->
    <div class="layout_top_header">
            <div style="float: left"><span style="font-size: 16px;line-height: 45px;padding-left: 20px;color: #8d8d8d">后台管理界面</h1></span></div>
            <div id="ad_setting" class="ad_setting">
                <a class="ad_setting_a" href="javascript:; ">
                    <i class="icon-user glyph-icon" style="font-size: 20px"></i>
                    <span><?php echo htmlentities(app('session')->get('admin.nick_name')); ?></span>
                    <i class="icon-chevron-down glyph-icon"></i>
                </a>
                <ul class="dropdown-menu-uu" style="display: none" id="ad_setting_ul">
                    <li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-user glyph-icon"></i> 个人中心 </a> </li>
                    <li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-cog glyph-icon"></i> 设置 </a> </li>
                    <li class="ad_setting_ul_li"> <a href="/Login/cancellation"><i class="icon-signout glyph-icon"></i> <span class="font-bold">退出</span> </a> </li>
                </ul>
            </div>
    </div>
    <!--顶部结束-->
    <!--菜单-->
    <div class="layout_left_menu">
        <ul id="menu">
            <li class="childUlLi">
               <a href="<?php echo url('Index/holle'); ?>"  target="menuFrame"><i class="glyph-icon icon-home"></i>首页</a>
            </li>
            <li class="childUlLi">
                <a href="javascript:(0);"  target="menuFrame"> <i class="glyph-icon icon-reorder"></i>客户管理</a>
                <ul>
                    <li><a href="<?php echo url('IndexUserAll/index'); ?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>客户信息</a></li>
                </ul>
            </li>
            <li class="childUlLi">
                <a href="javascript:(0);" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>业绩管理</a>
                <ul>
                    <li><a href="<?php echo url('IndexAchievementAll/index'); ?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>所有业绩</a></li>
                </ul>
            </li>
            <?php if(app('session')->get('admin.id') == 1): ?>
            <li class="childUlLi">
                <a href="javascript:(0);" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>管理员管理</a>
                <ul>
                    <li><a href="<?php echo url('IndexAdminAll/index'); ?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>所有管理员</a></li>
                    <li><a href="<?php echo url('IndexAdminJurisdiction/index'); ?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>权限管理</a></li>
                    <li><a href="<?php echo url('IndexAdminAchievementType/showAchievementType'); ?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>业绩分类管理</a></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <!--菜单-->
    <div id="layout_right_content" class="layout_right_content">
        <div class="route_bg" name="div_title">
            <a href="#">主页</a><i class="glyph-icon icon-chevron-right"></i>
            <a href="#" name="two">菜单管理</a>
        </div>
        <div class="mian_content">
            <div id="page_content">
                <iframe id="menuFrame" name="menuFrame" src="<?php echo url('Index/holle'); ?>" style="overflow:visible;" scrolling="yes" frameborder="no" width="100%" height="100%"></iframe>
            </div>
        </div>
    </div>

    <div class="layout_footer">
        <!--<p>Copyright © 2019 - 菁华同创教育有限公司</p>-->
    </div>

</body>
</html>