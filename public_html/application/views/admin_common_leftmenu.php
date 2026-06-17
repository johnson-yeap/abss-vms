<style>

</style>
<?php 
if(isset($_COOKIE[DB_PRE().'admininfo'])){
    $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
    $this->admin_id = $admininfo['admin_id'];
    
    //重新续期cookie
    $arr = array('admin_id'=>$admininfo['admin_id'], 'admin_code'=>$admininfo['admin_code']);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->admin_id = 0;
}

$menu = $this->session->userdata('menu');
?>
<style>
    .leftmenuarea{position:fixed;top:60px;bottom:0px;float:left;width:200px;background:#EFEFEF;}
    .leftmenuarea .innercontent{float:left;width:calc(100% - 30px);margin-left:15px;}
    .leftmenuarea .innercontent .list{float:left;width:100%;margin-top:15px;line-height:40px;text-indent:15px;border-radius:20px;}
    .leftmenuarea .innercontent .list_on{background:#DF9C4D;color:white;}
    .leftmenuarea .innercontent .list_on a{color:white;}
    .leftmenuarea .innercontent .list_off{background:#CCC;color:black;}
    .leftmenuarea .innercontent .list_off a{color:black;}
</style>
<div class="leftmenuarea">
	<div class="innercontent">
		<?php if($this->admin_id == 1){?>
    		<div class="list <?php if($menu == 'dashboard'){echo 'list_on';}else{echo 'list_off';}?>"><a href="<?php echo base_url().'admin';?>"><?php if($this->langtype == '_ch'){echo '仪表板';}else{echo 'Dashboard';}?></a></div>
        	<div class="list <?php if($menu == 'form'){echo 'list_on';}else{echo 'list_off';}?>"><a href="<?php echo base_url().'admin/formtable';?>"><?php if($this->langtype == '_ch'){echo '表单';}else{echo 'Form';}?></a></div>
        	<div class="list <?php if($menu == 'case'){echo 'list_on';}else{echo 'list_off';}?>"><a href="<?php echo base_url().'admin/case_pending';?>"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></a></div>
			<?php 
    			$sql = "
                    SELECT count(*) AS numcount
    
                    FROM ".DB_PRE()."form_list AS a
            
                    WHERE a.form_type = 'enrolmentform' AND a.status = 1 AND a.is_closed = 0 AND a.is_assigned = 1 AND a.is_finished = 0
                    AND a.datetime_last < ".(time() - 86400*2)."
            
                    ORDER BY a.form_id DESC
                ";
    			$res = $this->db->query($sql)->row_array();
    			if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
			?>
			<div class="list <?php if($menu == 'over48hrs'){echo 'list_on';}else{echo 'list_off';}?>"><a href="<?php echo base_url().'admin/case_over48hrs';?>"><?php if($this->langtype == '_ch'){echo '超过48小时未填写';}else{echo 'Over 48hrs';}?> <?php if($num_1 != 0){echo '<span style="color:red;font-weight:bold;">('.$num_1.')</span>';}?></a></div>
		<?php }else{?>
        	<div class="list <?php if($menu == 'form'){echo 'list_on';}else{echo 'list_off';}?>"><a href="<?php echo base_url().'admin/formtable';?>"><?php if($this->langtype == '_ch'){echo '表单';}else{echo 'Form';}?></a></div>
		<?php }?>
    </div>
</div>
