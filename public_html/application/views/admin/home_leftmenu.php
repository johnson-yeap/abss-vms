<?php $this->load->view('admin/common_header')?>

<div style="float:left;width:100%;height:15px;">&nbsp;</div>
<div style="float:left;width:100%;" id="leftarea_tab">
	<div class="menu_stage_one list_off" style="display:none;">
		<?php 
    		if($this->langtype == '_ch'){
    		    $section_name = '仪表板';
    		}else{
    		    $section_name = 'Dashboard';
    		}
    		$section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/home/main'));
		?>
		<div class="lemenu_c">
			<div class="leftico">
				<a href="<?php echo $section_link;?>" target="iframe_main">
					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_dashboard_off.png'?>">
					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_dashboard_on.png'?>">
				</a>
			</div>
			<div class="lefttextname">
    			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?></a>
    		</div>
		</div>
	</div>
	
	<?php 
    	$group_id_str = '1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 507';
    	// 	    		, 'group_id_IN'=>$group_id_str
    	$con = array('group_id_XIAOYU'=>1000, 'parent'=>0);
    	$all_banner_list = $this->CmsModel->getcmslist($con);
    	
    	$count_banner = 0;
    	if(!empty($all_banner_list)){
    	    for ($aaabbb = 0; $aaabbb < count($all_banner_list); $aaabbb++) {
    	        if($all_banner_list[$aaabbb]['group_id'] == 1){
    	            $count_banner = $count_banner + 1;
    	        }else if($all_banner_list[$aaabbb]['group_id'] == 2){
    	            $count_banner = $count_banner + 1;
    	        }else if($all_banner_list[$aaabbb]['group_id'] == 3){
    	            $count_banner = $count_banner + 1;
    	        }else if($all_banner_list[$aaabbb]['group_id'] == 4){
    	            $count_banner = $count_banner + 1;
    	        }else if($all_banner_list[$aaabbb]['group_id'] == 5){
    	            $count_banner = $count_banner + 1;
    	        }else if($all_banner_list[$aaabbb]['group_id'] == 6){
    	            $count_banner = $count_banner + 1;
    	        }else if($all_banner_list[$aaabbb]['group_id'] == 8){
    	            $count_banner = $count_banner + 1;
    	        }
    	    }
    	}
	?>
	
	<?php if($this->admin_type == 1 || $this->admin_type == 2){?>
		<div class="menu_stage_one list_off">
			<?php 
			    $thisid = 1;
	    		if($this->langtype == '_ch'){
	    		    $section_name = '横幅';
	    		}else{
	    		    $section_name = 'Banner';
	    		}
			?>
			<div isopen="1" area_id="<?php echo $thisid?>" id="category_<?php echo $thisid;?>" class="lemenu_category">
				<div class="leftico">
					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_cms_off.png'?>">
					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_cms_on.png'?>">
				</div>
				<div class="lefttextname">
	    			<a href="javascript:;"><?php echo $section_name;?> <?php if($count_banner != 0){echo '<span style="color:#CCC;">('.$count_banner.')</span>';}?></a>
	    		</div>
	    		<span style="float:right;margin-top:10px;">
					<div class="arrow-box" style="transform: rotate(270deg);">
				        <div class="cssleft"><i class="cssleft-arrow1"></i><i class="cssleft-arrow2"></i></div>
				    </div>
				</span>
			</div>
		</div>
		<div id="tabbody_<?php echo $thisid;?>" class="menu_group" style="display:block;">
	    	<div class="menu_stage_two list_on">
	    		<?php 
	    			$group_id = 1;
	    			$count_banner = 0;
	    			if(!empty($all_banner_list)){
	    			    for ($aaabbb = 0; $aaabbb < count($all_banner_list); $aaabbb++) {
	    			        if($all_banner_list[$aaabbb]['group_id'] == $group_id){
	    			            $count_banner = $count_banner + 1;
	    			        }
	    			    }
	    			}
	                if($this->langtype == '_ch'){$section_name = '电脑版首页';}else{$section_name = 'Home';}
	                $section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/cms/index?group_id='.$group_id));
	        	?>
	    		<div class="lemenu_c">
	    			<div class="leftico">
	    				<a href="<?php echo $section_link;?>" target="iframe_main">
	    					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_home_off.png'?>">
	    					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_home_on.png'?>">
	    				</a>
	    			</div>
	    			<div class="lefttextname">
	        			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?> <?php if($count_banner != 0){echo '<span style="color:#CCC;">('.$count_banner.')</span>';}?></a>
	        		</div>
	    		</div>
	    	</div>
		</div>
	<?php }?>
	
	
	
	<?php if($this->admin_type == 1){?>
		<div class="menu_stage_one list_off" style="display:none;">
			<?php 
			    $group_id = 129;
			    if($this->langtype == '_ch'){$section_name = '关于我们';}else{$section_name = 'About Us';}
			    $section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/cms/index?group_id='.$group_id));
			?>
			<div class="lemenu_c">
				<div class="leftico">
					<a href="<?php echo $section_link;?>" target="iframe_main">
						<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_order_off.png'?>">
						<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_order_on.png'?>">
					</a>
				</div>
				<div class="lefttextname">
	    			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?></a>
	    		</div>
			</div>
		</div>
	<?php }?>
	
	
	<div class="menu_stage_one list_off">
		<?php 
		    if($this->langtype == '_ch'){$section_name = 'Manage Email';}else if($this->langtype == '_jp'){$section_name = 'Manage Email';}else if($this->langtype == '_sk'){$section_name = 'Manage Email';}else if($this->langtype == '_ru'){$section_name = 'Manage Email';}else{$section_name = 'Manage Email';}
		    $section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/email/index'));
		?>
		<div class="lemenu_c">
			<div class="leftico">
				<a href="<?php echo $section_link;?>" target="iframe_main">
					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_partynews_off.png'?>">
					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_partynews_on.png'?>">
				</a>
			</div>
			<div class="lefttextname">
    			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?></a>
    		</div>
		</div>
	</div>
	
	<?php if($this->admin_type == 1){?>
		<div class="menu_stage_one list_off">
			<?php 
			    $group_id = 124;
			    if($this->langtype == '_ch'){$section_name = 'Form Data';}else{$section_name = 'Form Data';}
			    $section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/notice/index'));
			?>
			<div class="lemenu_c">
				<div class="leftico">
					<a href="<?php echo $section_link;?>" target="iframe_main">
						<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_order_off.png'?>">
						<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_order_on.png'?>">
					</a>
				</div>
				<div class="lefttextname">
	    			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?></a>
	    		</div>
			</div>
		</div>
	<?php }?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php if($this->admin_type == 1){?>
		<div class="menu_stage_one list_off" style="display:none;">
			<?php 
			    $thisid = 5;
	    		if($this->langtype == '_ch'){
	    		    $section_name = 'Admins';
	    		}else{
	    		    $section_name = 'Admins';
	    		}
	    		
	    		$count_user = 0;
	    		$count_admin_1 = 0;
	    		$count_admin_2 = 0;
			?>
			<div isopen="1" area_id="<?php echo $thisid?>" id="category_<?php echo $thisid;?>" class="lemenu_category">
				<div class="leftico">
					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_client_off.png'?>">
					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_client_on.png'?>">
				</div>
				<div class="lefttextname">
	    			<a href="javascript:;"><?php echo $section_name;?> <?php if(($count_user + $count_admin_1) != 0){echo '<span style="color:#CCC;">('.($count_user + $count_admin_1).')</span>';}?></a>
	    		</div>
	    		<span style="float:right;margin-top:10px;">
					<div class="arrow-box" >
				        <div class="cssleft"><i class="cssleft-arrow1"></i><i class="cssleft-arrow2"></i></div>
				    </div>
				</span>
			</div>
		</div>
		<div id="tabbody_<?php echo $thisid;?>" class="menu_group">
	    	<div class="menu_stage_two list_off">
	    		<?php 
					if($this->langtype == '_ch'){$section_name = '超级管理员';}else{$section_name = 'System Admin';}
	                $section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/user/adminassistantlist?admin_type=1'));
	        	?>
	    		<div class="lemenu_c">
	    			<div class="leftico">
	    				<a href="<?php echo $section_link;?>" target="iframe_main">
	    					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_client_off.png'?>">
	    					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_client_on.png'?>">
	    				</a>
	    			</div>
	    			<div class="lefttextname">
	        			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?> <?php if($count_admin_1 != 0){echo '<span style="color:#CCC;">('.$count_admin_1.')</span>';}?></a>
	        		</div>
	    		</div>
	    	</div>
	    	<div class="menu_stage_two list_off">
	    		<?php 
					if($this->langtype == '_ch'){$section_name = '管理员助理';}else{$section_name = 'Admin Assistant';}
	                $section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/user/adminassistantlist?admin_type=2'));
	        	?>
	    		<div class="lemenu_c">
	    			<div class="leftico">
	    				<a href="<?php echo $section_link;?>" target="iframe_main">
	    					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_client_off.png'?>">
	    					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_client_on.png'?>">
	    				</a>
	    			</div>
	    			<div class="lefttextname">
	        			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?> <?php if($count_admin_2 != 0){echo '<span style="color:#CCC;">('.$count_admin_2.')</span>';}?></a>
	        		</div>
	    		</div>
	    	</div>
	    	<div class="menu_stage_two list_off">
	    		<?php 
					if($this->langtype == '_ch'){$section_name = 'Article Editor';}else{$section_name = 'Article Editor';}
	                $section_link = base_url().'admins/home/page_loading?redirecturl='.str_replace('/', 'slash_tag', base64_encode(base_url().'admins/user/adminassistantlist?admin_type=3'));
	        	?>
	    		<div class="lemenu_c">
	    			<div class="leftico">
	    				<a href="<?php echo $section_link;?>" target="iframe_main">
	    					<img class="ico_off" src="<?php echo base_url().'themes/default/images/admin/icon_client_off.png'?>">
	    					<img class="ico_on" src="<?php echo base_url().'themes/default/images/admin/icon_client_on.png'?>">
	    				</a>
	    			</div>
	    			<div class="lefttextname">
	        			<a href="<?php echo $section_link;?>" target="iframe_main"><?php echo $section_name;?> <?php if($count_admin_2 != 0){echo '<span style="color:#CCC;">('.$count_admin_2.')</span>';}?></a>
	        		</div>
	    		</div>
	    	</div>
		</div>
	<?php }?>
	
	
	
	
	

<script type="text/javascript">
	$('.lemenu_c').find('a').click(function (){
		$('.lemenu_c').parent().removeClass('list_off').removeClass('list_on');
		$('.lemenu_c').parent().addClass('list_off');
		
		if($(this).parent().attr('class') == 'lemenu_c'){
			$(this).parent().parent().removeClass('list_off').addClass('list_on');
		}else if($(this).parent().parent().attr('class') == 'lemenu_c'){
			$(this).parent().parent().parent().removeClass('list_off').addClass('list_on');
		}
	})
	
	//左边菜单的点击事件
	$(".lemenu_category").on('click', function (){
// 	$(".lemenu_category").live('click', function (){
		var area_id=$(this).attr('area_id');
		if($('#category_'+area_id).attr('isopen')==1){
			$('#category_'+area_id).attr('isopen',0);//此时不可以再次点击
			var this_height=$('#tabbody_'+area_id).height();
			if($('#tabbody_'+area_id).css('display')=='none'){
				$('#tabbody_'+area_id).css('height','0px');
				$('#tabbody_'+area_id).show();
				$('#tabbody_'+area_id).animate({height:this_height+"px"}, 500, function (){
					$('#category_'+area_id).attr('isopen',1);//此时恢复可点击
				});
				
// 				$('#category_'+area_id).find('.arrow-box').css({'transform': 'rotate(270deg)'});

				var elem = $('#category_'+area_id).find('.arrow-box');
				// Animate rotation with a recursive call
				rotate(elem, 180, 1);
			}else{
				$('#tabbody_'+area_id).animate({height:"0px"}, 500, function (){
					$('#category_'+area_id).attr('isopen',1);//此时恢复可点击
					$('#tabbody_'+area_id).hide();
					$('#tabbody_'+area_id).css('height',this_height+'px');
				});

// 				$('#category_'+area_id).find('.arrow-box').css({'transform': 'rotate(180deg)'});

				var elem = $('#category_'+area_id).find('.arrow-box');
				// Animate rotation with a recursive call
				rotate(elem, 270, 2);
			}
		}
	});

	function rotate(elem, degree, fangxiang) {
		if(fangxiang == 1){
			if(degree == 270){
				elem.css({'transform': 'rotate('+degree+'deg)'});
			}else{
				elem.css({'transform': 'rotate('+degree+'deg)'});
				setTimeout(function() {rotate(elem, ++degree, fangxiang); }, 2);
			}
		}else{
			if(degree == 180){
				elem.css({'transform': 'rotate('+degree+'deg)'});
			}else{
				elem.css({'transform': 'rotate('+degree+'deg)'});
				setTimeout(function() {rotate(elem, --degree, fangxiang); }, 2);
			}
		}
	}

	
</script>

<style>
	.arrow-box{
		position:relative;
		padding-left:16px;
		width:16px;
		height:16px;
		
		transform:rotate(180deg);
        -ms-transform:rotate(180deg); 	/* IE 9 */
        -moz-transform:rotate(180deg); 	/* Firefox */
        -webkit-transform:rotate(180deg); /* Safari 和 Chrome */
        -o-transform:rotate(180deg); 	/* Opera */
	}
 	/*左箭头*/
    .cssleft{
    	position:absolute;
        width:16px;
        height:16px;
        left:0;
        top:0;
        border:0px solid blue;
    }
    .cssleft-arrow1, .cssleft-arrow2{
    	position:absolute;
        width:0;
        height:0;
        display:block;
        
        left:0;
        top:0;
        z-index:5;/*兼容ie8-*/
        border-top:8px transparent dashed;
        border-left:8px transparent dashed;
        border-bottom:8px transparent dashed;
        border-right:8px #F7B5B7 solid;
        overflow:hidden;
    }
    .cssleft-arrow1{
        border-right:8px solid white;
    }
    .cssleft-arrow2{
        left:2px;/*重要*/
        border-right:8px solid #F7B5B7;
    }
</style>


<?php $this->load->view('admin/common_footer')?>