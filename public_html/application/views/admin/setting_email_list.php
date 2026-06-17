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
?>
<div style="float:left;width:calc(100% - 20px);background-color:white;padding:10px 10px;border-radius:8px;">
<table class="gksel_normal_tablist">
	<thead>
		<tr>
			<td width="50" align="center"><?php echo lang('cy_sn')?></td>
			<td align="left"><p>&nbsp;&nbsp;&nbsp;<?php echo lang('cy_name')?></p></td>
			<td align="left"><p>&nbsp;&nbsp;&nbsp;From</p></td>
			<td align="left"><p>&nbsp;&nbsp;&nbsp;To</p></td>
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '作者';}else{echo 'Author';}?></p></td>
			<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></p></td>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($emaillist)){for ($i = 0; $i < count($emaillist); $i++) {?>
			<tr>
				<td align="center"><?php echo $i+1?></td>
				<td align="left"><?php echo $emaillist[$i]['email_name'.$this->langtype];?></td>
				<td align="left"><?php echo $emaillist[$i]['email_from'];?></td>
				<td align="left"><?php echo $emaillist[$i]['email_to'];?></td>
				<td align="center"><?php echo $emaillist[$i]['edited_author']?></td>
				<td align="center">
					<div style="float:right;">
						<?php 
							echo '<a href="'.base_url().'admins/email/toedit_email/'.$emaillist[$i]['email_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
						?>
					</div>
				</td>
			</tr>
		<?php }}?>
	</tbody>
</table>
</div>

</div>
<?php $this->load->view('admin/common_footer')?>