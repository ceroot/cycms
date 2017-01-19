/**
 * 
 * @authors SpringYang (ceroot@163.com)
 * @date    2016-04-13 11:44:24
 * @version $Id$
 */

if (typeof jQuery === "undefined") {
  throw new Error("需要引入 jQuery");
}


$.Cy = {};

/* --------------------
 * - Cy Options -
 * --------------------
 * Modify these options to suit your implementation
 */
$.Cy.options = {
  
};

var doc      = document;
var storage  = window.localStorage;  // html5 本地存储对象

$(function(){
    'use strict';
	_init();

	$.Cy.layout.activate();

    document.onkeydown = function(){  
        var oEvent = window.event;
        // 全屏快捷键 Atl + x
        if (oEvent.keyCode == 88 && oEvent.altKey) {
            $.Cy.fulWrapper.main();
        }

        // 侧边栏快捷键
        if (oEvent.keyCode == 90 && oEvent.altKey) {
            $.Cy.sidebar.fold();
        }
    }
    
    // 选择框变形
    $('body').on('click', '.lbl', function(event) {
        event.preventDefault();
        /* Act on the event */
        var _checkbox = $(this).prev();
        if(_checkbox.is(':checked')){
            _checkbox.prop('checked',false);
        }else{
            _checkbox.prop('checked',true);
        }
    });

    // checkbox样式
    var args = ['iCheck'];
    Wind.use(args, function () {
        $('input.iCheck[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        $('input.iCheck[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });


    $("#file0").change(function(){
		var objUrl = getObjectURL(this.files[0]) ;
		
		console.log("objUrl = "+objUrl) ;
		if (objUrl) {
			$("#img0").attr("src", objUrl) ;
		}

        $('.cover-show').show();
		
	});

    $('body').on('click', '.fileinput-remove-button', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('.cover-show').hide();
    });
	
	function getObjectURL(file) {
		var url = null ;
		if (window.createObjectURL!=undefined) { // basic
			//$("#oldcheckpic").val("nopic");
			url = window.createObjectURL(file) ;
		} else if (window.URL!=undefined) { // mozilla(firefox)
			//$("#oldcheckpic").val("nopic");
			url = window.URL.createObjectURL(file) ;
		} else if (window.webkitURL!=undefined) { // webkit or chrome
			//$("#oldcheckpic").val("nopic");
			url = window.webkitURL.createObjectURL(file) ;
		}
		return url ;
	}
});

function _init(){
	'use strict';

	$.Cy.layout  = {
        activate:function(){
        	var _this  = this;
        	_this.main();
            _this.slimScroll();
            _this.productSidebar();

            $.Cy.sidebar.init();
            $.Cy.fulWrapper.init();
            $.Cy.ajax.init();

        	$(window,'.main-wrapper').resize(function(event) {
        		/* Act on the event */
        		_this.slimScroll();
        		// console.log(0);
                
        	});
            
        },
        main:function(){
            // iCheck
            var checkbox = $('body').find('input[type="checkbox"]');
            // if(checkbox.length>0){
            //     Wind.use('iCheck',function(){
            //         checkbox.iCheck({
            //             checkboxClass: 'icheckbox_square-blue',
            //             radioClass: 'iradio_square-blue',
            //             increaseArea: '20%' // optional
            //         });
            //     });
            // }
        	
        },

        // 滚动条
        slimScroll:function(){
            var _this  = this;
            // 左边菜单滚动条
            var sidebar  = $('body').find('.sidebar');
            sidebar.slimScroll({destroy: true}).height("auto");
            sidebar.slimScroll({
                height: ($(window).height() - $('.main-header').height() - $('.copyright').height()) + 'px',
                color: 'rgba(0,0,0,0.2)',
                size: '0px',
                // wrapperClass:'sidebarScroll'
            });

            // 二级菜单滚动
            if($(window).width()>768){
                var productSidebar  = $('body').find('.product-sidebar-wrapper');

                productSidebar.slimScroll({destroy: true}).height("auto");
                productSidebar.slimscroll({
                    height: ($(window).height() - $('.main-header').height()) + 'px',
                    color: 'rgba(0,0,0,0.2)',
                    size: '5px',
                    opacity:0.6,
                    // wrapperClass:'productSidebarScroll'
                });
            }

            // 主体滚动函数
            // _this.contentMainScroll();
        },

        // 主体滚动
        contentMainScroll:function(){
            var contentMain  = $('.content-main');
            var height;

            if($('body').hasClass('full-wrapper')){
                height  = $(window).height();
            }else{
                height  = $(window).height() - $('.main-header').height();
            }

            contentMain.slimScroll({destroy: true}).height("auto");
            contentMain.slimscroll({
                // height: ($(window).height() - $('.main-header').height()) + 'px',
                height: height + 'px',
                color: 'rgba(0,0,0,0.2)',
                size: '10px',
                opacity:0.8,
                alwaysVisible: true,
                // railVisible: true,
                // disableFadeOut:true
                // width: 'auto', //可滚动区域宽度
                // height: '100%', //可滚动区域高度
                // size: '10px', //组件宽度
                // color: '#000', //滚动条颜色
                // position: 'right', //组件位置：left/right
                // distance: '0px', //组件与侧边之间的距离
                // start: 'top', //默认滚动位置：top/bottom
                // opacity: .4, //滚动条透明度
                // alwaysVisible: true, //是否 始终显示组件
                // disableFadeOut: false, //是否 鼠标经过可滚动区域时显示组件，离开时隐藏组件
                // railVisible: true, //是否 显示轨道
                // railColor: '#333', //轨道颜色
                // railOpacity: .2, //轨道透明度
                // railDraggable: true, //是否 滚动条可拖动
                // railClass: 'slimScrollRail', //轨道div类名 
                // barClass: 'slimScrollBar', //滚动条div类名
                // wrapperClass: 'slimScrollDiv', //外包div类名
                // allowPageScroll: true, //是否 使用滚轮到达顶端/底端时，滚动窗口
                // wheelStep: 20, //滚轮滚动量
                // touchScrollStep: 200, //滚动量当用户使用手势
                // borderRadius: '7px', //滚动条圆角
                // railBorderRadius: '7px' //轨道圆角
            });
        },

        // 二级侧边
        productSidebar:function(){
            // 隐藏左第二级侧边
            $('body').on('click', '.second-sidebar-toggle', function(event) {
                event.preventDefault();
                /* Act on the event */
                var mainWrapper  = $('.main-wrapper');
                var productSidebarControl  = $('.product-sidebar-control i');
                if(mainWrapper.hasClass('product-sidebar-fold')){
                    mainWrapper.removeClass('product-sidebar-fold');

                    // 本地存储数据判断[html5/cookie]
                    if(storage){
                        storage.removeItem('productSidebarFold');
                    }else{
                        $.cookie(productSidebarFold, null, { path: '/' });  //删除cookie
                    }
                }else{
                    mainWrapper.addClass('product-sidebar-fold');

                    // 本地存储数据判断[html5/cookie]
                    if(storage){
                        storage.setItem('productSidebarFold',1);
                    }else{
                        $.cookie(productSidebarFold,1, { path: '/', expires: 15 });
                    }
                };
            });
        },

        fix:function(){
        	console.log(0);
        }
	};

    $.Cy.sidebar  = {
        init:function(){
            var _this  = this;

            _this.main();
            _this.click();
            _this.hover();

        },
        main:function(){
            var _this  = this;
            // 侧边栏折叠
            $('body').on('click', '.main-sidebar-toggle', function(event) {
                event.preventDefault();
                _this.fold();
            });

            // 屏幕大小判断
            if(getWindowSize().x<1366){
                $.get('/console/index/getcollapsed',{},function(data){
                    if(data==1){
                        
                    }else{
                        $.post('/console/index/setcollapsed',{collapsed:1});
                        if($('body').hasClass('sidebar-expanded')){
                            $('body').removeClass('sidebar-expanded').addClass('sidebar-collapsed');
                        }
                    }
                });
                // $.post('/console/index/setcollapsed',{collapsed:1});

                // $.get('/console/index/getcollapsed',{},function(data){
                //     if(data!='1'){
                //         $.post('/console/index/setcollapsed',{collapsed:1});
                //         if($('body').hasClass('sidebar-expanded')){
                //             $('body').removeClass('sidebar-expanded').addClass('sidebar-collapsed');
                //         }
                //     }
                // },'json');
            };

            $('body').on('mouseenter', '.sidebar-tooltip', function(event) {
                event.preventDefault();
                /* Act on the event */
                var dataTooltip  = $(this).prop('data-tooltip');
                $('.sidebar>ul>li').eq(dataTooltip).find('dl>dt>a').addClass('current');
                $('.sidebar>ul>li').eq(dataTooltip).siblings().find('dl>dt>a').removeClass('current');
            });

            $('body').on('mouseleave', '.main-sidebar', function(event) {
                event.preventDefault();
                /* Act on the event */
                $('body').find('.sidebar-tooltip').fadeOut('normal',function(){
                    $('body').find('.sidebar-tooltip').remove();
                })
                $('.sidebar>ul>li').find('dl>dt>a').removeClass('current');
            });
        },
        click:function(){
            // 主菜单点击事件
            $('body').on('click', '.sidebar ul>li>dl>dt>a', function(event) {
                /* Act on the event */
                var _self  = $(this);
                var _li    = _self.closest('li');

                if(!$('body').hasClass('sidebar-collapsed')){
                    if(_li.find('dd').length>0){
                        if(_li.hasClass('active')){
                            _li.find('dd').slideUp('normal',function(){
                                _li.removeClass('active');
                            });
                        }else{
                            _li.addClass('active').find('dd').slideDown();
                            _li.siblings().find('dd').slideUp('normal',function(){
                                _li.siblings().removeClass('active');
                            });
                        }
                        return false;
                    }
                }
            });
        },
        hover:function(){
            // 主菜单鼠标移上去
            $('body').on('mouseenter', '.sidebar ul>li', function(event) {
                event.preventDefault();
                /* Act on the event */
                if($('body').hasClass('sidebar-collapsed')){
                    var _self      = $(this);
                    var offsetY    = _self.offset().top;
                    var index      = _self.index();
                    var dlHtml;

                    $('.sidebar>li>dl>dt').find('a').removeClass('current');

                    if($('body').find('.sidebar-tooltip').length==0){
                        var tooltipHtml  = '<div class="sidebar-tooltip" data-tooltip="0"></div>';
                        $('.main-sidebar').append(tooltipHtml);
                    }

                    if($('body').find('.sidebar-tooltip').length>0){
                        $('body').find('.sidebar-tooltip').hide().fadeIn(150).css({'top':offsetY}).prop('data-tooltip',index);
                        if(_self.find('dl').length>0){
                            dlHtml  = _self.find('dl').prop('outerHTML');
                            $('body').find('.sidebar-tooltip').html(dlHtml);
                        }
                    }

                    if($('body').find('.sidebar-tooltip dd').length>0){
                        $('body').find('.sidebar-tooltip dt').addClass('bbrr-no');
                    }else{
                        $('body').find('.sidebar-tooltip dt').removeClass('bbrr-no');
                    }

                }
            });
        },
        fold:function(){
            // 侧边栏折叠
            if($('body').hasClass('sidebar-expanded')){
                $('body').removeClass('sidebar-expanded').addClass('sidebar-collapsed');
                $.post('/console/index/setcollapsed',{collapsed:1});

                // 本地存储数据判断[html5/cookie]
                if(storage){
                    storage.setItem('sidebarFold',1);
                }else{
                    $.cookie(sidebarFold,1, { path: '/', expires: 15 });
                }
            }else{
                $('body').removeClass('sidebar-collapsed').addClass('sidebar-expanded');
                $.post('/console/index/setcollapsed',{collapsed:0});
                // 本地存储数据判断[html5/cookie]
                if(storage){
                    storage.removeItem('sidebarFold');
                }else{
                    $.cookie(sidebarFold, null, { path: '/' });  //删除cookie
                }
            };
        }
        
    };

    // full wrapper
    $.Cy.fulWrapper  = {
        init:function(){
            var _this  = this;
            $('body').on('click', '.full-control', function(event) {
               event.preventDefault();
               _this.main();
            });
        },
        main:function(){
            if($('body').hasClass('full-wrapper')){
                $('body').removeClass('full-wrapper');
            }else{
                $('body').addClass('full-wrapper');
            };
            // 主体滚动函数
            //$.Cy.layout.contentMainScroll();
        }
    };

    // ajax 提交
    $.Cy.ajax  = {
        init:function(){
            var _this  = this;
            _this.a_ajax();
            _this.form_ajax();
        },
        maim:function(){},
        a_ajax:function(){
            // a 标签 ajax 提交，成功之后刷新页面或者跳转到新的页面
            // 使用方法：直接在 a 标签添加 a_ajax class
            // 参数：
            // data-layer-msg：显示提示信息，默认为[操作]
            // data-layer-okbtn：提交按钮文字，默认为[提交]
            // data-layer-cancelbtn：取消按钮文字，默认为[取消]
            // data-layer-confirm: 是否弹出提交提示，默认为[false]不弹出
            var _this = this;
            var a_ajax  = 'cy-ajax';
            if ($('body').find('a.'+a_ajax).length) {
                Wind.use('layer', function () {
                    $('body').on('click','a.'+a_ajax, function (e) {
                        e.preventDefault();
                        var $_self   = $(this),
                            $_href   = $_self.prop('href'),
                            // $_msg   = $_self.data('msg');
                            $_msg    = $_self.attr('data-layer-msg') ? $_self.attr('data-layer-msg') : '操作',
                            $_ok_btn_text      = $_self.attr('data-layer-okbtn') ? $_self.attr('data-layer-okbtn') : '提交',
                            $_cancel_btn_text  = $_self.attr('data-layer-cancelbtn') ? $_self.attr('data-layer-cancelbtn') : '取消',
                            $_confirm          = $_self.attr('data-layer-confirm')  ? $_self.attr('data-layer-confirm') : false;

                        if($_self.hasClass('disabled')){
                            return false;
                        }
                        if($_confirm){
                            layer.confirm('确定要'+$_msg+'吗？', {
                                icon: 7,
                                btn: [$_ok_btn_text,$_cancel_btn_text], //按钮
                                shadeClose:true,
                            }, function(){
                                var loading = layer.load();
                                $_self.addClass('disabled');
                                _this.a_ajax_json($_self,$_href,$_msg,loading);
                            }, function(index){
                                layer.close(index);
                            });
                        }else{
                            var loading = layer.load();
                            $_self.addClass('disabled');
                            _this.a_ajax_json($_self,$_href,$_msg,loading);
                        }
                    });
                });
            }
        },
        a_ajax_json:function($_self,$_href,$_msg,loading){
            $.getJSON($_href).done(function(data){
                console.log(data);
                if(data.code){
                    layer.closeAll('loading');
                    layer.msg(
                        $_msg+'成功，页面正在进行页面跳转……',
                        {
                            icon: 1,
                            time:800,
                            shift:0,
                        },
                        function(){
                            reloadPage(window);
                        });
                }else{
                    layer.msg(data.msg,{icon:2});
                    layer.closeAll('loading');
                }
            });
        },
        form_ajax:function(){
            var ajaxForm = $('form.cy-ajaxForm');
            if(ajaxForm.length){
                var validateStatus  = ajaxForm.attr('data-validate') ? ajaxForm.attr('data-validate') : false;
                var args = ['ajaxForm'];
                console.log(10);
                console.log(validateStatus);
                if(validateStatus==true){
                    console.log(20);
                    args = ['validate', 'ajaxForm'];
                }
                console.log(21);
                Wind.use(args, function () {
                    var btn = ajaxForm.find('button.btn-post');
                    // window.UEDITOR_HOME_URL = "/statics/";
                    // var ue  = UE.getEditor('content');
                    console.log(30);
                    if(validateStatus==true){
                        console.log(40);
                        //表单验证开始
                        var baseValidate = {
                            //是否在获取焦点时验证
                            onfocusout:false,
                            //是否在敲击键盘时验证
                            onkeyup:false,
                            //当鼠标掉级时验证
                            onclick: false,
                            //验证错误
                            showErrors: function (errorMap, errorArr) {
                                //errorMap {'name':'错误信息'}
                                //errorArr [{'message':'错误信息',element:({})}]
                                try{
                                    $(errorArr[0].element).focus();
                                    layer.msg(errorArr[0].message);
                                }catch(err){
                                }
                            },
                            //验证规则
                           
                            //给未通过验证的元素加效果,闪烁等
                            highlight: true,
                            //验证通过，提交表单
                            submitHandler: function (forms) {
                                ajaxForm.ajaxSubmit({
                                    url: ajaxForm.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
                                    dataType: 'json',
                                    beforeSubmit: function (arr, $form, options) {
                                        var text = btn.text();

                                        // 按钮文案、状态修改
                                        btn.text(text + '中...').prop('disabled', true).addClass('disabled');
                                        layer.load();
                                    },
                                    success: function (data, statusText, xhr, $form) {
                                        console.log(data);
                                        var text = btn.text();
                                        //按钮文案、状态修改
                                        btn.prop('disabled',false).removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();
                                        if(data.code){
                                            layer.msg(data.msg,{time:500,shift:0},function(){
                                               if(data.url){
                                                    window.location.href = data.url;
                                                } 
                                            });
                                        }else{
                                            layer.msg(data.msg);
                                        }
                                        layer.closeAll('loading');
                                    }
                                });
                            }
                        };
                        var validate = $.extend({},baseValidate,userValidate);
                        
                        ajaxForm.validate(validate);
                    }else{
                        console.log(41);
                        btn.on('click', function (e) {
                            e.preventDefault();
                            var form = ajaxForm;

                            //批量操作 判断选项
                            if (btn.data('subcheck')) {
                                btn.parent().find('span').remove();
                                if (form.find('input.J_check:checked').length) {
                                    var msg = btn.data('msg');
                                    if (msg) {
                                        art.dialog({
                                            id: 'warning',
                                            icon: 'warning',
                                            content: btn.data('msg'),
                                            cancelVal: '关闭',
                                            cancel: function () {
                                                btn.data('subcheck', false);
                                                btn.click();
                                            }
                                        });
                                    } else {
                                        btn.data('subcheck', false);
                                        btn.click();
                                    }

                                } else {
                                    resultTip({error:1,msg:'请至少选择一项'});
                                   // $('<span class="tips_error">请至少选择一项</span>').appendTo(btn.parent()).fadeIn('fast');
                                }
                                return false;
                            }

                            form.ajaxSubmit({
                                url: btn.data('action') ? btn.data('action') : form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
                                dataType: 'json',
                                beforeSubmit: function (arr, $form, options) {
                                    var text = btn.text();

                                    // 按钮文案、状态修改
                                    btn.text(text + '中...').prop('disabled', true).addClass('disabled');
                                    layer.load();
                                },
                                success: function (data, statusText, xhr, $form) {
                                    var text = btn.text();
                                    console.log(data);
                                    //按钮文案、状态修改
                                    btn.removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();

                                    if (data.code) {
                                        layer.msg(data.msg,{time:500,shift:0},function(){
                                            if(data.url){
                                                window.location.href = data.url;
                                            } 
                                        });
                                    } else {
                                        layer.msg(data.msg);
                                    }
                                    btn.prop('disabled',false);
                                    layer.closeAll('loading');
                                }
                            });
                        });
                    }
                });
            }
        }
    };

}


/**
 * reloadPage       [重新刷新页面，使用location.reload()有可能导致重新提交]
 */
function reloadPage(win)
{
    var location = win.location;
    location.href = location.pathname + location.search;
}

/**
 * getWindowSize          [getWindexSize Fun]
 * 取值方法
 * 取得宽：getWindowSize().x;
 * 取得高：getWindowSize().y;
 * @return     int
 */
function getWindowSize()
{
    var client = {x:0,y:0};
    if(typeof document.compatMode != 'undefined' && document.compatMode == 'CSS1Compat') {
        client.x = document.documentElement.clientWidth;
        client.y = document.documentElement.clientHeight;
    } else if(typeof document.body != 'undefined' && (document.body.scrollLeft || document.body.scrollTop)) {
        client.x = document.body.clientWidth;
        client.y = document.body.clientHeight;
    }
    return client;
}

/**
 * getQueryString           [取得 url 参数]
 *
 * @param   string  name    参数变量
 * @return  string 
 */
function getQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

/**
 * genTimestamp     [取得时间函数]
 * @return     int  [时间截]
 */
function genTimestamp()
{
    var time = new Date();
    return time.getTime();
}
/**
 * getCookie   [取得Cookie值]
 * @param      string  name    The name
 * @return     string  Cookie.
 */
function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg)){
        return unescape(arr[2]);
    }else{
        return null;
    }
}