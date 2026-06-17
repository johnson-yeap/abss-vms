<?php $this->load->view('header')?>
<script src="<?php echo base_url()?>lib/chartjs/Chart.bundle.js"></script>
<script src="<?php echo base_url()?>lib/chartjs/utils.js"></script>
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
<?php if($this->admin_code != ''){?>
	<?php $this->load->view('admin_common_leftmenu');?>
<?php }?>
<div style="float:left;<?php if($this->admin_code != ''){echo 'width:calc(100% - 200px);margin-left:200px;';}else{echo 'width:100%;margin-left:0px;';}?>">
	<div style="float:left;width:100%;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php if($this->admin_code != ''){?>
            	<style>
                .contentarea{float:left;width:calc(100% - 10px);padding:0px 5px;margin-top:10px;background:white;}
                .contentarea .title{position:relative;cursor:pointer;float:left;width:100%;font-size:16px;line-height:50px;border-bottom:1px solid #E5E7EB;}
                .contentarea .leftarea{float:left;width:calc(30% - 20px);margin-bottom:30px;}
                .contentarea .leftarea .grouptitle{float:left;width:100%;font-size:18px;font-weight:bold;margin-top:40px;}
                .contentarea .leftarea .itemlist{color:#0883AB;float:left;width:100%;font-size:14px;line-height:20px;margin-top:20px;}
                .contentarea .leftarea .itemlist .icon{float:left;width:16px;height:16px;margin-top:2px;}
                .contentarea .leftarea .itemlist .textname{float:left;margin-left:4px;}
                
                .contentarea .middlearea{float:left;width:calc(30% - 20px);margin-left:20px;margin-bottom:30px;}
                .contentarea .middlearea .grouptitle{float:left;width:100%;font-size:18px;font-weight:bold;margin-top:40px;}
                .contentarea .middlearea .itemlist{color:#0883AB;float:left;width:100%;font-size:14px;line-height:20px;margin-top:20px;}
                
                .contentarea .rightarea{float:left;width:40%;margin-left:20px;margin-bottom:30px;}
                .contentarea .rightarea .grouptitle{float:left;width:100%;font-size:18px;font-weight:bold;margin-top:40px;}
                .contentarea .rightarea .itemlist{color:#0883AB;float:left;width:100%;font-size:14px;line-height:20px;margin-top:20px;}
                
                </style>
            	<div class="contentarea">
            		<?php 
                    	$sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0";
                    	$allrecordlist = $this->db->query($sql)->result_array();
                	?>
                    <div class="title" style="background:#00D96D;color:white;text-indent:10px;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '关怀义工';}else{echo 'Caring Volunteer';}?></div>
                    <div style="float:left;width:calc(100% - 20px);padding:0px 10px;background:rgba(0, 217, 109, 0.1);">
                        <div class="leftarea">
                        	 <div class="grouptitle"><?php if($this->langtype == '_ch'){echo '关怀义工可提供家访的时间';}else{echo 'Caring Volunteer Availability';}?> <span style="color:#00D96D;">(Passed)</span></div>
                        	 <div class="itemlist">
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                    	<tr style="line-height:40px;">
                                        	<td width="90"></td>
                                    		<td colspan="2" align="center"><?php if($this->langtype == '_ch'){echo '每周可参与的时段';}else{echo 'The time slot that can be participated in each day';}?></td>
                                    	</tr>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td width="90"></td>
                                    		<td align="center">AM : 10–12pm</td>
                                    		<td align="center">PM : 2-4pm</td>
                                    	</tr>
                                    	<?php 
                                        	$num_9 = 0;
                                        	$num_10 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_9'] == 1){
                                    		            $num_9 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_10'] == 1){
                                    		            $num_10 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                        	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周一';}else{echo 'Monday';}?></td>
                                    		<td align="center"><?php echo $num_9?></td>
                                    		<td align="center"><?php echo $num_10?></td>
                                    	</tr>
                                    	<?php 
                                        	$num_11 = 0;
                                        	$num_12 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_11'] == 1){
                                    		            $num_11 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_12'] == 1){
                                    		            $num_12 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                        	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周二';}else{echo 'Tuesday';}?></td>
                                    		<td align="center"><?php echo $num_11?></td>
                                    		<td align="center"><?php echo $num_12?></td>
                                    	</tr>
                                    	<?php 
                                        	$num_13 = 0;
                                        	$num_14 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_13'] == 1){
                                    		            $num_13 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_14'] == 1){
                                    		            $num_14 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                        	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周三';}else{echo 'Wednesday';}?></td>
                                    		<td align="center"><?php echo $num_13?></td>
                                    		<td align="center"><?php echo $num_14?></td>
                                    	</tr>
                                    	<?php 
                                        	$num_15 = 0;
                                        	$num_16 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_15'] == 1){
                                    		            $num_15 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_16'] == 1){
                                    		            $num_16 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                        	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周四';}else{echo 'Thursday';}?></td>
                                    		<td align="center"><?php echo $num_15?></td>
                                    		<td align="center"><?php echo $num_16?></td>
                                    	</tr>
                                    	<?php 
                                        	$num_17 = 0;
                                        	$num_18 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_17'] == 1){
                                    		            $num_17 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_18'] == 1){
                                    		            $num_18 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                        	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周五';}else{echo 'Friday';}?></td>
                                    		<td align="center"><?php echo $num_17?></td>
                                    		<td align="center"><?php echo $num_18?></td>
                                    	</tr>
                                    	<?php 
                                        	$num_19 = 0;
                                        	$num_20 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_19'] == 1){
                                    		            $num_19 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_20'] == 1){
                                    		            $num_20 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                        	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周六';}else{echo 'Saturday';}?></td>
                                    		<td align="center"><?php echo $num_19?></td>
                                    		<td align="center"><?php echo $num_20?></td>
                                    	</tr>
                                    	<?php 
                                        	$num_21 = 0;
                                        	$num_22 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_21'] == 1){
                                    		            $num_21 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_22'] == 1){
                                    		            $num_22 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                        	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周日';}else{echo 'Sunday';}?></td>
                                    		<td align="center"><?php echo $num_21?></td>
                                    		<td align="center"><?php echo $num_22?></td>
                                    	</tr>
                                    </tbody></table>
                                </div>
                        	 </div>
                        	
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '害怕动物吗？';}else{echo 'Are You In Fear of Animals？';}?> <span style="color:#00D96D;">(Passed)</span></div>
                        	<div class="itemlist">
                        		
                        		
                        		
                        		
    				<?php 
        				$num_1 = 0;
        				$num_2 = 0;
                		if(!empty($allrecordlist)){
                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                		        if($allrecordlist[$aaarrr]['select_id_8'] == 1){
                		            $num_1 += 1;
                		        }
                		        if($allrecordlist[$aaarrr]['select_id_8'] == 2){
                		            $num_2 += 1;
                		        }
                		    }
                		}
                  	?>
                    <div style="float:left;width:calc(100% - 20px);margin-left:0px;">
                            																																																																																																													
                        <div style="float: left;width:100%;">
                        	<div style="float: left;width:100%;">
                        		<div style="float: left;width:calc(100% - 40px - 30px);margin-left:40px;line-height:25px;text-align:center;">
									<div style="float: left;width:40px;background:#FF6384;color:white;">&nbsp;</div>
                                	<div style="float: left;margin-left:10px;">Yes: <?php echo $num_1;?></div>
                                	<div style="float: left;width:40px;background:rgba(54, 162, 235,1);color:white;margin-left:20px;">&nbsp;</div>
                                	<div style="float: left;margin-left:10px;">No: <?php echo $num_2;?></div>
                            	</div>
                        	</div>
                        	<div style="display:none;float: left;width:100%;">
                            	<canvas id="myChart_1" width="420" height="300" style="display: block; box-sizing: border-box;height:300px; width: 420px;"></canvas>
                        	</div>
                        	<div style="float: left;width:100%;">
                        	</div>
                        	
                        </div>
                        
                    	
                    	    																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																											    <div style="float: left;width:100%;">
                    	</div>
                    	
                        	
                        	
                        	
                        	
                    	    																																				    <div style="float: left;width:100%;">
                    	</div>
                    	
                        	
                        	
                        	
                        	
                        	
                    	<div style="float: left;width:100%;">
                    	</div>
                    	<div style="float:left;width:100%;height:15px;">&nbsp;</div>
                    </div>
                    <script>
                        var arr = [{'product_id': 1, 'product_name_en': '<?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?>', 'product_viewnum': <?php echo $num_1;?>}, {'product_id': 2, 'product_name_en': '<?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?>', 'product_viewnum': <?php echo $num_2;?>}, {'product_id': 3, 'product_name_en': '3', 'product_viewnum': 3}, {'product_id': 4, 'product_name_en': '4', 'product_viewnum': 4}, {'product_id': 5, 'product_name_en': '5', 'product_viewnum': 5}];
            			var a = new Array();
                    	var b = new Array();
                    	for(var i= 0;i < 2;i++){
                    		a.push(arr[i].product_name_en)
                    		b.push(arr[i].product_viewnum)
                    	}
                    	
                    	var ctx = document.getElementById("myChart_1");
                    	var myChart_1 = new Chart(ctx, {
                    	    type: 'doughnut',
                    	    data: {
                    	        labels: a,
                    	        datasets: [{
                    	            label: '# of Votes',
                    	            data: b,
                    	            backgroundColor: [
                    	                'rgba(255, 99, 132, 1)',
                    	                'rgba(54, 162, 235, 1)',
                    	                'rgba(255, 206, 86, 1)',
                    	                'rgba(75, 192, 192, 1)',
                    	                'rgba(153, 102, 255, 1)',
                    	                'rgba(255, 159, 64, 1)'
                    	            ],
                    	            borderColor: [
                    	                'rgba(255,99,132,1)',
                    	                'rgba(54, 162, 235, 1)',
                    	                'rgba(255, 206, 86, 1)',
                    	                'rgba(75, 192, 192, 1)',
                    	                'rgba(153, 102, 255, 1)',
                    	                'rgba(255, 159, 64, 1)'
                    	            ],
                    	            borderWidth: 1
                    	        }]
                    	    },
                    	    options: {
                    	        scales: {
                    	            yAxes: [{
                    	                ticks: {
                    	                    beginAtZero:true
                    	                }
                    	            }]
                    	        }
                    	    }
                    	});
                    </script>
                        	
                        	
                        	
                        	
                        	
                        	
                        		
                        		
                        		
                        		
                        		
                        		
                        		
                        	</div>
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '有技能或才能？';}else{echo 'skills or talents？';}?> <span style="color:#00D96D;">(Passed)</span></div>
                        	<div class="itemlist">
                        		<?php 
                    				$num_1 = 0;
                    				$num_2 = 0;
                            		if(!empty($allrecordlist)){
                            		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                            		        if($allrecordlist[$aaarrr]['textarea_1'] != ''){
                            		            $num_1 += 1;
                            		        }
                            		        if($allrecordlist[$aaarrr]['textarea_1'] == ''){
                            		            $num_2 += 1;
                            		        }
                            		    }
                            		}
                              	?>
                                <div style="float:left;width:calc(100% - 20px);margin-left:0px;">
                                    <div style="float: left;width:100%;">
                                    	<div style="float: left;width:100%;">
                                    		<div style="float: left;width:calc(100% - 40px - 30px);margin-left:40px;line-height:25px;text-align:center;">
            									<div style="float: left;width:40px;background:#FF6384;color:white;">&nbsp;</div>
                                            	<div style="float: left;margin-left:10px;">Yes: <?php echo $num_1;?></div>
                                            	<div style="float: left;width:40px;background:rgba(54, 162, 235,1);color:white;margin-left:20px;">&nbsp;</div>
                                            	<div style="float: left;margin-left:10px;">No: <?php echo $num_2;?></div>
                                        	</div>
                                    	</div>
                                    </div>
                                	<div style="float:left;width:100%;height:15px;">&nbsp;</div>
                                </div>
                        	</div>
                        </div>
                        <div class="middlearea">
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '关怀义工和司机';}else{echo 'Caring Volunteers and Drivers';}?> <span style="color:#00D96D;">(Passed)</span></div>
                        	<div style="float:left;width:100%;border: 1px solid #E5E7EB;margin-top:20px;">
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;">
                                	<div style="float:left;width:100%;font-size:14px;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '注册数量';}else{echo 'Signups Numbers';}?></div>
                            	</div>
                            	<div style="float:left;width:100%;text-align:center;height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:25%;font-size:14px;">&nbsp;</div>
                                	<div style="float:left;width:25%;font-size:14px;font-weight:bold;line-height:18px;height:40px;display: flex;flex-direction: row;justify-content: center;align-items: center;"><?php if($this->langtype == '_ch'){echo '义工';}else{echo 'Volunteers';}?></div>
                            		<div style="float:left;width:25%;font-size:14px;font-weight:bold;line-height:18px;height:40px;display: flex;flex-direction: row;justify-content: center;align-items: center;"><?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Drivers';}?></div>
                            		<div style="float:left;width:25%;font-size:14px;font-weight:bold;line-height:18px;height:40px;display: flex;flex-direction: row;justify-content: center;align-items: center;"><?php if($this->langtype == '_ch'){echo '义工和司机';}else{echo 'Volunteers and Drivers';}?></div>
                            	</div>
                            	<?php 
                            	   $start_time = strtotime(date('Y-m-d').' 00:00:00');
                            	   $end_time = strtotime(date('Y-m-d').' 23:59:59');
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                            	   
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:25%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '今天';}else{echo 'Today';}?></div>
                                	<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_2;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_3;?></div>
                            	</div>
                            	<?php 
                            	   $start_time = strtotime(date('Y').'-01-01 00:00:00');
                            	   $end_time = strtotime(date('Y').'-03-31 23:59:59');
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                            	   
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:25%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '1-3月';}else{echo 'Jan - Mar';}?></div>
                                	<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_2;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_3;?></div>
                            	</div>
                            	<?php 
                            	   $start_time = strtotime(date('Y').'-04-01 00:00:00');
                            	   $end_time = strtotime(date('Y').'-06-30 23:59:59');
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                            	   
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:25%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '4-6月';}else{echo 'Apr - Jun';}?></div>
                                	<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_2;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_3;?></div>
                            	</div>
                            	<?php 
                            	   $start_time = strtotime(date('Y').'-07-01 00:00:00');
                            	   $end_time = strtotime(date('Y').'-09-30 23:59:59');
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                            	   
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:25%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '7-9月';}else{echo 'Jul - Sep';}?></div>
                                	<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_2;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_3;?></div>
                            	</div>
                            	<?php 
                            	   $start_time = strtotime(date('Y').'-10-01 00:00:00');
                            	   $end_time = strtotime(date('Y').'-12-31 23:59:59');
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                            	   
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3 AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:25%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '10-12月';}else{echo 'Oct - Dec';}?></div>
                                	<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_2;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_3;?></div>
                            	</div>
                            	<?php 
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1";
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	   
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2";
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                            	   
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3";
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;">
                                	<div style="float:left;width:25%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '所有时间';}else{echo 'All Time';}?></div>
                                	<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_2;?></div>
                            		<div style="float:left;width:25%;font-size:14px;;font-weight:bold;"><?php echo $num_3;?></div>
                            	</div>
                        	</div>
                        	<!-- 
                        	<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;margin-top:10px;">
                        		<div style="float:left;background:#0D72AE;color:white;line-height:40px;padding:0px 15px;border-radius:4px;font-size:14px;">View More</div>
                        	</div>
                        	 -->
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '关怀义工性别';}else{echo 'Caring Volunteer Gender';}?> <span style="color:#00D96D;">(Passed)</span></div>
                        	<div style="float:left;width:100%;margin-top:20px;">
                            	<div style="float: left;width:100%;height:250px;">
                                	<canvas id="bar_1" style="width:100%;height:100%;"></canvas>
                            	</div>
                            	<div style="float: left;width:100%;">
                            		<div style="float: left;width:calc(100% - 40px - 30px);margin-left:40px;line-height:30px;text-align:center;">
    									<div style="float: left;width:33.33%;background:rgba(54, 162, 235,1);color:white;">
        									<?php if($this->langtype == '_ch'){echo '义工';}else{echo 'Volunteer';}?>
                                    	</div>
                                    	<div style="float: left;width:33.33%;background:rgba(38, 255, 255, 1);color:black;">
        									<?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?>
                                    	</div>
                                    	<div style="float: left;width:33.33%;background:rgba(153, 102, 255,1);color:white;">
        									<?php if($this->langtype == '_ch'){echo '义工和司机';}else{echo 'Volunteer and Driver';}?>
                                    	</div>
                                	</div>
                            	</div>
                            	<script>
                                	var a_3 = new Array();
                            		var b_3 = new Array();

                            		<?php 
                                	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1 AND select_id_1 = 1";
                                	   $res = $this->db->query($sql)->row_array();
                                	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                                	
                                	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 1 AND select_id_1 = 2";
                                	   $res = $this->db->query($sql)->row_array();
                                	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                                	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?>');
                        			b_3.push(<?php echo $num_1?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?>');
                        			b_3.push(<?php echo $num_2?>);
                        

                        			<?php 
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2 AND select_id_1 = 1";
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                                  	
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 2 AND select_id_1 = 2";
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_4 = $res['numcount'];}else{$num_4 = 0;}}else{$num_4 = 0;}
                                  	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?>');
                        			b_3.push(<?php echo $num_3?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?>');
                        			b_3.push(<?php echo $num_4?>);
                        
                        			<?php 
                                	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3 AND select_id_1 = 1";
                                	   $res = $this->db->query($sql)->row_array();
                                	   if(!empty($res)){if($res['numcount'] != ''){$num_5 = $res['numcount'];}else{$num_5 = 0;}}else{$num_5 = 0;}
                                	
                                	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND select_id_6 = 3 AND select_id_1 = 2";
                                	   $res = $this->db->query($sql)->row_array();
                                	   if(!empty($res)){if($res['numcount'] != ''){$num_6 = $res['numcount'];}else{$num_6 = 0;}}else{$num_6 = 0;}
                                	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?>');
                        			b_3.push(<?php echo $num_5?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?>');
                        			b_3.push(<?php echo $num_6?>);
    			
                            		var ctx = document.getElementById("bar_1");
                            		var myBar_1 = new Chart(ctx, {
                            		    type: 'bar',
                            		    data: {
                            		        labels: a_3,
                            		        datasets: [{
                            		            label: '<?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?>',
                            		            data: b_3,
                            		            backgroundColor: [
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(255, 99, 132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderColor: [
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(255,99,132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderWidth: 1
                            		        }]
                            		    },
                            		    options: {
                            		    	title: {
                            		            display: false, // 显示标题
                            		            text: '示例柱形图标题' // 标题文本
                            		        },
                            		    	legend: {
                            		    	    display: false
                            		    	},
                        			        scales: {
                        			             xAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ],
                                                yAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ]
                        			        }
                        			    }
                        //     		    options: {
                        //     		    	legend: {
                        //     		    	    display: false
                        //     		    	},
                        //     		        scales: {
                        //     		            y: {
                        //     		                beginAtZero: true // 设置y轴从0开始
                        //     		            }
                        //     		        }
                        //     		    }
                            		});
                            	</script>
                        	</div>
                        </div>
                        <div class="rightarea">
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '语言能力';}else{echo 'Language Skills';}?> <span style="color:#00D96D;">(Passed)</span></div>
                        	<div style="float:left;width:100%;margin-top:20px;">
                            	<div style="float: left;width:100%;height:250px;">
                                	<canvas id="bar_11" style="width:100%;height:100%;"></canvas>
                            	</div>
                            	<div style="float: left;width:100%;">
                            		<div style="float: left;width:calc(100% - 40px - 20px);margin-left:40px;line-height:30px;text-align:center;">
    									<div style="float: left;width:50%;background:rgba(54, 162, 235,1);color:white;">
        									<?php if($this->langtype == '_ch'){echo '义工';}else{echo 'Volunteer';}?>
                                    	</div>
                                    	<div style="float: left;width:50%;background:rgba(38, 255, 255, 1);color:black;">
        									<?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?>
                                    	</div>
                                	</div>
                            	</div>
                            	<script>
                                	var a_3 = new Array();
                            		var b_3 = new Array();

                            		<?php 
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 1";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND (select_id_6 = 1 OR select_id_6 = 3) AND ".$subsql;
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                                  	
                                  	   $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 2";} $subsql .= ")";
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND (select_id_6 = 1 OR select_id_6 = 3) AND ".$subsql;
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_2 = $res['numcount'];}else{$num_2 = 0;}}else{$num_2 = 0;}
                                  	   
                                  	   $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 3";} $subsql .= ")";
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND (select_id_6 = 1 OR select_id_6 = 3) AND ".$subsql;
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_3 = $res['numcount'];}else{$num_3 = 0;}}else{$num_3 = 0;}
                                  	   
                                  	   $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 4";} $subsql .= ")";
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 1 AND is_closed = 0 AND (select_id_6 = 1 OR select_id_6 = 3) AND ".$subsql;
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_4 = $res['numcount'];}else{$num_4 = 0;}}else{$num_4 = 0;}
                                  	   
                                  	   $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 5";} $subsql .= ")";
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 1 OR select_id_6 = 3) AND ".$subsql;
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_5 = $res['numcount'];}else{$num_5 = 0;}}else{$num_5 = 0;}
                                  	   
                                  	   $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 6";} $subsql .= ")";
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 1 OR select_id_6 = 3) AND ".$subsql;
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_6 = $res['numcount'];}else{$num_6 = 0;}}else{$num_6 = 0;}
                                  	   
                                  	   $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 7";} $subsql .= ")";
                                  	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 1 OR select_id_6 = 3) AND ".$subsql;
                                  	   $res = $this->db->query($sql)->row_array();
                                  	   if(!empty($res)){if($res['numcount'] != ''){$num_7 = $res['numcount'];}else{$num_7 = 0;}}else{$num_7 = 0;}
                                  	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '中文';}else{echo 'Chinese';}?>');
                        			b_3.push(<?php echo $num_1?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '英语';}else{echo 'English';}?>');
                        			b_3.push(<?php echo $num_2?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Teochew';}else{echo 'Teochew';}?>');
                        			b_3.push(<?php echo $num_3?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Cantonese';}else{echo 'Cantonese';}?>');
                        			b_3.push(<?php echo $num_4?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Hakka';}else{echo 'Hakka';}?>');
                        			b_3.push(<?php echo $num_5?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Hokkien';}else{echo 'Hokkien';}?>');
                        			b_3.push(<?php echo $num_6?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '其他';}else{echo 'Others';}?>');
                        			b_3.push(<?php echo $num_7?>);
                        

                                    <?php 
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 1";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 2 OR select_id_6 = 3) AND ".$subsql;
                                        $res = $this->db->query($sql)->row_array();
                                        if(!empty($res)){if($res['numcount'] != ''){$num_8 = $res['numcount'];}else{$num_8 = 0;}}else{$num_8 = 0;}
                                        
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 2";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 2 OR select_id_6 = 3) AND ".$subsql;
                                        $res = $this->db->query($sql)->row_array();
                                        if(!empty($res)){if($res['numcount'] != ''){$num_9 = $res['numcount'];}else{$num_9 = 0;}}else{$num_9 = 0;}
                                        
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 3";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 2 OR select_id_6 = 3) AND ".$subsql;
                                        $res = $this->db->query($sql)->row_array();
                                        if(!empty($res)){if($res['numcount'] != ''){$num_10 = $res['numcount'];}else{$num_10 = 0;}}else{$num_10 = 0;}
                                        
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 4";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 2 OR select_id_6 = 3) AND ".$subsql;
                                        $res = $this->db->query($sql)->row_array();
                                        if(!empty($res)){if($res['numcount'] != ''){$num_11 = $res['numcount'];}else{$num_11 = 0;}}else{$num_11 = 0;}
                                        
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 5";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 2 OR select_id_6 = 3) AND ".$subsql;
                                        $res = $this->db->query($sql)->row_array();
                                        if(!empty($res)){if($res['numcount'] != ''){$num_12 = $res['numcount'];}else{$num_12 = 0;}}else{$num_12 = 0;}
                                        
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 6";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 2 OR select_id_6 = 3) AND ".$subsql;
                                        $res = $this->db->query($sql)->row_array();
                                        if(!empty($res)){if($res['numcount'] != ''){$num_13 = $res['numcount'];}else{$num_13 = 0;}}else{$num_13 = 0;}
                                        
                                        $subsql = "(";for($ccc = 1; $ccc <= 10; $ccc++){if($ccc != 1){$subsql .= " OR ";} $subsql .= " checkbox_id_2_".$ccc." = 7";} $subsql .= ")";
                                        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND (select_id_6 = 2 OR select_id_6 = 3) AND ".$subsql;
                                        $res = $this->db->query($sql)->row_array();
                                        if(!empty($res)){if($res['numcount'] != ''){$num_14 = $res['numcount'];}else{$num_14 = 0;}}else{$num_14 = 0;}
                                    ?>
                        
									a_3.push('<?php if($this->langtype == '_ch'){echo '中文';}else{echo 'Chinese';}?>');
                        			b_3.push(<?php echo $num_8?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '英语';}else{echo 'English';}?>');
                        			b_3.push(<?php echo $num_9?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Teochew';}else{echo 'Teochew';}?>');
                        			b_3.push(<?php echo $num_10?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Teochew';}else{echo 'Teochew';}?>');
                        			b_3.push(<?php echo $num_11?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Teochew';}else{echo 'Teochew';}?>');
                        			b_3.push(<?php echo $num_12?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Teochew';}else{echo 'Teochew';}?>');
                        			b_3.push(<?php echo $num_13?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Teochew';}else{echo 'Teochew';}?>');
                        			b_3.push(<?php echo $num_14?>);
    			
                            		var ctx = document.getElementById("bar_11");
                            		var myBar_11 = new Chart(ctx, {
                            		    type: 'bar',
                            		    data: {
                            		        labels: a_3,
                            		        datasets: [{
                            		            label: '<?php if($this->langtype == '_ch'){echo '语言技能';}else{echo 'Language Skills';}?>',
                            		            data: b_3,
                            		            backgroundColor: [
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(255, 99, 132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(255, 99, 132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            ],
                            		            borderColor: [
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(255,99,132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(255,99,132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            ],
                            		            borderWidth: 1
                            		        }]
                            		    },
                            		    options: {
                            		    	title: {
                            		            display: false, // 显示标题
                            		            text: '示例柱形图标题' // 标题文本
                            		        },
                            		    	legend: {
                            		    	    display: false
                            		    	},
                        			        scales: {
                        			             xAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ],
                                                yAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ]
                        			        }
                        			    }
                        //     		    options: {
                        //     		    	legend: {
                        //     		    	    display: false
                        //     		    	},
                        //     		        scales: {
                        //     		            y: {
                        //     		                beginAtZero: true // 设置y轴从0开始
                        //     		            }
                        //     		        }
                        //     		    }
                            		});
                            	</script>
                        	</div>
                        	
                        	 <div class="grouptitle"><?php if($this->langtype == '_ch'){echo '您能承诺至少 3 个月吗？';}else{echo 'Are you able to commit to a minimum of 3 months?';}?> <span style="color:#00D96D;">(Passed)</span></div>
                        	 <div class="itemlist">
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                                	<?php 
                                		$num_1 = 0;
                                		$num_2 = 0;
                                		if(!empty($allrecordlist)){
                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                		        if($allrecordlist[$aaarrr]['select_id_7'] == 1){
                                		            $num_1 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['select_id_7'] == 2){
                                		            $num_2 += 1;
                                		        }
                                		    }
                                		}
                                  	?>
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                        	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                        		<td align="center" style="color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></td>
                                        		<td align="center" style="color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></td>
                                        	</tr>
                                        	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                        		<td align="center"><?php echo $num_1;?></td>
                                        		<td align="center"><?php echo $num_2;?></td>
                                        	</tr>
                                        </tbody>
                                    </table>
                                </div>
                        	 </div>
                        	 
                        	 
                        	 
                        	 <?php 
                            	$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 0 AND is_closed = 0";
                            	$res = $this->db->query($sql)->row_array();
                            	if(!empty($res)){if($res['numcount'] != ''){$num_pending = $res['numcount'];}else{$num_pending = 0;}}else{$num_pending = 0;}
                            	
                            	$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND status = 2 AND is_closed = 0";
                            	$res = $this->db->query($sql)->row_array();
                            	if(!empty($res)){if($res['numcount'] != ''){$num_denied = $res['numcount'];}else{$num_denied = 0;}}else{$num_denied = 0;}
                            	
                            	$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND is_closed = 1";
                            	$res = $this->db->query($sql)->row_array();
                            	if(!empty($res)){if($res['numcount'] != ''){$num_closed = $res['numcount'];}else{$num_closed = 0;}}else{$num_closed = 0;}
                            	
                          	?>
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Number';}?></div>
                        	<div class="itemlist">
                                <div style="float:left;width:calc(100% - 20px);margin-left:0px;">
                                	<div style="float: left;width:100%;line-height:25px;text-align:center;">
    									<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:red;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                        	<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '待批准';}else{echo 'Pending';}?>: <?php echo $num_pending;?></div>
                                    	</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:green;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                    		<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '已通过';}else{echo 'Passed';}?>: <?php echo count($allrecordlist)?></div>
                                    	</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:orange;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                    		<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '已拒绝';}else{echo 'Denied';}?>: <?php echo $num_denied;?></div>
                                    	</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:gray;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                    		<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '已关闭';}else{echo 'Closed';}?>: <?php echo $num_closed;?></div>
                                    	</div>
                                	</div>
                                </div>
                    			<div style="float:left;width:100%;height:15px;">&nbsp;</div>
                    		</div>
                        	
                        	
                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                
                <div class="contentarea">
                    <div class="title" style="background:#36A2EB;color:white;text-indent:10px;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '申请接受关怀 (患者数据)';}else{echo 'Enrollment (Patient Data)';}?></div>
                    <div style="float:left;width:calc(100% - 20px);padding:0px 10px;background:rgba(54, 162, 235, 0.1);">
                        <div class="leftarea">
                        	<?php 
                            	$sql = "SELECT * FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = 'enrolmentform'";
                            	$allrecordlist = $this->db->query($sql)->result_array();
                        	?>
                        	 <div class="grouptitle"><?php if($this->langtype == '_ch'){echo '有没有非佛教徒的家庭成员？ <span style="color:#36A2EB;">(进行中)</span>';}else{echo 'Any Family Members Who Are NonBuddhism? <span style="color:#36A2EB;">(In Progress)</span>';}?></div>
                        	 <div class="itemlist">
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td align="center" style="color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></td>
                                    		<td align="center" style="color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></td>
                                    	</tr>
                                    	<?php 
                                    		$num_1 = 0;
                                    		$num_2 = 0;
                                    		$num_3 = 0;
                                    		if(!empty($allrecordlist)){
                                    		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                    		        if($allrecordlist[$aaarrr]['select_id_6'] == 1 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                    		            $num_1 += 1;
                                    		        }
                                    		        if($allrecordlist[$aaarrr]['select_id_6'] == 2 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                    		            $num_2 += 1;
                                    		        }
                                    		    }
                                    		}
                                      	?>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                    		<td align="center"><?php echo $num_1?></td>
                                    		<td align="center"><?php echo $num_2?></td>
                                    	</tr>
                                    </tbody></table>
                                </div>
                        	 </div>
                        	 
                        	 
                        	 <div class="grouptitle"><?php if($this->langtype == '_ch'){echo '需要哪方面的帮助 <span style="color:#36A2EB;">(进行中)</span>';}else{echo 'Area of Help <span style="color:#36A2EB;">(In Progress)</span>';}?></div>
                        	 <div class="itemlist">
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                        	 		<?php 
                                		$num_1 = 0;
                                		$num_2 = 0;
                                		$num_3 = 0;
                                		$num_4 = 0;
                                		if(!empty($allrecordlist)){
                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_2_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_3_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_4_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_5_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_6_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_7_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_8_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_9_last'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_10_last'] == 1) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0 && $allrecordlist[$aaarrr]['is_assigned'] == 1){
                                		            $num_1 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_2_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_3_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_4_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_5_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_6_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_7_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_8_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_9_last'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_10_last'] == 2) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0 && $allrecordlist[$aaarrr]['is_assigned'] == 1){
                                		            $num_2 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_2_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_3_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_4_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_5_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_6_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_7_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_8_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_9_last'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_10_last'] == 3) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0 && $allrecordlist[$aaarrr]['is_assigned'] == 1){
                                		            $num_3 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1_last'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_2_last'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_3_last'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_4_last'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_5_last'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_6'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_7'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_8'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_9'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_10'] == 4) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0 && $allrecordlist[$aaarrr]['is_assigned'] == 1){
                                		            $num_4 += 1;
                                		        }
                                		    }
                                		}
                                  	?>
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '家访 提供佛教情感支持';}else{echo 'Home visit to provide Buddhism emotional support';}?></td>
                                    		<td width="60" align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_1?></td>
                                    	</tr>
                                    	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '家访包括提供助念（10 到 30 分钟） 以及介绍联络人提供佛教葬礼仪式的协助';}else{echo 'Home visits include prayer assistance (10 to 30 minutes) and a referral to a contact person to assist with Buddhist funeral rites';}?></td>
                                    		<td align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_2?></td>
                                    	</tr>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '电话慰问';}else{echo 'Phone Follow Up';}?></td>
                                    		<td width="60" align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_3?></td>
                                    	</tr>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '无需跟进';}else{echo 'No Follow Up Required';}?></td>
                                    		<td width="60" align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_4?></td>
                                    	</tr>
                                    </tbody></table>
                                </div>
                        	 </div>
                        	 
                        	
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '你家里有动物吗？ <span style="color:#36A2EB;">(进行中)</span>';}else{echo 'Do You Have Animals In Your Home? <span style="color:#36A2EB;">(In Progress)</span>';}?></div>
                        	<div class="itemlist">
                        		
                        		
                        	<?php 
                            	$num_1 = 0;
                        		$num_2 = 0;
                        		if(!empty($allrecordlist)){
                        		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                        		        if($allrecordlist[$aaarrr]['select_id_7'] == 1 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                        		            $num_1 += 1;
                        		        }
                        		        if($allrecordlist[$aaarrr]['select_id_7'] == 2 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                        		            $num_2 += 1;
                        		        }
                        		    }
                        		}
                          	?>
                    <div style="float:left;width:calc(100% - 20px);margin-left:0px;">
                            																																																																																																													
                        <div style="float: left;width:100%;">
                        	<div style="float: left;width:100%;">
                        		<div style="float: left;width:calc(100% - 40px - 30px);margin-left:40px;line-height:25px;text-align:center;">
									<div style="float: left;width:40px;background:#FF6384;color:white;">&nbsp;</div>
                                	<div style="float: left;margin-left:10px;">Yes: <?php echo $num_1;?></div>
                                	<div style="float: left;width:40px;background:rgba(54, 162, 235,1);color:white;margin-left:20px;">&nbsp;</div>
                                	<div style="float: left;margin-left:10px;">No: <?php echo $num_2;?></div>
                            	</div>
                        	</div>
                        	<div style="display:none;float: left;width:100%;">
                            	<canvas id="myChart_2" width="420" height="300" style="display: block; box-sizing: border-box; height: 300px; width: 420px;"></canvas>
                        	</div>
                        	<div style="float: left;width:100%;">
                        	</div>
                        	
                        </div>
                        
                    	
                    	    																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																											    <div style="float: left;width:100%;">
                    	</div>
                    	
                        	
                        	
                        	
                        	
                    	    																																				    <div style="float: left;width:100%;">
                    	</div>
                    	
                        	
                        	
                        	
                        	
                        	
                    	<div style="float: left;width:100%;">
                    	</div>
                    	<div style="float:left;width:100%;height:15px;">&nbsp;</div>
                    </div>
                    <script>
                        var arr = [{'product_id': 1, 'product_name_en': '<?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?>', 'product_viewnum': <?php echo $num_1;?>}, {'product_id': 2, 'product_name_en': '<?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?>', 'product_viewnum': <?php echo $num_2;?>}, {'product_id': 3, 'product_name_en': '3', 'product_viewnum': 3}, {'product_id': 4, 'product_name_en': '4', 'product_viewnum': 4}, {'product_id': 5, 'product_name_en': '5', 'product_viewnum': 5}];
            			var a = new Array();
                    	var b = new Array();
                    	for(var i= 0;i < 2;i++){
                    		a.push(arr[i].product_name_en)
                    		b.push(arr[i].product_viewnum)
                    	}
                    	
                    	var ctx = document.getElementById("myChart_2");
                    	var myChart_2 = new Chart(ctx, {
                    	    type: 'doughnut',
                    	    data: {
                    	        labels: a,
                    	        datasets: [{
                    	            label: '# of Votes',
                    	            data: b,
                    	            backgroundColor: [
                    	                'rgba(255, 99, 132, 1)',
                    	                'rgba(54, 162, 235, 1)',
                    	                'rgba(255, 206, 86, 1)',
                    	                'rgba(75, 192, 192, 1)',
                    	                'rgba(153, 102, 255, 1)',
                    	                'rgba(255, 159, 64, 1)'
                    	            ],
                    	            borderColor: [
                    	                'rgba(255,99,132,1)',
                    	                'rgba(54, 162, 235, 1)',
                    	                'rgba(255, 206, 86, 1)',
                    	                'rgba(75, 192, 192, 1)',
                    	                'rgba(153, 102, 255, 1)',
                    	                'rgba(255, 159, 64, 1)'
                    	            ],
                    	            borderWidth: 1
                    	        }]
                    	    },
                    	    options: {
                    	        scales: {
                    	            yAxes: [{
                    	                ticks: {
                    	                    beginAtZero:true
                    	                }
                    	            }]
                    	        }
                    	    }
                    	});
                    </script>
                        	
                        	
                        	
                        	
                        	
                        	
                        		
                        		
                        		
                        		
                        		
                        		
                        		
                        	</div>
                        	
                        	
                        	
                        	
                        	
                        	
                        	
                        	
                        	
                        	
                        	
                        	
                        	
                        </div>
                        <div class="middlearea">
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '语言能力 <span style="color:#36A2EB;">(进行中)</span>';}else{echo 'Language Skills <span style="color:#36A2EB;">(In Progress)</span>';}?></div>
                        	<div style="float:left;width:100%;margin-top:20px;">
                            	<div style="float: left;width:100%;height:250px;">
                                	<canvas id="bar_3" style="width:100%;height:100%;"></canvas>
                            	</div>
                            	<div style="float: left;width:100%;">
                            		<div style="float: left;width:calc(100% - 40px - 20px);margin-left:40px;line-height:30px;text-align:center;">
    									<div style="float: left;width:50%;background:rgba(54, 162, 235,1);color:white;">
        									<?php if($this->langtype == '_ch'){echo '接受关怀';}else{echo 'Enrolment';}?>
                                    	</div>
                                	</div>
                            	</div>
                            	<?php //echo '<pre>';print_r($allrecordlist);exit;?>
                            	<script>
                                	var a_3 = new Array();
                            		var b_3 = new Array();
                            		<?php 
                                		$num_1 = 0;
                                		$num_2 = 0;
                                		$num_3 = 0;
                                		$num_4 = 0;
                                		$num_5 = 0;
                                		$num_6 = 0;
                                		$num_7 = 0;
                                		if(!empty($allrecordlist)){
                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_2_1'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_2'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_3'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_4'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_5'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_6'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_7'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_8'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_9'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_2_10'] == 1) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_1 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_2_1'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_2'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_3'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_4'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_5'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_6'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_7'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_8'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_9'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_2_10'] == 2) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_2 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_2_1'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_2'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_3'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_4'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_5'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_6'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_7'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_8'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_9'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_2_10'] == 3) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_3 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_2_1'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_2'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_3'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_4'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_5'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_6'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_7'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_8'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_9'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_2_10'] == 4) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_4 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_2_1'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_2'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_3'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_4'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_5'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_6'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_7'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_8'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_9'] == 5 || $allrecordlist[$aaarrr]['checkbox_id_2_10'] == 5) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_5 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_2_1'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_2'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_3'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_4'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_5'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_6'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_7'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_8'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_9'] == 6 || $allrecordlist[$aaarrr]['checkbox_id_2_10'] == 6) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_6 += 1;
                                		        }
                                		        if(($allrecordlist[$aaarrr]['checkbox_id_2_1'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_2'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_3'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_4'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_5'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_6'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_7'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_8'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_9'] == 7 || $allrecordlist[$aaarrr]['checkbox_id_2_10'] == 7) && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_7 += 1;
                                		        }
                                		    }
                                		}
                                  	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '中文';}else{echo 'Chinese';}?>');
                        			b_3.push(<?php echo $num_1?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '英语';}else{echo 'English';}?>');
                        			b_3.push(<?php echo $num_2?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Teochew';}else{echo 'Teochew';}?>');
                        			b_3.push(<?php echo $num_3?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Cantonese';}else{echo 'Cantonese';}?>');
                        			b_3.push(<?php echo $num_4?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Hakka';}else{echo 'Hakka';}?>');
                        			b_3.push(<?php echo $num_5?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo 'Hokkien';}else{echo 'Hokkien';}?>');
                        			b_3.push(<?php echo $num_6?>);

                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '其他';}else{echo 'Other';}?>');
                        			b_3.push(<?php echo $num_7?>);
                        			
                            		var ctx = document.getElementById("bar_3");
                            		var myBar_3 = new Chart(ctx, {
                            		    type: 'bar',
                            		    data: {
                            		        labels: a_3,
                            		        datasets: [{
                            		            label: '<?php if($this->langtype == '_ch'){echo '语言技能';}else{echo 'Language Skills';}?>',
                            		            data: b_3,
                            		            backgroundColor: [
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(255, 99, 132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderColor: [
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(255,99,132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderWidth: 1
                            		        }]
                            		    },
                            		    options: {
                            		    	title: {
                            		            display: false, // 显示标题
                            		            text: '示例柱形图标题' // 标题文本
                            		        },
                            		    	legend: {
                            		    	    display: false
                            		    	},
                        			        scales: {
                        			             xAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ],
                                                yAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ]
                        			        }
                        			    }
                        //     		    options: {
                        //     		    	legend: {
                        //     		    	    display: false
                        //     		    	},
                        //     		        scales: {
                        //     		            y: {
                        //     		                beginAtZero: true // 设置y轴从0开始
                        //     		            }
                        //     		        }
                        //     		    }
                            		});
                            	</script>
                        	</div>
                        	<!-- 
                        	<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;margin-top:10px;">
                        		<div style="float:left;background:#0D72AE;color:white;line-height:40px;padding:0px 15px;border-radius:4px;font-size:14px;">View More</div>
                        	</div>
                        	 -->
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '接受关怀者性别 <span style="color:#36A2EB;">(进行中)</span>';}else{echo 'Enrolment Gender <span style="color:#36A2EB;">(In Progress)</span>';}?></div>
                        	<div style="float:left;width:100%;margin-top:20px;">
                            	<div style="float: left;width:100%;height:250px;">
                                	<canvas id="bar_2" style="width:100%;height:100%;"></canvas>
                            	</div>
                            	<div style="float: left;width:100%;">
                            		<div style="float: left;width:calc(100% - 40px - 30px);margin-left:40px;line-height:30px;text-align:center;">
    									<div style="float: left;width:33.33%;background:rgba(54, 162, 235,1);color:white;">
        									<?php if($this->langtype == '_ch'){echo '接受关怀';}else{echo 'Enrolment';}?>
                                    	</div>
                                	</div>
                            	</div>
                            	<script>
                                	var a_3 = new Array();
                            		var b_3 = new Array();
                            		<?php 
                                		$num_1 = 0;
                                		$num_2 = 0;
                                		if(!empty($allrecordlist)){
                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                		        if($allrecordlist[$aaarrr]['select_id_1'] == 1 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_1 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['select_id_1'] == 2 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_2 += 1;
                                		        }
                                		    }
                                		}
                                  	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?>');
                        			b_3.push(<?php echo $num_1?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?>');
                        			b_3.push(<?php echo $num_2?>);
                        
                        
                        		    a_3.push('');
                        			b_3.push(0);
                        			
                        		    a_3.push('');
                        			b_3.push(0);
                        
                        
                        		    a_3.push('');
                        			b_3.push(0);
                        			
                        		    a_3.push('');
                        			b_3.push(0);
    			
                            		var ctx = document.getElementById("bar_2");
                            		var myBar_2 = new Chart(ctx, {
                            		    type: 'bar',
                            		    data: {
                            		        labels: a_3,
                            		        datasets: [{
                            		            label: '<?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?>',
                            		            data: b_3,
                            		            backgroundColor: [
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(255, 99, 132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderColor: [
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(255,99,132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderWidth: 1
                            		        }]
                            		    },
                            		    options: {
                            		    	title: {
                            		            display: false, // 显示标题
                            		            text: '示例柱形图标题' // 标题文本
                            		        },
                            		    	legend: {
                            		    	    display: false
                            		    	},
                        			        scales: {
                        			             xAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ],
                                                yAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ]
                        			        }
                        			    }
                        //     		    options: {
                        //     		    	legend: {
                        //     		    	    display: false
                        //     		    	},
                        //     		        scales: {
                        //     		            y: {
                        //     		                beginAtZero: true // 设置y轴从0开始
                        //     		            }
                        //     		        }
                        //     		    }
                            		});
                            	</script>
                        	</div>
                        </div>
                        <div class="rightarea">
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '会员 <span style="color:#36A2EB;">(进行中)</span>';}else{echo 'Membership <span style="color:#36A2EB;">(In Progress)</span>';}?></div>
                        	<div style="float:left;width:100%;border: 1px solid #E5E7EB;margin-top:20px;">
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;">
                                	<div style="float:left;width:24%;font-size:14px;font-weight:bold;">&nbsp;</div>
                                	<div style="float:left;width:76%;font-size:14px;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Numbers';}?></div>
                            	</div>
                            	<?php 
                            		$num_1 = 0;
                            		$num_2 = 0;
                            		if(!empty($allrecordlist)){
                            		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                            		        if($allrecordlist[$aaarrr]['select_id_3'] == 1 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                            		            $num_1 += 1;
                            		        }
                            		        if($allrecordlist[$aaarrr]['select_id_3'] == 0 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                            		            $num_2 += 1;
                            		        }
                            		    }
                            		}
                              	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1?></div>
                            	</div>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_2?></div>
                            	</div>
                        	</div>
                        	
                        	 
                        	 
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '当前健康状况 <span style="color:#36A2EB;">(进行中)</span>';}else{echo 'Current Health Condition(s) <span style="color:#36A2EB;">(In Progress)</span>';}?></div>
                        	<div style="float:left;width:100%;margin-top:20px;">
                            	<div style="float:left;width:100%;height:250px;">
                                	<canvas id="bar_12" style="width:100%;height:100%;"></canvas>
                            	</div>
                            	<script>
                                	var a_3 = new Array();
                            		var b_3 = new Array();
                            		<?php 
                                		$num_1 = 0;
                                		$num_2 = 0;
                                		$num_3 = 0;
                                		$num_4 = 0;
                                		if(!empty($allrecordlist)){
                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                		        if($allrecordlist[$aaarrr]['health_id_last'] == 1 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_1 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['health_id_last'] == 2 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_2 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['health_id_last'] == 3 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_3 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['health_id_last'] == 4 && $allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                		            $num_4 += 1;
                                		        }
                                		    }
                                		}
                                  	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '良好';}else{echo 'Good';}?>');
                        			b_3.push(<?php echo $num_1?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '正常';}else{echo 'Normal';}?>');
                        			b_3.push(<?php echo $num_2?>);
                        
                        
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '状况不佳';}else{echo 'Poor/Weak';}?>');
                        			b_3.push(<?php echo $num_3?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '卧床不起';}else{echo 'Bed Bound';}?>');
                        			b_3.push(<?php echo $num_4?>);
                        
                        
                        		    a_3.push('');
                        			b_3.push(0);
                        			
                        		    a_3.push('');
                        			b_3.push(0);
    			
                            		var ctx = document.getElementById("bar_12");
                            		var myBar_12 = new Chart(ctx, {
                            		    type: 'bar',
                            		    data: {
                            		        labels: a_3,
                            		        datasets: [{
                            		            label: '<?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?>',
                            		            data: b_3,
                            		            backgroundColor: [
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(255, 99, 132, 1)',
                            		            	'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderColor: [
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(255,99,132, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderWidth: 1
                            		        }]
                            		    },
                            		    options: {
                            		    	title: {
                            		            display: false, // 显示标题
                            		            text: '示例柱形图标题' // 标题文本
                            		        },
                            		    	legend: {
                            		    	    display: false
                            		    	},
                        			        scales: {
                        			             xAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ],
                                                yAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ]
                        			        }
                        			    }
                        //     		    options: {
                        //     		    	legend: {
                        //     		    	    display: false
                        //     		    	},
                        //     		        scales: {
                        //     		            y: {
                        //     		                beginAtZero: true // 设置y轴从0开始
                        //     		            }
                        //     		        }
                        //     		    }
                            		});
                            	</script>
                        	</div>
                        	
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '数量';}else{echo 'Number';}?></div>
                        	<div class="itemlist">
                            	<?php 
                                	$num_1 = 0;
                            		$num_2 = 0;
                            		$num_3 = 0;
                            		$num_4 = 0;
                            		if(!empty($allrecordlist)){
                            		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                            		        if($allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 0){
                            		            $num_1 += 1;
                            		        }
                            		        if($allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1){
                            		            $num_2 += 1;
                            		        }
                            		        if($allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 2){
                            		            $num_3 += 1;
                            		        }
                            		        if($allrecordlist[$aaarrr]['is_closed'] == 1){
                            		            $num_4 += 1;
                            		        }
                            		    }
                            		}
                              	?>
                                <div style="float:left;width:calc(100% - 20px);margin-left:0px;">
                                	<div style="float: left;width:100%;line-height:25px;text-align:center;">
    									<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:red;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                        	<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '待分配';}else{echo 'Pending';}?>: <?php echo $num_1;?></div>
                                    	</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:green;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                    		<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '已通过';}else{echo 'Passed';}?>: <?php echo $num_2;?></div>
                                    	</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:orange;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                    		<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '已拒绝';}else{echo 'Denied';}?>: <?php echo $num_3;?></div>
                                    	</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:40px;background:gray;color:white;margin-left:calc(50% - 20px);">&nbsp;</div>
                                    		<div style="float: left;width:100%;text-align:center;"><?php if($this->langtype == '_ch'){echo '已关闭';}else{echo 'Closed';}?>: <?php echo $num_4;?></div>
                                    	</div>
                                	</div>
                                	<div style="float: left;width:100%;line-height:25px;text-align:center;">
    									<div style="float: left;width:25%;">&nbsp;</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:2px;background:green;color:white;margin-left:calc(50% - 1px);">&nbsp;</div>
                                    	</div>
                                    	<div style="float: left;width:25%;">&nbsp;</div>
                                    	<div style="float: left;width:25%;">&nbsp;</div>
                                	</div>
                                	<div style="float: left;width:100%;line-height:25px;text-align:center;">
    									<div style="float: left;width:25%;">&nbsp;</div>
                                    	<div style="float: left;width:25%;">
        									<div style="float: left;width:100%;border-top:2px solid green;">
        										<div style="float: left;width:calc(33.33% - 2px);border-left:2px solid green;">&nbsp;</div>
        										<div style="float: left;width:33.33%;">
        											<div style="float: left;border-left:2px solid green;margin-left:calc(50% - 1px);">&nbsp;</div>
        										</div>
        										<div style="float: left;width:calc(33.33% - 2px);border-right:2px solid green;">&nbsp;</div>
        									</div>
        									<div style="float: left;width:calc(100% + 60%);margin-left:-30%;">
            									<div style="float: left;width:33.33%;text-align:left;">
            										<?php if($this->langtype == '_ch'){echo '未分配';}else{echo 'Unassigned';}?>
            										<?php 
                                                    	$num = 0;
                                                		if(!empty($allrecordlist)){
                                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                                		        if($allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 0){
                                                		            $num += 1;
                                                		        }
                                                		    }
                                                		}
                                                		echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;'.$num;
                                                  	?>
            									</div>
            									<div style="float: left;width:33.33%;text-align:center;">
            										<?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'In Progress';}?>
            										<?php 
                                                    	$num = 0;
                                                		if(!empty($allrecordlist)){
                                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                                		        if($allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_assigned'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 0){
                                                		            $num += 1;
                                                		        }
                                                		    }
                                                		}
                                                		echo '<br />'.$num;
                                                  	?>
            									</div>
            									<div style="float: left;width:33.33%;text-align:right;">
            										<?php if($this->langtype == '_ch'){echo '已完成';}else{echo 'Completed';}?>
            										<?php 
                                                    	$num = 0;
                                                		if(!empty($allrecordlist)){
                                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                                		        if($allrecordlist[$aaarrr]['is_closed'] == 0 && $allrecordlist[$aaarrr]['status'] == 1 && $allrecordlist[$aaarrr]['is_finished'] == 1){
                                                		            $num += 1;
                                                		        }
                                                		    }
                                                		}
                                                		echo '<br />'.$num.'&nbsp;&nbsp;&nbsp;&nbsp;';
                                                  	?>
            									</div>
        									</div>
                                    	</div>
                                    	<div style="float: left;width:25%;">&nbsp;</div>
                                    	<div style="float: left;width:25%;">&nbsp;</div>
                                	</div>
                                </div>
                    			<div style="float:left;width:100%;height:15px;">&nbsp;</div>
                    		</div>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                <?php 
                	$sql = "
                        SELECT a.* 
                        , b.select_id_3 AS enrolmentform_select_id_3
                        , b.is_closed AS enrolmentform_is_closed
                        , b.status AS enrolmentform_status
                        , b.is_assigned AS enrolmentform_is_assigned
                        , b.is_finished AS enrolmentform_is_finished

                        FROM ".DB_PRE()."form_list AS a
                        LEFT JOIN ".DB_PRE()."form_list AS b ON a.enrolmentform_id = b.form_id
                        WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit')
                        AND b.is_closed = 0 AND b.status = 1 AND b.is_assigned = 1 AND b.is_finished = 0
                    ";
                	$allrecordlist = $this->db->query($sql)->result_array();
            	?>
                <div class="contentarea">
                    <div class="title" style="background:#FF99FF;color:white;text-indent:10px;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '关怀组家访 (志愿者在家访后提交的数据)';}else{echo 'Caring Unit Home Visit (data filed in by volunteers, after visiting)';}?></div>
                    <div style="float:left;width:calc(100% - 20px);padding:0px 10px;background:rgba(255, 153, 255, 0.1);">
                        <div class="leftarea">
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '身心状况';}else{echo 'Physical and mental conditions';}?> <span style="color:#FF99FF;">(<?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'In Progress';}?>)</span></div>
                        	<div style="float:left;width:100%;margin-top:20px;">
                            	<div style="float: left;width:100%;height:250px;">
                                	<canvas id="bar_5" style="width:100%;height:100%;"></canvas>
                            	</div>
                            	<script>
                                	var a_3 = new Array();
                            		var b_3 = new Array();

                            		<?php 
                                		$num_1 = 0;
                                		$num_2 = 0;
                                		$num_3 = 0;
                                		$num_4 = 0;
                                		if(!empty($allrecordlist)){
                                		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                                		        if($allrecordlist[$aaarrr]['select_id_3'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                                		            $num_1 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['select_id_3'] == 2 && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                                		            $num_2 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['select_id_3'] == 3 && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                                		            $num_3 += 1;
                                		        }
                                		        if($allrecordlist[$aaarrr]['select_id_3'] == 4 && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                                		            $num_4 += 1;
                                		        }
                                		    }
                                		}
                                  	?>
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '良好';}else{echo 'Good';}?>');
                        			b_3.push(<?php echo $num_1?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '正常';}else{echo 'Normal';}?>');
                        			b_3.push(<?php echo $num_2?>);
                        
                        
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '状况不佳';}else{echo 'Poor/Weak';}?>');
                        			b_3.push(<?php echo $num_3?>);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '卧床不起';}else{echo 'Bed Bound';}?>');
                        			b_3.push(<?php echo $num_4?>);
                        
                        
                        		    a_3.push('');
                        			b_3.push(0);
                        			
                        		    a_3.push('');
                        			b_3.push(0);
    			
                            		var ctx = document.getElementById("bar_5");
                            		var myBar_5 = new Chart(ctx, {
                            		    type: 'bar',
                            		    data: {
                            		        labels: a_3,
                            		        datasets: [{
                            		            label: '<?php if($this->langtype == '_ch'){echo '身心状况';}else{echo 'Physical and mental conditions';}?>',
                            		            data: b_3,
                            		            backgroundColor: [
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(255, 99, 132, 1)',
                            		            	'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderColor: [
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(255,99,132, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderWidth: 1
                            		        }]
                            		    },
                            		    options: {
                            		    	title: {
                            		            display: false, // 显示标题
                            		            text: '示例柱形图标题' // 标题文本
                            		        },
                            		    	legend: {
                            		    	    display: false
                            		    	},
                        			        scales: {
                        			             xAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ],
                                                yAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ]
                        			        }
                        			    }
                        //     		    options: {
                        //     		    	legend: {
                        //     		    	    display: false
                        //     		    	},
                        //     		        scales: {
                        //     		            y: {
                        //     		                beginAtZero: true // 设置y轴从0开始
                        //     		            }
                        //     		        }
                        //     		    }
                            		});
                            	</script>
                        	</div>
                        	
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '信众需求';}else{echo 'Needs';}?> <span style="color:#FF99FF;">(<?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'In Progress';}?>)</span></div>
                        	 <div class="itemlist">
                        	 	<?php 
                            		$num_1 = 0;
                            		$num_2 = 0;
                            		$num_3 = 0;
                            		$num_4 = 0;
                            		if(!empty($allrecordlist)){
                            		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                            		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_2'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_3'] == 1 || $allrecordlist[$aaarrr]['checkbox_id_1_4'] == 1) && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                            		            $num_1 += 1;
                            		        }
                            		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_2'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_3'] == 2 || $allrecordlist[$aaarrr]['checkbox_id_1_4'] == 2) && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                            		            $num_2 += 1;
                            		        }
                            		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_2'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_3'] == 3 || $allrecordlist[$aaarrr]['checkbox_id_1_4'] == 3) && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                            		            $num_3 += 1;
                            		        }
                            		        if(($allrecordlist[$aaarrr]['checkbox_id_1_1'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_2'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_3'] == 4 || $allrecordlist[$aaarrr]['checkbox_id_1_4'] == 4) && $allrecordlist[$aaarrr]['enrolmentform_is_closed'] == 0 && $allrecordlist[$aaarrr]['enrolmentform_status'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_assigned'] == 1 && $allrecordlist[$aaarrr]['enrolmentform_is_finished'] == 0){
                            		            $num_4 += 1;
                            		        }
                            		    }
                            		}
                              	?>
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '家访 提供佛教情感支持';}else{echo 'Home visit to provide Buddhism emotional support';}?></td>
                                    		<td width="60" align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_1;?></td>
                                    	</tr>
                                    	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '家访包括提供助念（10 到 30 分钟） 以及介绍联络人提供佛教葬礼仪式的协助';}else{echo 'Home visits include prayer assistance (10 to 30 minutes) and a referral to a contact person to assist with Buddhist funeral rites';}?></td>
                                    		<td align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_2;?></td>
                                    	</tr>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '电话慰问';}else{echo 'Phone Follow Up';}?></td>
                                    		<td width="60" align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_3;?></td>
                                    	</tr>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;color:black;"><?php if($this->langtype == '_ch'){echo '无需跟进';}else{echo 'No Follow Up Required';}?></td>
                                    		<td width="60" align="center" style="padding-top:10px;padding-bottom:10px;"><?php echo $num_4?></td>
                                    	</tr>
                                    </tbody></table>
                                </div>
                        	 </div>
                        
                        
                        </div>
                        <div class="middlearea">
                        	
                        	<!-- 隐藏 -->
                        	<div class="grouptitle" style="display:none;"><?php if($this->langtype == '_ch'){echo '关怀组家访性别';}else{echo 'Caring Unit Home Visit Gender';}?></div>
                        	<div style="display:none;float:left;width:100%;margin-top:20px;">
                            	<div style="float: left;width:100%;height:250px;">
                                	<canvas id="bar_4" style="width:100%;height:100%;"></canvas>
                            	</div>
                            	<script>
                                	var a_3 = new Array();
                            		var b_3 = new Array();
                        
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?>');
                        			b_3.push(63);
                        			
                        		    a_3.push('<?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?>');
                        			b_3.push(175);
                        
                        
                        		    a_3.push('');
                        			b_3.push(0);
                        			
                        		    a_3.push('');
                        			b_3.push(0);
                        
                        
                        		    a_3.push('');
                        			b_3.push(0);
                        			
                        		    a_3.push('');
                        			b_3.push(0);
    			
                            		var ctx = document.getElementById("bar_4");
                            		var myBar_4 = new Chart(ctx, {
                            		    type: 'bar',
                            		    data: {
                            		        labels: a_3,
                            		        datasets: [{
                            		            label: '<?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?>',
                            		            data: b_3,
                            		            backgroundColor: [
                            		            	'rgba(54, 162, 235,1)',
                            		            	'rgba(255, 99, 132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                        			                'rgba(153, 102, 255,1)',
                        			                'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderColor: [
                            		            	'rgba(54, 162, 235, 1)',
                            		            	'rgba(255,99,132,1)',
                            		            	'rgba(38, 255, 255, 1)',
                            		            	'rgba(255, 153, 153, 1)',
                            		            	'rgba(153, 102, 255,1)',
                            		            	'rgba(255, 207, 191, 1)'
                            		            ],
                            		            borderWidth: 1
                            		        }]
                            		    },
                            		    options: {
                            		    	title: {
                            		            display: false, // 显示标题
                            		            text: '示例柱形图标题' // 标题文本
                            		        },
                            		    	legend: {
                            		    	    display: false
                            		    	},
                        			        scales: {
                        			             xAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ],
                                                yAxes: [
                                                    {
                                                        stacked: true
                                                    }
                                                ]
                        			        }
                        			    }
                        //     		    options: {
                        //     		    	legend: {
                        //     		    	    display: false
                        //     		    	},
                        //     		        scales: {
                        //     		            y: {
                        //     		                beginAtZero: true // 设置y轴从0开始
                        //     		            }
                        //     		        }
                        //     		    }
                            		});
                            	</script>
                        	</div>
                        	
                        	<!-- 隐藏 -->
                        	<div class="grouptitle" style="display:none;"><?php if($this->langtype == '_ch'){echo '跟进下一次访问';}else{echo 'To follow up the next visit';}?></div>
                        	<div class="itemlist" style="display:none;">
                        	 	<?php 
                    				$num_1 = 0;
                    				$num_2 = 0;
                            		if(!empty($allrecordlist)){
                            		    for ($aaarrr = 0; $aaarrr < count($allrecordlist); $aaarrr++) {
                            		        if($allrecordlist[$aaarrr]['select_id_4'] == 1){
                            		            $num_1 += 1;
                            		        }
                            		        if($allrecordlist[$aaarrr]['select_id_4'] == 2){
                            		            $num_2 += 1;
                            		        }
                            		    }
                            		}
                              	?>
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;">
                                    		<td align="center" style="color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></td>
                                    		<td align="center" style="color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></td>
                                    	</tr>
                                    	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                    		<td align="center"><?php echo $num_1;?></td>
                                    		<td align="center"><?php echo $num_2;?></td>
                                    	</tr>
                                    </tbody></table>
                                </div>
                        	 </div>
                        	 
                        	 
                        	 <div class="grouptitle"><?php if($this->langtype == '_ch'){echo '关怀组家访<br />次数';}else{echo 'Caring Unit Home Visit Times';}?> <span style="color:#FF99FF;">(<?php if($this->langtype == '_ch'){echo '今年';}else{echo 'This Year';}?>)</span></div>
                        	<div style="float:left;width:100%;border: 1px solid #E5E7EB;margin-top:20px;">
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;">
                                	<div style="float:left;width:24%;font-size:14px;font-weight:bold;">&nbsp;</div>
                                	<div style="float:left;width:76%;font-size:14px;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '次数';}else{echo 'Times';}?></div>
                            	</div>
                            	<?php 
                            	   $start_time = strtotime(date('Y-m-d').' 00:00:00');
                            	   $end_time = strtotime(date('Y-m-d').' 23:59:59');
                            	   $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                            	   $res = $this->db->query($sql)->row_array();
                            	   if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '今天';}else{echo 'Today';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-01-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-01-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '1月';}else{echo 'Jan';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-02-01 00:00:00');
                                	if((date('Y') % 4) == 0){
                                	    $end_time = strtotime(date('Y').'-02-29 23:59:59');
                                	}else{
                                	    $end_time = strtotime(date('Y').'-02-28 23:59:59');
                                	}
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '2月';}else{echo 'Feb';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-03-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-03-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '3月';}else{echo 'Mar';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	
                            	
                            	<?php 
                                	$start_time = strtotime(date('Y').'-04-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-04-30 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '4月';}else{echo 'Apr';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-05-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-05-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '5月';}else{echo 'May';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-06-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-06-30 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '6月';}else{echo 'Jun';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	
                            	<?php 
                                	$start_time = strtotime(date('Y').'-07-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-07-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '7月';}else{echo 'Jul';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-08-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-08-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '8月';}else{echo 'Aug';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-09-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-09-30 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '9月';}else{echo 'Sep';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	
                            	
                            	<?php 
                                	$start_time = strtotime(date('Y').'-10-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-10-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '10月';}else{echo 'Oct';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-11-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-11-30 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '11月';}else{echo 'Nov';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	<?php 
                                	$start_time = strtotime(date('Y').'-12-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-12-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;border-top: 1px solid #E5E7EB;background:#F5F8FA;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '12月';}else{echo 'Dec';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                            	
                            	
                            	
                            	<?php 
                                	$start_time = strtotime(date('Y').'-01-01 00:00:00');
                                	$end_time = strtotime(date('Y').'-12-31 23:59:59');
                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                    $res = $this->db->query($sql)->row_array();
                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                            	?>
                            	<div style="float:left;width:100%;text-align:center;line-height:40px;">
                                	<div style="float:left;width:24%;font-size:14px;"><?php if($this->langtype == '_ch'){echo '所有月份';}else{echo 'All Month';}?></div>
                                	<div style="float:left;width:76%;font-size:14px;;font-weight:bold;"><?php echo $num_1;?></div>
                            	</div>
                        	</div>
                        </div>
                        <div class="rightarea">
                        	
                        	
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '本月家访统计';}else{echo 'Home Visit Statistics';}?> <span style="color:#FF99FF;">(<?php if($this->langtype == '_ch'){echo '本月';}else{echo 'This Month';}?>)</span></div>
                        	<div style="float:left;width:100%;margin-top:20px;">
    							<div style="float:left;width:100%;height:300px;">
                            		<canvas id="canvas_1" style="width:100%;height:100%;"></canvas>
                            	</div>
    							<script>
                            		var config_1 = {
                            			type: 'line',
                            			data: {
                            				labels: [
                            					<?php for ($mmm = 0; $mmm < $max_day; $mmm++) {?>
                            						<?php if($mmm != 0){?>
                            							,
                            						<?php }?>
                            						'<?php echo ($mmm + 1)?>'
                            					<?php }?>
                            				],
                            				datasets: [{
                            					label: '<?php if($this->langtype == '_ch'){echo '家访<br />次数';}else{echo 'Home Visit Times';}?>',
                            					fill: false,
                            					backgroundColor: window.chartColors.blue,
                            					borderColor: window.chartColors.blue,
                            					data: [
                                                    <?php for ($mmm = 0; $mmm < $max_day; $mmm++) {?>
                            							<?php if($date_year == date('Y') && $date_month == date('m')){?>
                                							<?php if(($mmm + 1) <= intval(date('d'))){?>
                                    							<?php if($mmm != 0){?>
                                    								,
                                    							<?php }?>
                                        						<?php 
                                            						$start_time = strtotime($date_year.'-'.$date_month.'-'.($mmm + 1).' 00:00:00');
                                            						$end_time = strtotime($date_year.'-'.$date_month.'-'.($mmm + 1).' 23:59:59');
                                                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                                                    $res = $this->db->query($sql)->row_array();
                                                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                                                                    echo $num_1;
                                 	                        	?>
                                        					<?php }?>
                                    					<?php }else{?>
                                    							<?php if($mmm != 0){?>
                                    								,
                                    							<?php }?>
                                    							<?php 
                                            						$start_time = strtotime($date_year.'-'.$date_month.'-'.($mmm + 1).' 00:00:00');
                                            						$end_time = strtotime($date_year.'-'.$date_month.'-'.($mmm + 1).' 23:59:59');
                                                                    $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type IN ('homevisit_1st', 'homevisit', 'homevisit_followupvisit') AND created >= ".$start_time." AND created <= ".$end_time;
                                                                    $res = $this->db->query($sql)->row_array();
                                                                    if(!empty($res)){if($res['numcount'] != ''){$num_1 = $res['numcount'];}else{$num_1 = 0;}}else{$num_1 = 0;}
                                                                    echo $num_1;
                                 	                        	?>
                                    					<?php }?>
                                					<?php }?>
                            					],
                            					fill: false,
                            				}]
                            			},
                            			options: {
                            				responsive: false,//是否自适应容器大小
                            				title: {
                            					display: false,
                            					text: ''
                            				},
                            				legend: {
                            		    	    display: false
                            		    	},
                            				tooltips: {
                            					mode: 'index',
                            					intersect: false,
                            				},
                            				hover: {
                            					mode: 'nearest',
                            					intersect: true
                            				},
                            				scales: {
                            					xAxes: [{
                            						display: true,
                            						scaleLabel: {
                            							display: true,
                            							labelString: ''
                            						}
                            					}],
                            					yAxes: [{
                            						display: true,
                            						scaleLabel: {
                            							display: true,
                            							labelString: '家访<br />次数'
                            						}
                            					}]
                            				}
                            			}
                            		};
                            	</script>
                            	
                            	<script type="text/javascript">
                                	window.onload = function() {
                                		var ctx1 = document.getElementById('canvas_1').getContext('2d');
                                		window.myLine1 = new Chart(ctx1, config_1);
                                	};
                            	</script>
                        	</div>
                        	
                        	 
                        </div>
					</div>
                </div>
                
                
                
                
                
                
                
                
                
                <div class="contentarea">
                    <div class="title" style="background:rgb(66, 116, 109);color:white;text-indent:10px;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '其他';}else{echo 'Others';}?></div>
                    <div style="float:left;width:calc(100% - 20px);padding:0px 10px;background:rgba(66, 116, 109, 0.1);">
                        <div class="leftarea" style="width: calc(50% - 5px);">
                        	<div class="grouptitle"><?php if($this->langtype == '_ch'){echo '义工';}else{echo '义工';}?></div>
                        	 <div class="itemlist">
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                    		<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<td rowspan="2" align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;background:rgba(66, 116, 109, 0.5);color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'In Progress';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已完成';}else{echo 'Completed';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已关闭';}else{echo 'Closed';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '所有';}else{echo 'Total';}?></td>
                                        	</tr>
                                        	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<!-- 
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?></td>
                                        		
                                        		<!-- 
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?></td>
                                        		
                                        		<!--
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?></td>
                                        		
                                        		<!--
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?></td>
                                        	</tr>
                                        	<?php 
                                                $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_6 IN (1, 3) AND status = 1 AND is_closed = 0 ORDER BY form_id DESC LIMIT 0, 1000";
                                                $volunteer_list = $this->db->query($sql)->result_array();
                                                
                                                $all_num_process = 0;
                                                $all_num_finished = 0;
                                                $all_num_closed = 0;
                                                
                                                $all_times_process = 0;
                                                $all_times_finished = 0;
                                                $all_times_closed = 0;
                                                
                                                if(!empty($volunteer_list)){for ($v = 0; $v < count($volunteer_list); $v++) {
                                    			    $volunteer_id = $volunteer_list[$v]['form_id'];
                                    			    //times (process)
                                        			$sql = "
                                                            SELECT count(*) AS numcount
                                                            FROM ".DB_PRE()."form_list AS a
                                                            LEFT JOIN ".DB_PRE()."form_list AS b ON a.enrolmentform_id = b.form_id
                                                            WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit') 
                                                            AND (
                                                                (a.volunteer_1_id = ".$volunteer_id.")
                                                                OR ((a.volunteer_2_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_3_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_4_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_5_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_6_id = ".$volunteer_id."))
                                                            )
                                                            AND b.is_closed = 0 AND b.is_finished = 0 AND b.status = 1 AND b.is_assigned = 1
                                                     ";
                                    			    $res = $this->db->query($sql)->row_array();
                                    			    if(!empty($res)){if($res['numcount'] != ''){$times_process = $res['numcount'];}else{$times_process = 0;}}else{$times_process = 0;}
                                    			    $all_times_process += $times_process;
                                    			    $volunteer_list[$v]['times_process'] = $times_process;
                                    			    
                                    			    
                                    			    //times (finished)
                                    			    $sql = "
                                                            SELECT count(*) AS numcount
                                                            FROM ".DB_PRE()."form_list AS a
                                                            LEFT JOIN ".DB_PRE()."form_list AS b ON a.enrolmentform_id = b.form_id
                                                            WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit')
                                                            AND (
                                                                (a.volunteer_1_id = ".$volunteer_id.")
                                                                OR ((a.volunteer_2_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_3_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_4_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_5_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_6_id = ".$volunteer_id."))
                                                            )
                                                            AND b.is_finished = 1
                                                     ";
                                    			    $res = $this->db->query($sql)->row_array();
                                    			    if(!empty($res)){if($res['numcount'] != ''){$times_finished = $res['numcount'];}else{$times_finished = 0;}}else{$times_finished = 0;}
                                    			    $all_times_finished += $times_finished;
                                    			    $volunteer_list[$v]['times_finished'] = $times_finished;
                                    			    
                                    			    
                                    			    //times (closed)
                                    			    $sql = "
                                                            SELECT count(*) AS numcount
                                                            FROM ".DB_PRE()."form_list AS a
                                                            LEFT JOIN ".DB_PRE()."form_list AS b ON a.enrolmentform_id = b.form_id
                                                            WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit')
                                                            AND (
                                                                (a.volunteer_1_id = ".$volunteer_id.")
                                                                OR ((a.volunteer_2_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_3_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_4_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_5_id = ".$volunteer_id."))
                                                                OR ((a.volunteer_6_id = ".$volunteer_id."))
                                                            )
                                                            AND b.is_closed = 1
                                                     ";
                                    			    $res = $this->db->query($sql)->row_array();
                                    			    if(!empty($res)){if($res['numcount'] != ''){$times_closed = $res['numcount'];}else{$times_closed = 0;}}else{$times_closed = 0;}
                                    			    $all_times_closed += $times_closed;
                                    			    $volunteer_list[$v]['times_closed'] = $times_closed;
                                    			    
                                    			    
                                    			    $form_type = 'enrolmentform';
//                                     			    //如果该义工：同时是义工又是司机
// //                                     			    if($volunteer_list[$v]['select_id_6'] == 3){
// //                                     			        $sql = "
// //                                                             SELECT count(*) AS numcount
		    
// //                                                             FROM ".DB_PRE()."form_list AS a
// //                                                             LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
// //                                                             LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
// //                                                             LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                    
// //                                                             LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
// //                                                             LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
// //                                                             LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                    
// //                                                             LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                    
// //                                                             WHERE a.form_type = '".$form_type."' AND a.status = 1 AND a.is_closed = 0 AND a.is_assigned = 1 AND a.is_finished = 0
// //                                                             AND
// //                                                             (
// //                                                                 (a.volunteer_1_id = ".$volunteer_id.")
// //                                                                 OR (a.volunteer_2_id = ".$volunteer_id.")
// //                                                                 OR (a.volunteer_3_id = ".$volunteer_id.")
// //                                                                 OR (a.volunteer_4_id = ".$volunteer_id.")
// //                                                                 OR (a.volunteer_5_id = ".$volunteer_id.")
// //                                                                 OR (a.volunteer_6_id = ".$volunteer_id.")
// //                                                                 OR (a.driver_id = ".$volunteer_id.")
// //                                                             )
// //                                                             ORDER BY a.form_id DESC
// //                                                         ";
// //                                     			    }else{
//                                     			        $sql = "
//                                                             SELECT count(*) AS numcount
                        
//                                                             FROM ".DB_PRE()."form_list AS a
//                                                             LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
//                                                             LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
//                                                             LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                        
//                                                             LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
//                                                             LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
//                                                             LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                        
//                                                             LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                        
//                                                             WHERE a.form_type = '".$form_type."' AND a.status = 1 AND a.is_closed = 0 AND a.is_assigned = 1 AND a.is_finished = 0
//                                                             AND
//                                                             (
//                                                                 (a.volunteer_1_id = ".$volunteer_id.")
//                                                                 OR (a.volunteer_2_id = ".$volunteer_id.")
//                                                                 OR (a.volunteer_3_id = ".$volunteer_id.")
//                                                                 OR (a.volunteer_4_id = ".$volunteer_id.")
//                                                                 OR (a.volunteer_5_id = ".$volunteer_id.")
//                                                                 OR (a.volunteer_6_id = ".$volunteer_id.")
//                                                             )
//                                                             ORDER BY a.form_id DESC
//                                                         ";
// //                                     			    }
//                                         			$res = $this->db->query($sql)->row_array();
//                                         			if(!empty($res)){if($res['numcount'] != ''){$num_process = $res['numcount'];}else{$num_process = 0;}}else{$num_process = 0;}
//                                         			$all_num_process += $num_process;
//                                         			$volunteer_list[$v]['num_process'] = $num_process;
                                        			
                                        			
//                                         			$sql = "
//                                                         SELECT count(*) AS numcount
                                		            
//                                                         FROM ".DB_PRE()."form_list AS a
//                                                         LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                                		    
//                                                         LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                                		        
//                                                         LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                                		            
//                                                         WHERE a.form_type = '".$form_type."' AND a.is_closed = 1
//                                                         AND
//                                                         (
//                                                             (a.volunteer_1_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_2_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_3_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_4_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_5_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_6_id = ".$volunteer_id.")
//                                                         )
//                                                         ORDER BY a.form_id DESC
//                                                     ";
//                                         			$res = $this->db->query($sql)->row_array();
//                                         			if(!empty($res)){if($res['numcount'] != ''){$num_closed = $res['numcount'];}else{$num_closed = 0;}}else{$num_closed = 0;}
//                                         			$all_num_closed += $num_closed;
//                                         			$volunteer_list[$v]['num_closed'] = $num_closed;
                                        			
                                        			
//                                         			$sql = "
//                                                         SELECT count(*) AS numcount
                                    		            
//                                                         FROM ".DB_PRE()."form_list AS a
//                                                         LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                                    		    
//                                                         LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                                    		        
//                                                         LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                                    		            
//                                                         WHERE a.form_type = '".$form_type."' AND a.is_finished = 1
//                                                         AND
//                                                         (
//                                                             (a.volunteer_1_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_2_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_3_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_4_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_5_id = ".$volunteer_id.")
//                                                             OR (a.volunteer_6_id = ".$volunteer_id.")
//                                                         )
//                                                         ORDER BY a.form_id DESC
//                                                     ";
//                                         			$res = $this->db->query($sql)->row_array();
//                                         			if(!empty($res)){if($res['numcount'] != ''){$num_finished = $res['numcount'];}else{$num_finished = 0;}}else{$num_finished = 0;}
//                                         			$all_num_finished += $num_finished;
//                                         			$volunteer_list[$v]['num_finished'] = $num_finished;
                                                }}
                                                
                                                //根据字段last_name对数组$data进行降序排列
                                                $last_names = array_column($volunteer_list, 'times_process');
                                                array_multisort($last_names, SORT_DESC, $volunteer_list);
                                    		?>
                                        	
                                        	
                                        	<?php if(!empty($volunteer_list)){for ($v = 0; $v < count($volunteer_list); $v++) {?>
                                    			<?php 
                                    			    $volunteer_id = $volunteer_list[$v]['form_id'];
                                    			    $times_process = $volunteer_list[$v]['times_process'];
                                    			    $times_closed = $volunteer_list[$v]['times_closed'];
                                    			    $times_finished = $volunteer_list[$v]['times_finished'];
                                    			    
//                                         			$num_process = $volunteer_list[$v]['num_process'];
//                                         			$num_closed = $volunteer_list[$v]['num_closed'];
//                                         			$num_finished = $volunteer_list[$v]['num_finished'];
                                        			
                                        			$num_process = 0;
                                        			$num_closed = 0;
                                        			$num_finished = 0;
                                    			?>
                                            	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;<?php if($v%2 == 1){echo 'background:#F5F8FA;';}?>">
                                            		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;<?php if($volunteer_list[$v]['select_id_6'] == 3){echo 'color:#0788FF;';}else{echo 'color:black;';}?>"><?php echo $volunteer_list[$v]['input_1']?> <?php if($volunteer_list[$v]['select_id_6'] == 3){echo '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/icon_driver_both_blue.png"/>';}?></td>
                                            		<!--
                                            		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($num_process != 0){echo $num_process;}else{echo '';}?></td>
                                            		-->
                                            		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($times_process != 0){echo $times_process;}else{echo '';}?></td>
                                            		
                                            		<!--
                                            		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($num_finished != 0){echo $num_finished;}else{echo '';}?></td>
                                            		-->
                                            		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($times_finished != 0){echo $times_finished;}else{echo '';}?></td>
                                            		
                                            		<!--
                                            		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($num_closed != 0){echo $num_closed;}else{echo '';}?></td>
                                            		-->
                                            		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($times_closed != 0){echo $times_closed;}else{echo '';}?></td>
                                            		
                                            		<!--
                                            		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if(($num_process + $num_finished + $num_closed) != 0){echo ($num_process + $num_finished + $num_closed);}else{echo '';}?></td>
                                            		-->
                                            		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if(($times_process + $times_finished + $times_closed) != 0){echo ($times_process + $times_finished + $times_closed);}else{echo '';}?></td>
                                            	</tr>
                                        	<?php }}?>
                                        	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<td rowspan="2" align="right" style="padding-top:10px;padding-bottom:10px;padding-left:10px;background:rgba(66, 116, 109, 0.5);color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '总计';}else{echo 'Total';}?>&nbsp;&nbsp;</td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'In Progress';}?></td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已完成';}else{echo 'Completed';}?></td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已关闭';}else{echo 'Closed';}?></td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '所有';}else{echo 'Total';}?></td>
                                        	</tr>
                                        	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo $all_num_process;?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?><br /><?php echo $all_times_process;?></td>
                                        		
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo $all_num_finished;?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?><br /><?php echo $all_times_finished;?></td>
                                        		
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo $all_num_closed;?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?><br /><?php echo $all_times_closed;?></td>
                                        		
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo ($all_num_process + $all_num_finished + $all_num_closed);?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Visits';}?><br /><?php echo ($all_times_process + $all_times_finished + $all_times_closed);?></td>
                                        	</tr>
                                        </tbody>
                                    </table>
                                </div>
                        	 </div>
                        </div>
                        <div class="rightarea" style="width: calc(50% - 5px);margin-left:10px;">
                        	 <div class="grouptitle"><?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?></div>
                        	 <div class="itemlist">
                        	 	<div style="float:left;width:100%;border: 1px solid #E5E7EB;">
                                    <table style="float:left;width:100%;" cellpadding="0">
                                    	<tbody>
                                    		<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<td rowspan="2" align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;background:rgba(66, 116, 109, 0.5);color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'In Progress';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已完成';}else{echo 'Completed';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已关闭';}else{echo 'Closed';}?></td>
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '所有';}else{echo 'Total';}?></td>
                                        	</tr>
                                        	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<!--
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?></td>
                                        		
                                        		<!--
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?></td>
                                        		
                                        		<!--
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?></td>
                                        		
                                        		<!--
                                        		<td width="50" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></td>
                                        		-->
                                        		<td colspan="2" width="100" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?></td>
                                        	</tr>
                                    		<?php 
                                                $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_6 IN (2, 3) AND status = 1 AND is_closed = 0 ORDER BY form_id DESC LIMIT 0, 1000";
                                                $volunteer_list = $this->db->query($sql)->result_array();
                                                
                                                
                                                $all_times_process = 0;
                                                $all_times_finished = 0;
                                                $all_times_closed = 0;
                                                
                                                $all_num_process = 0;
                                                $all_num_finished = 0;
                                                $all_num_closed = 0;
                                            ?>
                                    		<?php if(!empty($volunteer_list)){for ($v = 0; $v < count($volunteer_list); $v++) {?>
                                    			<?php 
                                    			    $volunteer_id = $volunteer_list[$v]['form_id'];
                                        			
                                        			//times (process)
                                        			$sql = "
                                                        SELECT count(*) AS numcount
                                                        FROM ".DB_PRE()."form_list AS a
                                                        LEFT JOIN ".DB_PRE()."form_list AS b ON a.enrolmentform_id = b.form_id
                                                        WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit')
                                                        AND a.driver_id = ".$volunteer_id."
                                                        AND b.is_closed = 0 AND b.is_finished = 0 AND b.status = 1 AND b.is_assigned = 1
                                                    ";
                                        			$res = $this->db->query($sql)->row_array();
                                        			if(!empty($res)){if($res['numcount'] != ''){$times_process = $res['numcount'];}else{$times_process = 0;}}else{$times_process = 0;}
                                        			$all_times_process += $times_process;
                                        			$volunteer_list[$v]['times_process'] = $times_process;
                                        			
                                        			//times (completed)
                                        			$sql = "
                                                        SELECT count(*) AS numcount
                                                        FROM ".DB_PRE()."form_list AS a
                                                        LEFT JOIN ".DB_PRE()."form_list AS b ON a.enrolmentform_id = b.form_id
                                                        WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit')
                                                        AND a.driver_id = ".$volunteer_id."
                                                        AND b.is_finished = 1
                                                    ";
                                        			$res = $this->db->query($sql)->row_array();
                                        			if(!empty($res)){if($res['numcount'] != ''){$times_finished = $res['numcount'];}else{$times_finished = 0;}}else{$times_finished = 0;}
                                        			$all_times_finished += $times_finished;
                                        			$volunteer_list[$v]['times_finished'] = $times_finished;
                                        			
                                        			//times (closed)
                                        			$sql = "
                                                        SELECT count(*) AS numcount
                                                        FROM ".DB_PRE()."form_list AS a
                                                        LEFT JOIN ".DB_PRE()."form_list AS b ON a.enrolmentform_id = b.form_id
                                                        WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit')
                                                        AND a.driver_id = ".$volunteer_id."
                                                        AND b.is_closed = 1
                                                    ";
                                        			$res = $this->db->query($sql)->row_array();
                                        			if(!empty($res)){if($res['numcount'] != ''){$times_closed = $res['numcount'];}else{$times_closed = 0;}}else{$times_closed = 0;}
                                        			$all_times_closed += $times_closed;
                                        			$volunteer_list[$v]['times_closed'] = $times_closed;
                                        			
                                        			
                                        			
                                        			
                                        			
                                    			    $form_type = 'enrolmentform';
                                    			    //num (process)
//                                     			    $sql = "
//                                                         SELECT count(*) AS numcount
                                                                
//                                                         FROM ".DB_PRE()."form_list AS a
//                                                         LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                                                                    
//                                                         LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                                                                    	     
//                                                         LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                                                                    	 	    
//                                                         WHERE a.form_type = '".$form_type."' AND a.status = 1 AND a.is_closed = 0 AND a.is_assigned = 1 AND a.is_finished = 0
//                                                         AND
//                                                         (
//                                                             (a.driver_id = ".$volunteer_id.")
//                                                         )
//                                                         ORDER BY a.form_id DESC
//                                                     ";
//                                     			    $res = $this->db->query($sql)->row_array();
//                                         			if(!empty($res)){if($res['numcount'] != ''){$num_process = $res['numcount'];}else{$num_process = 0;}}else{$num_process = 0;}
//                                         			$all_num_process += $num_process;
//                                         			$volunteer_list[$v]['num_process'] = $num_process;
                                        			
                                        			
//                                         			//num (finished)
//                                         			$sql = "
//                                                         SELECT count(*) AS numcount
                                        	    
//                                                         FROM ".DB_PRE()."form_list AS a
//                                                         LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                                    		        
//                                                         LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                                    		                
//                                                         LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                                      	    
//                                                         WHERE a.form_type = '".$form_type."' AND a.is_finished = 1
//                                                         AND
//                                                         (
//                                                             (a.driver_id = ".$volunteer_id.")
//                                                         )
//                                                         ORDER BY a.form_id DESC
//                                                     ";
//                                         			$res = $this->db->query($sql)->row_array();
//                                         			if(!empty($res)){if($res['numcount'] != ''){$num_finished = $res['numcount'];}else{$num_finished = 0;}}else{$num_finished = 0;}
//                                         			$all_num_finished += $num_finished;
//                                         			$volunteer_list[$v]['num_finished'] = $num_finished;
                                        			
                                        			
//                                         			//num (closed)
//                                         			$sql = "
//                                                         SELECT count(*) AS numcount
                    
//                                                         FROM ".DB_PRE()."form_list AS a
//                                                         LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                    	    
//                                                         LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
//                                                         LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                            
//                                                         LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                        	     
//                                                         WHERE a.form_type = '".$form_type."' AND a.is_closed = 1
//                                                         AND
//                                                         (
//                                                             (a.driver_id = ".$volunteer_id.")
//                                                         )
//                                                         ORDER BY a.form_id DESC
//                                                     ";
//                                         			$res = $this->db->query($sql)->row_array();
//                                         			if(!empty($res)){if($res['numcount'] != ''){$num_closed = $res['numcount'];}else{$num_closed = 0;}}else{$num_closed = 0;}
//                                         			$all_num_closed += $num_closed;
//                                         			$volunteer_list[$v]['num_closed'] = $num_closed;
                                                }}
                                                
                                                //根据字段last_name对数组$data进行降序排列
                                                $last_names = array_column($volunteer_list, 'times_process');
                                                array_multisort($last_names, SORT_DESC, $volunteer_list);
                                    		?>
                                        	<?php if(!empty($volunteer_list)){for ($v = 0; $v < count($volunteer_list); $v++) {?>
                                    			<?php 
                                    			    $volunteer_id = $volunteer_list[$v]['form_id'];
                                        			
                                        			$times_process = $volunteer_list[$v]['times_process'];
                                        			$times_finished = $volunteer_list[$v]['times_finished'];
                                        			$times_closed = $volunteer_list[$v]['times_closed'];
                                        			
//                                         			$num_process = $volunteer_list[$v]['num_process'];
//                                         			$num_finished = $volunteer_list[$v]['num_finished'];
//                                         			$num_closed = $volunteer_list[$v]['num_closed'];
                                        			
                                        			$num_process = 0;
                                        			$num_finished = 0;
                                        			$num_closed = 0;
                                    			?>
                                            	<tr style="line-height:40px;border-top: 1px solid #E5E7EB;<?php if($v%2 == 1){echo 'background:#F5F8FA;';}?>">
                                            		<td align="left" style="padding-top:10px;padding-bottom:10px;padding-left:10px;<?php if($volunteer_list[$v]['select_id_6'] == 3){echo 'color:#0788FF;';}else{echo 'color:black;';}?>"><?php echo $volunteer_list[$v]['input_1']?> <?php if($volunteer_list[$v]['select_id_6'] == 3){echo '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/icon_driver_both_blue.png"/>';}?></td>
                                            		<!--
                                        		    <td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($num_process != 0){echo $num_process;}else{echo '';}?></td>
                                            		-->
                                        			<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($times_process != 0){echo $times_process;}else{echo '';}?></td>
                                            		
                                            		<!--
                                        		    <td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($num_finished != 0){echo $num_finished;}else{echo '';}?></td>
                                            		-->
                                        			<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($times_finished != 0){echo $times_finished;}else{echo '';}?></td>
                                            		
                                            		<!--
                                        		    <td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($num_closed != 0){echo $num_closed;}else{echo '';}?></td>
                                            		-->
                                        			<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($times_closed != 0){echo $times_closed;}else{echo '';}?></td>
                                            		
                                            		<!--
                                        		    <td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if(($num_process + $num_finished + $num_closed) != 0){echo ($num_process + $num_finished + $num_closed);}else{echo '';}?></td>
                                            		-->
                                        			<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if(($times_process + $times_finished + $times_closed) != 0){echo ($times_process + $times_finished + $times_closed);}else{echo '';}?></td>
                                            	</tr>
                                        	<?php }}?>
                                        	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<td rowspan="2" align="right" style="padding-top:10px;padding-bottom:10px;padding-left:10px;background:rgba(66, 116, 109, 0.5);color:black;font-weight:bold;"><?php if($this->langtype == '_ch'){echo '总计';}else{echo 'Total';}?>&nbsp;&nbsp;</td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '进行中';}else{echo 'In Progress';}?></td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已完成';}else{echo 'Completed';}?></td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '已关闭';}else{echo 'Closed';}?></td>
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);font-weight:bold;"><?php if($this->langtype == '_ch'){echo '所有';}else{echo 'Total';}?></td>
                                        	</tr>
                                        	<tr style="line-height:20px;border-top: 1px solid #E5E7EB;">
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo $all_num_process;?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,128,0,0.2);color:rgb(255,128,0);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?><br /><?php echo $all_times_process;?></td>
                                        		
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo $all_num_finished;?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(54,217,0,0.2);color:rgb(54,217,0);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?><br /><?php echo $all_times_finished;?></td>
                                        		
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo $all_num_closed;?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(255,0,0,0.2);color:rgb(255,0,0);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?><br /><?php echo $all_times_closed;?></td>
                                        		
                                        		<!--
                                        		<td align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?><br /><?php echo ($all_num_process + $all_num_finished + $all_num_closed);?></td>
                                        		-->
                                        		<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;background-color:rgba(77,122,255,0.2);color:rgb(77,122,255);"><?php if($this->langtype == '_ch'){echo '驾驶<br />次数';}else{echo 'Driver Times';}?><br /><?php echo ($all_times_process + $all_times_finished + $all_times_closed);?></td>
                                        	</tr>
                                        </tbody>
                                    </table>
                                </div>
                        	 </div>
                        </div>
					</div>
                </div>
            <?php }else{?>
            	<?php $this->load->view('common_entercode_admin')?>
            <?php }?>
    	</div>
    </div>
</div>
<?php $this->load->view('footer')?>