<?php $this->load->view('header_volunteer')?>
<script src="<?php echo base_url()?>lib/chartjs/Chart.bundle.js"></script>
<script src="<?php echo base_url()?>lib/chartjs/utils.js"></script>
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

<?php 
    $date_year = $this->input->get('date_year');
    $date_month = $this->input->get('date_month');
    
    if($date_year != ''){
        
    }else{
        $date_year = date('Y');
    }
    
    if($date_month != ''){
        
    }else{
        $date_month = date('m');
    }
    if($date_month == '02'){
        if($date_year % 4 == 0){
            $max_day = 29;
        }else{
            $max_day = 28;
        }
    }else{
        if($date_month == '01' || $date_month == '03' || $date_month == '05' || $date_month == '07' || $date_month == '08' || $date_month == '10' || $date_month == '12'){
            $max_day = 31;
        }else{
            $max_day = 30;
        }
    }
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
<div style="float:left;width:calc(100% - 0px);">
	<div style="float:left;width:100%;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php if($this->volunteer_id != ''){?>
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
                <div style="float:left;width:calc(100% - 20px);margin-left:10px;"><?php $this->load->view('volunteer_case_list')?></div>
            <?php }else{?>
            	<?php $this->load->view('common_entercode_volunteer')?>
            <?php }?>
    	</div>
    </div>
</div>
<?php $this->load->view('footer')?>