function offsetLoc(dom){
	var arr = [dom.getBoundingClientRect().left, dom.getBoundingClientRect().top];
	return arr;
}
function lazyLoad(){
    var l = document.getElementsByClassName ? [].slice.call(document.querySelectorAll("img[data-img]")) : new Function('var a = document.getElementsByTagName("img"), b = []; for (var i=0,I=a.length; i<I; i++){ if (!!a[i].getAttribute("data-img")) b.push(a[i]);} return b;')();
    function loadImg(a){
        var t = document.createElement("img");
        t.onload = function(){
            var w = t.width, h = t.height, m, n, cw = parseInt(a.getAttribute("data-confWidth"), 10), ch = parseInt(a.getAttribute("data-confHeight"), 10), rw = parseInt(a.getAttribute("data-restrictWidth"), 10), rh = parseInt(a.getAttribute("data-restrictHeight"), 10);
            if (cw > 0 && ch > 0){
                if (w/cw > h/ch){
                    n = ch;
                    m = w*ch/h;
                }else {
                    m = cw;
                    n = h*cw/w;
                }
                var ll = (cw - m) / 2, tt = (ch - n) / 2;
                a.style.top = tt+"px";
                a.style.left = ll+"px";
                a.style.width = m+"px";
                a.style.height = n+"px";
                a.removeAttribute("data-confWidth", true);
                a.removeAttribute("data-confHeight", true);
            }else if (rw > 0){
                a.style.width = rw+"px";
                a.removeAttribute("data-restrictWidth", true);
                if(rh > 0 ){
                    a.style.height = rh+"px";
                    a.removeAttribute("data-restrictHeight", true);
                }
            }else {
                a.style.width = w+"px";
                a.style.height = h+"px";
            }
            a.src = t.src;
        };
        t.src = a.getAttribute("data-img");
        a.removeAttribute("data-img");
    }
    function getArea(){
        var H = document.getElementsByTagName("html")[0], B = document.getElementsByTagName("body")[0], x1 = 0, y1 = 0, x2 = x1+document.documentElement.clientWidth, y2 = y1+document.documentElement.clientHeight, a = [];
        if (l.length > 0){
            for (var i=0, I=l.length; i<I; i++){
                var xy = offsetLoc(l[i]), xx1 = xy[0], xx2 = xx1+l[i].offsetWidth, yy1 = xy[1], yy2 = yy1+l[i].offsetHeight;
                if (xx2 > x1 && xx1 < x2 && yy2 > y1 && yy1 < y2) loadImg(l[i]);
            }
        }
    }
    getArea();
}

function addEvt(a, b, c){
    if (!!window.attachEvent) a.attachEvent("on"+b, c);
    else {
        a.addEventListener(b, c, false);
        if (b == "mousewheel") a.addEventListener("DOMMouseScroll", c, false);
    }
}
function rmEvt(a, b, c){
    if (window.detachEvent) a.detachEvent("on"+b, c);
    else {
        a.removeEventListener(b, c);
        if (b == "mousewheel") a.removeEventListener("DOMMouseScroll", c, false);
    }
}

addEvt(window, "scroll", function(){
    lazyLoad();
});
addEvt(window, "resize", function(){
    lazyLoad();
});
lazyLoad();