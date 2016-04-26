<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\www\think5\public/../code/application/admin\view\order\index3.html";i:1461569559;s:67:"D:\www\think5\public/../code/application/admin\view\mould\base.html";i:1461655424;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>后台首页 -- 后台管理</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="__PUBLIC__/bootstrap/4.0.0/css/bootstrap.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="__PUBLIC__/font-awesome/4.6.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="__PUBLIC__/ionicons/2.0.1/css/ionicons.min.css">
<!-- animate.css -->
<link rel="stylesheet" href="__PUBLIC__/animate.css/3.5.1/animate.css">
<link rel="stylesheet" href="__CSS__/cyAdmin.css">
<!-- Theme style -->
<link rel="stylesheet" href="__CSS__/skins/skin-default.css">
<link rel="stylesheet" href="//cdn.bootcss.com/pace/1.0.2/themes/orange/pace-theme-flash.css">
<!-- //cdn.bootcss.com/pace/1.0.2/themes/orange/pace-theme-minimal.css -->

<script src="//cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="skin-default">
<div class="wrapper">
  <header class="main-header"> 
    <!-- Logo --> 
    <a href="#" class="logo">
    <span class="logo-mini"><b>BW</b></span>
    <span class="logo-lg"><b>BENWENG</b></span> </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="javascrpt:void(0)" class="sidebar-toggle main-sidebar-toggle" title=""> <span class="sr-only">Toggle navigation</span> </a>
      <ul class="list-inline">
        <li class="dropdown">
          <a href="" data-toggle="dropdown" title="">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">5</span>
          </a>
          <ul class="dropdown-menu animated-nav fadeIn">
            <li><a href="http://www.baidu.com">百度</a></li>
            <li>fdsafd</li>
            <li>fdsafd</li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="" data-toggle="dropdown" title="">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">5</span>
          </a>
          <ul class="dropdown-menu animated-nav flipInX">
            <li>fdsafd</li>
            <li>fdsafd</li>
            <li>fdsafd</li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="" data-toggle="dropdown" title="">
            <i class="fa fa-user"></i>
          </a>
          <ul class="dropdown-menu animated flipInX">
            <li>fdsafd</li>
            <li>fdsafd</li>
            <li>fdsafd</li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="" data-toggle="dropdown" title=""><i class="fa fa-cogs fa-spin"></i></a>
          <ul class="dropdown-menu animated flipInY">
            <li>fdsafd</li>
            <li>fdsafd</li>
            <li><a href="" title="退出">退出</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar"> 
      <ul>
        <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
          <li <?php if($menu['active']): ?>class="active"<?php endif; ?>>
            <dl>
              <dt>
                <a href="<?php echo $menu['name']; ?>" title="<?php echo $menu['title']; ?>">
                  <i class="fa <?php if(empty($menu['icon'])): ?>fa-circle-o<?php else: ?><?php echo $menu['icon']; endif; ?>"></i> <span><?php echo $menu['title']; ?></span>
                  <?php if(!empty($menu['items'])): ?><em class="fa fa-angle-left pull-right"></em><?php endif; ?>
                </a>
              </dt>
              <?php if(!empty($menu['items'])): ?>
                <dd class="animated fadeIn" <?php if($menu['active']): ?>style="display: block;"<?php endif; ?>>
                  <?php if(is_array($menu['items'])): $i = 0; $__LIST__ = $menu['items'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$items): $mod = ($i % 2 );++$i;?>
                    <a <?php if($items['active']): ?>class="active"<?php endif; ?> href="<?php echo $items['name']; ?>" title="<?php echo $items['title']; ?>"><i class="fa fa-circle-o"></i> <?php echo $items['title']; ?></a>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </dd>
              <?php endif; ?>
            </dl>
          </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- <li>
          <dl>
            <dt><a href="<?php echo url('index'); ?>" title="index3"><i class="fa fa-home"></i> <span>首页</span></a></dt>
          </dl>
        </li>
        <li>
          <dl>
            <dt><a href="<?php echo url('index2'); ?>" title="index3"><i class="fa fa-desktop"></i> <span>index2</span></a></dt>
          </dl>
        </li>
        <li>
          <dl>
            <dt><a href="<?php echo url('index3'); ?>" title="index3"><i class="fa fa-credit-card"></i> <span>index3</span></a></dt>
          </dl>
        </li>
        <li class="active">
          <dl>
            <dt><a href="" title=""><i class="fa fa-product-hunt"></i> <span>产品</span><em class="fa fa-angle-left pull-right"></em></a></dt>
            <dd class="animated fadeIn" style="display: block;">
              <a class="active" href="<?php echo url('index3'); ?>" title="产品"><i class="fa fa-circle-o text-yellow"></i> 产品</a>
              <a href="<?php echo url('index3'); ?>" title="产品1"><i class="fa fa-circle-o text-yellow"></i> 产品1</a>
              <a href="<?php echo url('index3'); ?>" title="产品2"><i class="fa fa-circle-o text-yellow"></i> 产品2</a>
              <a href="<?php echo url('index3'); ?>" title="产品3"><i class="fa fa-circle-o text-yellow"></i> 产品3</a>
              <a href="<?php echo url('index3'); ?>" title="产品4"><i class="fa fa-circle-o text-yellow"></i> 产品4</a>
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt><a href="" title=""><i class="fa fa-cubes"></i> <span>产品产品</span><em class="fa fa-angle-left pull-right"></em></a></dt>
            <dd class="animated fadeIn">
              <a href="<?php echo url('index3'); ?>" title="产品"><i class="fa fa-circle-o text-yellow"></i> 产品产品</a>
              <a href="<?php echo url('index3'); ?>" title="产品1"><i class="fa fa-circle-o text-yellow"></i> 产品产品1</a>
              <a href="<?php echo url('index3'); ?>" title="产品2"><i class="fa fa-circle-o text-yellow"></i> 产品产品2</a>
              <a href="<?php echo url('index3'); ?>" title="产品3"><i class="fa fa-circle-o text-yellow"></i> 产品产品3</a>
              <a href="<?php echo url('index3'); ?>" title="产品4"><i class="fa fa-circle-o text-yellow"></i> 产品产品4</a>
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt><a href="" title=""><i class="fa fa-graduation-cap"></i> <span>产品</span><em class="fa fa-angle-left pull-right"></em></a></dt>
            <dd class="animated fadeIn">
              <a href="<?php echo url('index3'); ?>" title="产品"><i class="fa fa-circle-o text-yellow"></i> 产品</a>
              <a href="<?php echo url('index3'); ?>" title="产品1"><i class="fa fa-circle-o text-yellow"></i> 产品1</a>
              <a href="<?php echo url('index3'); ?>" title="产品2"><i class="fa fa-circle-o text-yellow"></i> 产品2</a>
              <a href="<?php echo url('index3'); ?>" title="产品3"><i class="fa fa-circle-o text-yellow"></i> 产品3</a>
              <a href="<?php echo url('index3'); ?>" title="产品4"><i class="fa fa-circle-o text-yellow"></i> 产品4</a>
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt><a href="" title=""><i class="fa fa-globe"></i> <span>产品</span><em class="fa fa-angle-left pull-right"></em></a></dt>
            <dd>
              <a href="<?php echo url('index3'); ?>" title="产品"><i class="fa fa-circle-o text-yellow"></i> 产品</a>
              <a href="<?php echo url('index3'); ?>" title="产品1"><i class="fa fa-circle-o text-yellow"></i> 产品1</a>
              <a href="<?php echo url('index3'); ?>" title="产品2"><i class="fa fa-circle-o text-yellow"></i> 产品2</a>
              <a href="<?php echo url('index3'); ?>" title="产品3"><i class="fa fa-circle-o text-yellow"></i> 产品3</a>
              <a href="<?php echo url('index3'); ?>" title="产品4"><i class="fa fa-circle-o text-yellow"></i> 产品4</a>
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt><a href="" title=""><i class="fa fa-industry"></i> <span>产品</span><em class="fa fa-angle-left pull-right"></em></a></dt>
            <dd class="animated fadeIn">
              <a href="<?php echo url('index3'); ?>" title="产品"><i class="fa fa-circle-o text-yellow"></i> 产品</a>
              <a href="<?php echo url('index3'); ?>" title="产品1"><i class="fa fa-circle-o text-yellow"></i> 产品1</a>
              <a href="<?php echo url('index3'); ?>" title="产品2"><i class="fa fa-circle-o text-yellow"></i> 产品2</a>
              <a href="<?php echo url('index3'); ?>" title="产品3"><i class="fa fa-circle-o text-yellow"></i> 产品3</a>
              <a href="<?php echo url('index3'); ?>" title="产品4"><i class="fa fa-circle-o text-yellow"></i> 产品4</a>
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt><a href="" title=""><i class="fa fa-life-bouy"></i> <span>产品end</span><em class="fa fa-angle-left pull-right"></em></a></dt>
            <dd class="animated fadeIn">
              <a href="<?php echo url('index3'); ?>" title="产品"><i class="fa fa-circle-o text-yellow"></i> 产品</a>
              <a href="<?php echo url('index3'); ?>" title="产品1"><i class="fa fa-circle-o text-yellow"></i> 产品1</a>
              <a href="<?php echo url('index3'); ?>" title="产品2"><i class="fa fa-circle-o text-yellow"></i> 产品2</a>
              <a href="<?php echo url('index3'); ?>" title="产品3"><i class="fa fa-circle-o text-yellow"></i> 产品3</a>
              <a href="<?php echo url('index3'); ?>" title="产品4"><i class="fa fa-circle-o text-yellow"></i> 产品4end</a>
            </dd>
          </dl>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
    <div class="copyright">Copyright &copy; 2015-2016<br/><a href="http://www.benweng.com" title="SpringYang Studio">Benweng</a>. All rights
    reserved.</div>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="main-wrapper"> 
    <!-- Product Sidebar -->
    <div class="product-sidebar">
      <section class="product-sidebar-wrapper">
        <dl>
          <dt>产品</dt>
          <dd>
            <a href="" title="second-sidebar1">secondsecondsecondsecond-sidebar1</a>
            <a href="" title="second-sidebar1">second-sidebar1</a>
            <a href="" title="second-sidebar1">second-sidebar1</a>
            <a href="" title="second-sidebar1">second-sidebar1</a>
            <a href="" title="second-sidebar1">second-sidebar1</a>
            <a href="" title="second-sidebar1">second-sidebar1</a>
          </dd>
        </dl>
      </section>
      <div class="product-sidebar-control second-sidebar-toggle">
        <a class="second-sidebar-sold-left" href="javascript:void(0)" title="隐藏"><i class="fa fa-angle-double-left"></i></a>
        <a class="second-sidebar-sold-right" href="javascript:void(0)" title="展开"><i class="fa fa-angle-double-right"></i></a>
      </div>
    </div>
    <!-- /.product-sidebar --> 
    <!-- Content Header (Page header) -->
    <div class="content-wrapper">
      <div class="full-control">
        <a href="javascript:void(0)" title="全屏"><i class="fa fa-arrows-alt"></i></a>
      </div>
      <div class="content-main">
        <section class="content-header">
          <h1><strong>这是标题</strong></h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content" style="padding-left: 16px"> 
  index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>index3<br/>end
 </section>
      </div>
    </div>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="display: none;">
    <div class="pull-right hidden-xs"> <b>Version</b> 2.3.2 </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://www.benweng.com">SpringYang Studio</a>.</strong> All rights
    reserved. </footer>
  
  <!-- /.control-sidebar --> 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper --> 

<!-- jQuery 2.2.0 --> 
<script src="__PUBLIC__/jQuery/jQuery-2.2.0.min.js"></script> 
<!-- Bootstrap 3.3.5 --> 
<script src="__PUBLIC__/bootstrap/4.0.0/js/bootstrap.js"></script> 
<!-- Slimscroll --> 
<script src="__PUBLIC__/slimScroll/1.3.9/jquery.slimscroll.js"></script>

<script src="__JS__/cyAdmin.js"></script>
</body>
</html>
