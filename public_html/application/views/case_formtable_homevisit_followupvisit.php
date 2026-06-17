<?php $this->load->view('header')?>
<style>

</style>
<?php 
if(isset($_COOKIE[DB_PRE().'codeinfo'])){
    $codeinfo = unserialize($_COOKIE[DB_PRE().'codeinfo']);
    $this->code = $codeinfo['code'];
    $this->admin_id = $codeinfo['admin_id'];
    
    //重新续期cookie
    $arr = array('admin_id'=>$codeinfo['admin_id'], 'code'=>$codeinfo['code']);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'codeinfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->code = '';
    $this->admin_id = 0;
}
?>

<?php $this->load->view('admin_common_leftmenu');?>
<div style="float:left;width:calc(100% - 200px);margin-left:200px;">
	<div style="width:96%;max-width:1400px;margin:0 auto;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php 
                $this->load->view('case_formtable_homevisit_followupvisit_content');
            ?>
    	</div>
    </div>
</div>
<?php $this->load->view('footer')?>