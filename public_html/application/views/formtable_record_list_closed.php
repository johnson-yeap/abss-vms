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
                <?php $this->load->view('formtable_record_list_closed_'.$form_type)?>
            <?php }else{?>
            	<?php $this->load->view('common_entercode_admin')?>
            <?php }?>
    	</div>
    </div>
</div>
<?php $this->load->view('footer')?>