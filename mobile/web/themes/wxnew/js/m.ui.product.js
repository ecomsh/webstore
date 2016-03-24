// var myScroll,
//     pullUpEl, pullUpOffset,
//     generatedCount = 0;

// /**
//  * 滚动翻页 （自定义实现此方法）
//  * myScroll.refresh();      // 数据加载完成后，调用界面更新方法
//  */
// function pullUpAction () {
//     console.log(1111);
//     setTimeout(function () {    // <-- Simulate network congestion, remove setTimeout from production!
//         var el, li, i;
//         el = document.getElementById('thelist');
//         for (i=0; i<3; i++) {
//             li = document.createElement('li');
//             li.innerText = '222222222222222222' + (++generatedCount);
//             el.appendChild(li, el.childNodes[0]);
//         }
        
//         myScroll.refresh();     // 数据加载完成后，调用界面更新方法 Remember to refresh when contents are loaded (ie: on ajax completion)
//     }, 1000);   // <-- Simulate network congestion, remove setTimeout from production!
// }

// /**
//  * 初始化iScroll控件
//  */
// function loaded() { 
//     pullUpEl = document.getElementById('pullUp');   
//     pullUpOffset = pullUpEl.offsetHeight;
    
//     myScroll = new iScroll('wrapper', {
//         scrollbarClass: 'myScrollbar', /* 重要样式 */
//         useTransition: false, /* 此属性不知用意，本人从true改为false */
//         topOffset: pullUpOffset,
//         onRefresh: function () {
//             if (pullUpEl.className.match('loading')) {
//                 pullUpEl.className = '';
//                 pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
//             }
//         },
//         onScrollMove: function () {
//             if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
//                 pullUpEl.className = 'flip';
//                 pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手开始更新...';
//                 this.maxScrollY = this.maxScrollY;
//             } else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
//                 pullUpEl.className = '';
//                 pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
//                 this.maxScrollY = pullUpOffset;
//             }
//         },
//         onScrollEnd: function () {
//             if (pullUpEl.className.match('flip')) {
//                 pullUpEl.className = 'loading';
//                 pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';                
//                 pullUpAction(); // Execute custom function (ajax call?)
//             }
//         }
//     });
    
//     setTimeout(function () { document.getElementById('wrapper').style.left = '0'; }, 800);
// }
var slider;
window.onload = function() {	
    changebuynum(1);        
    (function (){
        var tab = new fz.Scroll('.ui-tab', {
            role: 'tab',
            autoplay: false,                   
        });
        /* 滑动开始前 */
        tab.on('beforeScrollStart', function(fromIndex, toIndex) {
            //console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
        })
    })();

    (function (){           
        $(".show-skumapbox").click(function(){
            $(".ui-dialog").dialog("show");
        })
    })();
    
    slider = new fz.Scroll('.ui-slider', {
        role: 'slider',
        indicator: true,
        autoplay: true,
        interval: 3000
    });

    slider.on('beforeScrollStart', function(fromIndex, toIndex) {
        //console.log(fromIndex,toIndex)
    });

    slider.on('scrollEnd', function(cruPage) {
        //console.log(cruPage)
    }); 
}
	
