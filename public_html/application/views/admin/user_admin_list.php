<?php $this->load->view('admin/common_header')?>
<div style="float:left;width:calc(100% - 40px);margin-left:20px;">
<?php 
$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url = current_url();
$current_url_encode=str_replace('/','slash_tag',base64_encode($current_url.$get_str));

$keyword = $this->input->get('keyword');
$admin_type = $this->input->get('admin_type');

check_SQLinjection($keyword);//防止sql注入，防止js注入
?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
<?php if($admin_type == 2 || $admin_type == 3){?>
	<table class="gksel_normal_tabaction">
		<tr>
			<td>
				<div class="searcharea">
					<form action = "<?php echo base_url().'admins/user/adminassistantlist?admin_type='.$admin_type?>" method="get">
						<input type="hidden" name="admin_type" value="<?php echo $admin_type?>"/>
						<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
						<input type="submit" value="<?php echo lang('cy_search')?>"/>
					</form>
				</div>
			</td>
		</tr>
	</table>
	<table class="gksel_normal_tabaction">
		<tr>
			<td>
				<div class="searcharea">
					<a href="<?php echo base_url().'admins/user/toadd_adminassistant/'.$admin_type.'?backurl='.$current_url_encode?>">
						<font class="nav_on">
							<img class="plus" src="<?php echo base_url().'themes/default/images/plus.png'?>"/>
							<?php if($admin_type == 2){?>
								<?php if($this->langtype == '_ch'){echo '添加管理员助理';}else{echo 'Add Admin Assistant';}?>
							<?php }else{?>
							    <?php if($this->langtype == '_ch'){echo '添加Article Editor';}else{echo 'Add Article Editor';}?>
							<?php }?>
						</font>
					</a>
				</div>
			</td>
		</tr>
	</table>
<?php }?>

<div style="float:left;width:calc(100% - 20px);background-color:white;padding:10px 10px;border-radius:8px;">
<?php if($admin_type == 1){?>
	<table class="gksel_normal_tablist">
		<thead>
			<tr>
				<td width="50" align="center"><?php echo lang('cy_sn')?></td>
				<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
				<td width="165"><p>&nbsp;&nbsp;&nbsp;Name</p></td>
				<td width="165"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_email')?></p></td>
				<td width="120"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_phone')?></p></td>
				<td width="165" align="center"><p><?php if($this->langtype == '_ch'){echo '最后修改时间';}else{echo 'Last Time';}?></p></td>
				<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '作者';}else{echo 'Author';}?></p></td>
				<td width="200" align="center"><p><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></p></td>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($adminlist)){for ($i = 0; $i < count($adminlist); $i++) {?>
				<tr>
					<td align="center"><?php echo $i+1?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_username']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_realname']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_email']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_phone']));?></td>
					<td align="center"><?php echo date('Y-m-d H:i:s', $adminlist[$i]['edited'])?></td>
					<td align="center"><?php echo $adminlist[$i]['edited_author']?></td>
					<td align="center" style="padding-top:10px;padding-bottom:10px;">
						<div style="float:right;">
							<?php 
								echo '<a href="'.base_url().'admins/user/toedit_adminassistant/'.$admin_type.'/'.$adminlist[$i]['admin_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
								if($adminlist[$i]['admin_type'] == 2){
									echo '<a onclick="todel_adminassistant('.$adminlist[$i]['admin_id'].', \''.$adminlist[$i]['admin_username'].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
								}
							?>
						</div>
					</td>
				</tr>
			<?php }}?>
		</tbody>
	</table>
<?php } else if($admin_type == 2){?>
	<table class="gksel_normal_tablist">
		<thead>
			<tr>
				<td width="50" align="center"><?php echo lang('cy_sn')?></td>
				<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
				<td width="165"><p>&nbsp;&nbsp;&nbsp;Name</p></td>
				<td width="165"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_email')?></p></td>
				<td width="120"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_phone')?></p></td>
				<td width="165" align="center"><p><?php if($this->langtype == '_ch'){echo '最后修改时间';}else{echo 'Last Time';}?></p></td>
				<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '作者';}else{echo 'Author';}?></p></td>
				<td width="200" align="center"><p><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></p></td>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($adminlist)){for ($i = 0; $i < count($adminlist); $i++) {?>
				<tr>
					<td align="center"><?php echo $i+1?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_username']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_realname']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_email']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_phone']));?></td>
					<td align="center"><?php echo date('Y-m-d H:i:s', $adminlist[$i]['edited'])?></td>
					<td align="center"><?php echo $adminlist[$i]['edited_author']?></td>
					<td align="center" style="padding-top:10px;padding-bottom:10px;">
						<div style="float:right;">
							<?php 
								echo '<a href="'.base_url().'admins/user/toedit_adminassistant/'.$admin_type.'/'.$adminlist[$i]['admin_id'].'?backurl='.$current_url_encode.'"><img style="float:left;margin-right:15px;" src="'.base_url().'themes/default/images/icon_edit.gif"/></a>';
								if($adminlist[$i]['admin_type'] == 2){
									echo '<a onclick="todel_adminassistant('.$adminlist[$i]['admin_id'].', \''.$adminlist[$i]['admin_username'].'\')" href="javascript:;"><img style="float:left;margin-right:15px;" src="'.base_url().'themes/default/images/icon_del.gif"/></a>';
								}
							?>
						</div>
					</td>
				</tr>
			<?php }}?>
		</tbody>
	</table>
	<?php } else if($admin_type == 3){?>
	<table class="gksel_normal_tablist">
		<thead>
			<tr>
				<td width="50" align="center"><?php echo lang('cy_sn')?></td>
				<td><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_username')?></p></td>
				<td width="165"><p>&nbsp;&nbsp;&nbsp;Name</p></td>
				<td width="165"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_email')?></p></td>
				<td width="120"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('dz_user_phone')?></p></td>
				<td width="165" align="center"><p><?php if($this->langtype == '_ch'){echo '最后修改时间';}else{echo 'Last Time';}?></p></td>
				<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '作者';}else{echo 'Author';}?></p></td>
				<td width="200" align="center"><p><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></p></td>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($adminlist)){for ($i = 0; $i < count($adminlist); $i++) {?>
				<tr>
					<td align="center"><?php echo $i+1?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_username']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_realname']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_email']));?></td>
					<td><?php echo actionsearchdaxiaoxiezimu($keyword, strip_tags($adminlist[$i]['admin_phone']));?></td>
					<td align="center"><?php echo date('Y-m-d H:i:s', $adminlist[$i]['edited'])?></td>
					<td align="center"><?php echo $adminlist[$i]['edited_author']?></td>
					<td align="center" style="padding-top:10px;padding-bottom:10px;">
						<div style="float:right;">
							<?php 
								echo '<a href="'.base_url().'admins/user/toedit_adminassistant/'.$admin_type.'/'.$adminlist[$i]['admin_id'].'?backurl='.$current_url_encode.'"><img style="float:left;margin-right:15px;" src="'.base_url().'themes/default/images/icon_edit.gif"/></a>';
								if($adminlist[$i]['admin_type'] == 2){
									echo '<a onclick="todel_adminassistant('.$adminlist[$i]['admin_id'].', \''.$adminlist[$i]['admin_username'].'\')" href="javascript:;"><img style="float:left;margin-right:15px;" src="'.base_url().'themes/default/images/icon_del.gif"/></a>';
								}
							?>
						</div>
					</td>
				</tr>
			<?php }}?>
		</tbody>
	</table>
	<?php }?>
</div>
</div>
<?php $this->load->view('admin/common_footer')?>