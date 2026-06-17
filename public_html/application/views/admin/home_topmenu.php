<div class="top_section">
<!-- 	background-color:#F7B5B7; -->
	<div style="float:left;width:250px;height:70px;background-color:white;">
    	<div style="float:left;width:100%;text-align:center;margin:4px 0px 4px 0px;">
    		<div style="float:left;width:calc(100% - 8px);padding:11px;background-color:white;border-radius:3px;">
	    		<img style="height:35px;border-radius:3px;" src="<?php echo base_url().'themes/default/images/logo.gif'?>"/>
	    	</div>
    	</div>
	</div>
	<div style="float:left;width:calc(100% - 250px);height:70px;">
		<div style="display:none;float:left;margin-left:20px;margin-top:25px;">
			<a href="#!" onclick="javascript:toggleFullScreen()">
				<i class="feather icon-maximize full-screen"></i>
			</a>
		</div>
    	<div style="float:right;margin-top:10px;">
    		<div style="float:left;">
	    		<select onchange="tochangelanguage(this.value)" style="float:left;background: url('<?php echo base_url().'themes/default/images/select_arrow.png';?>') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width: 100px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;margin-right:10px;">
	    			<option value="en" <?php if($this->langtype == '_en'){echo 'selected';}?>>English</option>
	    			<option value="ch" <?php if($this->langtype == '_ch'){echo 'selected';}?>>简体中文</option>
	    		</select>
	    	</div>
	    	<div style="float:left;margin-left:10px;margin-right:10px;line-height:35px;">
	    		<?php echo $this->admin_username?>
	    		<?php if($this->admin_type == 2){?>
					[<?php if($this->langtype == '_ch'){echo 'Admin Assistant';}else{echo 'Admin Assistant';}?>]
				<?php }else if($this->admin_type == 3){?>
					[<?php if($this->langtype == '_ch'){echo 'Article Editor';}else{echo 'Article Editor';}?>]
				<?php }else{?>
					[<?php if($this->langtype == '_ch'){echo 'System Admin';}else{echo 'System Admin';}?>]
				<?php }?>
	    		, 
	    		<a href="<?php echo base_url().'admin/logout'?>"><?php if($this->langtype == '_ch'){echo '退出';}else{echo 'Logout';}?></a>
	    	</div>
    	</div>
    	<script>
			function tochangelanguage(lang){
				top.location = '<?php echo base_url().'admins/home/changelanguage/'?>'+lang;
			}
    	</script>
	</div>
</div>
<div style="display:none;float:left;width:100%;">
	<div class="top_nav_l">
		<strong>XXXXXX</strong>
	</div>
	<div class="top_nav_c">
		<div class="topmenu">
			
		</div>
	</div>
	<div class="top_nav_r">
		<a href="<?php echo site_url('admin/tologout')?>" target="_top">退出</a>
	</div>
</div>

