<?php $this->load->view('header_volunteer')?>
<style>

</style>
<?php 
if(isset($_COOKIE[DB_PRE().'volunteerinfo'])){
    $volunteerinfo = unserialize($_COOKIE[DB_PRE().'volunteerinfo']);
    $this->volunteer_id = $volunteerinfo['volunteer_id'];
    
    //重新续期cookie
    $arr = array('volunteer_id'=>$volunteerinfo['volunteer_id']);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'volunteerinfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->volunteer_id = 0;
}
?>
<div style="float:left;width:100%;">
	<div style="width:96%;max-width:1400px;margin:0 auto;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php 
                if($this->volunteer_id != ''){
                    $this->load->view('volunteer_record_edit_'.$form_type.'_content');
                }else{
                    $this->load->view('common_entercode_volunteer');
                }
            ?>
    	</div>
    </div>
</div>
<?php $this->load->view('footer')?>