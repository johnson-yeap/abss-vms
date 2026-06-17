function toshowshareqrcode(url){
	$('.qrcode_imgbox').show();
	$('.qrcode_imgshow').html('<img style="float:left;width:20px;height:20px;margin-left:42px;margin-top:30px;margin-bottom:30px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/>');
	$.post(baseurl+'welcome/toshowshareqrcode', {url: url}, function (data){
		$('.qrcode_imgshow').html('<img style="float:left;width:100%;height:100%;" src="'+baseurl+data+'"/>');
	})
}
function clickimg(num){
	$('.clickimg_'+num).click();
}
function clicktopreview(num){
	$('.newspreviewimg').hide();
	$('.newspreviewimg_'+num).show();

	$('.newspreviewname').hide();
	$('.newspreviewname_'+num).show();

	$('.picturelist').find('.fixedbox').removeClass('box_on');
	$('.picturelist').find('.clickcentbox').removeClass('box_on');
	$('a[onclick="clicktopreview('+num+')"]').find('.fixedbox').addClass('box_on');
	$('a[onclick="clicktopreview('+num+')"]').find('.clickcentbox').addClass('box_on');
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

function autotestwidth_page(){
	allbody_width = document.body.clientWidth;
	allbody_height = document.body.clientHeight;
	if(allbody_width >= 1395){
		var addwidth = (allbody_width - 1340) / 2;
		$('.coverpicture, .coverpicture_name').css({'width': 'calc(100% + 1px + '+addwidth+'px)', 'margin-left': '-'+addwidth+'px'});
		$('.newsgalleryarea').css({'width': 'calc(100% + 1px + '+addwidth+'px)', 'margin-left': '-'+addwidth+'px'});
	}else{
		var addwidth = allbody_width * 0.04;

		$('.coverpicture, .coverpicture_name').css({'width': 'calc(100% + 1px + '+addwidth+'px)', 'margin-left': '-'+addwidth+'px'});
		$('.newsgalleryarea').css({'width': 'calc(100% + 1px + '+addwidth+'px)', 'margin-left': '-'+addwidth+'px'});
	}
}


$(document).ready(function (){
//	$('.news_content').find('.rightarea').find('img').each(function(){
//        if($(this).parent().prop('nodeName') == 'SPAN' && $(this).parent().parent().prop('nodeName') == 'SPAN' && $(this).parent().parent().parent().prop('nodeName') == 'P'){
//        	if($(this).parent().parent().parent().next().css('text-align') == 'center' || $(this).parent().parent().parent().next().attr('align') == 'center'){
//            	$(this).parent().parent().parent().next().find('span').hide();
//            }
//        	if($(this).parent().parent().parent().next().next().css('text-align') == 'center' || $(this).parent().parent().parent().next().next().attr('align') == 'center'){
//            	$(this).parent().parent().parent().next().next().find('span').hide();
//            }
//
//        	if($(this).parent().parent().parent().next().next().html() == '&nbsp;'){
//            	$(this).parent().parent().parent().next().next().hide();
//            }
//        }else if($(this).parent().prop('nodeName') == 'SPAN' && $(this).parent().parent().prop('nodeName') == 'P'){
//        	if($(this).parent().parent().next().css('text-align') == 'center' || $(this).parent().parent().next().attr('align') == 'center'){
//            	$(this).parent().parent().next().find('span').hide();
//            }
//        	if($(this).parent().parent().next().next().css('text-align') == 'center' || $(this).parent().parent().next().next().attr('align') == 'center'){
//            	$(this).parent().parent().next().next().find('span').hide();
//            }
//
//        	if($(this).parent().parent().next().next().html() == '&nbsp;'){
//            	$(this).parent().parent().next().next().hide();
//            }
//        }else{
//        	if($(this).parent().next().css('text-align') == 'center' || $(this).parent().next().attr('align') == 'center'){
//            	$(this).parent().next().find('span').hide();
//            }
//        	if($(this).parent().next().next().css('text-align') == 'center' || $(this).parent().next().next().attr('align') == 'center'){
//            	$(this).parent().next().next().find('span').hide();
//            }
//            
//        	if($(this).parent().next().next().html() == '&nbsp;'){
//            	$(this).parent().next().next().hide();
//            }
//        }
//    });

//    $('.news_content').find('.rightarea').find('video').hide();
//	$('.news_content').find('.rightarea').find('img').hide();
	
	$('.news_content').find('.rightarea').removeClass('displaynone');
})
