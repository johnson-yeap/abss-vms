function clickimg(screensection, num){
	$('.clickimg_'+screensection+'_'+num).click();
}

//获取浏览器窗口的可视区域的宽度
function getViewPortWidth() {
    return document.documentElement.clientWidth || document.body.clientWidth;
}
 
//获取浏览器窗口的可视区域的高度
function getViewPortHeight() {
    return document.documentElement.clientHeight || document.body.clientHeight;
}



var allbody_width = 0;
var viewbody_height = 0;

function autotestwidth_page(){
	allbody_width = document.body.clientWidth;
	viewbody_height = getViewPortHeight();
	viewbody_height = viewbody_height - 82;

	$('.explorecampuses_content').css({'height':viewbody_height+'px'});

	$('.one_1').find('.showimg').css({'height':parseInt((viewbody_height - 160) / 3)+'px'});
	$('.one_2').find('.showimg').css({'height':parseInt((viewbody_height - 160) / 3)+'px'});
	$('.one_3').find('.showimg').css({'height':parseInt((viewbody_height - 160) / 3)+'px'});

	$('.one_6').find('.showimg').css({'height':parseInt((viewbody_height - 40 + 28) / 2)+'px'});
	$('.one_7').find('.showimg').css({'height':parseInt((viewbody_height - 40 + 28) / 2)+'px'});

	$('.threetwo_1').find('.showimg').css({'height':parseInt((viewbody_height - 40 - 40 - 40 - 30) * 0.359)+'px'});
	$('.threetwo_2').find('.showimg').css({'height':parseInt((viewbody_height - 40 - 40 - 40 - 30) * 0.284)+'px'});
	$('.threetwo_3').find('.showimg').css({'height':parseInt((viewbody_height - 40 - 40 - 40 - 30) * 0.355)+'px'});

	$('.threetwo_6').find('.showimg').css({'height':parseInt((viewbody_height - (viewbody_height*0.1873) + 60 - 20 - 30) *0.388)+'px'});
	$('.threetwo_7').find('.showimg').css({'height':parseInt((viewbody_height - (viewbody_height*0.1873) + 60 - 20 - 30) * 0.290)+'px'});
	$('.threetwo_8').find('.showimg').css({'height':parseInt((viewbody_height - (viewbody_height*0.1873) + 60 - 20 - 30) * 0.321)+'px'});
	$('.threetwo_6').css({'margin-top':parseInt(viewbody_height*0.1873)+'px'});

	$('.onethree_1').find('.showimg').css({'height':parseInt((viewbody_height - 50 - 50 - 40) * 0.333)+'px'});
	$('.onethree_2').find('.showimg').css({'height':parseInt((viewbody_height - 50 - 50 - 40) * 0.666)+'px'});
	$('.onethree_4').find('.showimg').css({'height':parseInt((viewbody_height - 170 - 110) * 1)+'px'});
	
	$('.onethree_5').find('.showimg').css({'height':parseInt((viewbody_height - 140 - (viewbody_height*0.144) - 40) * 0.542)+'px'});
	$('.onethree_6').find('.showimg').css({'height':parseInt((viewbody_height - 140 - (viewbody_height*0.144) - 40) * 0.458)+'px'});
	$('.onethree_6').css({'margin-top':parseInt(viewbody_height*0.144)+'px'});
	
	$('.onethree_7').find('.showimg').css({'height':parseInt((viewbody_height - 28 - (viewbody_height*0.288) - 30) * 0.38)+'px'});
	$('.onethree_8').find('.showimg').css({'height':parseInt((viewbody_height - 28 - (viewbody_height*0.288) - 30) * 0.62)+'px'});
	$('.onethree_8').css({'margin-top':parseInt(viewbody_height*0.288)+'px'});
}

function autoscrollfixed(){
	var topDist = $(this).scrollTop();
	console.log('距上：'+topDist);
	if(topDist < 290){
//			$('.explorecampusespopupbox').css({'position': 'absolute', 'top': 'calc(50% - 103px + 290px - '+topDist+'px)'});
		$('.explorecampusespopupbox').css({'position': 'absolute', 'top': 'calc(50% - 103px + 290px)'});
//			$('.explorecampusespopupbox').css({'position': 'absolute', 'top': '0px'});
//			$('.explorecampusespopupbox').stop().animate({'margin-top': 'calc(50% - 103px + 290px - '+topDist+'px)'}, 100);
//			console.log('calc(50% - 103px + 290px - '+topDist+'px)');
	}else if(topDist >= 290 && topDist < (290 + viewbody_height*2)){
		$('.explorecampusespopupbox').css({'position': 'fixed', 'top': 'calc(50% - 103px)', 'margin-top': '0px'});
	}else{
//			$('.explorecampusespopupbox').css({'position': 'absolute', 'top': 'calc(50% - 103px + 290px + '+(viewbody_height * 2)+'px)'});
		$('.explorecampusespopupbox').css({'position': 'absolute', 'top': 'calc(50% - 103px + 290px + '+(viewbody_height * 2)+'px)'});
	}

	if(topDist < 290){
		$('.ecnu_menu_list').addClass('ecnu_menu_list_absolute').removeClass('ecnu_menu_list_fixed');
	}else{
		$('.ecnu_menu_list').addClass('ecnu_menu_list_fixed').removeClass('ecnu_menu_list_absolute');
	}

	for(var ppp = 1; ppp <= 3; ppp++){
		for(var sss = 1; sss <= 8; sss++){
			var RETURNOBJ = getDivTopLength("showclickimg_"+ppp+"_"+sss);
			var RETURN_width = $('#showclickimg_'+ppp+'_'+sss).width();
			var RETURN_width_half = (RETURN_width / 2);
			var RETURN_height = $('#showclickimg_'+ppp+'_'+sss).height();
			var RETURN_height_half = (RETURN_height / 2);
			$('.clickimg_'+ppp+'_'+sss).css({'float': 'left', 'margin-left': (RETURNOBJ.leftLength + RETURN_width_half)+'px', 'margin-top': (RETURNOBJ.topLength + RETURN_height_half)+'px'});
// 			if(ppp == 1 && sss == 3){
// 				console.log(' 宽度：'+RETURN_width + ' 高度：'+RETURN_height + ' 距离左边：'+RETURNOBJ.leftLength + ' 距离右边+'+RETURNOBJ.rightLength + ' 距离上边+'+RETURNOBJ.topLength + ' 距离下边+'+RETURNOBJ.bottomLength);
// 			}
		}
	}
}


function getDivTopLength(obj) {
    var div = document.getElementById(obj);
    var topLength = div.getBoundingClientRect().top; //div离屏幕上边距离（长度）
    var bottomLength = div.getBoundingClientRect().bottom; //div离屏幕下边距离（长度）

    var leftLength = div.getBoundingClientRect().left; //div离屏幕左边距离（长度）
    var rightLength = div.getBoundingClientRect().right; //div离屏幕右边距离（长度）

    var RETURNOBJ = new Object();
    RETURNOBJ.topLength = topLength;
    RETURNOBJ.bottomLength = bottomLength;
    RETURNOBJ.leftLength = leftLength;
    RETURNOBJ.rightLength = rightLength;
  	return RETURNOBJ;
}

var initPhotoSwipeFromDOM = function(gallerySelector) {
    // 解析来自DOM元素幻灯片数据（URL，标题，大小...）
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item,
            divEl;
        console.log('numNodes: '+numNodes);
        console.log('thumbElements: '+thumbElements);

        for(var i = 0; i < numNodes; i++) {
            figureEl = thumbElements[i]; // <figure> element
			console.log('figureEl: '+figureEl);
        }
        
        for(var i = 0; i < numNodes; i++) {
            figureEl = thumbElements[i]; // <figure> element
            // 仅包括元素节点
            console.log('figureEl.nodeType: '+figureEl.nodeType);
            if(figureEl.nodeType !== 1) {
                continue;
            }
            divEl = figureEl.children[0];
            linkEl = divEl.children[0]; // <a> element
            size = linkEl.getAttribute('data-size').split('x');
            // 创建幻灯片对象
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };
            if(figureEl.children.length > 1) {
                item.title = figureEl.children[1].innerHTML;
            }
            if(linkEl.children.length > 0) {
                // <img> 缩略图节点, 检索缩略图网址
                item.msrc = linkEl.children[0].getAttribute('src');
            }
            item.el = figureEl; // 保存链接元素 for getThumbBoundsFn
            items.push(item);
        }
        console.log('items: '+items);
        return items;
    };

    // 查找最近的父节点
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // 当用户点击缩略图触发
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
        var eTarget = e.target || e.srcElement;
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });
        if(!clickedListItem) {
            return;
        }
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        console.log('numChildNodes: '+numChildNodes);
        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) {
                continue;
            }
            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }
        console.log('nodeIndex: '+nodeIndex);
        console.log('index: '+index);
        if(index >= 0) {
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
            params = {};
        if(hash.length < 5) {
            return params;
        }
        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if(pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }
        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }
        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;
        items = parseThumbnailElements(galleryElement);
        // 这里可以定义参数
        options = {
            barsSize: {
                top: 100,
                bottom: 100
            },
            fullscreenEl : false,
            shareButtons: [
                {id:'wechat', label:'分享微信', url:'#'},
                {id:'weibo', label:'新浪微博', url:'#'},
                {id:'download', label:'保存图片', url:'{{raw_image_url}}', download:true}
            ],
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),
            getThumbBoundsFn: function(index) {
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();
                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }
        };
        if(fromURL) {
            if(options.galleryPIDs) {
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }
        if( isNaN(options.index) ) {
            return;
        }
        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    var galleryElements = document.querySelectorAll( gallerySelector );
    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};




$(document).ready(function (){
	$(window).scroll(function(){
		autoscrollfixed();
	});
	autoscrollfixed();
	autoscrollfixed();
	
	$(window).resize(function() {
		autotestwidth_page();
	})
	autotestwidth_page();
	autotestwidth_page();
	
	var isprocessdoing = 0;//是否正在进行中
    var scrollFunc = function(e) {
         var e = e || window.event;
         if(e.wheelDelta) {
               if(e.wheelDelta > 0) {     //当鼠标滚轮向上滚动时
                    var topDist = $(this).scrollTop();
                    console.log("鼠标滚轮向上滚动1："+topDist+'px');
                    
//                     if(topDist >= (290 - 64) && topDist <= (viewbody_height + 290 - 64 - 50)){
                    if(topDist >= (viewbody_height + 290 - 64 - 200) && topDist <= (viewbody_height + 290 - 10)){
                    	console.log('当前在第1个模块');
                    	history.pushState(null, null, baseurl+'about/explorecampuses/nanshan');
                 		if(isprocessdoing == 0){
                 			isprocessdoing = 1;//正在进行中
                 			$("body, html").stop().animate({
             					scrollTop: (290 - 0)
             				}, 500, function (){
             					isprocessdoing = 0;//完成
                 			});
                 			$('.popupinnercontent').stop().animate({'margin-top': '0px'});
                     	}
//              		}else if(topDist >= (viewbody_height + 290 - 64) && topDist <= (viewbody_height*2 + 290 - 64 - 50)){
             		}else if(topDist >= (viewbody_height*2 + 290 - 64 - 200) && topDist <= (viewbody_height*2 + 290 - 10)){
             			console.log('当前在第2个模块');
             			history.pushState(null, null, baseurl+'about/explorecampuses/xiangshan');
             			if(isprocessdoing == 0){
                 			isprocessdoing = 1;//正在进行中
                 			$("body, html").stop().animate({
             					scrollTop: (290 + viewbody_height - 0)
                 			}, 500, function (){
             					isprocessdoing = 0;//完成
                 			});
                 			$('.popupinnercontent').stop().animate({'margin-top': '-206px'});
             			}
             		}else if(topDist >= (viewbody_height*2 + 290 - 10)){
             			console.log('当前在第3个模块');
             			history.pushState(null, null, baseurl+'about/explorecampuses/liangzhu');
             		}else{
						console.log('向上滚不操作');
						if(topDist <= (viewbody_height + 290 - 64 - 200)){
							history.pushState(null, null, baseurl+'about/explorecampuses');
						}
                 	}
               }
               if(e.wheelDelta < 0) {     //当鼠标滚轮向下滚动时
            	   var topDist = $(this).scrollTop();
                    console.log("鼠标滚轮向下滚动1："+topDist+'px');
                    
//                     if(topDist > (290 + 50) && topDist < (viewbody_height + 290 - 64)){
                    if(topDist > (290 - 200) && topDist < (290 + 10)){
                    	console.log('当前在第1个模块');
                    	history.pushState(null, null, baseurl+'about/explorecampuses/nanshan');
              		}else if(topDist > (290 + 10) && topDist < (290 + 64 + 200)){
                    	console.log('当前在第2个模块');
                    	history.pushState(null, null, baseurl+'about/explorecampuses/xiangshan');
                  		if(isprocessdoing == 0){
                  			isprocessdoing = 1;//正在进行中
                  			var jutop_2 = $('#screen_2').offset().top;
                 			$("body, html").stop().animate({
             					scrollTop: (290 + viewbody_height - 0)
                 			}, 500, function (){
             					isprocessdoing = 0;//完成
                 			});
                 			$('.popupinnercontent').stop().animate({'margin-top': '-206px'});
                      	}
//               		}else if(topDist > (viewbody_height + 290 + 50) && topDist < (viewbody_height*2 + 290)){
              		}else if(topDist > (viewbody_height + 290 + 10) && topDist < (viewbody_height + 290 + 64 + 200)){
              			console.log('当前在第3个模块');
              			history.pushState(null, null, baseurl+'about/explorecampuses/liangzhu');
              			if(isprocessdoing == 0){
                  			isprocessdoing = 1;//正在进行中
                  			var jutop_3 = $('#screen_3').offset().top;
                 			$("body, html").stop().animate({
             					scrollTop: (290 + viewbody_height*2 - 0)
                 			}, 500, function (){
             					isprocessdoing = 0;//完成
                 			});
                 			$('.popupinnercontent').stop().animate({'margin-top': '-412px'});
              			}
              		}else{
              			console.log('向下滚不操作');
              			if(topDist <= (viewbody_height + 290 - 64 - 200)){
							history.pushState(null, null, baseurl+'about/explorecampuses');
						}
                  	}
               }
         } else if(e.detail) {
               if(e.detail < 0) {   //当鼠标滚轮向上滚动时
            	   var topDist = $(this).scrollTop();
                   console.log("鼠标滚轮向上滚动2："+topDist+'px');

                   if(topDist >= (290 - 64) && topDist <= (viewbody_height + 290 - 64 - 50)){
                   		if(isprocessdoing == 0){
                   			isprocessdoing = 1;//正在进行中
                   			$("body, html").stop().animate({
               					scrollTop: (290 - 64)
                   			}, 500, function (){
               					isprocessdoing = 0;//完成
                   			});
               				$('.popupinnercontent').animate({'margin-top': '0px'});
                       	}
               		}else if(topDist >= (viewbody_height + 290 - 64) && topDist <= (viewbody_height*2 + 290 - 64 - 50)){
               			if(isprocessdoing == 0){
                   			isprocessdoing = 1;//正在进行中
                   			$("body, html").stop().animate({
               					scrollTop: (290 + viewbody_height - 64)
                   			}, 500, function (){
               					isprocessdoing = 0;//完成
                   			});
                   			$('.popupinnercontent').animate({'margin-top': '-206px'});
               			}
               		}
               }
               if(e.detail > 0) {   //当鼠标滚轮向下滚动时
            	   var topDist = $(this).scrollTop();
            	   console.log("鼠标滚轮向下滚动2："+topDist+'px');
                   
                   if(topDist > (290 + 50) && topDist < (viewbody_height + 290 - 64)){
                  		if(isprocessdoing == 0){
                  			isprocessdoing = 1;//正在进行中
                  			var jutop_2 = $('#screen_2').offset().top;
                 			$("body, html").stop().animate({
             					scrollTop: (jutop_2 - 64)
                 			}, 500, function (){
             					isprocessdoing = 0;//完成
                 			});
                  			$('.popupinnercontent').animate({'margin-top': '-206px'});
                      	}
              		}else if(topDist > (viewbody_height + 290 + 50) && topDist < (viewbody_height*2 + 290)){
              			if(isprocessdoing == 0){
                  			isprocessdoing = 1;//正在进行中
                  			var jutop_3 = $('#screen_3').offset().top;
                 			$("body, html").stop().animate({
             					scrollTop: (jutop_3 - 64)
                 			}, 500, function (){
             					isprocessdoing = 0;//完成
                 			});
                  			$('.popupinnercontent').animate({'margin-top': '-412px'});
              			}
              		}
               }
         }
    }
    //给页面绑定鼠标滚轮事件,针对火狐的非标准事件 
    window.addEventListener("DOMMouseScroll", scrollFunc)
    //给页面绑定鼠标滚轮事件，针对Google，mousewheel非标准事件已被弃用，请使用 wheel事件代替
    window.addEventListener("wheel", scrollFunc)
    //ie不支持wheel事件，若一定要兼容，可使用mousewheel
    window.addEventListener("mousewheel", scrollFunc)
    


    
    if(short_url != ''){
		if(short_url == 'nanshan'){
			console.log('当前在第1个模块');
			isprocessdoing = 1;//正在进行中
 			$("body, html").stop().animate({
					scrollTop: (290 - 0)
				}, 500, function (){
					isprocessdoing = 0;//完成
 			});
 			$('.popupinnercontent').stop().animate({'margin-top': '0px'});
 			
		}else if(short_url == 'xiangshan'){
			console.log('当前在第2个模块');
  			isprocessdoing = 1;//正在进行中
  			var jutop_2 = $('#screen_2').offset().top;
 			$("body, html").stop().animate({
				scrollTop: (290 + viewbody_height - 0)
 			}, 500, function (){
				isprocessdoing = 0;//完成
 			});
 			$('.popupinnercontent').stop().animate({'margin-top': '-206px'});
		}else if(short_url == 'liangzhu'){
			console.log('当前在第2个模块');
  			isprocessdoing = 1;//正在进行中
  			var jutop_2 = $('#screen_2').offset().top;
 			$("body, html").stop().animate({
				scrollTop: (290 + viewbody_height - 0)
 			}, 500, function (){
				isprocessdoing = 0;//完成
 			});
 			$('.popupinnercontent').stop().animate({'margin-top': '-206px'}, function (){
 				console.log('当前在第3个模块');
      			isprocessdoing = 1;//正在进行中
      			var jutop_3 = $('#screen_3').offset().top;
     			$("body, html").stop().animate({
 					scrollTop: (290 + viewbody_height*2 - 0)
     			}, 500, function (){
 					isprocessdoing = 0;//完成
     			});
     			$('.popupinnercontent').stop().animate({'margin-top': '-412px'});
 	 		});
		}
    }
    
    
    initPhotoSwipeFromDOM('.my-gallery_1');
    initPhotoSwipeFromDOM('.my-gallery_2');
    initPhotoSwipeFromDOM('.my-gallery_3');
})

