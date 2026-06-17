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
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:0px 10px 10px 10px;background:rgba(255, 153, 255, 0.3);">JF001A - <?php if($this->langtype == '_ch'){echo '关怀组家访表格 （初次）';}else{echo 'Caring Unit Home Visit Form (1<sup>st</sup> visit)';}?></div>
    <div class="sectionsummary"><?php if($this->langtype == '_ch'){echo '关怀组家访表格是一种用于记录和管理被关怀者及其家庭信息的表格。';}else{echo 'The Care Group Home Visit Form is a form used to record and manage information about the person being cared for and their family.';}?></div>
    
    <div class="bodycontentarea">
    	<table cellpadding="0">
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '拜访日期 、时间';}else{echo 'Date and time of visit';}?></td>
            	<td>
            		<?php echo date('d/m/Y H:i', $recordinfo['datetime_1'])?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '信众姓名';}else{echo 'Name';}?></td>
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
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '联系方式';}else{echo 'Contact number';}?></td>
            	<td>
            		<?php echo $recordinfo['input_2']?>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '拜访地址';}else{echo 'Visiting address';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<div style="float:left;">
            				<?php echo $this->WelModel->getarea_show($recordinfo, 'checkbox_id_2', 'input_3');?>
                    	</div>
                    	<div style="float:left;margin-left:20px;">
                        	<?php echo $recordinfo['input_3']?>
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
                			<?php 
                			     $is_checked = '';
                			     for($ccc = 1; $ccc <= 10; $ccc++){
                			         if($recordinfo[$section_name.'_'.$ccc] == $valuelist[$i]['value_id']){
                			             $is_checked = ' checked';
                			         }
                			     }
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
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
            		<div class="select_id_3_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
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
        </table>
    </div>
    <?php 
        $have_volunteer_num = 0;
        for($vvv = 1; $vvv <= 6; $vvv++){
            if($recordinfo['volunteer_'.$vvv.'_id'] != 0){
                $have_volunteer_num ++;
            }
        }
    ?>
    <?php for ($vvv = 1; $vvv <= 4; $vvv++) {?>
        <div class="signincontent">
    		<div class="left2">. <?php if($this->langtype == '_ch'){echo '义工人员';}else{echo 'Volunteer name and signature';}?></div>
    		<div class="right2"><input name="signature_<?php echo $vvv?>" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" /></div>
        </div>
        <div class="signincontent">
    		<div class="left2"><?php echo $vvv?>. <?php if($this->langtype == '_ch'){echo '义工人员';}else{echo 'Volunteer name and signature';}?></div>
    		<div class="right2"><input name="signature_<?php echo $vvv?>" type="text" value="<?php echo $recordinfo['signature_'.$vvv]?>" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" /></div>
        </div>
    <?php }?>
    <?php if($have_volunteer_num >= 5){for ($vvv = 5; $vvv <= $have_volunteer_num; $vvv++) {?>
        <div class="signincontent">
    		<div class="left2">. <?php if($this->langtype == '_ch'){echo '义工人员';}else{echo 'Volunteer name and signature';}?></div>
    		<div class="right2"><input name="signature_<?php echo $vvv?>" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" /></div>
        </div>
        <div class="signincontent">
    		<div class="left2"><?php echo $vvv?>. <?php if($this->langtype == '_ch'){echo '义工人员';}else{echo 'Volunteer name and signature';}?></div>
    		<div class="right2"><input name="signature_<?php echo $vvv?>" type="text" value="<?php echo $recordinfo['signature_'.$vvv]?>" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" /></div>
        </div>
    <?php }}?>
                    
                    
    <div class="remarkscontent">
<b><?php if($this->langtype == '_ch'){echo '备注';}else{echo 'Remarks';}?></b>
<br /><?php if($this->langtype == '_ch'){echo '其他需要注意的事项';}else{echo 'Other things to keep in mind';}?>：
<br /><?php if($this->langtype == '_ch'){echo '您可以根据具体需求添加或修改以上内容，以确保表格能够全面、准确地记录关怀组成员及其家庭的信息';}else{echo 'You can add or modify the above to ensure that the form provides a comprehensive and accurate record.';}?>
    </div>
    
    <div style="float:left;width:100%;margin-top:10px;">
		<textarea name="textarea_1" style="float:left;width:calc(100% - 6px);height:100px;"><?php echo $recordinfo['textarea_1']?></textarea>
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
    <?php if($recordinfo['status'] == 0){?>
        <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
            <div class="btn_approve_submit" onclick="toapprove_form()" style="float:left;background:green;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '同意';}else{echo 'Approve';}?></div>
        	<div class="btn_approve_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
        
        	<div class="btn_reject_submit" onclick="toreject_form()" style="float:left;background:red;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;margin-left:20px;"><?php if($this->langtype == '_ch'){echo '拒绝';}else{echo 'Reject';}?></div>
        	<div class="btn_reject_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;margin-left:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
        </div>
    <?php }?>
</div>

<script type="text/javascript">
	function toapprove_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

		if(ispass == 1){
			$('.btn_approve_submit').hide();
			$('.btn_approve_loading').show();
			$.post(baseurl+'welcome/approve_formtable/<?php echo $recordinfo['form_id']?>', function (data){
				location.reload();
			})
		}
	}
	function toreject_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

		if(ispass == 1){
			$('.btn_reject_submit').hide();
			$('.btn_reject_loading').show();
			$.post(baseurl+'welcome/reject_formtable/<?php echo $recordinfo['form_id']?>', function (data){
				location.reload();
			})
		}
	}
</script>