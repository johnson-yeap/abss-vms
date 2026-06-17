<?php $this->load->view('admin/common_header');?>
<table cellspacing="0" cellpadding="0" style="float:left;width:100%;height:100%;">
	<tr>
		<td align="center">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<img style="float:left;width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">
    if (window.self != window.top) {
    	location.href='<?php echo $redirecturl;?>';
    }else{
    	alert('页面不能新窗口打开');
    }
</script>


<?php $this->load->view('admin/common_footer');?>