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
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:10px 10px 10px 10px;background:rgba(54, 162, 235, 0.3);"><?php echo $recordinfo['form_number'];?> - P001A - <?php if($this->langtype == '_ch'){echo '接受关怀登记表';}else{echo 'Caring Form';}?></div>
    <div class="sectionsummary"><?php if($this->langtype == '_ch'){echo '欢迎您登记接受关怀，请填写以下信息，以便我们为您提供更好的关怀服务';}else{echo 'Welcome to register for care. Please fill in the following information so that we can provide you with better care services';}?></div>
    <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
        <?php if($this->langtype == '_ch'){echo '个人信息';}else{echo 'Personal Information';}?>
    </div>
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
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '会员号码';}else{echo 'Membership';}?></td>
            	<td>
            		<?php $section_name = 'select_id_3';?>
            		<div style="float:left;width:100%;">
            			<div style="float:left;"><input name="<?php echo $section_name;?>" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] != 0){echo 'checked';}?> disabled="disabled"/></div>
            			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                		<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是 : 请注明';}else{echo 'Yes : please specify';}?></div>
            		</div>
            		<div class="input_2_area" style="<?php if($recordinfo['select_id_3'] != 0){echo '';}else{echo 'display:none;';}?>float:left;width:100%;margin-top:5px;">
                		<div style="float:left;width:100%;">
                			<input name="input_2" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;" value="<?php echo $recordinfo['input_2']?>" disabled="disabled"/>
                		</div>
                	</div>
                	<div style="float:left;width:100%;margin-top:10px;">
                    	<div style="float:left;width:100%;">
                    		<?php 
                    		      $section_name = "select_id_4";
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
                		<div class="select_id_4_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                    		<?php if($this->langtype == '_ch'){echo '请选择';}else{echo 'Please choose';}?>
                    	</div>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '语言能力';}else{echo 'Language Skills';}?></td>
            	<td>
            		<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '口语';}else{echo 'Spoken';}?>:</div>
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
                        		<div style="float:left;width:25px;"><input type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<?php if($valuelist[$i]['value_id'] == 99){?>
                        				<?php 
                        				    $ishave_99 = 0;
                            				for ($ccc = 1; $ccc <= 10; $ccc++) {
                            				    if($recordinfo[$section_name.'_'.$ccc] == 99){
                            				        $ishave_99 = 1;
                            				    }
                            				}
                        				?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="<?php echo $section_name?>_others" style="<?php if($ishave_99 == 1){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_3" type="text" value="<?php echo $recordinfo['input_3']?>" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;"/></div>
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
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '电话号码';}else{echo 'Contact Number';}?></td>
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
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '紧急联络人';}else{echo 'Emergency contact person';}?></td>
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
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '有没有非佛教徒的家庭成员？';}else{echo 'Any Family Members Who Are NonBuddhism?';}?></td>
            	<td>
                     <div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_6";
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
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="select_id_6_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择身心状况有没有非佛教徒的家庭成员';}else{echo 'Please choose Any Family Members Who Are NonBuddhism';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '你家里有动物吗？如狗、猫和鸟等';}else{echo 'Do You Have Animals In Your Home? Eg. Dog, Cat and Bird etc';}?></td>
            	<td>
                     <div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_7";
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
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="select_id_7_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择你家里有动物吗？如狗、猫和鸟等';}else{echo 'Please choose Do You Have Animals In Your Home?';}?>
                	</div>
            	</td>
        	</tr>
        </table>
    </div>
    
    
    <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
        <?php if($this->langtype == '_ch'){echo '家访的时间';}else{echo 'Availability';}?>
    </div>
    <div class="bodycontentarea">
        <table cellpadding="0">
        	<tr>
            	<td class="tdleftside" rowspan="2"></td>
        		<td colspan="2" align="center"><?php if($this->langtype == '_ch'){echo '每天可参与的时段';}else{echo 'Your Available Timeslot';}?></td>
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
        <?php if($this->langtype == '_ch'){echo '声明与同意';}else{echo 'Consent form';}?>
    </div>
    <div class="agreecontent">
		<div style="float:left;width:25px;"><input name="shenming_1" id="shenming_1" type="radio" class="mgr mgr-success mgr-lg" value="1" checked/></div>
		<label for="shenming_1" style="float:left;width:calc(100% - 25px - 10px);line-height:20px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '本人声明所提供的信息真实准确，并同意佛教关怀组使用这些信息为我提供关怀服务。';}else{echo 'I declare that the information provided is true and accurate, and I agree that the Buddhist Care Team will use this information to provide care services to me.';}?></label>
    </div>
    
    <div class="signincontent">
		<div class="left3"><?php if($this->langtype == '_ch'){echo '签名';}else{echo 'Signature';}?></div>
		<div class="right3"><input name="signature_1" type="text" value="<?php echo $recordinfo['signature_1']?>" disabled="disabled" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" /></div>
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
        		    echo '<span style="color:green;">Approved</span>';
        		}else if($recordinfo['status'] == 2){
        		    echo '<span style="color:green;">Approved</span>';
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
        <?php if($this->langtype == '_ch'){echo '关怀组委员会意见（仅供内部填写）';}else{echo 'Comments From The Caring Committee (For Internal Use Only)';}?>
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
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '当前健康状况';}else{echo 'Current Health Condition(s)';}?></td>
                	<td>
                         <div style="float:left;width:100%;">
                    		<?php 
                    		      $section_name = "select_id_8";
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
                    		<?php if($this->langtype == '_ch'){echo '请选择当前健康状况';}else{echo 'Please choose Current Health Condition(s)';}?>
                    	</div>
                	</td>
            	</tr>
            </table>
        </div>
        
        <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
            <?php if($this->langtype == '_ch'){echo '需求和期望';}else{echo 'Needs and Concern';}?>
        </div>
        <div class="bodycontentarea">
            <table cellpadding="0">
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '需要哪方面的帮助';}else{echo 'Area of Help';}?></td>
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
                		<div class="checkbox_id_1_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                    		<?php if($this->langtype == '_ch'){echo '请选择需要哪方面的帮助';}else{echo 'Please choose Area of Help';}?>
                    	</div>
                	</td>
            	</tr>
            </table>
        </div>
        
        
        
        <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
            <div class="btn_approve_submit" onclick="toapprove_form()" style="float:left;background:green;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '同意';}else{echo 'Approve';}?></div>
        	<div class="btn_approve_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
        
        	<div class="btn_reject_submit" onclick="toreject_form()" style="display:none;float:left;background:red;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;margin-left:20px;"><?php if($this->langtype == '_ch'){echo '拒绝';}else{echo 'Reject';}?></div>
        	<div class="btn_reject_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;margin-left:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
        </div>
    </div>
    <div class="shenpi_viewtion" style="float:left;width:100%;<?php if($recordinfo['status'] != 0){}else{echo 'display:none;';}?>">
    	<div class="bodycontentarea">
            <table cellpadding="0">
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '申请状态';}else{echo 'Application Status';}?></td>
            		<td>
            			<div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" value="1" <?php if($recordinfo['status'] == 1){echo 'checked';}?> disabled="disabled"/></div>
                		<label style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '通过';}else{echo 'Passed';}?></label>
                		
                		<div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" value="2" <?php if($recordinfo['status'] == 2){echo 'checked';}?> disabled="disabled"/></div>
                		<label style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '拒绝';}else{echo 'Denied';}?></label>
            		</td>
            	</tr>
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '当前健康状况';}else{echo 'Current Health Condition(s)';}?></td>
                	<td>
                         <div style="float:left;width:100%;">
                    		<?php 
                    		      $section_name = "select_id_8";
                    		      $valuelist = array();
                    		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Good', 'value_name_ch'=>'良好');
                    		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-primary', 'value_name_en'=>'Normal', 'value_name_ch'=>'正常');
                    		      $valuelist[] = array('value_id'=>3, 'radioclass'=>'mgr-warning', 'value_name_en'=>'Poor/Weak', 'value_name_ch'=>'状况不佳');
                    		      $valuelist[] = array('value_id'=>4, 'radioclass'=>'mgr-danger', 'value_name_en'=>'Bed Bound', 'value_name_ch'=>'卧床不起');
                    		?>
                    		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
                        		<?php 
                    			     $is_checked = '';
                			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
                			             $is_checked = ' checked';
                			         }
                    			?>
                        		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                            		<div style="float:left;width:25px;"><input type="radio" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                            		<label style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                        		</div>
                    		<?php }}?>
                		</div>
                	</td>
            	</tr>
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '操作时间';}else{echo 'Action Time';}?></td>
            		<td><?php echo date('d/m/Y H:i', $recordinfo['status_time'])?></td>
            	</tr>
            </table>
        </div>
        <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
            <?php if($this->langtype == '_ch'){echo '需求和期望';}else{echo 'Needs and Concern';}?>
        </div>
        <div class="bodycontentarea">
            <table cellpadding="0">
            	<tr>
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '需要哪方面的帮助';}else{echo 'Area of Help';}?></td>
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
                        		<?php 
                    			     $is_checked = '';
                    			     for($ccc = 1; $ccc <= 10; $ccc++){
                    			         if($recordinfo[$section_name.'_'.$ccc] == $valuelist[$i]['value_id']){
                    			             $is_checked = ' checked';
                    			         }
                    			     }
                    			?>
                        		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                            		<div style="float:left;width:25px;"><input type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                            		<label style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                        		</div>
                    		<?php }}?>
                		</div>
                	</td>
            	</tr>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
	function toapprove_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

		var select_id_8 = $('input[name="select_id_8"]:checked').val();
		if(select_id_8 == undefined){select_id_8 = 0;}

		var checkbox_id_1_arr = $('input[name="checkbox_id_1[]"]:checked');
		var checkbox_id_1 = [];
		if(checkbox_id_1_arr.length > 0){
			for(i = 0; i < checkbox_id_1_arr.length; i++){
				checkbox_id_1.push(checkbox_id_1_arr[i].value);
			}
		}
		console.log('checkbox_id_1:', checkbox_id_1);

		if(select_id_8 == 0){ispass = 0;$('.select_id_8_error').show();}else{$('.select_id_8_error').hide();}

		if(checkbox_id_1.length == 0){ispass = 0;$('.checkbox_id_1_error').show();}else{$('.checkbox_id_1_error').hide();}

		if(ispass == 1){
			$('.btn_approve_submit').hide();
			$('.btn_approve_loading').show();
			var postOBJ = new Object();
			postOBJ.select_id_8 = select_id_8;
			<?php for ($aaa = 1; $aaa <= 1; $aaa++) {?>
    			postOBJ.checkbox_id_<?php echo $aaa?> = checkbox_id_<?php echo $aaa?>;
    		<?php }?>
    		
    		$.post(baseurl+'welcome/approve_formtable/<?php echo $recordinfo['form_id']?>/1', postOBJ, function (data){
				//location.reload();
				location.href = baseurl+'admin/formtable_record_list_passed/<?php echo $form_type?>';
			})
		}
	}
	function toreject_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

		var select_id_8 = $('input[name="select_id_8"]:checked').val();
		if(select_id_8 == undefined){select_id_8 = 0;}

		if(select_id_8 == 0){ispass = 0;$('.select_id_8_error').show();}else{$('.select_id_8_error').hide();}

		if(ispass == 1){
			$('.btn_reject_submit').hide();
			$('.btn_reject_loading').show();
			var postOBJ = new Object();
			postOBJ.select_id_8 = select_id_8;
			$.post(baseurl+'welcome/approve_formtable/<?php echo $recordinfo['form_id']?>/2', postOBJ, function (data){
				//location.reload();
				location.href = baseurl+'admin/formtable_record_list_passed/<?php echo $form_type?>';
			})
		}
	}
</script>