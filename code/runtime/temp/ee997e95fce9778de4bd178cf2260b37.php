<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\www\think5\public/../code/application/admin\view\index\index.html";i:1461567839;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>后台管理 | 登录</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="__PUBLIC__/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="__PUBLIC__/font-awesome/4.6.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="__PUBLIC__/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="__PUBLIC__/adminlte/2.3.2/css/AdminLTE.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="__PUBLIC__/iCheck/square/blue.css">
<link rel="stylesheet" href="//cdn.bootcss.com/pace/1.0.2/themes/orange/pace-theme-flash.css">
<script src="//cdn.bootcss.com/pace/1.0.2/pace.min.js"></script>
<style type="text/css">
.login-box-body, .register-box-body{ padding-bottom: 5px }
.verify-area{ display: none; }
.verify-area input{ width: 100px; display: inline-block;}
.captcha{ cursor: pointer; }
.copyright{ font-size: 10px; color: #aaa; border-top: 1px solid #d9d9d9; width: 100%; position: fixed; bottom: 0; left: 0; line-height: 26px;}

.color-line {
    background: #f7f9fa;
    height: 3px;
    background-image: -webkit-linear-gradient(left, #34495e, #34495e 25%, #9b59b6 25%, #9b59b6 35%, #3498db 35%, #3498db 45%, #62cb31 45%, #62cb31 55%, #ffb606 55%, #ffb606 65%, #e67e22 65%, #e67e22 75%, #e74c3c 85%, #e74c3c 85%, #c0392b 85%, #c0392b 100%);
    background-image: -moz-linear-gradient(left, #34495e, #34495e 25%, #9b59b6 25%, #9b59b6 35%, #3498db 35%, #3498db 45%, #62cb31 45%, #62cb31 55%, #ffb606 55%, #ffb606 65%, #e67e22 65%, #e67e22 75%, #e74c3c 85%, #e74c3c 85%, #c0392b 85%, #c0392b 100%);
    background-image: -ms-linear-gradient(left, #34495e, #34495e 25%, #9b59b6 25%, #9b59b6 35%, #3498db 35%, #3498db 45%, #62cb31 45%, #62cb31 55%, #ffb606 55%, #ffb606 65%, #e67e22 65%, #e67e22 75%, #e74c3c 85%, #e74c3c 85%, #c0392b 85%, #c0392b 100%);
    background-image: linear-gradient(to right, #34495e, #34495e 25%, #9b59b6 25%, #9b59b6 35%, #3498db 35%, #3498db 45%, #62cb31 45%, #62cb31 55%, #ffb606 55%, #ffb606 65%, #e67e22 65%, #e67e22 75%, #e74c3c 85%, #e74c3c 85%, #c0392b 85%, #c0392b 100%);
    background-size: 100% 6px;
    background-position: 50% 100%;
    background-repeat: no-repeat;
}

</style>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition login-page">
<div class="color-line"></div>
<div class="login-box">
    <div class="login-logo">
      <b>后台管理登录</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="<?php echo url('index'); ?>" method="post">
            <div class="input-area">
                <div class="form-group has-feedback">
                    <input type="email" name="username" class="form-control" placeholder="用户名/邮箱">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="密码">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback verify-area">
                    <input type="text" name="verify" id="verify" class="form-control" placeholder="验证码">  <img class="captcha" src="<?php echo url('verify'); ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="remember"> 记住用户名
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
        <!-- <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->
    </div>
    <!-- /.login-box-body -->
</div>
<div class="text-center copyright">Copyright ©2016 <a href="http://www.benweng.com" target="_blank" title="笨翁造型">BENWENG.COM</a></div>
<!-- /.login-box -->
<!-- jQuery 2.2.0 -->
<script src="__PUBLIC__/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="__PUBLIC__/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="__PUBLIC__/iCheck/icheck.min.js"></script>
<!-- layer -->
<script src="__PUBLIC__/layer/2.2/layer.js"></script>
<script>
$(function () {
    var storage     = window.localStorage;  // html5 本地存储对象
    var username    = $('input[name="username"]');
    var password    = $('#password');
    var remember    = $('#remember');
    var button      = $('button');
    var verifyArea  = $('.verify-area');
    
    // 本地存储数据判断[html5/cookie]
    if(storage){
        if(storage.getItem('username')){
            username.val(storage.getItem('username'));
            password.focus();
            remember.prop('checked',true);
        }else{
            username.focus();
        }

        if(storage.getItem('error_num')){
            if(storage.getItem('error_num')>3){
                verifyArea.show();
            }
        }
    }else{
        if($.cookie(COOKIE_NAME)){
            username.val($.cookie(COOKIE_NAME));
            password.focus();
            remember.prop('checked',true);
        }else{
            username.focus();
        }

        if($.cookie(COOKIE_ERROR)>3){
            verifyArea.show();
        }
    }

    // checkbox样式
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    
    // 密码框失焦检查是否显示验证码
    $('body').on('blur', '#password', function(event) {
        event.preventDefault();
        $.ajax({
            url: '<?php echo url("showverify"); ?>',
            type: 'POST',
            dataType: 'json',
        })
        .done(function(data) {
            if(data==1){
                verifyArea.show();
            }
        });
    });

    // 登录提交
    $('body').on('click', 'button[type="submit"]', function(event) {
        event.preventDefault();
        var _form     = $('form');
        var issubmit  = true;

        _form.find('.input-area .form-group:visible').each(function(index, el) {
            var input  = $(this).find('input');
            if(!input.val()){
                input.css('border','1px #ff0000 solid');
                if(issubmit){
                    input.focus();
                }
                issubmit  = false;
            }else{
                input.removeAttr('style');
            }
        });

        if(!issubmit){
            layer.msg('请填写必填项',function(){});
            return false;
        }

        var loading = layer.load();
        if (remember.prop('checked')==true) {
            if(storage){
                storage.setItem('username',username.val());
            }else{
                $.cookie(COOKIE_NAME,username.val(), { path: '/', expires: 15 });
            }
        }else{
            if(storage){
                storage.removeItem('username');
            }else{
                $.cookie(COOKIE_NAME, null, { path: '/' });  //删除cookie
            }
        }
        
        button.prop('disabled',true).text('登录中…');
        $.ajax({
            url: '<?php echo url('index'); ?>',
            type: 'POST',
            dataType: 'json',
            data: _form.serialize(),
        })
        .done(function(data) {
            console.log(data);
            if(data.status==1){
                layer.msg(data.info);
                layer.close(loading);
                window.location.href = data.url;
            }else{
                layer.msg(data.info,function(){});
                layer.close(loading);
                button.prop('disabled',false).text('登录');
                // console.log('登录');
            }

            if(storage){
                storage.setItem('error_num',data.error_num);
            }else{
                $.cookie(COOKIE_ERROR,data.error_num, { path: '/', expires: 15 });
            }

            if(data.show_code==1){
                verifyArea.show();
                changeCode();
            }else{
                verifyArea.hide();
            }
        })
        .fail(function() {
            layer.close(loading);
            console.log('fail');
            button.prop('disabled',false).text('登录');
        })
        .always(function() {
            console.log("complete");
        });
        
        return false;
    });
    
    // 点击切换验证码
    $('body').on('click', '.captcha', function(event) {
        event.preventDefault();
        changeCode();
    });

});

// 取得时间函数
function genTimestamp(){
    var time = new Date();
    return time.getTime();
}

// 验证码地址
var verifyUrl       = '<?php echo url("verify"); ?>';

// 切换验证码函数
function changeCode(){
    $('.captcha').attr('src',verifyUrl + '?t='+genTimestamp());
}
</script>
</body>
</html>