<div class="formtable_submit">
	<div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
    	<div onclick="togotobackpage()" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#DF9C4D;color:white;padding:10px 0px;border:0px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '返回';}else{echo 'Back';}?></div>
		<script type="text/javascript">
			function togotobackpage(){
				document.referrer === '' ? window.location.href = baseurl+'volunteer/homevisit_record_list/<?php echo $enrolmentforminfo['form_id']?>' : window.history.go(-1);
			}
		</script>
    </div>
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:0px 10px 10px 10px;background:rgba(255, 153, 255, 0.3);">JF001A - <?php if($this->langtype == '_ch'){echo '关怀组家访表格 （初次）';}else{echo 'Caring Unit Home Visit Form (1<sup>st</sup> visit)';}?></div>
    <div class="sectionsummary"><?php if($this->langtype == '_ch'){echo '关怀组家访表格是一种用于记录和管理被关怀者及其家庭信息的表格。';}else{echo 'The Care Group Home Visit Form is a form used to record and manage information about the person being cared for and their family.';}?></div>
    
    <div class="bodycontentarea">
    	<table cellpadding="0">
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '拜访日期 、时间';}else{echo 'Date and time of visit';}?></td>
            	<td>
        			<?php 
        			     $section_name = "datetime_1";
        			?>
        			<div style="position:relative;float:left;width:100%;">
                		<input name="<?php echo $section_name;?>" type="datetime-local" id="<?php echo $section_name;?>" style="float:left;width:230px;line-height:25px;border:0px;"/>
                		<div style="position:absolute;top:2px;bottom:2px;left:2px;width:115px;line-height:30px;font-size: 14px;text-align:center;background-color:#EFEFEF;">
                			<div id="<?php echo $section_name;?>_day" style="float:left;width:25px;color: green;margin-left:2px;"><?php if($this->langtype == '_ch'){echo '日';}else{echo 'dd';}?></div>
        					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
        					<div id="<?php echo $section_name;?>_month" style="float:left;width:25px;color: blue;"><?php if($this->langtype == '_ch'){echo '月';}else{echo 'mm';}?></div>
        					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
        					<div id="<?php echo $section_name;?>_year" style="float:left;width:40px;color: purple;"><?php if($this->langtype == '_ch'){echo '年';}else{echo 'YYYY';}?></div>
                		</div>
                	</div>
                	<div class="<?php echo $section_name;?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择日期与时间';}else{echo 'Please choose date/time';}?>
                	</div>
                	<script>
                      	  const <?php echo $section_name;?>dateInput = document.querySelector('#<?php echo $section_name;?>');
                      	  const <?php echo $section_name;?>yearSelect = document.getElementById('<?php echo $section_name;?>_year');
                      	  const <?php echo $section_name;?>monthSelect = document.getElementById('<?php echo $section_name;?>_month');
                      	  const <?php echo $section_name;?>daySelect = document.getElementById('<?php echo $section_name;?>_day');
                          <?php echo $section_name;?>dateInput.addEventListener('input', (e) => {
                      	    const <?php echo $section_name;?>date = new Date(e.target.value);
                        	  <?php echo $section_name;?>yearSelect.textContent = <?php echo $section_name;?>date.getFullYear();
                        	  <?php echo $section_name;?>monthSelect.textContent = String(<?php echo $section_name;?>date.getMonth() + 1).padStart(2, '0');
                        	  <?php echo $section_name;?>daySelect.textContent = String(<?php echo $section_name;?>date.getDate()).padStart(2, '0');
                      	  });
                	</script>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '信众姓名';}else{echo 'Name';}?></td>
            	<td>
            		<?php echo $enrolmentforminfo['input_1']?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?></td>
            	<td>
            		<?php 
            		    if($enrolmentforminfo['select_id_1'] == 1){
                		    if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}
            		    }else if($enrolmentforminfo['select_id_1'] == 2){
                		    if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}
                		}
            		?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '年龄';}else{echo 'Age';}?></td>
            	<td>
            		<?php 
                		if($enrolmentforminfo['select_id_2'] != 0){
                		    echo $enrolmentforminfo['select_id_2'];if($this->langtype == '_ch'){echo '岁';}else{echo ' years old';}
                		}
            		?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '联系方式';}else{echo 'Contact number';}?></td>
            	<td>
            		<?php echo $enrolmentforminfo['input_4']?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '拜访地址';}else{echo 'Visiting address';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<div style="float:left;">
            				<?php echo $this->WelModel->getarea_show($enrolmentforminfo['select_id_23']);?>
                    	</div>
                    	<div style="float:left;margin-left:20px;">
                        	<?php echo $enrolmentforminfo['input_5']?>
                    	</div>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '信众需求';}else{echo 'Needs';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<?php 
                		      $section_name = "checkbox_id_1";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'value_name_en'=>'Home visit to provide Buddhism emotional support', 'value_name_ch'=>'家访 提供佛教情感支持');
                		      $valuelist[] = array('value_id'=>2, 'value_name_en'=>'Home visits include prayer assistance (10 to 30 minutes) and a referral to a contact person to assist with Buddhist funeral rites', 'value_name_ch'=>'家访包括提供助念（10 到 30 分钟） 以及介绍联络人提供佛教葬礼仪式的协助');
                		      $valuelist[] = array('value_id'=>3, 'value_name_en'=>'Phone Follow Up', 'value_name_ch'=>'电话慰问');
                		      $valuelist[] = array('value_id'=>4, 'value_name_en'=>'No Follow Up Required', 'value_name_ch'=>'无需跟进');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择信众需求';}else{echo 'Please choose needs';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '身心状况';}else{echo 'Physical and mental conditions';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_3";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Good', 'value_name_ch'=>'良好');
                		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-primary', 'value_name_en'=>'Normal', 'value_name_ch'=>'正常');
                		      $valuelist[] = array('value_id'=>3, 'radioclass'=>'mgr-warning', 'value_name_en'=>'Poor/Weak', 'value_name_ch'=>'状况不佳');
                		      $valuelist[] = array('value_id'=>4, 'radioclass'=>'mgr-danger', 'value_name_en'=>'Bed Bound', 'value_name_ch'=>'卧床不起');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择身心状况';}else{echo 'Please choose physical and mental conditions';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '跟进下一次访问';}else{echo 'To follow up the next visit';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_4";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Yes', 'value_name_ch'=>'是');
                		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-danger', 'value_name_en'=>'No', 'value_name_ch'=>'否');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_isneednext(<?php echo $valuelist[$i]['value_id']?>)" type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择跟进下一次访问';}else{echo 'Please choose follow up the next visit';}?>
                	</div>
                	<script>
						function tochoose_isneednext(isneednext){
							if(isneednext == 1){
								$('.isneednext_datearea').css({'display': 'table-row'});
							}else{
								$('.isneednext_datearea').css({'display': 'none'});
							}
						}
                	</script>
            	</td>
        	</tr>
        	<tr class="isneednext_datearea" style="display:none;">
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '下一次访问日期';}else{echo 'Next visit date';}?></td>
            	<td>
            		<div style="float:left;width:200px;">
                		<?php 
            			     $section_name = "datetime_2";
            			?>
            			<div style="position:relative;float:left;width:100%;">
                    		<input name="<?php echo $section_name;?>" type="date" id="<?php echo $section_name;?>" style="float:left;width:180px;line-height:20px;border:0px;"/>
                    		<div style="position:absolute;top:2px;bottom:2px;left:2px;width:130px;line-height:35px;font-size: 14px;text-align:center;background-color: #EFEFEF;">
                    			<div id="<?php echo $section_name;?>_day" style="float:left;width:25px;color: green;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '日';}else{echo 'dd';}?></div>
            					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
            					<div id="<?php echo $section_name;?>_month" style="float:left;width:25px;color: blue; "><?php if($this->langtype == '_ch'){echo '月';}else{echo 'mm';}?></div>
            					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
            					<div id="<?php echo $section_name;?>_year" style="float:left;width:40px;color: purple;"><?php if($this->langtype == '_ch'){echo '年';}else{echo 'YYYY';}?></div>
                    		</div>
                    	</div>
                    	<div class="<?php echo $section_name;?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                    		<?php if($this->langtype == '_ch'){echo '请选择日期';}else{echo 'Please choose date';}?>
                    	</div>
                    	<script>
                          	  const <?php echo $section_name;?>dateInput = document.querySelector('#<?php echo $section_name;?>');
                          	  const <?php echo $section_name;?>yearSelect = document.getElementById('<?php echo $section_name;?>_year');
                          	  const <?php echo $section_name;?>monthSelect = document.getElementById('<?php echo $section_name;?>_month');
                          	  const <?php echo $section_name;?>daySelect = document.getElementById('<?php echo $section_name;?>_day');
                              <?php echo $section_name;?>dateInput.addEventListener('input', (e) => {
                          	    const <?php echo $section_name;?>date = new Date(e.target.value);
                            	  <?php echo $section_name;?>yearSelect.textContent = <?php echo $section_name;?>date.getFullYear();
                            	  <?php echo $section_name;?>monthSelect.textContent = String(<?php echo $section_name;?>date.getMonth() + 1).padStart(2, '0');
                            	  <?php echo $section_name;?>daySelect.textContent = String(<?php echo $section_name;?>date.getDate()).padStart(2, '0');
                          	  });
                    	</script>
                	</div>
                	<div style="float:left;width:200px;margin-top:10px;">
                		<div style="float:left;width:100%;">
                    		<?php 
                    		      $section_name = "datetime_2_duan";
                    		      $valuelist = array();
                    		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'AM', 'value_name_ch'=>'上午');
                    		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-success', 'value_name_en'=>'PM', 'value_name_ch'=>'下午');
                    		?>
                    		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                        		<div style="float:left;line-height:20px;margin-right:10px;">
                            		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                            		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;">
                            			<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            		</label>
                        		</div>
                    		<?php }}?>
                		</div>
                		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                    		<?php if($this->langtype == '_ch'){echo '请时间时间';}else{echo 'Please choose time';}?>
                    	</div>
            		</div>
            	</td>
        	</tr>
        </table>
    </div>
    <?php 
        $have_volunteer_num = 0;
        for($vvv = 1; $vvv <= 6; $vvv++){
            if($enrolmentforminfo['volunteer_'.$vvv.'_id'] != 0){
                $have_volunteer_num ++;
            }
        }
    ?>
    <div style="float:left;width:100%;font-weight:bold;margin-top:20px;font-size:18px;"><?php if($this->langtype == '_ch'){echo '义工';}else{echo 'Volunteer';}?>：</div>
    <?php for ($vvv = 1; $vvv <= 6; $vvv++) {?>
        <div class="signincontent">
    		<div class="left2">
    			<input name="volunteer_<?php echo $vvv?>_id" type="hidden" value="0"/>
    			<div style="float:left;width:20px;"><?php echo $vvv?>. </div>
    			<div class="volunteer_<?php echo $vvv?>_id_show" style="float:left;width:calc(100% - 20px);border-bottom:1px solid black;padding-bottom:4px;">&nbsp;</div>
    		</div>
    		<div class="right2">
    			<div style="float:left;width:100%;">
            		<div onclick="toopen_choose_volunteer('volunteer_<?php echo $vvv?>_id')" style="cursor:pointer;float:left;background:#CCC;padding:0px 10px;line-height:30px;border-radius:6px;font-size:12px;"><?php if($this->langtype == '_ch'){echo '选择义工';}else{echo 'Choose Volunteer';}?></div>
        		</div>
        		<div class="signature_<?php echo $vvv?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
            		<?php if($this->langtype == '_ch'){echo '请填写义工人员';}else{echo 'Please fill in volunteer name and signature';}?>
            	</div>
    		</div>
        </div>
    <?php }?>
    <div style="float:left;width:100%;font-weight:bold;margin-top:20px;font-size:18px;"><?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?>：</div>
    <div class="signincontent">
		<div class="left2">
			<input name="driver_id" type="hidden" value="0"/>
			<div style="float:left;width:20px;">&nbsp;</div>
			<div class="driver_id_show" style="float:left;width:calc(100% - 20px);border-bottom:1px solid black;padding-bottom:4px;">&nbsp;</div>
		</div>
		<div class="right2">
			<div style="float:left;width:100%;">
        		<div onclick="toopen_choose_driver('driver_id')" style="cursor:pointer;float:left;background:#CCC;padding:0px 10px;line-height:30px;border-radius:6px;font-size:12px;"><?php if($this->langtype == '_ch'){echo '选择司机';}else{echo 'Choose Driver';}?></div>
    		</div>
    		<div class="signature_<?php echo $vvv?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
        		<?php if($this->langtype == '_ch'){echo '请填写司机人员';}else{echo 'Please fill in driver name and signature';}?>
        	</div>
		</div>
    </div>
    <script>
    	var current_actionboxname = '';
        function toopen_choose_volunteer(actionboxname){
        	current_actionboxname = actionboxname;
        	
            var old_value = $('input[name="'+current_actionboxname+'"]').val();
        	$('input[name="choose_volunteer_id"][value="'+old_value+'"]').prop('checked', true);
            
    		$('.choose_volunteer_popupbox').show();
        }
    	function toclose_choose_volunteer(){
			$('.choose_volunteer_popupbox').hide();
        }
        function submit_choose_volunteer(){
			var choose_volunteer_id = $('input[name="choose_volunteer_id"]:checked').val();
			if(choose_volunteer_id == undefined){
				choose_volunteer_id = 0;
			}
			$('input[name="'+current_actionboxname+'"]').val(choose_volunteer_id);

			if(choose_volunteer_id != 0){
				var imgpath = $('img[for="choose_volunteer_id_'+choose_volunteer_id+'"]').attr('src');
				var imgname = $('label[for="choose_volunteer_id_'+choose_volunteer_id+'"]').text();
				var str = '<img style="cursor:pointer;float:left;width:20px;height:20px;margin-left:5px;border-radius:50%;" src="'+imgpath+'"/>';
				str += '<div style="cursor:pointer;float:left;width:calc(100% - 25px - 25px - 5px - 5px);margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;font-weight:normal;font-size:14px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;">'+imgname+'</div>';
				$('.'+current_actionboxname+'_show').html(str);
			}else{
				$('.'+current_actionboxname+'_show').html('&nbsp;');
			}
			
			toclose_choose_volunteer();
        }
    </script>
    <style>
        .vchooselistarea{float:left;width:calc(100% - 60px);padding:20px 30px;}
        .vchooselistarea .itemlist{float:left;width:100%;padding:5px 0px;border-radius:4px;}
        .vchooselistarea .itemlist:hover{background:#EFEFEF;}
    </style>
    <div class="choose_volunteer_popupbox" style="display:none;position:fixed;top:0px;bottom:0px;left:0px;right:0px;background:rgba(0,0,0,0.5);">
    	<div style="float:left;width:100%;height:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        	<div style="position:relative;float:left;width:370px;background:white;border-radius:10px;">
        		<div style="position:absolute;right:0px;top:0px;">
        			<img onclick="toclose_choose_volunteer()" style="cursor:pointer;float:left;width:25px;height:25px;margin-top:-30px;" src="<?php echo base_url().'themes/default/images/close_white.png'?>"/>
        		</div>
        		<div class="vchooselistarea">
        			<div class="itemlist">
    					<div style="float:left;width:25px;margin-left:5px;">
    						<input type="radio" id="choose_volunteer_id_0" name="choose_volunteer_id" class="mgr mgr-success mgr-lg" value="0"/>
    					</div>
            			<div style="float:left;width:20px;height:20px;background:#EFEFEF;margin-left:5px;border-radius:50%;"></div>
            			<label for="choose_volunteer_id_0" style="float:left;width:calc(100% - 25px - 25px - 5px - 5px);margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;font-weight:normal;font-size:14px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;"><?php if($this->langtype == '_ch'){echo '不选择';}else{echo 'None';}?></div></label>
            		</div>
                	<?php for($v = 1; $v <= 6; $v++){?>
            			<?php if($enrolmentforminfo['volunteer_'.$v.'_name'] != ''){?>
            				<div class="itemlist">
            					<div style="float:left;width:25px;margin-left:5px;">
            						<input type="radio" id="choose_volunteer_id_<?php echo $enrolmentforminfo['volunteer_'.$v.'_id']?>" name="choose_volunteer_id" class="mgr mgr-success mgr-lg" value="<?php echo $enrolmentforminfo['volunteer_'.$v.'_id']?>"/>
            					</div>
                    			<img for="choose_volunteer_id_<?php echo $enrolmentforminfo['volunteer_'.$v.'_id']?>" style="cursor:pointer;float:left;width:20px;height:20px;margin-left:5px;border-radius:50%;" src="<?php echo base_url().$enrolmentforminfo['volunteer_'.$v.'_pic_1_path'].'?datetime='.time()?>"/>
                    			<label for="choose_volunteer_id_<?php echo $enrolmentforminfo['volunteer_'.$v.'_id']?>" style="cursor:pointer;float:left;width:calc(100% - 25px - 25px - 5px - 5px);margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;font-weight:normal;font-size:14px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($enrolmentforminfo['volunteer_'.$v.'_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $enrolmentforminfo['volunteer_'.$v.'_name']?> <?php if($enrolmentforminfo['volunteer_'.$v.'_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></label>
                    		</div>
                		<?php }?>
            		<?php }?>
        		</div>
        		<div style="float:left;width:100%;margin-bottom:20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        			<div onclick="submit_choose_volunteer()" style="cursor:pointer;float:left;background:#DF9C4D;color:white;line-height:40px;padding:0px 40px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '选择';}else{echo 'Choose';}?></div>
        		</div>
        	</div>
    	</div>
    </div>
    <script>
        function toopen_choose_driver(actionboxname){
        	current_actionboxname = actionboxname;
        	
            var old_value = $('input[name="'+current_actionboxname+'"]').val();
        	$('input[name="choose_driver_id"][value="'+old_value+'"]').prop('checked', true);
            
    		$('.choose_driver_popupbox').show();
        }
    	function toclose_choose_driver(){
			$('.choose_driver_popupbox').hide();
        }
        function submit_choose_driver(){
			var choose_driver_id = $('input[name="choose_driver_id"]:checked').val();
			if(choose_driver_id == undefined){
				choose_driver_id = 0;
			}
			$('input[name="'+current_actionboxname+'"]').val(choose_driver_id);

			if(choose_driver_id != 0){
				var imgpath = $('img[for="choose_driver_id_'+choose_driver_id+'"]').attr('src');
				var imgname = $('label[for="choose_driver_id_'+choose_driver_id+'"]').text();
				var str = '<img style="cursor:pointer;float:left;width:20px;height:20px;margin-left:5px;border-radius:50%;" src="'+imgpath+'"/>';
				str += '<div style="cursor:pointer;float:left;width:calc(100% - 25px - 25px - 5px - 5px);margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;font-weight:normal;font-size:14px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;">'+imgname+'</div>';
				$('.'+current_actionboxname+'_show').html(str);
			}else{
				$('.'+current_actionboxname+'_show').html('&nbsp;');
			}
			
			toclose_choose_driver();
        }
    </script>
    <div class="choose_driver_popupbox" style="display:none;position:fixed;top:0px;bottom:0px;left:0px;right:0px;background:rgba(0,0,0,0.5);">
    	<div style="float:left;width:100%;height:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        	<div style="position:relative;float:left;width:370px;background:white;border-radius:10px;">
        		<div style="position:absolute;right:0px;top:0px;">
        			<img onclick="toclose_choose_driver()" style="cursor:pointer;float:left;width:25px;height:25px;margin-top:-30px;" src="<?php echo base_url().'themes/default/images/close_white.png'?>"/>
        		</div>
        		<div class="vchooselistarea">
        			<div class="itemlist">
    					<div style="float:left;width:25px;margin-left:5px;">
    						<input type="radio" id="choose_driver_id_0" name="choose_driver_id" class="mgr mgr-success mgr-lg" value="0"/>
    					</div>
            			<div style="float:left;width:20px;height:20px;background:#EFEFEF;margin-left:5px;border-radius:50%;"></div>
            			<label for="choose_driver_id_0" style="float:left;width:calc(100% - 25px - 25px - 5px - 5px);margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;font-weight:normal;font-size:14px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;"><?php if($this->langtype == '_ch'){echo '不选择';}else{echo 'None';}?></div></label>
            		</div>
            			<?php if($enrolmentforminfo['driver_name'] != ''){?>
            				<div class="itemlist">
            					<div style="float:left;width:25px;margin-left:5px;">
            						<input type="radio" id="choose_driver_id_<?php echo $enrolmentforminfo['driver_id']?>" name="choose_driver_id" class="mgr mgr-success mgr-lg" value="<?php echo $enrolmentforminfo['driver_id']?>"/>
            					</div>
                    			<img for="choose_driver_id_<?php echo $enrolmentforminfo['driver_id']?>" style="cursor:pointer;float:left;width:20px;height:20px;margin-left:5px;border-radius:50%;" src="<?php echo base_url().$enrolmentforminfo['driver_pic_1_path'].'?datetime='.time()?>"/>
                    			<label for="choose_driver_id_<?php echo $enrolmentforminfo['driver_id']?>" style="cursor:pointer;float:left;width:calc(100% - 25px - 25px - 5px - 5px);margin-left:5px;min-height:14px;padding:3px 0px;line-height:12px;font-weight:normal;font-size:14px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($enrolmentforminfo['driver_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $enrolmentforminfo['driver_name']?> <?php if($enrolmentforminfo['driver_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></label>
                    		</div>
                		<?php }?>
        		</div>
        		<div style="float:left;width:100%;margin-bottom:20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        			<div onclick="submit_choose_driver()" style="cursor:pointer;float:left;background:#DF9C4D;color:white;line-height:40px;padding:0px 40px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '选择';}else{echo 'Choose';}?></div>
        		</div>
        	</div>
    	</div>
    </div>
                    
                    
    <div class="remarkscontent">
<b><?php if($this->langtype == '_ch'){echo '备注';}else{echo 'Remarks';}?></b>
<br /><?php if($this->langtype == '_ch'){echo '其他需要注意的事项';}else{echo 'Other things to keep in mind';}?>：
<br /><?php if($this->langtype == '_ch'){echo '您可以根据具体需求添加或修改以上内容，以确保表格能够全面、准确地记录关怀组成员及其家庭的信息';}else{echo 'You can add or modify the above to ensure that the form provides a comprehensive and accurate record.';}?>
    </div>
    
    <div style="float:left;width:100%;margin-top:10px;">
		<textarea name="textarea_1" style="float:left;width:calc(100% - 6px);height:100px;"></textarea>
	</div>
    
    
    <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
        <div class="btn_form_submit" onclick="tosubmit_form()" style="float:left;background:#DF9C4D;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?></div>
    	<div class="btn_form_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
    </div>
</div>


<script type="text/javascript">
	var form_type = 'homevisit_1st';
	function tosubmit_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;
		
		var datetime_1 = $('input[name="datetime_1"]').val();
		var input_1 = $('input[name="input_1"]').val();
		var input_2 = $('input[name="input_2"]').val();
		var input_3 = $('input[name="input_3"]').val();
		var select_id_1 = $('select[name="select_id_1"]').val();
		var select_id_2 = $('select[name="select_id_2"]').val();
		var select_id_3 = $('input[name="select_id_3"]:checked').val();
		if(select_id_3 == undefined){select_id_3 = 0;}
		var select_id_4 = $('input[name="select_id_4"]:checked').val();
		if(select_id_4 == undefined){select_id_4 = 0;}
		var select_id_5 = $('select[name="select_id_5"]').val();
		
		var textarea_1 = $('textarea[name="textarea_1"]').val();

		var volunteer_1_id = $('input[name="volunteer_1_id"]').val();
		var volunteer_2_id = $('input[name="volunteer_2_id"]').val();
		var volunteer_3_id = $('input[name="volunteer_3_id"]').val();
		var volunteer_4_id = $('input[name="volunteer_4_id"]').val();
		var volunteer_5_id = $('input[name="volunteer_5_id"]').val();
		var volunteer_6_id = $('input[name="volunteer_6_id"]').val();
		var driver_id = $('input[name="driver_id"]').val();

		var datetime_2 = $('input[name="datetime_2"]').val();

		var datetime_2_duan = $('input[name="datetime_2_duan"]:checked').val();
		if(datetime_2_duan == undefined){
			datetime_2_duan = 0;
		}
		
		var checkbox_id_1_arr = $('input[name="checkbox_id_1[]"]:checked');
		var checkbox_id_1 = [];
		if(checkbox_id_1_arr.length > 0){
			for(i = 0; i < checkbox_id_1_arr.length; i++){
				checkbox_id_1.push(checkbox_id_1_arr[i].value);
			}
		}
		console.log('checkbox_id_1:', checkbox_id_1);
				
		if(datetime_1 == ''){ispass = 0;$('.datetime_1_error').show();}else{$('.datetime_1_error').hide();}
// 		if(input_1 == ''){ispass = 0;$('.input_1_error').show();}else{$('.input_1_error').hide();}
// 		if(input_2 == ''){ispass = 0;$('.input_2_error').show();}else{$('.input_2_error').hide();}
// 		if(input_3 == ''){ispass = 0;$('.input_3_error').show();}else{$('.input_3_error').hide();}

// 		if(select_id_1 == 0){ispass = 0;$('.select_id_1_error').show();}else{$('.select_id_1_error').hide();}
// 		if(select_id_2 == 0){ispass = 0;$('.select_id_2_error').show();}else{$('.select_id_2_error').hide();}
		if(checkbox_id_1.length == 0){ispass = 0;$('.checkbox_id_1_error').show();}else{$('.checkbox_id_1_error').hide();}
		if(select_id_3 == 0){ispass = 0;$('.select_id_3_error').show();}else{$('.select_id_3_error').hide();}
		if(select_id_4 == 0){ispass = 0;$('.select_id_4_error').show();}else{$('.select_id_4_error').hide();}
// 		if(select_id_5 == 0){ispass = 0;$('.select_id_5_error').show();}else{$('.select_id_5_error').hide();}

		if(select_id_4 == 1){
			if(datetime_2 == ''){ispass = 0;$('.datetime_2_error').show();}else{$('.datetime_2_error').hide();}
			if(datetime_2_duan == 0){ispass = 0;$('.datetime_2_duan_error').show();}else{$('.datetime_2_duan_error').hide();}
		}
		
		if(ispass == 1){
			$('.btn_form_submit').hide();
			$('.btn_form_loading').show();

			var postOBJ = new Object();
			postOBJ.form_type = form_type;
			postOBJ.datetime_1 = datetime_1;
			postOBJ.input_1 = input_1;
			postOBJ.input_2 = input_2;
			postOBJ.input_3 = input_3;
			postOBJ.select_id_1 = select_id_1;
			postOBJ.select_id_2 = select_id_2;
			postOBJ.select_id_3 = select_id_3;
			postOBJ.select_id_4 = select_id_4;
			postOBJ.select_id_5 = select_id_5;
			postOBJ.checkbox_id_1 = checkbox_id_1;
			postOBJ.volunteer_1_id = volunteer_1_id;
			postOBJ.volunteer_2_id = volunteer_2_id;
			postOBJ.volunteer_3_id = volunteer_3_id;
			postOBJ.volunteer_4_id = volunteer_4_id;
			postOBJ.volunteer_5_id = volunteer_5_id;
			postOBJ.volunteer_6_id = volunteer_6_id;
			postOBJ.driver_id = driver_id;
			
			postOBJ.textarea_1 = textarea_1;
			postOBJ.datetime_2 = datetime_2+' 12:00';
			postOBJ.datetime_2_duan = datetime_2_duan;
    		
			$.post(baseurl+'welcome/action_formmethod_forhomevisit/<?php echo $enrolmentforminfo['form_id']?>', postOBJ, function (data){
				if(data == 'feifacanshu'){
				    toopen_errortips();//打开错误提示
				}else{
					$('.formtable_submit').hide();
					$('.formtable_result_1').show();
				}
				$('.btn_form_submit').show();
				$('.btn_form_loading').hide();
			})
		}
	}
</script>
<script>
	//打开错误提示
    function toopen_errortips(){
    	$('.errortips_box').show();
    }
    //关闭错误提示
	function toclose_errortips(){
		$('.errortips_box').hide();
	}
	//是否有数字
	function hasNumber(str) {
	  return /\d/.test(str);
	}
</script>
<div class="errortips_box" onclick="toclose_errortips()" style="display:none;position: fixed;top:0px;bottom:0px;left:0px;right:0px;background:rgba(0,0,0,0.5);">
	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:320px;height:100%;margin-left:calc(50% - 160px);">
		<div style="float:left;width:100%;background:white;border-radius:6px;">
			<div style="float:left;width:100%;">
    			<div style="float:right;margin-top:-15px;margin-right:-15px;">
    				<div onclick="toclose_errortips()" style="cursor:pointer;float:left;width:30px;height:30px;background:black;border-radius:50%;">
    					<img style="float:left;width:14px;height:14px;margin:8px;" src="<?php echo base_url()?>themes/default/images/mobile_close_01.png"/>
        			</div>
    				
    			</div>
			</div>
    		<div style="float:left;width:calc(100% - 40px);margin:20px;font-size:18px;">
        		<div style="float:left;width:100%;text-align:center;">
            		<img style="width:80px;height:80px;" src="<?php echo base_url()?>themes/default/images/20240820154641.png"/>
            	</div>
        		<div style="float:left;width:100%;line-height:25px;text-align:center;margin-top:20px;">
            		Please enter accordingly
            	</div>
        	</div>
    	</div>
	</div>
</div>



<div class="formtable_result_1" style="display:none;float:left;width:calc(100% - 40px);padding:20px;background:white">
    <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
    	<div onclick="togotobackpage()" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#DF9C4D;color:white;padding:10px 0px;border:0px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '返回';}else{echo 'Back';}?></div>
		<script type="text/javascript">
			function togotobackpage(){
				document.referrer === '' ? window.location.href = baseurl+'volunteer/homevisit_record_list/<?php echo $enrolmentforminfo['form_id']?>' : window.history.go(-1);
			}
		</script>
    </div>
    <div style="float:left;width:100%;line-height:30px;font-size:17px;margin-top:20px;margin-bottom:20px;text-align:center;">
        Thank you,<br />
        We look forward to seeing you soon!<br />
    </div>
    
    <div style="float:left;width:100%;line-height:24px;font-size:17px;margin-top:20px;text-align:center;">
        For any enquires, feel free to contact us at <a href="tel:6744 7444" style="letter-spacing: 0px;color:red;text-decoration:underline;">6744 7444</a>
    </div>
</div>
