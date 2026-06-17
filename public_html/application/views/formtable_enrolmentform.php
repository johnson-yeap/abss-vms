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

$agreepurpose_num = 4;
if(isset($_COOKIE[DB_PRE().'agreepurposeinfo_'.$agreepurpose_num])){
    $agreepurposeinfo = unserialize($_COOKIE[DB_PRE().'agreepurposeinfo_'.$agreepurpose_num]);
    $this->agreepurpose = $agreepurposeinfo['agreepurpose_'.$agreepurpose_num];
    
    //重新续期cookie
    $arr = array('agreepurpose_'.$agreepurpose_num=>$agreepurposeinfo['agreepurpose_'.$agreepurpose_num]);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'agreepurposeinfo_'.$agreepurpose_num, $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->agreepurpose = '';
}
?>

<div style="float:left;width:100%;">
	<div style="width:96%;max-width:1400px;margin:0 auto;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php 
                if($this->code != ''){
//                     if($this->agreepurpose != ''){
                        $this->load->view('formtable_enrolmentform_content');
//                     }else{
//             		    $data['agreepurpose_num'] = $agreepurpose_num;
//                 		$this->load->view('common_agreetermsandconditions', $data);
//                 	}
                }else{
                    $this->load->view('common_entercode');
                }
            ?>
    	</div>
    </div>
</div>

<?php $this->load->view('footer')?>