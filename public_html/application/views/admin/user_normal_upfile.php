<script src="<?php echo base_url()?>themes/default/js/uploadifive-v1.2.2-standard/Sample/jquery.uploadifive.min_new.js?date=<?php echo CACHE_USETIME()?>" type="text/javascript"></script>
<script src="<?php echo base_url()?>themes/default/js/uploadifive-v1.2.2-standard/Sample/jquery.uploadifive.min_camera.js?date=<?php echo CACHE_USETIME()?>" type="text/javascript"></script>
<?php if(checkagent() == 'iphone'){?>
<script src="<?php echo base_url()?>themes/default/js/uploadifive-v1.2.2-standard/Sample/jquery.uploadifive.min_video_iphone.js?date=<?php echo CACHE_USETIME()?>" type="text/javascript"></script>
<?php }else{?>
<script src="<?php echo base_url()?>themes/default/js/uploadifive-v1.2.2-standard/Sample/jquery.uploadifive.min_video_android.js?date=<?php echo CACHE_USETIME()?>" type="text/javascript"></script>
<?php }?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/js/uploadifive-v1.2.2-standard/Sample/uploadifive_new.css">
<style type="text/css">
.uploadifive-button {
	float: left;
	margin-right: 10px;
}
/*
#queue {
	float:left;
	width:calc(100% - 6px - 2px);
	border: 1px solid #E5E5E5;
	overflow: auto;
	margin-bottom: 10px;
	padding: 0 3px 3px;
}
*/
#queue {
	float:left;
}
.uploadifive-queue-item{
	float:left;
	width:190px;
	height:190px;
	margin-top: 10px;
    margin-right: 8px;
	background-color: #F5F5F5;
    border-bottom: 1px dotted #D5D5D5;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    font: 12px Arial, Helvetica, Sans-serif;
    padding: 5px;
	text-align:center;
}
.uploadifive-queue-item .close {
    display: none;
}
.uploadifive-queue-item .filename {
    display: none;
}
.uploadifive-queue-item .progress {
    float:left;
}
.uploadifive-queue-item .fileinfo {
    float:left;width:100%;margin-top:80px;
}
</style>
<style>
    #normalpicturelist_tbody{float:left;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;}
    #normalpicturelist_tbody .list{position:relative;float:left;width:<?php echo $upload_show_width;?>px;height:<?php echo $upload_show_height;?>px;margin-top:10px;margin-right:8px;}
    #normalpicturelist_tbody .list .btndelete{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
    #normalpicturelist_tbody .list .btndelete2{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
	#normalpicturelist_tbody .list:hover .btndelete{display:block;}
    #normalpicturelist_tbody .list:hover .btndelete2{display:block;}
    
    #normalpicturelist_tbody .list .btnxuanzhuan{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
    #normalpicturelist_tbody .list .btnxuanzhuan2{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
    #normalpicturelist_tbody .list:hover .btnxuanzhuan{display:block;}
    #normalpicturelist_tbody .list:hover .btnxuanzhuan2{display:block;}
    .draggable-placeholder{float:left;width:<?php echo $upload_show_width;?>px;height:<?php echo $upload_show_height;?>px;margin-top:15px;margin-right:15px;}

    ::-webkit-input-placeholder {
      color: #999;
      font-size: 10px;
    }
    ::-moz-placeholder {
      color: #999;
      font-size: 10px;
    }
    :-ms-input-placeholder {
      color: #999;
      font-size: 10px;
    }
</style>

<script>
   function toreloadfunctions_hetong(){
	   (function($) {
	  		$(document).ready(function(){
			   $(".btndelete").click(function(){
        	     	$(this).parent().remove();
        	     	if(typeof(tocheckvideo_num) == "function"){
        				//alert("存在的函数"); 
        	     		tocheckvideo_num();//检查video的数量
        			}else{ 
        				//alert("不存在的函数"); 
        			}
        	   });
			   $(".btndelete2").click(function(){
          	     	var filename = $(this).parent().find('input[name="linshi_picpath[]"]').val();
          	     	$.post(baseurl+'welcome/deletelinshifile', {filename:filename}, function (){
          	     		
              	    })
                    $(this).parent().remove();
          	     	if(typeof(tocheckvideo_num) == "function"){
        				//alert("存在的函数"); 
        	     		tocheckvideo_num();//检查video的数量
        			}else{ 
        				//alert("不存在的函数"); 
        			}
              	});

               $(".btnxuanzhuan").click(function(){
            	   var filename = $(this).parent().find('input[name="linshi_picpath[]"]').val();
            	   var thissmallitem = $(this).parent();

            	   thissmallitem.find('input[name="linshi_picpath[]"]').next().hide();
            	   thissmallitem.find(".btnloading").show();
            	   $.post(baseurl+'welcome/xuanzhuanpicture', {filename:filename}, function (){
            		    var date_now = new Date();
          				var time_now = date_now.getTime();

            			var filename_arr = filename.split('.');
              		   var file_type = filename_arr[filename_arr.length - 1];
              		   var filename_200x200 = filename.replace('.'+file_type, '_200x200.'+file_type);
                		 thissmallitem.find('input[name="linshi_picpath[]"]').next().attr('src', baseurl + filename_200x200+'?datetime='+time_now);


                		 setTimeout(function() {
                			 
                    		 thissmallitem.find('input[name="linshi_picpath[]"]').next().show();
                    		 thissmallitem.find(".btnloading").hide();
                     	}, 3000);
            		   
                	})
          	});
    	  });
	   })(jQuery);
    }

   toreloadfunctions_hetong();
</script>
<ul id="normalpicturelist_tbody" style="float:left;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
	
	<?php 
    	if(isset($picturelist)){
    	    for ($i = 0; $i < count($picturelist); $i++) {
    	        $uploadFile_path = $picturelist[$i]['uploadfile_path'];
    	            $filename_arr = explode('.', $uploadFile_path);
    	            $file_type = end($filename_arr);
    	            $file_type = strtolower($file_type);
    	            
    	            if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
    	            	echo '
	    		    		<div class="list">
	    						<input type="hidden" name="linshi_picpath[]" value="'.$uploadFile_path.'"/>
								<table cellspacing="0" cellpadding="0" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;border:0px;margin:0px;padding:0px;background-color:black;">
									<tr>
										<td valign="middle" style="border:0px;margin:0px;padding:0px;">
											<video id="video" width="'.$upload_show_width.'" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;object-fit:cover;" src="'.base_url().$uploadFile_path.'?datetime='.time().'" controls></video>
										</td>
									</tr>
								</table>
	                            <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.base_url().'themes/default/images/ajax_loading.gif"/></div>
	                            <div class="btndelete">
	                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_delete_1.png"/>
	                            </div>
	                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
	                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="linshi_picname[]" value="'.$picturelist[$i]['uploadfile_name'].'"/>
	                            </div>
	    					</div>
	    				';
    	            }else if($file_type == 'doc' || $file_type == 'docx' || $file_type == 'xls' || $file_type == 'xlsx' || $file_type == 'ppt' || $file_type == 'pptx' || $file_type == 'rar' || $file_type == 'pdf' || $file_type == 'zip'){
    	                echo '
	    		    		<div class="list">
	    						<input type="hidden" name="linshi_picpath[]" value="'.$uploadFile_path.'"/>
	    						<a href="'.base_url().$uploadFile_path.'" target="_blank"><img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.CDN_URL().'themes/default/images/icon_file_'.$file_type.'.png"/></a>
	                            <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.base_url().'themes/default/images/ajax_loading.gif"/></div>
	                            <div class="btndelete">
	                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_delete_1.png"/>
	                            </div>
	                            <div class="btnxuanzhuan">
	                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_xuanzhuan.png"/>
	                            </div>
	                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
	                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="linshi_picname[]" value="'.$picturelist[$i]['uploadfile_name'].'"/>
	                            </div>
	    					</div>
	    				';
    	            }else{
    	            	$filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $uploadFile_path);
    	            	$filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile_path);
    	            	$filename_400x400 = str_replace('.'.$file_type, '_400x400.'.$file_type, $uploadFile_path);
    	            	$filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $uploadFile_path);
    	            	
    	            	echo '
	    		    		<div class="list">
	    						<input type="hidden" name="linshi_picpath[]" value="'.$uploadFile_path.'"/>
	    						<img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.base_url().$filename_200x200.'?datetime='.time().'"/>
	                            <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.base_url().'themes/default/images/ajax_loading.gif"/></div>
	                            <div class="btndelete">
	                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_delete_1.png"/>
	                            </div>
	                            <div class="btnxuanzhuan">
	                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_xuanzhuan.png"/>
	                            </div>
	                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
	                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="linshi_picname[]" value="'.$picturelist[$i]['uploadfile_name'].'"/>
	                            </div>
	    					</div>
	    				';
    	            }
    	            
    	    }
    	}
	?>
</ul>
<div style="float:left;">
    <div id="queue"></div>
    <div id="info"></div>
</div>
<script src="<?php echo base_url()?>themes/default/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		$('#normalpicturelist_tbody').sortable({
			opacity:0.8,
			revert:true,//如果设置成true，则被拖拽的元素在返回新位置时，会有一个动画效果。
			forceHelperSize:true,
			placeholder: 'draggable-placeholder',
			forcePlaceholderSize:true,
			tolerance:'pointer',
			stop: function( event,ui) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
				$(ui.item).css('z-index', 'auto');
				var newsrot=[];
				var idarr=[];
				var i=0;
			},
			scroll: false,
		});
		
	})
</script>


<div style="float:left;width:100%;font-weight:bold;font-size:14px;margin:10px 0px 0px 0px;">
	<table cellspacing=0 cellpadding=0 border=0 style="width:100%;">
		<tr class="addnewpicture_showlist_area">
			<td style="padding:0px;">
				<div style="float:left;height:70px;margin-left:0px;">
					<div class="choosebtn_choose" style="float:left;width:100%;">
					    <input id="file_upload" name="file_upload" style="float:left;margin-left:0px;opacity:0;"/>
					</div>
					<div class="choosebtn_loading" style="float:left;width:100%;display:none;">
					    <div style="float:left;background:gray;color:white;line-height:30px;padding:0px 30px;font-size:12px;border-radius:30px;">
						    加载中...
						</div>
					</div>
				</div>
				
				<div style="float:left;width:100%;margin-top:5px;">
				    <span style="font-size:12px;font-weight:normal;">
				    <?php if($upload_size_tips != ''){?>
					    <?php if($this->langtype == '_ch'){echo '图片尺寸为：'.$upload_size_tips;}else{echo 'Size：'.$upload_size_tips;}?>
					    <br />
				    <?php }?>
				    (<?php if($this->langtype == '_ch'){echo '格式必须为 ';}else{echo 'Format must be';}?><span style="border-bottom:1px solid orange;color:orange;font-weight:bold;"> <?php echo $upload_format;?> </span>)
				    <?php if(isset($upload_other_tips)){echo $upload_other_tips;}?>
				    </span>
				</div>
			</td>
		</tr>
		<tr class="addnewpicture_btn_area" style="display:none;">
			<td>
				<div style="float:left;">
					<input type="button" onclick="toaddnewpicturenormal()" value=" 开始上传 " class="btn_2" style="border:none;padding-top:4px;padding-bottom:4px;"/>
				</div>
			</td>
		</tr>
	</table>
</div>

<script type="text/javascript">
	<?php $timestamp = time();?>
	<?php 
    	if(isset($text_choosefilename)){
    	    
    	}else{
    		if($this->langtype == '_ch'){
    			$text_choosefilename = '选择图片';
    		}else{
    			$text_choosefilename = 'Choose';
    		}
    	}
	?>
	(function($) {
    	$(function() {
    		$('#file_upload').uploadifive({
    			'fileObjName': 'Filedata',
    			'buttonText': "<div style='float:left;width:100%;margin-top:10px;'><img style='width:25px;height:25px;' src='<?php echo base_url().'themes/default/images/icon_plus_gray.png'?>'/></div><div style='float:left;width:100%;margin-top:5px;'><?php echo $text_choosefilename;?></div>",
    			'width': 70,
    			'height': 70,
    			'auto'             : true,
    			'checkScript'      : '<?php echo base_url().'welcome/checkexists'?>',
    			'formData'         : {
    								   'timestamp' : '<?php echo $timestamp;?>',
    								   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
    			                     },
    			'queueID'          : 'queue',
    			<?php if($upload_init_type == 2){?>
    			'multi': true,
    	        <?php }else{?>
    	        'multi': false,
    	        <?php }?>
    	        'uploadLimit': 20,//上传文件数
    	        'queueSizeLimit': 20,//一次可以在队列中拥有的最大文件数
    	        'fileSizeLimit': 0,
    			'uploadScript'     : '<?php echo base_url().'welcome/uploadpicturebyhtml/'.$upload_init_path.'/'.$upload_show_width.'/'.$upload_show_height?>',
    			'onUpload' : function(file) {
    				<?php if($upload_init_type == 2){?>
        			
        	        <?php }else{?>
        	        $('#normalpicturelist_tbody').html('');
        	        <?php }?>
    				$('.choosebtn_choose').hide();
    				$('.choosebtn_loading').show();
    // 	            document.getElementById("submit").disabled = true;//当开始上传文件，要防止上传未完成而表单被提交
    	        },
    			'onUploadComplete' : function(file, data) {
        			file.queueItem.remove();//隐藏提示的内容
        			<?php if($upload_init_type == 2){?>
        			$('#normalpicturelist_tbody').append(data);
        	        <?php }else{?>
        	        $('#normalpicturelist_tbody').html(data);
        	        <?php }?>
    				toreloadfunctions_hetong();
    				if(typeof(tocheckvideo_num) == "function"){
    					//alert("存在的函数"); 
    		     		tocheckvideo_num();//检查video的数量
    				}else{ 
    					//alert("不存在的函数"); 
    				}
    			},
    			'onQueueComplete': function(data){
    				$('.choosebtn_choose').show();
    				$('.choosebtn_loading').hide();
    // 				$('.addnewpicture_btn_area').css({'display':'none'});
    // 				$('.addnewpicture_showlist_area').css({'display':'none'});
    			},
    			'onError': function(errorType){
        			alert("错误: "+errorType);
    			}
    		});
    	});

	})(jQuery);

    function toaddnewpicturenormal(){
		(function($) {
			$('#file_upload').uploadifive('upload');
		})(jQuery);
	}
</script>



    	    	
    	    	