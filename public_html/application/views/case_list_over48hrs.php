<?php $this->load->view('header')?>
<style>
    .availabletime{}
    .availabletime table{float:left;width:100%;background:black;border-spacing: 1px;border-collapse: separate;margin-top:5px;}
    .availabletime table tr{background:white;}
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
                    	<div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
            				<?php 
                				$start_date = $this->input->get('start_date');
                				$end_date = $this->input->get('end_date');
                				$language_id = $this->input->get('language_id');
                				$fearanimal_id = $this->input->get('fearanimal_id');
                				$address_id = $this->input->get('address_id');
                				$health_id = $this->input->get('health_id');
                				$gender = $this->input->get('gender');
            				    $keyword = $this->input->get('keyword');
            				?>
            				<div style="float:left;width:100%;">
                				<div style="float:right;">
                    				<form action = "<?php echo base_url().'admin/case_over48hrs'?>" method="get">
                                    	<div style="float:left;margin-right:10px;">
                    						<?php if($address_id != '' && $address_id != 0){$thiscolor = 'black';}else{$thiscolor = '#999';}?>
                                        	<select name="address_id" onchange="tochoose_address_id(this.value)" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:<?php echo $thiscolor?>;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                                        		<option value="0"><?php if($this->langtype == '_ch'){echo '地区';}else{echo 'Area';}?></option>
                                        		<?php echo $this->WelModel->getarea_select($address_id);?>
                                        	</select>
                                        	<script>function tochoose_address_id(address_id){if(address_id != '' && address_id != 0){$('select[name="address_id"]').css({'color': 'black'});}else{$('select[name="address_id"]').css({'color': '#999'});}}</script>
                                    	</div>
                    					
                    					<div style="float:left;margin-right:10px;">
                    						<?php if($fearanimal_id != '' && $fearanimal_id != 0){$thiscolor = 'black';}else{$thiscolor = '#999';}?>
                                        	<select name="fearanimal_id" onchange="tochoose_fearanimal_id(this.value)" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:<?php echo $thiscolor?>;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:150px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                                        		<option value="0"><?php if($this->langtype == '_ch'){echo '有动物吗？';}else{echo 'Have Animal?';}?></option>
                                        		<option value="1" <?php if($fearanimal_id != '' && $fearanimal_id == 1){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></option>
                                        		<option value="2" <?php if($fearanimal_id != '' && $fearanimal_id == 2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></option>
                                        	</select>
                                        	<script>function tochoose_fearanimal_id(fearanimal_id){if(fearanimal_id != '' && fearanimal_id != 0){$('select[name="fearanimal_id"]').css({'color': 'black'});}else{$('select[name="fearanimal_id"]').css({'color': '#999'});}}</script>
                                    	</div>
                                    	
                    					<div style="float:left;margin-right:10px;">
                    						<?php if($language_id != '' && $language_id != 0){$thiscolor = 'black';}else{$thiscolor = '#999';}?>
                                        	<select name="language_id" onchange="tochoose_language_id(this.value)" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:<?php echo $thiscolor?>;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:150px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                                        		<option value="0"><?php if($this->langtype == '_ch'){echo '语言能力';}else{echo 'Language Skills';}?></option>
                                        		<option value="1" <?php if($language_id != '' && $language_id == 1){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '中文';}else{echo 'Chinese';}?></option>
                                        		<option value="2" <?php if($language_id != '' && $language_id == 2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '英语';}else{echo 'English';}?></option>
                                        		<option value="3" <?php if($language_id != '' && $language_id == 3){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '中文和英语';}else{echo 'Chinese and English';}?></option>
                                        		<option value="99" <?php if($language_id != '' && $language_id == 99){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '其他';}else{echo 'Other';}?></option>
                                        	</select>
                                        	<script>function tochoose_language_id(language_id){if(language_id != '' && language_id != 0){$('select[name="language_id"]').css({'color': 'black'});}else{$('select[name="language_id"]').css({'color': '#999'});}}</script>
                                    	</div>
                                    	
                                    	<div style="float:left;margin-right:10px;">
                    						<?php if($gender != '' && $gender != 0){$thiscolor = 'black';}else{$thiscolor = '#999';}?>
                                        	<select name="gender" onchange="tochoose_gender(this.value)" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:<?php echo $thiscolor?>;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                                        		<option value="0"><?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?></option>
                                        		<option value="1" <?php if($gender != '' && $gender == 1){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?></option>
                                        		<option value="2" <?php if($gender != '' && $gender == 2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?></option>
                                        	</select>
                                        	<script>function tochoose_gender(gender){if(gender != '' && gender != 0){$('select[name="gender"]').css({'color': 'black'});}else{$('select[name="gender"]').css({'color': '#999'});}}</script>
                                    	</div>
                                    	
                                    	<div style="float:left;margin-right:10px;">
                    						<?php if($health_id != '' && $health_id != 0){$thiscolor = 'black';}else{$thiscolor = '#999';}?>
                                        	<select name="health_id" onchange="tochoose_health_id(this.value)" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:<?php echo $thiscolor?>;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:150px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                                        		<option value="0"><?php if($this->langtype == '_ch'){echo '当前健康';}else{echo 'Current Health';}?></option>
                                        		<option value="1" <?php if($health_id != '' && $health_id == 1){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '良好';}else{echo 'Good';}?></option>
                                        		<option value="2" <?php if($health_id != '' && $health_id == 2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '正常';}else{echo 'Normal';}?></option>
                                        		<option value="2" <?php if($health_id != '' && $health_id == 2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '状况不佳';}else{echo 'Poor/Weak';}?></option>
                                        		<option value="2" <?php if($health_id != '' && $health_id == 2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '卧床不起';}else{echo 'Bed Bound';}?></option>
                                        	</select>
                                        	<script>function tochoose_health_id(health_id){if(health_id != '' && health_id != 0){$('select[name="health_id"]').css({'color': 'black'});}else{$('select[name="health_id"]').css({'color': '#999'});}}</script>
                                    	</div>
                    					
                    					<input type="text" name="keyword" style="margin-right:10px;height:13px;line-height:13px;" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
                    					<input type="submit" onclick="toloadingcontent()" style="float:left;background:#DF9C4D;color:white;line-height:35px;border-radius:6px;border:0px;padding:0px 10px;" value="<?php if($this->langtype == '_ch'){echo '搜索';}else{echo 'Search';}?>"/>
                    				</form>
                				</div>
                			</div>
                        </div>
                    	<div class="sectiontitle">
                            <div style="float:left;width:25px;font-size:16px;text-align:center;">&nbsp;</div>
            				<div style="float:left;width:calc(100% - 25px - 120px - 120px - 120px - 140px - 140px);font-size:16px;"><?php if($this->langtype == '_ch'){echo '案例';}else{echo 'Cases';}?></div>
                        	<div style="float:left;width:120px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '当前健康';}else{echo 'Current Health';}?></div>
                        	<div style="float:left;width:120px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '义工';}else{echo 'Volunteer';}?></div>
                    		<div style="float:left;width:120px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?></div>
                        	<div style="float:left;width:140px;font-size:16px;text-align:center;line-height:20px;margin-top:15px;margin-bottom:15px;"><?php if($this->langtype == '_ch'){echo '下一次家访日期';}else{echo 'Next Home Visit Date';}?></div>
                        	<div style="float:left;width:140px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></div>
                    	</div>
                	</div>
                	<?php 
                	    $subsql = "";
                	    if($start_date != '' && $end_date != ''){
                	        $subsql .= " AND a.created >= ".strtotime($start_date.' 00:00:00')." AND a.created <= ".strtotime($end_date.' 23:59:59');
                	    }else if($start_date != ''){
                	        $subsql .= " AND a.created >= ".strtotime($start_date.' 00:00:00');
                	    }else if($end_date != ''){
                	        $subsql .= " AND a.created <= ".strtotime($end_date.' 23:59:59');
                	    }
                	    if($gender != '' && $gender != 0){
                	        $subsql .= " AND a.select_id_1 = ".$gender;
                	    }
                	    if($fearanimal_id != '' && $fearanimal_id != 0){
                	        $subsql .= " AND a.select_id_7 = ".$fearanimal_id;
                	    }
                	    if($language_id != '' && $language_id != 0){
                	        $innersql = "(";
                	        for($ccc = 1; $ccc <= 10; $ccc++){
                	            if($ccc != 1){$innersql .= " OR ";}
                	            $innersql .= " a.checkbox_id_2_".$ccc." = ".$language_id;
                	        }
                	        $innersql .= ")";
                	        
                	        $subsql .= " AND ".$innersql;
                	    }
                	    if($address_id != '' && $address_id != 0){
                	        $subsql .= " AND a.select_id_23 = ".$address_id;
                	    }
                	    if($health_id != '' && $health_id != 0){
                	        $subsql .= " AND a.health_id_last = ".$health_id;
                	    }
                	    if($keyword != ''){
                	        $subsql .= " AND ((a.input_1 LIKE '%".$keyword."%') OR (a.input_4 LIKE '%".$keyword."%') OR (a.input_5 LIKE '%".$keyword."%') OR (a.input_6 LIKE '%".$keyword."%') OR (a.form_number LIKE '%".str_replace('ABSSC', 'ABSSP', $keyword)."%'))";
                	    }
                    	
                    	$sql = "
                            SELECT a.*
                    	    
                            , b.form_pic_1_path AS volunteer_1_pic_1_path
                            , b.input_1 AS volunteer_1_name
                            , b.select_id_6 AS volunteer_1_shenfen
                	        
                            , c.form_pic_1_path AS volunteer_2_pic_1_path
                            , c.input_1 AS volunteer_2_name
                            , c.select_id_6 AS volunteer_2_shenfen
                	        
                            , d.form_pic_1_path AS volunteer_3_pic_1_path
                            , d.input_1 AS volunteer_3_name
                            , d.select_id_6 AS volunteer_3_shenfen
                	        
                            , f.form_pic_1_path AS volunteer_4_pic_1_path
                            , f.input_1 AS volunteer_4_name
                	        , f.select_id_6 AS volunteer_4_shenfen
                	        
                            , g.form_pic_1_path AS volunteer_5_pic_1_path
                            , g.input_1 AS volunteer_5_name
                            , g.select_id_6 AS volunteer_5_shenfen
                	        
                            , i.form_pic_1_path AS volunteer_6_pic_1_path
                            , i.input_1 AS volunteer_6_name
                            , i.select_id_6 AS volunteer_6_shenfen
                
                            , e.form_pic_1_path AS driver_pic_1_path
                            , e.input_1 AS driver_name
                            , e.select_id_6 AS driver_shenfen

                            FROM ".DB_PRE()."form_list AS a
                            LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                
                            LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                                            
                            WHERE a.form_type = '".$form_type."' ".$subsql." AND a.status = 1 AND a.is_closed = 0 AND a.is_assigned = 1 AND a.is_finished = 0
                            AND a.datetime_last < ".(time() - 86400*2)."

                            ORDER BY a.form_id DESC
                        ";
                    	$recordlist = $this->db->query($sql)->result_array();
                	?>
                	<script>
                		function toshow_available_time(form_id){
                    		if($('.availabletime_'+form_id).css('display') == 'none'){
                    			$('.availabletime_'+form_id).animate({'height': 'show'}, 300, function (){
        							
                    			})
                        	}else{
                        		$('.availabletime_'+form_id).animate({'height': 'hide'}, 300, function (){
        							
                    			})
                    		}
                    	}
                		function toshow_jiafangrecord(form_id){
                    		if($('.jiafangrecord_'+form_id).css('display') == 'none'){
                    			$('.jiafangrecord_'+form_id).animate({'height': 'show'}, 300, function (){
        							
                    			})
                        	}else{
                        		$('.jiafangrecord_'+form_id).animate({'height': 'hide'}, 300, function (){
        							
                    			})
                    		}
                    	}
                	</script>
                	<div class="formtable_homepage">
                		<?php if(!empty($recordlist)){for ($i = 0; $i < count($recordlist); $i++) {?>
                            <div class="sectiontitle sectiontitle_<?php echo $recordlist[$i]['form_id']?>">
                                <div style="float:left;width:100%;">
                                	<div style="float:left;width:25px;line-height:25px;font-size:15px;">
                                		<input type="checkbox" name="form_id[]" onclick="tochoose_form_id()" class="mgc mgc-success mgc-lg" style="margin-left:2px;" value="<?php echo $recordlist[$i]['form_id']?>"/>
                                	</div>
                                	<div style="float:left;width:calc(100% - 25px - 120px - 120px - 120px - 140px - 140px);line-height:25px;font-size:15px;">
                                		<div style="float:left;width:calc(100% - 10px);margin-left:10px;">
                                    		<div style="float:left;" class="formnumber_showname_<?php echo $recordlist[$i]['form_id'];?>"><span style="font-weight: normal;"><?php echo actionsearchdaxiaoxiezimu($keyword, str_replace('ABSSP', 'ABSSC', $recordlist[$i]['form_number']));?></span> - <?php echo actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_1']);?></div>
                            				<div style="float:left;">
                                				<?php 
                                                    if($recordlist[$i]['select_id_1'] == 1){
                                        			    echo '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_male.jpg"/>';
                                                    }else if($recordlist[$i]['select_id_1'] == 2){
                                                        echo '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_female.jpg"/>';
                                                    }
                                    			?>
                                			</div>
                            			</div>
                            			<div style="float:left;width:calc(100% - 10px);margin-left:10px;color:gray;font-weight:normal;">
                                    		<?php echo date('d/m/Y H:i', $recordlist[$i]['created']);?>
                                    		- <?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Contact';}?>: <?php echo actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_4']);?>
                                    		- <?php if($this->langtype == '_ch'){echo '邮箱';}else{echo 'Email';}?>: <?php echo actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_6']);?>
                            			</div>
                            			<div style="float:left;width:calc(100% - 10px);margin-left:10px;color:gray;font-weight:normal;">
                                    		<div style="float:left;"><?php if($this->langtype == '_ch'){echo '有动物吗？';}else{echo 'Have Animal?';}?></div>
                                			<div style="float:left;">
                                				<?php if($recordlist[$i]['select_id_7'] == 1){?>
                                        			<div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
                                        			<div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                                    			<?php }else if($recordlist[$i]['select_id_7'] == 2){?>
                                        			<div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
                                        			<div style="float:left;line-height:20px;margin-left:6px;color:green;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                                    			<?php }?>
                                    			&nbsp;
                                    		</div>
                            			</div>
                            			<div style="float:left;width:calc(100% - 10px);margin-left:10px;color:gray;font-weight:normal;">
                                    		<div style="float:left;"><?php if($this->langtype == '_ch'){echo '年龄：';}else{echo 'Age: ';}?></div>
                                			<div style="float:left;">
                                				<?php 
                                                    if($recordlist[$i]['select_id_2'] != 0){
                                                        echo $recordlist[$i]['select_id_2'];if($this->langtype == '_ch'){echo '岁';}else{echo '';}
                                        			}
                                    			?>
                                    		</div>
                            			</div>
                                	</div>
                            		<div style="float:left;width:120px;line-height:25px;font-size:15px;text-align:center;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                            			<div style="float:left;">
                            				<?php if($recordlist[$i]['health_id_last'] == 1){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:green;"><?php if($this->langtype == '_ch'){echo '良好';}else{echo 'Good';}?></div>
                                			<?php }else if($recordlist[$i]['health_id_last'] == 2){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-primary mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:#337ab7;"><?php if($this->langtype == '_ch'){echo '正常';}else{echo 'Normal';}?></div>
                                			<?php }else if($recordlist[$i]['health_id_last'] == 3){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-warning mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:#f0ad4e;"><?php if($this->langtype == '_ch'){echo '状况不佳';}else{echo 'Poor/Weak';}?></div>
                                			<?php }else if($recordlist[$i]['health_id_last'] == 4){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;"><?php if($this->langtype == '_ch'){echo '卧床不起';}else{echo 'Bed Bound';}?></div>
                                			<?php }?>
                                			&nbsp;
                                		</div>
                            		</div>
                            		<div style="float:left;width:120px;line-height:25px;font-size:15px;text-align:center;">
                            			<?php if($recordlist[$i]['volunteer_1_name'] != '' || $recordlist[$i]['volunteer_2_name'] != '' || $recordlist[$i]['volunteer_3_name'] != '' || $recordlist[$i]['volunteer_4_name'] != '' || $recordlist[$i]['volunteer_5_name'] != '' || $recordlist[$i]['volunteer_6_name'] != ''){?>
                            				<?php for($v = 1; $v <= 6; $v++){?>
                                				<?php if($recordlist[$i]['volunteer_'.$v.'_name'] != ''){?>
                                    				<div style="float:left;width:100%;">
                                    					<?php 
                                    					   $filename = $recordlist[$i]['volunteer_'.$v.'_pic_1_path'];
                                    					   $filename_arr = explode('.', $filename);
                                    					   $file_type = end($filename_arr);
                                    					   $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                                    					?>
                                            			<img style="float:left;width:20px;height:20px;margin-left:5px;border-radius:50%;" src="<?php echo base_url().$filename_100x100?>"/>
                                            			<div style="float:left;width:80px;margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;background:#EFEFEF;font-weight:normal;font-size:12px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($recordlist[$i]['volunteer_'.$v.'_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $recordlist[$i]['volunteer_'.$v.'_name']?> <?php if($recordlist[$i]['volunteer_'.$v.'_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></div>
                                            		</div>
                                        		<?php }?>
                                    		<?php }?>
                            			<?php }else{?>
                            				<div style="float:left;width:100%;">
                                    			<img style="float:left;width:20px;height:20px;margin-left:5px;" src="<?php echo base_url().'themes/default/images/avatar_default.png'?>"/>
                                    			<div style="float:left;width:80px;margin-left:5px;height:20px;background:#EFEFEF;">&nbsp;</div>
                                    		</div>
                            			<?php }?>
                            		</div>
                            		<div style="float:left;width:120px;line-height:25px;font-size:15px;text-align:center;">
                            			<?php if($recordlist[$i]['driver_name'] != ''){?>
                            				<div style="float:left;width:100%;">
                            					<?php 
                            					   $filename = $recordlist[$i]['driver_pic_1_path'];
                            					   $filename_arr = explode('.', $filename);
                            					   $file_type = end($filename_arr);
                            					   $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                            					?>
                                    			<img style="float:left;width:20px;height:20px;margin-left:5px;border-radius:50%;" src="<?php echo base_url().$filename_100x100?>"/>
                                    			<div style="float:left;width:80px;margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;background:#EFEFEF;font-weight:normal;font-size:12px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($recordlist[$i]['driver_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $recordlist[$i]['driver_name']?> <?php if($recordlist[$i]['driver_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></div>
                                    		</div>
                            			<?php }else{?>
                            				<div style="float:left;width:100%;">
                                    			<img style="float:left;width:20px;height:20px;margin-left:5px;" src="<?php echo base_url().'themes/default/images/avatar_default.png'?>"/>
                                    			<div style="float:left;width:80px;margin-left:5px;height:20px;background:#EFEFEF;">&nbsp;</div>
                                    		</div>
                            			<?php }?>
                            		</div>
                                	<div style="float:left;width:140px;line-height:25px;font-size:15px;">
                                		<?php if($recordlist[$i]['is_finished'] == 1){?>
                                		    <?php 
                                    		    if($this->langtype == '_ch'){
                                    		        echo '
                                                        <div style="float:left;width:85px;line-height:19px;margin-left:5px;">
                                                			<div style="float:left;width:100%;">
                                                    			<div style="float:left;background:green;color:white;padding:0px 5px;border-radius:4px;">已完成</div>
                                                			</div>
                                                        </div>
                                                    ';
                                    		    }else{
                                    		        echo '
                                                        <div style="float:left;width:85px;line-height:19px;margin-left:5px;">
                                                			<div style="float:left;width:100%;">
                                                    			<div style="float:left;background:green;color:white;padding:0px 5px;border-radius:4px;">Completed</div>
                                                			</div>
                                                        </div>
                                                    ';
                                    		    }
                                		    ?>
                                		<?php }else{?>
                                			<?php if($recordlist[$i]['datetime_last'] != 0){?>
                                    			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        			<div style="float:left;">
                                            			<img style="float:left;width:17px;height:17px;margin-top:4px;" src="<?php echo base_url().'themes/default/images/icon_date_blue.png'?>"/>
                                            			<div style="float:left;margin-left:5px;">
                                                			<?php 
                                                			    if($recordlist[$i]['datetime_last_duan'] == 1){
                                                    			    if($this->langtype == '_ch'){$duan_name = '上午';}else{$duan_name = 'AM';}
                                                    			}else{
                                                    			    if($this->langtype == '_ch'){$duan_name = '下午';}else{$duan_name = 'PM';}
                                                    			}
                                                    			if($recordlist[$i]['datetime_last'] > time()){
                                                    			    $have_days = ceil(($recordlist[$i]['datetime_last'] - time()) / 86400);
                                                    			    if(($recordlist[$i]['datetime_last'] - 86400*3) > time()){
                                                    			        echo '<span style="color:green;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_last']).' '.$duan_name.'</span>';
                                                    			    }else{
                                                    			        echo '<span style="color:orange;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_last']).' '.$duan_name.'</span>';
                                                    			    }
                                                    			}else{
                                                    			    $have_days = ceil((time() - $recordlist[$i]['datetime_last']) / 86400);
                                                    			    echo '<span style="color:red;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_last']).' '.$duan_name.'</span>';
                                                    			}
                                                			?>
                                            			</div>
                                        			</div>
                                    			</div>
                                    			<div style="float:left;width:100%;margin-top:0px;text-align:center;">
                                        			<?php 
                                            			if($this->langtype == '_ch'){
                                            			    $text_remain = '还有';
                                            			    $text_days = '天';
                                            			    $text_hasexpired = '已过期';
                                            			}else{
                                            			    $text_remain = '';
                                            			    if($recordlist[$i]['datetime_last'] > time()){
                                            			         $text_days = 'days left';
                                            			    }else{
                                            			        $text_days = 'days';
                                            			    }
                                            			    $text_hasexpired = 'Expired';
                                            			}
                                            			if($recordlist[$i]['datetime_last'] > time()){
                                            			    $have_days = ceil(($recordlist[$i]['datetime_last'] - time()) / 86400);
                                            			    if(($recordlist[$i]['datetime_last'] - 86400*3) > time()){
                                            			        echo '<span style="color:green;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
                                            			    }else{
                                            			        echo '<span style="color:orange;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
                                            			    }
                                            			}else{
                                            			    $have_days = ceil((time() - $recordlist[$i]['datetime_last']) / 86400);
                                            			    echo '<span style="color:red;font-weight:normal;">'.$text_hasexpired.' '.$have_days.' '.$text_days.'</span>';
                                            			}
                                        			?>
                                    			</div>
                                    		<?php }else{?>
                                    			&nbsp;
                                    		<?php }?>
                                		<?php }?>
                                	</div>
                                	<div style="float:left;width:140px;">
                                		<?php 
                            			    $is_careforphone = 0;
                            			    if($recordlist[$i]['checkbox_id_1_1_last'] == 3){
                            			        $is_careforphone = 1;
                            			    }
                            			?>
                            			<?php if($is_careforphone == 1){//电话慰问?>
                                    		<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;">
                                        		<a href="<?php echo base_url().'admin/case_record_info/'.$recordlist[$i]['form_id']?>" style="float:left;">
                                        			<img style="width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/icon_view_orange.png'?>"/>
                                        		</a>
                                        		<a href="javascript:;" onclick="todel_notice(<?php echo $recordlist[$i]['form_id']?>)" style="float:left;margin-left:20px;">
                                        			<img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/icon_close_red.png'?>"/>
                                        		</a>
                                    		</div>
                                		<?php }else{?>
                                    		<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;">
                                        		<a href="<?php echo base_url().'admin/case_record_info/'.$recordlist[$i]['form_id']?>" style="float:left;">
                                        			<img style="width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/icon_view_orange.png'?>"/>
                                        		</a>
                                        		<a href="javascript:;" onclick="todel_notice(<?php echo $recordlist[$i]['form_id']?>)" style="float:left;margin-left:20px;">
                                        			<img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/icon_close_red.png'?>"/>
                                        		</a>
                                    		</div>
                                		<?php }?>
                                		<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;margin-top:10px;">
                                    		<?php 
                                        		$sql = "
                                                    SELECT count(*) AS numcount
                                                    FROM ".DB_PRE()."form_list AS a
                                                    WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit') AND a.enrolmentform_id = ".$recordlist[$i]['form_id']."
                                                    ORDER BY a.form_id DESC
                                                ";
                                        		$res = $this->db->query($sql)->row_array();
                                        		if(!empty($res)){
                                        		    if($res['numcount'] != ''){
                                        		        $jiafang_num = $res['numcount'];
                                        		    }else{
                                        		        $jiafang_num = 0;
                                        		    }
                                        		}else{
                                        		    $jiafang_num = 0;
                                        		}
                                    		?>
                                    		<a href="<?php echo base_url().'admin/homevisit_record_list/'.$recordlist[$i]['form_id']?>" style="float:left;width:calc(100% - 15px);margin-left:15px;<?php if($jiafang_num != 0){echo 'background:red;color:white;';}else{echo 'background:#EFEFEF;color:gray;';}?>border-radius:4px;line-height:30px;font-size:15px;text-align:center;">
                                    			<?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Home Visit';}?>
                                    			<?php if($jiafang_num != 0){echo '<span> ('.$jiafang_num.')</span>';}?>
                                    		</a>
                                		</div>
                                	</div>
                                </div>
                                <div style="float:left;width:100%;">
                                	<div style="float:left;width:calc(100% - 120px - 120px - 120px - 120px - 120px);line-height:25px;font-size:15px;">
                            			<div style="float:left;width:calc(100% - 10px);margin-left:10px;font-weight:normal;">
                                            <div style="float:left;width:100%;line-height:20px;font-size:15px;">
                                            	<div onclick="toshow_available_time(<?php echo $recordlist[$i]['form_id'];?>)" style="float:left;cursor:pointer;">
                                                	<div style="float:left;"><img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/icon_time_blue.png'?>"/></div>
                                                    <div style="float:left;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '家访的时间';}else{echo 'Availability';}?></div>
                                                	<div style="float:left;margin-left:5px;"><img style="float:left;width:14px;height:14px;margin-top:3px;" src="<?php echo base_url().'themes/default/images/visa_down_off.png'?>"/></div>
                                                </div>
                                                <div style="float:left;cursor:pointer;margin-left:20px;font-weight:normal;">
                                                    <?php echo $this->WelModel->getarea_show($recordlist[$i]['select_id_23']).' '.actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_5']);?>
                                                </div>
                                                <div style="float:left;cursor:pointer;font-weight:normal;">
                                                    <?php echo $this->WelModel->getlanguage_show_colorful($recordlist[$i], 'checkbox_id_2', 'input_3');?>
                                                </div>
                                            </div>
                                            <div class="availabletime availabletime_<?php echo $recordlist[$i]['form_id'];?>" style="display:none;float:left;width:100%;">
                                            	<?php echo $this->WelModel->availabletimetableshow($recordlist[$i]);//显示可利用的时间?>
                                            </div>
                                        </div>
                                	</div>
                                	<div style="float:left;width:600px;line-height:25px;font-size:15px;">
                            			<div style="float:left;width:calc(100% - 15px);margin-left:15px;text-align:left;">
                            				<div style="float:left;width:100%;line-height:20px;font-size:12px;font-weight:normal;">
                                            	<?php 
                                        		      $section_name = "checkbox_id_1";
                                        		      $valuelist = array();
                                        		      $valuelist[] = array('value_id'=>1, 'value_name_en'=>'Home visit to provide Buddhism emotional support', 'value_name_ch'=>'家访 提供佛教情感支持');
                                        		      $valuelist[] = array('value_id'=>2, 'value_name_en'=>'Home visits include prayer assistance (10 to 30 minutes) and a referral to a contact person to assist with Buddhist funeral rites', 'value_name_ch'=>'家访包括提供助念（10 到 30 分钟） 以及介绍联络人提供佛教葬礼仪式的协助');
                                        		      $valuelist[] = array('value_id'=>3, 'value_name_en'=>'Phone Follow Up', 'value_name_ch'=>'电话慰问');
                                        		      $valuelist[] = array('value_id'=>4, 'value_name_en'=>'No Follow Up Required', 'value_name_ch'=>'无需跟进');
                                        		?>
                                        		<?php if(!empty($valuelist)){for ($v = 0; $v < count($valuelist); $v++) {?>
                                        			<?php 
                                        			    $ischecked = 0;
                                        			    for($ccc = 1; $ccc <= 10; $ccc++){
                                            			    if($recordlist[$i][$section_name.'_'.$ccc.'_last'] == $valuelist[$v]['value_id']){
                                            			        $ischecked = 1;
                                            			    }
                                            			}
                                        			?>
                                        			<?php if($ischecked == 1){?>
                                                		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                                                    		<div style="float:left;width:25px;"><input type="checkbox" class="mgc mgc-success mgc-lg" checked disabled="disabled"/></div>
                                                    		<label style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$v]['value_name'.$this->langtype]?></label>
                                                		</div>
                                            		<?php }?>
                                        		<?php }}?>
                                            </div>
                                            <?php if($recordlist[$i]['assign_memo'] != ''){?>
                                				<div style="float:left;width:100%;">
                                        			<div style="float:left;background:#EFEFEF;border:1px solid gray;padding:3px 5px;margin-top:3px;font-size:12px;line-height:14px;border-radius:4px;"><?php echo $recordlist[$i]['assign_memo'];?></div>
                                        		</div>
                                        	<?php }?>
                                		</div>
                            		</div>
                                </div>
                            </div>
                        <?php }}else{?>
                            <div class="sectiontitle" style="border:0px;font-size:14px;">
                            	<div style="float:left;width:100%;text-align:center;line-height:20px;color:gray;"><?php if($this->langtype == '_ch'){echo '暂无超过48小时未填写家访表';}else{echo 'No home visit form that has not been filled over 48 hours';}?></div>
                            </div>
                        <?php }?>
                    </div>
            <?php }else{?>
            	<?php $this->load->view('common_entercode_admin')?>
            <?php }?>
    	</div>
    </div>
</div>
<script type="text/javascript">
//删除提示框 ---- 关闭
function toclose_deletebox(){
	$('.gksel_delete_box_bg, .gksel_delete_box').fadeOut(800);
}
var del_url = '';
var del_loading = 0;

//删除信息
function todel(title, subtitle){
	$('.gksel_delete_content .title').html(title);
	$('.gksel_delete_content .subtitle').html(subtitle);
	$('.gksel_delete_box_bg, .gksel_delete_box').fadeIn(800);
}
//删除信息 --- 处理方法
function del(){
	var ispass = 1;
	var isNull = /^[\s' ']*$/;
	var is_closed_reason = $('textarea[name="is_closed_reason"]').val();
	if(isNull.test(is_closed_reason)){ispass = 0;$('.is_closed_reason_error').show();}else{$('.is_closed_reason_error').hide();}
	if(ispass == 1){
    	if(del_loading == 0){
    		del_loading = 1;
			$('.gksel_delete_content .title').html('&nbsp;');
			$('.gksel_delete_content .subtitle').html('<div style="float:left;width:100%;text-align:center;"><img src="'+baseurl+'themes/default/images/indicator.gif"/></div>');
			del_url=decodeURI(del_url);
			$.post(del_url, {is_closed_reason: is_closed_reason}, function (data){
				location.reload();
			});
		}
	}
}
//删除商品
function todel_notice(id){
	var name = $('.formnumber_showname_'+id).html();
	var title = '<?php if($this->langtype == '_ch'){echo '您确定要关闭 ';}else{echo 'Are you sure to close ';}?><font style="color:red;">【'+name+'】</font><?php if($this->langtype == '_ch'){echo '吗？';}else{echo '?';}?>';
	var subtitle = '';
	del_url = encodeURI(baseurl+"admin/toclose_case/"+id);
	todel(title, subtitle);
}
</script>
<style>
.gksel_delete_box_bg{display:none;position:fixed;z-index:1000;left:0px;right:0px;top:0px;bottom:0px;background:black;opacity:0.7;}
.gksel_delete_box{display:none;position:fixed;z-index:1000;left:0px;right:0px;top:0px;bottom:0px;}
.gksel_delete_box table{float:left;width:450px;height:100%;margin-left:50%;border-collapse:collapse;border-spacing:0;padding:0;}
.gksel_delete_content{float:left;width:100%;margin-left:-225px;background:white;}
.gksel_delete_content .close{float:left;width:100%;}
.gksel_delete_content .close img{float:right;width:25px;height:25px;margin:20px 20px 0px 0px;cursor:pointer;}
.gksel_delete_content .title{float:left;width:80%;margin:20px 10% 0px 10%;font-size:17px;line-height:25px;}
.gksel_delete_content .subtitle{float:left;width:80%;margin:0px 10%;font-size:14px;line-height:17px;color:gray;margin-top:4px;}
.gksel_delete_content .control{float:left;width:100%;background:#f1f5f8;font-size:14px;line-height:17px;color:gray;margin-top:40px;}
.gksel_delete_content .control .yes{float:left;margin:15px 0px 15px 100px;height: 40px;line-height: 40px;width:120px;font-size:15px;background: #DF9C4D;border: 1px solid #DF9C4D;color: #fff;text-align: center;cursor: pointer;}
.gksel_delete_content .control .no{float:left;margin:15px 0px 15px 15px;height: 40px;line-height: 40px;width:120px;font-size:15px;background: #EFEFEF;border: 1px solid #ccc;color: #DF9C4D;text-align: center;cursor: pointer;}
</style>
<div class="gksel_delete_box_bg"></div>
<div class="gksel_delete_box">
	<table>
		<tr>
			<td>
				<div class="gksel_delete_content">
					<div class="close"><img onclick="toclose_deletebox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div style="float:left;width:80%;margin:0px 10%;font-size:14px;line-height:17px;color:black;margin-top:4px;">
						<div style="float:left;width:60px;">
    						<?php if($this->langtype == '_ch'){echo '原因';}else{echo 'Reason';}?>
    					</div>
    					<div style="float:left;width:calc(100% - 60px);">
    						<textarea name="is_closed_reason" style="float:left;width:calc(100% - 6px);height:50px;"></textarea>
    					</div>
					</div>
					<div class="is_closed_reason_error" style="display:none;float:left;width:80%;margin:0px 10%;font-size:14px;line-height:17px;color:red;margin-top:4px;">
    					<div style="float:left;width:calc(100% - 60px);margin-left:60px;">
    						<?php if($this->langtype == '_ch'){echo '请填写关闭原因';}else{echo 'Please fill in the reason for closure';}?>
    					</div>
					</div>
					<div class="control">
						<div class="yes" onclick="del()">OK</div>
						<div class="no" onclick="toclose_deletebox()">Cancel</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
<script>
	function tochoose_form_id(){
		var form_id_arr = $('input[name="form_id[]"]');
		var ishave_selected = 0;
		if(form_id_arr.length > 0){
			for(var i = 0; i < form_id_arr.length; i++){
				if(form_id_arr[i].checked == true){
					ishave_selected = 1;
					$('.sectiontitle_'+form_id_arr[i].value).css({'background': '#CCC'});
				}else{
					$('.sectiontitle_'+form_id_arr[i].value).css({'background': '#FFF'});
				}
			}
		}
		if(ishave_selected == 1){
			$('.btn_download_on').show();
			$('.btn_download_off').hide();
		}else{
			$('.btn_download_on').hide();
			$('.btn_download_off').show();
		}
	}
	function todownload_case(){
		var form_id_arr = $('input[name="form_id[]"]:checked');
		var form_id_str = '';
		if(form_id_arr.length > 0){
			for(var i = 0; i < form_id_arr.length; i++){
				if(i != 0)
				form_id_str += ',';
				form_id_str += form_id_arr[i].value;
			}
		}
		location.href = '<?php echo base_url()?>admin/todownload_case/complete?form_id_str='+form_id_str;
	}
</script>
<?php $this->load->view('footer')?>