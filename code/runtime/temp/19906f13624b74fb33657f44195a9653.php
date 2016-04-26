<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\www\think5\public/../code/application/admin\view\order\index.html";i:1461569550;s:67:"D:\www\think5\public/../code/application/admin\view\mould\base.html";i:1461662926;}*/ ?>
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
        <?php if(is_array($menu['menu'])): $i = 0; $__LIST__ = $menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?>
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Chat</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
              </div>
            </div>
            <div class="box-body chat" id="chat-box">
              <!-- chat item -->
              <div class="item">
                <img src="__IMAGES__/user4-128x128.jpg" alt="user image" class="online">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                    Mike Doe
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
                <div class="attachment">
                  <h4>Attachments:</h4>

                  <p class="filename">
                    Theme-thumbnail-image.jpg
                  </p>

                  <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                  </div>
                </div>
                <!-- /.attachment -->
              </div>
              <!-- /.item -->
              <!-- chat item -->
              <div class="item">
                <img src="__IMAGES__/user3-128x128.jpg" alt="user image" class="offline">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                    Alexander Pierce
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
              </div>
              <!-- /.item -->
              <!-- chat item -->
              <div class="item">
                <img src="__IMAGES__/user2-160x160.jpg" alt="user image" class="offline">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                    Susan Doe
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
              </div>
              <!-- /.item -->
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              <div class="input-group">
                <input class="form-control" placeholder="Type message...">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                <li>
                  <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  <input type="checkbox" value="" name="">
                  <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Check your messages and notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div>
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Visitors
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label">Exists</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Mail-Orders</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">In-Store</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <!-- Progress bars -->
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
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
