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
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:10px 10px 10px 10px;background:rgba(178, 89, 0, 0.3);">JF002B - <?php if($this->langtype == '_ch'){echo '家访跟进表';}else{echo 'Home Visit Form (follow up visit)';}?></div>
    
    <div class="bodycontentarea">
        <table cellpadding="0">
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '日期与时间';}else{echo 'Date/time';}?></td>
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
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '评估';}else{echo 'Assessment';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<?php echo $recordinfo['textarea_1']?>
            		</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '跟进下一次访问';}else{echo 'To follow up the next visit';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
                		<?php 
                		      $section_name = "select_id_1";
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
            		<div class="select_id_1_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择跟进下一次访问';}else{echo 'Please choose follow up the next visit';}?>
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
    		<div class="left2"><?php echo $vvv?>. <?php if($this->langtype == '_ch'){echo '义工人员';}else{echo 'Volunteer name and signature';}?></div>
    		<div class="right2">
    			<div style="float:left;width:100%;">
        			<input name="signature_<?php echo $vvv?>" type="text" value="<?php echo $recordinfo['signature_'.$vvv]?>" readonly="readonly" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" />
        		</div>
    		</div>
        </div>
    <?php }?>
    <?php if($have_volunteer_num >= 5){for ($vvv = 5; $vvv <= $have_volunteer_num; $vvv++) {?>
        <div class="signincontent">
    		<div class="left2"><?php echo $vvv?>. <?php if($this->langtype == '_ch'){echo '义工人员';}else{echo 'Volunteer name and signature';}?></div>
    		<div class="right2">
    			<div style="float:left;width:100%;">
        			<input name="signature_<?php echo $vvv?>" type="text" value="<?php echo $recordinfo['signature_'.$vvv]?>" readonly="readonly" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" />
        		</div>
    		</div>
        </div>
    <?php }}?>
    
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
