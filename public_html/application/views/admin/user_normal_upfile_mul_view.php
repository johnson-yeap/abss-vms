<?php 
    if(isset($fujiangroup_name)){
        $fujianinputname = $fujiangroup_name;
    }else{
        $fujianinputname = 'linshi_pic';
    }
    
    if(isset($upload_maxnum)){
        $uploadmaxnum = $upload_maxnum;
    }else{
        $uploadmaxnum = 10;
    }
?>
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
#queue_<?php echo $fujianinputname;?> {
	float:left;
	width:calc(100% - 6px - 2px);
	border: 1px solid #E5E5E5;
	overflow: auto;
	margin-bottom: 10px;
	padding: 0 3px 3px;
}
*/
#queue_<?php echo $fujianinputname;?> {
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
    #coursepicturelist_<?php echo $fujianinputname;?>{float:left;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;}
    #coursepicturelist_<?php echo $fujianinputname;?> .list{position:relative;float:left;width:<?php echo $upload_show_width;?>px;height:<?php echo $upload_show_height;?>px;margin-top:0px;margin-right:8px;}
    #coursepicturelist_<?php echo $fujianinputname;?> .list .btndelete{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
    #coursepicturelist_<?php echo $fujianinputname;?> .list .btndelete2{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
	#coursepicturelist_<?php echo $fujianinputname;?> .list:hover .btndelete{display:block;}
    #coursepicturelist_<?php echo $fujianinputname;?> .list:hover .btndelete2{display:block;}
    
    #coursepicturelist_<?php echo $fujianinputname;?> .list .btnxuanzhuan{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
    #coursepicturelist_<?php echo $fujianinputname;?> .list .btnxuanzhuan2{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
    #coursepicturelist_<?php echo $fujianinputname;?> .list:hover .btnxuanzhuan{display:block;}
    #coursepicturelist_<?php echo $fujianinputname;?> .list:hover .btnxuanzhuan2{display:block;}
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
   function toreloadfunctions_<?php echo $fujianinputname;?>(){
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
          	     	var filename = $(this).parent().find('input[name="<?php echo $fujianinputname;?>_path[]"]').val();
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
            	   var filename = $(this).parent().find('input[name="<?php echo $fujianinputname;?>_path[]"]').val();
            	   var thissmallitem = $(this).parent();

            	   thissmallitem.find('input[name="<?php echo $fujianinputname;?>_path[]"]').next().hide();
            	   thissmallitem.find(".btnloading").show();
            	   $.post(baseurl+'welcome/xuanzhuanpicture', {filename:filename}, function (){
            		    var date_now = new Date();
          				var time_now = date_now.getTime();

            			var filename_arr = filename.split('.');
              		   var file_type = filename_arr[filename_arr.length - 1];
              		   var filename_200x200 = filename.replace('.'+file_type, '_200x200.'+file_type);
                		 thissmallitem.find('input[name="<?php echo $fujianinputname;?>_path[]"]').next().attr('src', baseurl + filename_200x200+'?datetime='+time_now);

                		 setTimeout(function() {
                			
                		   thissmallitem.find('input[name="<?php echo $fujianinputname;?>_path[]"]').next().show();
                		   thissmallitem.find(".btnloading").hide();
                   		}, 3000);
            		   
                	})
          	});
    	  });
	   })(jQuery);
    }

   toreloadfunctions_<?php echo $fujianinputname;?>();
</script>
<ul id="coursepicturelist_<?php echo $fujianinputname;?>" style="float:left;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
	
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
	    						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile_path.'"/>
								<table cellspacing="0" cellpadding="0" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;border:0px;margin:0px;padding:0px;background-color:black;">
									<tr>
										<td valign="middle" style="border:0px;margin:0px;padding:0px;">
											<video id="video" width="'.$upload_show_width.'" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;object-fit:cover;" src="'.base_url().$uploadFile_path.'?datetime='.time().'" controls></video>
										</td>
									</tr>
								</table>
	                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
	                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value="'.$picturelist[$i]['uploadfile_name'].'"/>
	                            </div>
	    					</div>
	    				';
    	            }else if($file_type == 'doc' || $file_type == 'docx' || $file_type == 'xls' || $file_type == 'xlsx' || $file_type == 'ppt' || $file_type == 'pptx' || $file_type == 'rar' || $file_type == 'pdf' || $file_type == 'zip'){
    	                echo '
	    		    		<div class="list">
	    						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile_path.'"/>
	    						<a href="'.base_url().$uploadFile_path.'" target="_blank"><img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.CDN_URL().'themes/default/images/icon_file_'.$file_type.'.png"/></a>
	                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
	                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value="'.$picturelist[$i]['uploadfile_name'].'"/>
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
	    						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile_path.'"/>
	    						<img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.base_url().$filename_200x200.'?datetime='.time().'"/>
	                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
	                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value="'.$picturelist[$i]['uploadfile_name'].'"/>
	                            </div>
	    					</div>
	    				';
    	            }
    	            
    	    }
    	}
	?>
</ul>
