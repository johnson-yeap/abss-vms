<script>
	function tochoose_statuswidthtext(section_name){
		var section_value = $('input[name="'+section_name+'"]:checked').val();
		if(section_value == undefined){section_value = 0;}
		if(section_value == 1){
			$('.'+section_name+'_0').hide();
			$('.'+section_name+'_1').show();
    	}else{
    		$('.'+section_name+'_0').show();
			$('.'+section_name+'_1').hide();
    	}
	}
</script>
<div class="formtable_submit">
    <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
    	<div onclick="togotobackpage()" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#DF9C4D;color:white;padding:10px 0px;border:0px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '返回';}else{echo 'Back';}?></div>
		<script type="text/javascript">
    		function togotobackpage(){
    			<?php if($recordinfo['is_closed'] == 1){?>
    				document.referrer === '' ? window.location.href = baseurl+'admin/formtable_record_list_closed/<?php echo $form_type?>' : window.history.go(-1);
    			<?php }else if($recordinfo['status'] == 1){?>
    				document.referrer === '' ? window.location.href = baseurl+'admin/formtable_record_list_passed/<?php echo $form_type?>' : window.history.go(-1);
    			<?php }else if($recordinfo['status'] == 2){?>
    				document.referrer === '' ? window.location.href = baseurl+'admin/formtable_record_list_denied/<?php echo $form_type?>' : window.history.go(-1);
    			<?php }else{?>
    				document.referrer === '' ? window.location.href = baseurl+'admin/formtable_record_list/<?php echo $form_type?>' : window.history.go(-1);
    			<?php }?>
    		}
		</script>
		<div style="float:right;">
    		<a href="<?php echo base_url().'admin/formtable_record_edit/'.$form_type.'/'.$recordinfo['form_id']?>" style="float:left;">
    			<img style="width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/revamp.png'?>"/>
    		</a>
		</div>
    </div>
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:10px 10px 10px 10px;background:rgba(0, 217, 109, 0.3);">V001A - <?php if($this->langtype == '_ch'){echo '关怀义工申请表格';}else{echo 'Caring Volunteer Application Form';}?></div>
    
    <div class="bodycontentarea">
        <table cellpadding="0">
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '头像';}else{echo 'Avatar';}?></td>
            	<td>
            		<?php
                		$picturelist = array();
                		$uploadFile1 = $recordinfo['form_pic_1_path'];
                		if($uploadFile1 != '' && file_exists($uploadFile1)){
                		    $picturelist[] = array('uploadfile_path'=>$uploadFile1, 'uploadfile_name'=>$recordinfo['form_pic_1_name']);
                		}
                		$data['upload_init_path'] = 'form';
                		$data['upload_init_type'] = 1;//1: 单选 2：多选
                		$data['upload_size_tips'] = '';
                		$data['upload_show_width'] = 200;
                		$data['upload_show_height'] = 200;
                		$data['upload_format'] = 'jpg, png, gif';
                		$data['picturelist'] = $picturelist;
                		$data['fujiangroup_name'] = 'linshi_pic_1';
                		$this->load->view('admin/user_normal_upfile_mul_view', $data);
        			?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></td>
            	<td>
            		<?php echo $recordinfo['input_1']?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?></td>
            	<td>
            		<?php 
                		if($recordinfo['select_id_1'] == 1){
                		    if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}
                		}else if($recordinfo['select_id_1'] == 2){
                		    if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}
                		}
            		?>
                	
                	<div style="float:left;width:100%;margin-top:10px;">
                    	<div style="float:left;width:100%;">
                    		<?php 
                    		      $section_name = "select_id_3";
                    		      $valuelist = array();
                    		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Three Refuges or Five Precepts', 'value_name_ch'=>'三皈或五戒');
                    		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-success', 'value_name_en'=>'Bodhisattva Vows', 'value_name_ch'=>'菩萨戒');
                    		      $valuelist[] = array('value_id'=>3, 'radioclass'=>'mgr-success', 'value_name_en'=>'Others', 'value_name_ch'=>'其他');
                    		?>
                    		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                        		<?php 
                    			     $is_checked = '';
                			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
                			             $is_checked = ' checked';
                			         }
                    			?>
                        		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                            		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                            		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                        		</div>
                    		<?php }}?>
                		</div>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '年龄';}else{echo 'Age';}?></td>
            	<td>
            		<?php 
                		if($recordinfo['select_id_2'] != 0){
                		    echo $recordinfo['select_id_2'];if($this->langtype == '_ch'){echo '岁';}else{echo ' years old';}
                		}
            		?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '语言能力';}else{echo 'Language Skills';}?></td>
            	<td>
            		 <div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '口语';}else{echo 'Spoken';}?>:</div>
                     <div style="display:none;float:left;width:100%;margin-top:5px;">
                		<?php 
                		      $section_name = "select_id_4";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Chinese', 'value_name_ch'=>'中文');
                		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-success', 'value_name_en'=>'English', 'value_name_ch'=>'英语');
                		      $valuelist[] = array('value_id'=>3, 'radioclass'=>'mgr-success', 'value_name_en'=>'Chinese and English', 'value_name_ch'=>'中文和英语');
                		      $valuelist[] = array('value_id'=>99, 'radioclass'=>'mgr-success', 'value_name_en'=>'Others', 'value_name_ch'=>'其他');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<?php 
                			     $is_checked = '';
            			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
            			             $is_checked = ' checked';
            			         }
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_select_id_4(<?php echo $valuelist[$i]['value_id']?>)" type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<?php if($valuelist[$i]['value_id'] == 99){?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="select_id_4_others" style="<?php if($recordinfo[$section_name] == 99){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_2" type="text" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;" value="<?php echo $recordinfo['input_2']?>" disabled="disabled"/></div>
                            				<div class="input_2_error" style="display:none;color:red;float:left;max-width:100px;margin-left:5px;">
                                        		<?php if($this->langtype == '_ch'){echo '请填写其他';}else{echo 'Please fill in others';}?>
                                        	</div>
                                    	</div>
                        			<?php }else{?>
                        				<?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        			<?php }?>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
            		
                	
                	
                	<div style="float:left;width:100%;margin-top:5px;">
            			<?php 
                		      $section_name = "checkbox_id_2";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'value_name_en'=>'Chinese', 'value_name_ch'=>'中文');
                		      $valuelist[] = array('value_id'=>2, 'value_name_en'=>'English', 'value_name_ch'=>'英文');
                		      $valuelist[] = array('value_id'=>3, 'value_name_en'=>'Teochew', 'value_name_ch'=>'Teochew');
                		      $valuelist[] = array('value_id'=>4, 'value_name_en'=>'Cantonese', 'value_name_ch'=>'Cantonese');
                		      $valuelist[] = array('value_id'=>5, 'value_name_en'=>'Hakka', 'value_name_ch'=>'Hakka');
                		      $valuelist[] = array('value_id'=>6, 'value_name_en'=>'Hokkien', 'value_name_ch'=>'Hokkien');
                		      $valuelist[] = array('value_id'=>7, 'value_name_en'=>'Others', 'value_name_ch'=>'其他');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                			<?php 
                			    $is_checked = '';
                			    for($ccc = 1; $ccc <= 10; $ccc++){
                			        if($recordinfo[$section_name.'_'.$ccc] == $valuelist[$i]['value_id']){
                			            $is_checked = ' checked';
                    			    }
                    			}
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_<?php echo $section_name?>()" name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<?php if($valuelist[$i]['value_id'] == 7){?>
                        				<?php 
                        				    $ishave_7 = 0;
                            				for ($ccc = 1; $ccc <= 10; $ccc++) {
                            				    if($recordinfo[$section_name.'_'.$ccc] == 7){
                            				        $ishave_7 = 1;
                            				    }
                            				}
                        				?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="<?php echo $section_name?>_others" style="<?php if($ishave_7 == 1){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_2" type="text" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;" value="<?php echo $recordinfo['input_2']?>" disabled="disabled"/></div>
                            				<div class="input_2_error" style="display:none;color:red;float:left;max-width:100px;margin-left:5px;">
                                        		<?php if($this->langtype == '_ch'){echo '请填写其他';}else{echo 'Please fill in others';}?>
                                        	</div>
                                    	</div>
                        			<?php }else{?>
                        				<?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        			<?php }?>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
                	
                	
                	
                	<div style="float:left;width:100%;margin-top:10px;"><?php if($this->langtype == '_ch'){echo '写作';}else{echo 'Written';}?>:</div>
                     <div style="display:none;float:left;width:100%;margin-top:5px;">
                		<?php 
                		      $section_name = "select_id_5";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Chinese', 'value_name_ch'=>'中文');
                		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-success', 'value_name_en'=>'English', 'value_name_ch'=>'英语');
                		      $valuelist[] = array('value_id'=>3, 'radioclass'=>'mgr-success', 'value_name_en'=>'Chinese and English', 'value_name_ch'=>'中文和英语');
                		      $valuelist[] = array('value_id'=>99, 'radioclass'=>'mgr-success', 'value_name_en'=>'Others', 'value_name_ch'=>'其他');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<?php 
                			     $is_checked = '';
            			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
            			             $is_checked = ' checked';
            			         }
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_select_id_5(<?php echo $valuelist[$i]['value_id']?>)" type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<?php if($valuelist[$i]['value_id'] == 99){?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="select_id_5_others" style="<?php if($recordinfo[$section_name] == 99){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_3" type="text" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;" value="<?php echo $recordinfo['input_3']?>" disabled="disabled"/></div>
                            				<div class="input_3_error" style="display:none;color:red;float:left;max-width:100px;margin-left:5px;">
                                        		<?php if($this->langtype == '_ch'){echo '请填写其他';}else{echo 'Please fill in others';}?>
                                        	</div>
                                    	</div>
                        			<?php }else{?>
                        				<?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        			<?php }?>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
            		
            		
                	
                	
                	
                	
                	<div style="float:left;width:100%;margin-top:5px;">
            			<?php 
                		      $section_name = "checkbox_id_3";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'value_name_en'=>'Chinese', 'value_name_ch'=>'中文');
                		      $valuelist[] = array('value_id'=>2, 'value_name_en'=>'English', 'value_name_ch'=>'英文');
                		      $valuelist[] = array('value_id'=>3, 'value_name_en'=>'Teochew', 'value_name_ch'=>'Teochew');
                		      $valuelist[] = array('value_id'=>4, 'value_name_en'=>'Cantonese', 'value_name_ch'=>'Cantonese');
                		      $valuelist[] = array('value_id'=>5, 'value_name_en'=>'Hakka', 'value_name_ch'=>'Hakka');
                		      $valuelist[] = array('value_id'=>6, 'value_name_en'=>'Hokkien', 'value_name_ch'=>'Hokkien');
                		      $valuelist[] = array('value_id'=>7, 'value_name_en'=>'Others', 'value_name_ch'=>'其他');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                			<?php 
                			    $is_checked = '';
                			    for($ccc = 1; $ccc <= 10; $ccc++){
                			        if($recordinfo[$section_name.'_'.$ccc] == $valuelist[$i]['value_id']){
                			            $is_checked = ' checked';
                    			    }
                    			}
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_<?php echo $section_name?>()" name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<?php if($valuelist[$i]['value_id'] == 7){?>
                        				<?php 
                        				    $ishave_7 = 0;
                            				for ($ccc = 1; $ccc <= 10; $ccc++) {
                            				    if($recordinfo[$section_name.'_'.$ccc] == 7){
                            				        $ishave_7 = 1;
                            				    }
                            				}
                        				?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="<?php echo $section_name?>_others" style="<?php if($ishave_7 == 1){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_3" type="text" value="<?php echo $recordinfo['input_3']?>" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;"  disabled="disabled"/></div>
                            				<div class="input_3_error" style="display:none;color:red;float:left;max-width:100px;margin-left:5px;">
                                        		<?php if($this->langtype == '_ch'){echo '请填写其他';}else{echo 'Please fill in others';}?>
                                        	</div>
                                    	</div>
                        			<?php }else{?>
                        				<?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        			<?php }?>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '联系电话';}else{echo 'Contact numbers';}?></td>
            	<td>
            		<?php echo $recordinfo['input_4']?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '地址';}else{echo 'Address';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<div style="float:left;">
            				<?php echo $this->WelModel->getarea_show($recordinfo['select_id_23']);?>
                    	</div>
                    	<div style="float:left;margin-left:20px;">
                        	<?php echo $recordinfo['input_5']?>
                    	</div>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '电子邮件地址';}else{echo 'Email Address';}?></td>
            	<td>
            		<?php echo $recordinfo['input_6']?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '紧急联系人';}else{echo 'Emergency contact person';}?></td>
            	<td>
            		<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<?php echo $recordinfo['input_7']?>
            		</div>
                	
                	<div style="float:left;width:100%;margin-top:5px;"><?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Contact';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<?php echo $recordinfo['input_8']?>
            		</div>
                	
                	<div style="float:left;width:100%;margin-top:5px;"><?php if($this->langtype == '_ch'){echo '关系';}else{echo 'Relationship';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<?php echo $recordinfo['input_9']?>
            		</div>
            	</td>
        	</tr>
        </table>
    </div>
    <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
        <?php if($this->langtype == '_ch'){echo '其他信息';}else{echo 'Other Information';}?>
    </div>
    <div class="bodycontentarea">
        <table cellpadding="0">
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '首选角色';}else{echo ' Preferred Role';}?></td>
            	<td>
                     <div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_6";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Caring Volunteer', 'value_name_ch'=>'关怀义工');
                		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-success', 'value_name_en'=>'Caring Driver', 'value_name_ch'=>'关怀司机');
                		      $valuelist[] = array('value_id'=>3, 'radioclass'=>'mgr-success', 'value_name_en'=>'Caring Volunteer and Driver', 'value_name_ch'=>'司机和关怀义工');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<?php 
                			     $is_checked = '';
            			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
            			             $is_checked = ' checked';
            			         }
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '您能承诺至少 3 个月吗？';}else{echo 'Are you able to commit to a minimum of 3 months?';}?></td>
            	<td>
                     <div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_7";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Yes', 'value_name_ch'=>'是');
                		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-danger', 'value_name_en'=>'No', 'value_name_ch'=>'否');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<?php 
                			     $is_checked = '';
            			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
            			             $is_checked = ' checked';
            			         }
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '你害怕动物吗？如狗、猫和鸟等';}else{echo 'Are You In Fear of Animals？Eg. Dog, Cat and Bird etc';}?></td>
            	<td>
                     <div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_8";
                		      $valuelist = array();
                		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-danger', 'value_name_en'=>'Yes', 'value_name_ch'=>'是');
                		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-success', 'value_name_en'=>'No', 'value_name_ch'=>'否');
                		?>
                		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                    		<?php 
                			     $is_checked = '';
            			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
            			             $is_checked = ' checked';
            			         }
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '请列出您认为与您的志愿者工作相关的任何技能或才能';}else{echo 'Please list any skills or talents that you feel are relevant to your volunteer work';}?></td>
            	<td>
                    <?php echo $recordinfo['textarea_1']?>
            	</td>
        	</tr>
        </table>
    </div>
    
    <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
        <?php if($this->langtype == '_ch'){echo '可提供家访的时间';}else{echo 'Availability';}?>
    </div>
    <div class="bodycontentarea">
        <table cellpadding="0">
        	<tr>
            	<td class="tdleftside" rowspan="2"></td>
        		<td colspan="2" align="center"><?php if($this->langtype == '_ch'){echo '每周可参与的时段';}else{echo 'The time slot that can be participated in each day';}?></td>
        	</tr>
        	<tr>
        		<td align="center">AM : 10–12pm</td>
        		<td align="center">PM : 2-4pm</td>
        	</tr>
        	<tr>
            	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周一';}else{echo 'Monday';}?></td>
        		<td>
        			<?php $section_name = 'select_id_9';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_10';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        	</tr>
        	<tr>
            	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周二';}else{echo 'Tuesday';}?></td>
        		<td>
        			<?php $section_name = 'select_id_11';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_12';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        	</tr>
        	<tr>
            	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周三';}else{echo 'Wednesday';}?></td>
        		<td>
        			<?php $section_name = 'select_id_13';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_14';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        	</tr>
        	<tr>
            	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周四';}else{echo 'Thursday';}?></td>
        		<td>
        			<?php $section_name = 'select_id_15';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_16';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        	</tr>
        	<tr>
            	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周五';}else{echo 'Friday';}?></td>
        		<td>
        			<?php $section_name = 'select_id_17';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_18';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        	</tr>
        	<tr>
            	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周六';}else{echo 'Saturday';}?></td>
        		<td>
        			<?php $section_name = 'select_id_19';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_20';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        	</tr>
        	<tr>
            	<td class="tdleftside" align="center"><?php if($this->langtype == '_ch'){echo '周日';}else{echo 'Sunday';}?></td>
        		<td>
        			<?php $section_name = 'select_id_21';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_22';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?> disabled="disabled"/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        	</tr>
        </table>
    </div>
    
    <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
        <?php if($this->langtype == '_ch'){echo '个人承诺';}else{echo 'Personal Commitment';}?>
    </div>
    <div class="agreecontent">
    	<div style="float:left;width:100%;">
    		<div style="float:left;width:25px;"><input name="shenming_1" id="shenming_1" type="checkbox" class="mgc mgc-success mgc-lg" value="1" checked disabled="disabled"/></div>
    		<label for="shenming_1" style="float:left;width:calc(100% - 25px - 10px);line-height:20px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '本人自愿加入关怀组， 承诺遵守组织的相关规定，积极参与关怀活动，保护服务对象的隐私，履行义工的责任。';}else{echo 'I voluntarily joined the care group and promised to abide by the relevant regulations of the organization, actively participate in care activities, protect the privacy of service users, and fulfill the responsibilities of volunteers.';}?></label>
    	</div>
    </div>
    <div class="agreecontent">
    	<div style="float:left;width:100%;">
    		<div style="float:left;width:25px;"><input name="shenming_2" id="shenming_2" type="checkbox" class="mgc mgc-success mgc-lg" value="1" checked disabled="disabled"/></div>
			<label for="shenming_2" style="float:left;width:calc(100% - 25px - 10px);line-height:20px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '本人特此声明，所提供的信息是真实和正确的。';}else{echo 'I hereby declare that the information provided is true and correct. ';}?></label>
    	</div>
    </div>
    
    
    <div class="signincontent">
		<div class="left3"><?php if($this->langtype == '_ch'){echo '申请人签名';}else{echo 'Signature';}?></div>
		<div class="right3">
			<div style="float:left;width:100%;">
    			<input name="signature_1" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" value="<?php echo $recordinfo['signature_1'];?>" disabled="disabled"/>
    		</div>
		</div>
    </div>
    <div class="signincontent">
		<div class="left3"><?php if($this->langtype == '_ch'){echo '日期';}else{echo 'Date';}?></div>
		<div class="right3">
			<?php echo date('d/m/Y', $recordinfo['datetime_1'])?>
		</div>
    </div>
    <div class="signincontent">
		<div class="left2"><?php if($this->langtype == '_ch'){echo '状态';}else{echo 'Status';}?></div>
		<div class="right2">
			<?php 
        		if($recordinfo['status'] == 1){
        		    echo '<span style="color:green;">Passed</span>';
        		}else if($recordinfo['status'] == 2){
        		    echo '<span style="color:green;">Denied</span>';
        		}else{
        		    echo '<span style="color:orange;">Pending</span>';
        		}
    		?>
		</div>
    </div>
    <div class="signincontent">
		<div class="left2"><?php if($this->langtype == '_ch'){echo '提交时间';}else{echo 'Submit Time';}?></div>
		<div class="right2">
			<?php echo date('d/m/Y H:i', $recordinfo['created'])?>
		</div>
    </div>
    
    <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
		<?php if($this->langtype == '_ch'){echo '关怀组委员会意见 (仅供内部填写）';}else{echo 'Comments From The Caring Committee (For Internal Use Only)';}?>
    	<div style="float:right;">
    		<a href="javascript:;" onclick="toshow_editapprove()">
    			<img style="width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/revamp.png'?>"/>
    		</a>
		</div>
		<script>
			function toshow_editapprove(){
				if($('.shenpi_edition').css('display') == 'none'){
					$('.shenpi_edition').show();
					$('.shenpi_viewtion').hide();
				}else{
					$('.shenpi_edition').hide();
					$('.shenpi_viewtion').show();
				}
			}
		</script>
    </div>
    <div class="shenpi_edition" style="float:left;width:100%;<?php if($recordinfo['status'] == 0){}else{echo 'display:none;';}?>">
    	<div class="bodycontentarea">
            <table cellpadding="0">
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '申请状态';}else{echo 'Application Status';}?></td>
            		<td>
            			<div style="float:left;"><input name="jiankang" id="jiankang_1" onclick="tochoose_status(1)" type="radio" class="mgr mgr-success mgr-lg" value="1" checked/></div>
                		<label for="jiankang_1" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '通过';}else{echo 'Passed';}?></label>
                		
                		<div style="float:left;"><input name="jiankang" id="jiankang_2" onclick="tochoose_status(2)" type="radio" class="mgr mgr-danger mgr-lg" value="2"/></div>
                		<label for="jiankang_2" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '拒绝';}else{echo 'Denied';}?></label>
            			
            			<script>
    						function tochoose_status(status){
    							if(status == 1){
    								$('.btn_approve_submit').show();
    								$('.btn_reject_submit').hide();
    							}else{
    								$('.btn_approve_submit').hide();
    								$('.btn_reject_submit').show();
    							}
    						}
            			</script>
            		</td>
            	</tr>
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '经验';}else{echo 'Experience';}?></td>
            		<td>
            			<div style="float:left;width:100%;">
                			<div style="float:left;"><input name="is_experience" id="is_experience_1" type="radio" class="mgr mgr-success mgr-lg" value="1"/></div>
                    		<label for="is_experience_1" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></label>
                    		
                    		<div style="float:left;"><input name="is_experience" id="is_experience_0" type="radio" class="mgr mgr-danger mgr-lg" value="0"/></div>
                    		<label for="is_experience_0" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></label>
                		</div>
            			<div class="is_experience_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                    		<?php if($this->langtype == '_ch'){echo '请选择经验';}else{echo 'Please choose experience';}?>
                    	</div>
            		</td>
            	</tr>
            	<!-- 
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '备注';}else{echo 'Remarks';}?></td>
            		<td></td>
            	</tr>
            	 -->
            </table>
        </div>
        <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
            <div class="btn_approve_submit" onclick="toapprove_form()" style="float:left;background:green;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '通过';}else{echo 'Pass';}?></div>
        	<div class="btn_approve_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
        
        	<div class="btn_reject_submit" onclick="toreject_form()" style="display:none;float:left;background:red;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;margin-left:20px;"><?php if($this->langtype == '_ch'){echo '拒绝';}else{echo 'Deny';}?></div>
        	<div class="btn_reject_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;margin-left:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
        </div>
    </div>
    <div class="shenpi_viewtion" style="float:left;width:100%;<?php if($recordinfo['status'] != 0){}else{echo 'display:none;';}?>">
    	<div class="bodycontentarea">
            <table cellpadding="0">
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '申请状态';}else{echo 'Application Status';}?></td>
            		<td>
            			<div style="float:left;"><input name="jiankang" id="jiankang_1" onclick="tochoose_status(1)" type="radio" class="mgr mgr-success mgr-lg" value="1" <?php if($recordinfo['status'] == 1){echo 'checked';}?> disabled="disabled"/></div>
                		<label for="jiankang_1" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '通过';}else{echo 'Passed';}?></label>
                		
                		<div style="float:left;"><input name="jiankang" id="jiankang_2" onclick="tochoose_status(2)" type="radio" class="mgr mgr-danger mgr-lg" value="2" <?php if($recordinfo['status'] == 2){echo 'checked';}?> disabled="disabled"/></div>
                		<label for="jiankang_2" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '拒绝';}else{echo 'Denied';}?></label>
            		</td>
            	</tr>
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '经验';}else{echo 'Experience';}?></td>
            		<td>
            			<div style="float:left;width:100%;">
                			<div style="float:left;"><input name="is_experience" id="is_experience_1" type="radio" class="mgr mgr-success mgr-lg" value="1" <?php if($recordinfo['is_experience'] == 1){echo 'checked';}?> disabled="disabled"/></div>
                    		<label for="is_experience_1" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></label>
                    		
                    		<div style="float:left;"><input name="is_experience" id="is_experience_0" type="radio" class="mgr mgr-danger mgr-lg" value="0" <?php if($recordinfo['is_experience'] == 0){echo 'checked';}?> disabled="disabled"/></div>
                    		<label for="is_experience_0" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></label>
                		</div>
            		</td>
            	</tr>
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '操作时间';}else{echo 'Action Time';}?></td>
            		<td><?php echo date('d/m/Y H:i', $recordinfo['status_time'])?></td>
            	</tr>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
	function toapprove_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

		var is_experience = $('input[name="is_experience"]:checked').val();
		if(is_experience == undefined){is_experience = -1;}

		if(is_experience == -1){ispass = 0;$('.is_experience_error').show();}else{$('.is_experience_error').hide();}

		if(ispass == 1){
			$('.btn_approve_submit').hide();
			$('.btn_approve_loading').show();
			var postOBJ = new Object();
			postOBJ.is_experience = is_experience;
			$.post(baseurl+'welcome/approve_formtable/<?php echo $recordinfo['form_id']?>/1', postOBJ, function (data){
				//location.reload();
				location.href = baseurl+'admin/formtable_record_list_passed/<?php echo $form_type?>';
			})
		}
	}
	function toreject_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

		var is_experience = $('input[name="is_experience"]:checked').val();
		if(is_experience == undefined){is_experience = -1;}

		if(is_experience == -1){ispass = 0;$('.is_experience_error').show();}else{$('.is_experience_error').hide();}

		if(ispass == 1){
			$('.btn_reject_submit').hide();
			$('.btn_reject_loading').show();
			var postOBJ = new Object();
			postOBJ.is_experience = is_experience;
			$.post(baseurl+'welcome/approve_formtable/<?php echo $recordinfo['form_id']?>/2', postOBJ, function (data){
				//location.reload();
				location.href = baseurl+'admin/formtable_record_list_passed/<?php echo $form_type?>';
			})
		}
	}
</script>