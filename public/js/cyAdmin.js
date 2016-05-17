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

    //所有的ajax form提交,由于大多业务逻辑都是一样的，故统一处理
    var ajaxForm_list = $('form.J_ajaxForm');
    if (ajaxForm_list.length) {
        Wind.use('ajaxForm', 'layer', function () {

            $('button.J_ajax_submit_btn').on('click', function (e) {
                e.preventDefault();
                var btn  = $(this),
                    form = btn.parents('form.J_ajaxForm');

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

                        if (data.status === 'success') {
                            layer.msg(data.info);
                        } else {
                            layer.msg(data.info);
                        }
                        btn.prop('disabled',false);
                        layer.closeAll('loading');
                    }
                });
            });

        });
    }

    var ajaxForm_lists = $('form.J_ajaxForms');
    if(ajaxForm_lists.length){
        Wind.use('validate', 'localization', 'ajaxForm', 'layer', function () {
            var btn = ajaxForm_lists.find('.J_ajax_submit_btn');

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
                    ajaxForm_lists.ajaxSubmit({
                        url: ajaxForm_lists.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
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
                            if(data.status === 'success'){
                                layer.msg(data.info,function(){
                                   if(data.url){
                                        window.location.href = data.url;
                                    } 
                                });
                            }else{
                                layer.msg(data.info);
                            }
                            layer.closeAll('loading');
                        }
                    });
                }
            };
            var validate = $.extend({},baseValidate,userValidate);
            
            ajaxForm_lists.validate(validate);
        });
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
        		console.log(0);
        	});
        },
        main:function(){
            
            var _body        = $('body');
            var mainWrapper  = $('.main-wrapper');

            // 本地存储数据判断[html5/cookie]
            if(storage){
                // 侧边栏状态
                if(storage.getItem('sidebarFold')){
                    _body.addClass('sidebar-fold');
                }else{
                    _body.removeClass('sidebar-fold');
                }

                // 二级边栏状态
                // if(storage.getItem('productSidebarFold')){
                //     _body.addClass('product-sidebar-fold');
                // }else{
                //     _body.removeClass('product-sidebar-fold');
                // }
            }else{
                if($.cookie(sidebarFold)){
                    mainWrapper.addClass('sidebar-fold');
                }else{
                    mainWrapper.removeClass('sidebar-fold');
                }

                // if($.cookie(productSidebarFold)){
                //     mainWrapper.addClass('product-sidebar-fold');
                // }else{
                //     mainWrapper.removeClass('product-sidebar-fold');
                // }
            }
        	
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
            _this.contentMainScroll();
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

            // 侧边栏折叠
            $('body').on('click', '.main-sidebar-toggle', function(event) {
                event.preventDefault();
                _this.fold();
            });

            _this.main();
            _this.click();
            _this.hover();

        },
        main:function(){
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

                if(!$('body').hasClass('sidebar-fold')){
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
                if($('body').hasClass('sidebar-fold')){
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
            if($('body').hasClass('sidebar-fold')){
                $('body').removeClass('sidebar-fold');

                // 本地存储数据判断[html5/cookie]
                if(storage){
                    storage.removeItem('sidebarFold');
                }else{
                    $.cookie(sidebarFold, null, { path: '/' });  //删除cookie
                }
            }else{
                $('body').addClass('sidebar-fold');

                // 本地存储数据判断[html5/cookie]
                if(storage){
                    storage.setItem('sidebarFold',1);
                }else{
                    $.cookie(sidebarFold,1, { path: '/', expires: 15 });
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
            $.Cy.layout.contentMainScroll();
        }
    };

    // ajax 提交
    $.Cy.ajax  = {
        init:function(){
            var _this  = this;
            _this.a_ajax();
        },
        maim:function(){},
        a_ajax:function(){
            // a 标签 ajax 提交，成功之后刷新页面或者跳转到新的页面
            // 使用方法：直接在 a 标签添加 a_ajax class
            // 参数：
            // data-layer-msg：显示提示信息，默认为[操作]
            // data-layer-okbtn：提交按钮文字，默认为[提交]
            // data-layer-cancelbtn：取消按钮文字，默认为[取消]
            var a_ajax  = 'cy-ajax';
            if ($('body').find('a.'+a_ajax).length) {
                Wind.use('layer', function () {
                    $('body').on('click','a.'+a_ajax, function (e) {
                        e.preventDefault();
                        var $_this   = this,
                            $_self   = $($_this),
                            $_href   = $_self.prop('href'),
                            // $_msg   = $_self.data('msg');
                            $_msg    = $_self.attr('data-layer-msg') ? $_self.attr('data-layer-msg') : '操作',
                            $_ok_btn_text      = $_self.attr('data-layer-okbtn') ? $_self.attr('data-layer-okbtn') : '提交',
                            $_cancel_btn_text  = $_self.attr('data-layer-cancelbtn') ? $_self.attr('data-layer-cancelbtn') : '取消';

                        console.log($_href);
                        layer.confirm('确定要'+$_msg+'吗？', {
                            icon: 7,
                            btn: [$_ok_btn_text,$_cancel_btn_text], //按钮
                            shadeClose:true,
                        }, function(){
                            layer.load();
                            $.getJSON($_href).done(function(data){
                                console.log(data);
                                if(data.status=='success'){
                                    layer.closeAll('loading');
                                    layer.msg(
                                        $_msg+'成功，页面正在进行页面跳转……',
                                        {
                                            icon: 1,
                                            time:1000,
                                        },
                                        function(){
                                            if(!data.url){
                                                reloadPage(window);
                                            }else{
                                                window.lacation.href  = data.url;
                                            }
                                        });
                                }else{
                                    layer.msg(data.info,{icon:2});
                                    layer.closeAll('loading');
                                }
                            });
                        }, function(index){
                            layer.close(index);
                        });
                    });
                });
            }
        },
        form_ajax:function(){}
    };

}


// 重新刷新页面，使用location.reload()有可能导致重新提交
function reloadPage(win) {
    var location = win.location;
    location.href = location.pathname + location.search;
}

/* getWindexSize Fun */
// 取值方法
// 取得宽：getWindowSize().x;
// 取得高：getWindowSize().y;
function getWindowSize() {
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

// 取得 url 参数
// name：参数变量
// 返回 string
function getQueryString(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

// 取得时间函数
// 返回：int[时间截]
function genTimestamp(){
    var time = new Date();
    return time.getTime();
}