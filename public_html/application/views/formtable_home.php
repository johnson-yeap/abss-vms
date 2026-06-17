<?php $this->load->view('header')?>
<style>

</style>
<?php 
if(isset($_COOKIE[DB_PRE().'admininfo'])){
    $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
    $this->admin_code = $admininfo['admin_code'];
    
    //重新续期cookie
    $arr = array('admin_id'=>$admininfo['admin_id'], 'admin_code'=>$admininfo['admin_code']);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->admin_code = '';
}
?>
<?php $this->load->view('admin_common_leftmenu');?>
<div style="float:left;width:calc(100% - 200px);margin-left:200px;">
	<div style="width:96%;max-width:100%;margin:0 auto;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php if($this->admin_code != ''){?>
            	<style>
                    @media screen and (max-width: 700px) {
                        .formtable_tabletitle{padding:20px 0px 0px 0px;}
                        .formtable_tabletitle .sectiontitle{line-height:24px;font-size:16px;padding:13px 15px;font-weight:bold;margin-bottom:20px;}
                        
                        .formtable_homepage{padding:20px 0px 30px 0px;}
                        .formtable_homepage .sectiontitle{line-height:24px;font-size:16px;padding:13px 15px;font-weight:bold;margin-bottom:20px;}
                    }
                    @media screen and (min-width: 700px){
                        .formtable_tabletitle{padding:50px 0px 0px 0px;}
                        .formtable_tabletitle .sectiontitle{line-height:50px;font-size:20px;padding:10px 15px;font-weight:bold;margin-bottom:20px;}
                    
                        .formtable_homepage{padding:20px 0px 30px 0px;}
                        .formtable_homepage .sectiontitle{line-height:50px;font-size:20px;padding:10px 15px;font-weight:bold;margin-bottom:20px;}
                    }
                    .formtable_tabletitle{float:left;width:100%;}
                    .formtable_tabletitle .sectiontitle{float:left;width:calc(100% - 30px);background:#EFEFEF;color:black;}
                
                    .formtable_homepage{float:left;width:100%;}
                    .formtable_homepage .sectiontitle{float:left;width:calc(100% - 30px);border-bottom:1px solid #DF9C4D;color:black;}
                </style>
                <div class="formtable_tabletitle">
                	<div class="sectiontitle">
                        <div style="float:left;width:calc(100% - 100px - 140px);font-size:16px;"><?php if($this->langtype == '_ch'){echo '表单';}else{echo 'Form';}?></div>
                    	<div style="float:left;width:100px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '二维码';}else{echo 'QRCode';}?></div>
                    	<div style="float:left;width:140px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></div>
                	</div>
            	</div>
            	<div class="formtable_homepage">
                    <div class="sectiontitle" style="display:none;background:rgba(255, 153, 255, 0.3);">
                    	<div style="float:left;width:calc(100% - 100px - 140px);"><a href="<?php echo base_url().'formtable/homevisit_1st'?>" target="_blank" style="color:black;">JF001A - <?php if($this->langtype == '_ch'){echo '关怀组家访表格 （初次）';}else{echo 'Caring Unit Home Visit Form (1<sup>st</sup> visit)';}?></a></div>
                    	<div style="float:left;width:100px;">
                    		<img onclick="toshow_qrcodearea('qrcode_homevisit_1st.png')" style="cursor:pointer;float:left;width:60px;height:60px;margin-left:20px;" src="<?php echo base_url().'themes/default/images/qrcode_homevisit_1st.png'?>"/>
                    	</div>
                    	<?php 
                    	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'homevisit_1st'";
                    	   $res = $this->db->query($sql)->row_array();
                    	   if(!empty($res)){if($res['numcount'] != ''){$num = $res['numcount'];}else{$num = 0;}}else{$num = 0;}
                    	?>
                    	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:140px;height:60px;">
                    		<a href="<?php echo base_url().'admin/formtable_record_list/homevisit_1st'?>" style="float:left;width:100%;line-height:20px;font-size:15px;text-align:center;color:black;"><?php if($this->langtype == '_ch'){echo '数据';}else{echo 'Data';}?> <?php if($num != 0){echo '<span style="color:red;">('.$num.')</span>';}?></a>
                    	</div>
                    </div>
                    <div class="sectiontitle" style="display:none;">
                    	<div style="float:left;width:calc(100% - 100px - 140px);"><a href="<?php echo base_url().'formtable/homevisit'?>" target="_blank" style="color:black;"><?php if($this->langtype == '_ch'){echo '关怀组家访表格';}else{echo 'Caring Unit Home Visit Form';}?></a></div>
                    	<div style="float:left;width:100px;">
                    		<img onclick="toshow_qrcodearea('qrcode_homevisit.png')" style="cursor:pointer;float:left;width:60px;height:60px;margin-left:20px;" src="<?php echo base_url().'themes/default/images/qrcode_homevisit.png'?>"/>
                    	</div>
                    	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:140px;height:60px;">
                    		<div style="float:left;width:100%;line-height:20px;font-size:15px;text-align:center;"><?php if($this->langtype == '_ch'){echo '数据';}else{echo 'Data';}?></div>
                    	</div>
                    </div>
                    <div class="sectiontitle" style="display:none;background:rgba(178, 89, 0, 0.3);">
                    	<div style="float:left;width:calc(100% - 100px - 140px);"><a href="<?php echo base_url().'formtable/homevisit_followupvisit'?>" target="_blank" style="color:black;">JF002B - <?php if($this->langtype == '_ch'){echo '家访跟进表';}else{echo 'Home Visit Form (follow up visit)';}?></a></div>
                    	<div style="float:left;width:100px;">
                    		<img onclick="toshow_qrcodearea('qrcode_homevisit_followupvisit.png')" style="cursor:pointer;float:left;width:60px;height:60px;margin-left:20px;" src="<?php echo base_url().'themes/default/images/qrcode_homevisit_followupvisit.png'?>"/>
                    	</div>
                    	<?php 
                    	   $num = 0;
//                     	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'homevisit_followupvisit'";
//                     	   $res = $this->db->query($sql)->row_array();
//                     	   if(!empty($res)){if($res['numcount'] != ''){$num = $res['numcount'];}else{$num = 0;}}else{$num = 0;}
                    	?>
                    	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:140px;height:60px;">
                    		<a href="<?php echo base_url().'admin/formtable_record_list/homevisit_followupvisit'?>" style="float:left;width:100%;line-height:20px;font-size:15px;text-align:center;color:black;"><?php if($this->langtype == '_ch'){echo '数据';}else{echo 'Data';}?> <?php if($num != 0){echo '<span style="color:red;">('.$num.')</span>';}?></a>
                    	</div>
                    </div>
                    <div class="sectiontitle" style="background:rgba(54, 162, 235, 0.3);">
                    	<div style="float:left;width:calc(100% - 100px - 140px);"><a href="<?php echo base_url().'formtable/enrolmentform'?>" target="_blank" style="color:black;">P001A - <?php if($this->langtype == '_ch'){echo '接受关怀登记表';}else{echo 'Caring Form';}?></a></div>
                    	<div style="float:left;width:100px;">
                    		<img onclick="toshow_qrcodearea('qrcode_enrolmentform.png')" style="cursor:pointer;float:left;width:60px;height:60px;margin-left:20px;" src="<?php echo base_url().'themes/default/images/qrcode_enrolmentform.png'?>"/>
                    	</div>
                    	<?php 
                    	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'enrolmentform' AND is_closed = 0 AND status = 0";
                    	   $res = $this->db->query($sql)->row_array();
                    	   if(!empty($res)){if($res['numcount'] != ''){$num_pending = $res['numcount'];}else{$num_pending = 0;}}else{$num_pending = 0;}
                    	   
                    	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'enrolmentform' AND is_closed = 0 AND status = 1";
                    	   $res = $this->db->query($sql)->row_array();
                    	   if(!empty($res)){if($res['numcount'] != ''){$num_passed = $res['numcount'];}else{$num_passed = 0;}}else{$num_passed = 0;}
                    	?>
                    	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:140px;height:60px;">
                    		<a href="<?php echo base_url().'admin/formtable_record_list/enrolmentform'?>" style="float:left;width:100%;line-height:20px;font-size:15px;text-align:center;color:black;"><?php if($this->langtype == '_ch'){echo '数据';}else{echo 'Data';}?>  <?php if($num_pending != 0){echo '<span style="color:red;">('.$num_pending.')</span> + ';}?> <?php if($num_passed != 0){echo '<span style="color:green;">('.$num_passed.')</span>';}?></a>
                    	</div>
                    </div>
                    <div class="sectiontitle" style="background:rgba(0, 217, 109, 0.3);">
                    	<div style="float:left;width:calc(100% - 100px - 140px);"><a href="<?php echo base_url().'formtable/applyformforvolunteers'?>" target="_blank" style="color:black;">V001A - <?php if($this->langtype == '_ch'){echo '关怀义工申请表格';}else{echo 'Caring Volunteer Application Form';}?></a></div>
                    	<div style="float:left;width:100px;">
                    		<img onclick="toshow_qrcodearea('qrcode_applyformforvolunteers.png')" style="cursor:pointer;float:left;width:60px;height:60px;margin-left:20px;" src="<?php echo base_url().'themes/default/images/qrcode_applyformforvolunteers.png'?>"/>
                    	</div>
                    	<?php 
                    	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND is_closed = 0 AND status = 0";
                    	   $res = $this->db->query($sql)->row_array();
                    	   if(!empty($res)){if($res['numcount'] != ''){$num_pending = $res['numcount'];}else{$num_pending = 0;}}else{$num_pending = 0;}
                    	   
                    	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND is_closed = 0 AND status = 1";
                    	   $res = $this->db->query($sql)->row_array();
                    	   if(!empty($res)){if($res['numcount'] != ''){$num_passed = $res['numcount'];}else{$num_passed = 0;}}else{$num_passed = 0;}
                    	?>
                    	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:140px;height:60px;">
                    		<a href="<?php echo base_url().'admin/formtable_record_list/applyformforvolunteers'?>" style="float:left;width:100%;line-height:20px;font-size:15px;text-align:center;color:black;"><?php if($this->langtype == '_ch'){echo '数据';}else{echo 'Data';}?> <?php if($num_pending != 0){echo '<span style="color:red;">('.$num_pending.')</span> + ';}?> <?php if($num_passed != 0){echo '<span style="color:green;">('.$num_passed.')</span>';}?></a>
                    	</div>
                    </div>
                </div>
            	
            <?php }else{?>
            	<?php $this->load->view('common_entercode_admin')?>
            <?php }?>
    	</div>
    </div>
</div>
<script>
	function toshow_qrcodearea(qrcode){
		$('.qrcodearea_content').show();
		$('.qrcodepopupshow').html('<img style="float:left;width:100%;" src="<?php echo base_url()?>themes/default/images/'+qrcode+'">');
	}
	function toclose_qrcodearea(){
		$('.qrcodearea_content').hide();
		$('.qrcodepopupshow').html('');
	}
</script>
<div class="qrcodearea_content" style="display:none;position: fixed; z-index: 100; inset: 0px; background: rgba(0, 0, 0, 0.5);">
	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;height:100%;">
		<div style="float:left;width:320px;">
    		<div style="float:left;width:100%;"><img onclick="toclose_qrcodearea()" style="cursor:pointer;float:right;margin-bottom:10px;width:25px;height:25px;" src="https://www.marillaparissa.com.cn/themes/default/images/close_white.png"></div>
    		<div class="qrcodepopupshow" style="float:left;width:100%;">
    			
    		</div>
		</div>
	</div>
</div>
<?php $this->load->view('footer')?>