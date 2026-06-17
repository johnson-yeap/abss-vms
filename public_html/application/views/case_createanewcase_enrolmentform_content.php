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
    </div>
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:10px 10px 10px 10px;background:rgba(54, 162, 235, 0.3);"><?php echo str_replace('ABSSP', 'ABSSC', $recordinfo['form_number']);?> (a)</div>
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
        </table>
    </div>
    <div style="float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
        <?php if($this->langtype == '_ch'){echo '关怀组委员会意见（仅供内部填写）';}else{echo 'Comments From The Caring Committee (For Internal Use Only)';}?>
    </div>
    <div class="shenpi_edition" style="float:left;width:100%;">
    	<div class="bodycontentarea">
            <table cellpadding="0">
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
        
    </div>
    <div style="float:left;width:100%;margin-top:15px;">
		<div style="float:left;width:100%;line-height:28px;font-size:20px;font-weight:bold;">
    		<?php if($this->langtype == '_ch'){echo '备注：';}else{echo 'Note: ';}?>
    	</div>
		<div style="float:left;width:100%;margin-top:10px;">
    		<textarea name="assign_memo" style="float:left;width:calc(100% - 6px);height:80px;"><?php echo $recordinfo['assign_memo']?></textarea>
		</div>
	</div>
	
    <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
        <div class="btn_form_submit" onclick="tosubmit_form()" style="float:left;background:#DF9C4D;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '创建一个新的案例';}else{echo 'Create New Case';}?></div>
    	<div class="btn_form_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
    </div>
    
    
</div>


<script type="text/javascript">
	var form_type = '<?php echo $form_type?>';
	function tosubmit_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;
		
		var assign_memo = $('textarea[name="assign_memo"]').val();

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
			$('.btn_form_submit').hide();
			$('.btn_form_loading').show();

			var postOBJ = new Object();
			postOBJ.form_type = form_type;
			postOBJ.assign_memo = assign_memo;
			
			postOBJ.select_id_8 = select_id_8;
			<?php for ($aaa = 1; $aaa <= 1; $aaa++) {?>
    			postOBJ.checkbox_id_<?php echo $aaa?> = checkbox_id_<?php echo $aaa?>;
    		<?php }?>
			
    		$.post(baseurl+'admin/action_createanewcase/<?php echo $recordinfo['form_id']?>', postOBJ, function (data){
    			if(data == 'feifacanshu'){
				    toopen_errortips();//打开错误提示
				}else{
	    			location.href = baseurl+'admin/case_pending';
				}
			})
		}
	}
</script>