/**
 * 显示div
 * @param divId 需要弹出的元素ID
 * 第一个参数可以为配置对象
 *   showDiv({
 *          selector:'弹出div',
 *          afterShow:function(){},
 *          afterClose:function(){},
 *          layerName:'xxx'
 *      });
 *
 * @param callback 关闭时回调函数(afterClose)
 * @param layerName 对象名称 关闭时需要用此名称,默认与divId相同
 */
function showDiv(divId, callback, layerName) {

    callback = callback ? callback : function () {
    };
    //width=width?width:550;
    layerName = layerName ? layerName : divId;
    //alert(layerName);

    var afterShow = function(){};

    if(typeof(divId) == 'object'){
        var config = divId;
        if('selector' in config){
            divId = config.selector;
        }

        if('afterShow' in config){
            afterShow = config.afterShow;
        }

        if('afterClose' in config){
            callback = config.afterClose;
        }

        if('layerName' in config){
            layerName = config.layerName;
        }

    }

    //支持多次弹出
    if (showDiv.counter) {
        showDiv.counter += 2;
    } else {
        showDiv.counter = showDiv.counter ? showDiv.counter : 999;
    }

    //alert(showDiv.counter);
    var obj = new Pop({
        oPop: divId,
        afterClose: callback,
        zIndexCover: showDiv.counter,
        zIndex: showDiv.counter + 1,
        success: function () {

            //右上角关闭按扭
            var closeBtn = $("#" + divId + " .showDivClose");
            if (closeBtn.length == 0) {
                closeBtn = $("<div class='close showDivClose'></div>");
                $("#" + divId).prepend(closeBtn);
                closeBtn.click(function () {
                    obj.close();
                });
            }

            $("#" + divId).css("border-radius", "5px");

            closeBtn.css("zIndex", showDiv.counter + 1 + 1);
            afterShow();
        }
    });

    obj.open();
    if (!window.showDivObjects) {
        window.showDivObjects = [];
    }
    window.showDivObjects[layerName] = obj;

    //点击遮盖层可关闭
    $("#popMask_" + divId).click(function () {
        $("#" + divId + " .showDivClose").trigger("click");
    });

}
/**
 * 关闭由showDiv()函数弹出的层
 * @param layerName
 */
function closeDiv(layerName, callback) {
    /*
     layerName=layerName?layerName:"showDiv";
     $.closePopupLayer(layerName);
     */

    callback = callback ? callback : function () {
    };


    if (window.showDivObjects[layerName]) {
        window.showDivObjects[layerName].close();
    }
    callback();
}

/**
 * ajax弹出显示url
 * @param url
 * @param width
 */
function ajaxShow(url) {
    var LayerId = "ajaxPopupLayer";
    if ($("#" + LayerId).length == 0) {
        var div = $("<div id='" + LayerId + "' style='display:none;'></div>");
        div.appendTo($("body"));
    }
    var div = $("#" + LayerId);

    $.get(url, function (str) {

        div.html(str);
        showDiv(LayerId);

    });

}
function closeAjaxWindow() {
    var LayerId = "ajaxPopupLayer";
    closeDiv(LayerId);
}


/*

 弹出DIV

 *var f = new Pop({ oPop: "准备弹出的id", zIndex: 1001, mode: ["center", "center"], idOpen: "点击哪个id时触发", idClose: ["关闭按扭的ID", "close_f_1"], cover: true, beCover: false, zIndexCover: 1000, colorCover: "#000000", opactiyCover: 0.6 });
 * 可以指定点击某个元素来弹出div，
 * 也可以用下面的方法调用
 * f.open();
 * f.close();
 * 实例化时，支持传入回调函数:
 * var obj = new Pop({
 oPop: divId ,
 afterClose:function(){},
 success:function(){}
 });
 */
var Pop = function (options) {
    this.isIE = (document.all) ? true : false;
    this.isIE6 = this.isIE && (navigator.userAgent.indexOf('MSIE 6.0') != -1);
    this.isIE6 ? this.position = "absolute" : this.position = "fixed";
    this.SetOptions(options);
    this.mode = this.options.mode;
    this.zIndex = this.options.zIndex;
    this.left = this.options.left;
    this.right = this.options.right;
    this.top = this.options.top;
    this.bottom = this.options.bottom;
    this.oPop = $("#" + this.options.oPop);
    this.oPop.css({position: this.position, "z-index": this.zIndex});

    this.popMaskId = "popMask_" + this.options.oPop;


    //页面载入时是否显示遮盖层
    if (this.options.beCover) {
        this.Start();
        this.Initialization();
        this.FullScreen(this.heightDocument, this.widthDocument);
    }

    //是否添加浮动层收缩
    if (!!this.options.idShrink) this.Shrink(this.options.idShrink);

    /*关闭、打开浮动层*/
    if (this.options.idClose.length != 0) this.Close(this.options.idClose);
    !!this.options.idOpen ? this.Open(this.options.idOpen) : this.Start();

};

Pop.prototype = {
    SetOptions: function (options) {
        this.options = {
            /*浮动框相关属性*/
            oPop: "idPop",            //浮动框id
            zIndex: "999",            //浮动框的z-index
            left: 0,                  //距离左边多少像素
            right: 0,                 //距离右边多少像素
            top: 0,                   //距离顶部多少像素
            bottom: 0,                //距离底部多少像素
            // mode: ["left", "top"],    //浮动层默认定位左上
            mode: ["center", "center"],    //浮动层默认定位居中

            /*遮罩层相关属性*/
            beCover: false,           //页面载入时是否显示遮盖层
            cover: true,             //是否显示遮盖层(遮盖层显示的必须条件)
            zIndexCover: 998,         //遮盖层的z-index
            colorCover: "#000",       //遮盖层的背景颜色
            opactiyCover: 0.70,        //遮盖层的透明度

            /*浮动框收缩相关属性*/
            idShrink: null,           //收缩按钮id
            minHeight: 0,            //收缩后的高度
            maxHeight: 0,       //展开后的高度
            classOne: null,           //切换用的class
            classTwo: null,           //切换用的class

            /*关闭、打开浮动层相关属性*/
            idOpen: null,             //打开按钮
            idClose: [],               //关闭按钮


            //zouyiliang
            afterClose: function () {
            },	//关闭时的回调函数
            success: function () {
            }		//弹出成功后的回调函数


        };
        $.extend(this.options, options || {});
    },
    Initialization: function () {
        this.widthPop = this.oPop.width();
        this.heightPop = this.oPop.height();
        this.heightDocument = $(document).height();
        this.widthDocument = Math.min($(document).width(), $("body").width()); //避免ie6下加上滚动条的宽度
        this.heightWindow = $(window).height();
        this.widthWindow = $(window).width();
        this.topScroll = $(window).scrollTop();
        this.leftScroll = $(window).scrollLeft();
    },
    Start: function () {
        switch (this.mode[0].toLowerCase()) {
            case "left":
                this.LeftRightLocation();
                break;
            case "right":
                this.LeftRightLocation();
                break;
            default:
                this.CenterLocation();
        }
    },
    //mark等于false为水平垂直居中定位
    GetValue: function (mark) {
        if (this.oPop.css("display") == "none") return; //浮动层显示时才动态计算其坐标(解决一个效率问题)
        var level = this.mode[0].toLowerCase(), vertical = this.mode[1].toLowerCase();
        this.Initialization();
        if (mark) {
            if (!this.isIE6) {
                level == "left" ? this.oPop.css({left: this.left}) : this.oPop.css({right: this.right});
                vertical == "top" ? this.oPop.css({top: this.top}) : this.oPop.css({bottom: this.bottom});
            } else {
                var x_final = level == "left" ? this.leftScroll + this.left : this.widthWindow + this.leftScroll - this.widthPop - this.right;
                var y_final = vertical == "top" ? this.topScroll + this.top : this.heightWindow + this.topScroll - this.heightPop - this.bottom;
                this.oPop.css({top: y_final, left: x_final});
            }
        } else {
            if (!this.isIE6) {
                var x_final = parseInt((this.widthWindow - this.widthPop) / 2);
                var y_final = parseInt((this.heightWindow - this.heightPop) / 2);
            } else {
                var x_final = (this.widthWindow - this.widthPop) / 2 + this.leftScroll;
                var y_final = (this.heightWindow - this.heightPop) / 2 + this.topScroll;
            }
            this.oPop.css({top: y_final, left: x_final});
        }

        //IE6在浮动层中添加iframe
        if (this.isIE6) {
            this.AddIframe(this.oPop, this.heightPop, this.widthPop);
        }
    },
    LeftRightLocation: function () {
        this.GetValue(true);
        var _this = this;
        $(window).bind("scroll." + this.options.oPop, function () {
            _this.GetValue(true);
        }).bind("resize." + this.options.oPop, function () {
            _this.GetValue(true);
        })
    },
    CenterLocation: function () {
        this.GetValue(false);
        var _this = this;
        $(window).bind("scroll." + this.options.oPop, function () {
            _this.GetValue(false);
        }).bind("resize." + this.options.oPop, function () {
            _this.GetValue(false);
            if (_this.oPop.css("display") != "none") _this.FullScreen(_this.heightDocument, _this.widthDocument);
        });
    },

    FullScreen: function (oHeight, oWidth) {
        if (!this.options.cover) return;

        //遮盖层参数
        this.zIndexCover = this.options.zIndexCover;
        this.colorCover = this.options.colorCover;
        this.opactiyCover = this.options.opactiyCover;


        if ($("#" + this.popMaskId).length == 0) $("body").append("<div id=\"" + this.popMaskId + "\"></div>");

        //ie6遮罩层定位absolute,非ie6遮罩层定位fixed
        if (this.isIE6) {
            $("#" + this.popMaskId).css({
                position: "absolute",
                "z-index": this.zIndexCover,
                top: 0,
                left: 0,
                height: oHeight,
                width: oWidth,
                opacity: this.opactiyCover,
                background: this.colorCover
            });
            //IE6在浮动层中添加iframe
            this.AddIframe($("#" + this.popMaskId), oHeight, oWidth);
        } else {
            $("#" + this.popMaskId).css({
                position: "fixed",
                "z-index": this.zIndexCover,
                top: 0,
                left: 0,
                height: "100%",
                width: "100%",
                opacity: this.opactiyCover,
                background: this.colorCover
            });
        }
    },


    //IE6覆盖select控件
    AddIframe: function (iElement, iHeight, iWidth) {
        iElement.append("<iframe></iframe>");
        var oIframe = iElement.children("iframe");
        oIframe.css({
            position: "absolute",
            top: 0,
            left: 0,
            opacity: 0,
            "z-index": -1,
            height: iHeight,
            width: iWidth,
            border: 0
        });
    },
    //浮动层收缩
    Shrink: function (iShrink) {
        this.minHeight = this.options.minHeight;
        this.maxHeight = this.options.maxHeight;
        this.classOne = this.options.classOne;
        this.classTwo = this.options.classTwo;
        var _this = this;
        $("#" + iShrink).toggle(
            function () {
                _this.oPop.height(_this.minHeight);
                $(this).removeClass();
                $(this).addClass(_this.classOne);
                if (_this.isIE6) _this.GetValue(true);
            },
            function () {
                _this.oPop.height(_this.maxHeight);
                $(this).removeClass();
                $(this).addClass(_this.classTwo);
                if (_this.isIE6) _this.GetValue(true);
            }
        );
    },
    Close: function (iClose) {
        var _this = this;
        $.each(iClose, function (index, name) {
            $("#" + name).click(function () {

                _this.close();
                /*
                 _this.oPop.css({ display: "none" });
                 if(!!$("#"+_this.popMaskId)[0]) { $("#"+_this.popMaskId).remove(); }
                 $(window).unbind("scroll."+_this.options.oPop);
                 $(window).unbind("resize."+_this.options.oPop);
                 */

            })
        });
    },
    Open: function (iOpen) {
        var _this = this;
        var oOpen = $("#" + iOpen);
        oOpen.click(function () {
            _this.open();
            /*
             _this.oPop.css({ display: "block" });

             _this.Start();

             //遮罩层初始化
             _this.FullScreen(_this.heightDocument, _this.widthDocument);
             */

        });
    },


    //显示 zouyiliang
    open: function () {
        var _this = this;
        _this.oPop.css({display: "block"});
        _this.Start();
        //遮罩层初始化
        _this.FullScreen(_this.heightDocument, _this.widthDocument);


        //成功回调函数
        _this.options.success();

        //修复垂直居中 zouyiliang 如果图片较大，需要等图片加载完后，修正居中
        setInterval(function () {
            _this.GetValue(false);
        }, 50);

    },

    //关闭 zouyiliang
    close: function () {
        var _this = this;
        _this.oPop.css({display: "none"});
        if (!!$("#" + _this.popMaskId)[0]) {
            $("#" + _this.popMaskId).remove();
        }
        $(window).unbind("scroll." + _this.options.oPop);
        $(window).unbind("resize." + _this.options.oPop);

        _this.options.afterClose();
    }

};