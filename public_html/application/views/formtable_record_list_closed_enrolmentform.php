<div class="formtable_tabletitle">
	<div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
    	<div onclick="togotobackpage()" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#DF9C4D;color:white;padding:10px 0px;border:0px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '返回';}else{echo 'Back';}?></div>
		<script type="text/javascript">
			function togotobackpage(){
				document.referrer === '' ? window.location.href = baseurl+'admin' : window.history.go(-1);
			}
		</script>
		<div style="float:left;line-height:40px;margin-left:10px;">
        	P001A - <?php if($this->langtype == '_ch'){echo '接受关怀登记表';}else{echo 'Caring Form';}?>
    	</div>
    </div>
	<div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
		<div style="float:left;width:200px;line-height:20px;">
			<?php 
    			$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = '".$form_type."' AND select_id_1 = 1";
    			$res = $this->db->query($sql)->row_array();
    			if(!empty($res)){if($res['numcount'] != ''){$count_male = $res['numcount'];}else{$count_male = 0;}}else{$count_male = 0;}
			?>
			<div style="float:left;"><img style="width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/sex_male.jpg'?>"/></div>
			<div style="float:left;">：</div>
			<div style="float:left;margin-left:6px;color:#61A5D6;"><?php echo $count_male?></div>
			<?php 
    			$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE form_type = '".$form_type."' AND select_id_1 = 2";
    			$res = $this->db->query($sql)->row_array();
    			if(!empty($res)){if($res['numcount'] != ''){$count_female = $res['numcount'];}else{$count_female = 0;}}else{$count_female = 0;}
			?>
			<div style="float:left;margin-left:50px;"><img style="width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/sex_female.jpg'?>"/></div>
			<div style="float:left;">：</div>
			<div style="float:left;margin-left:6px;color:#FF69C0;"><?php echo $count_female?></div>
		</div>
		<?php 
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$fearanimal_id = $this->input->get('fearanimal_id');
			$address_id = $this->input->get('address_id');
			$health_id = $this->input->get('health_id');
			$gender = $this->input->get('gender');
		    $keyword = $this->input->get('keyword');
		?>
		<div style="float:left;width:calc(100% - 200px);">
			<div style="float:right;">
				<form action = "<?php echo base_url().'admin/formtable_record_list_closed/'.$form_type?>" method="get">
					<div style="float:left;width:170px;margin-right:10px;">
                    	<?php 
            			     $section_name = "start_date";
            			     if($start_date != ''){
            			         $start_date_time = strtotime($start_date);
            			     }else{
            			         $start_date_time = 0;
            			     }
            			?>
            			<div style="position:relative;float:left;width:100%;">
                    		<input name="<?php echo $section_name;?>" type="date" id="<?php echo $section_name;?>" value="<?php echo $start_date;?>" style="float:left;width:170px;line-height:20px;border:0px;"/>
                    		<div style="position:absolute;top:2px;bottom:2px;left:2px;width:120px;line-height:36px;font-size: 14px;text-align:center;background-color: #EFEFEF;">
                    			<div id="<?php echo $section_name;?>_day" style="float:left;width:25px;color: green;margin-left:10px;"><?php if($start_date_time != 0){date('d', $start_date_time);}else{if($this->langtype == '_ch'){echo '日';}else{echo 'dd';}}?></div>
            					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
            					<div id="<?php echo $section_name;?>_month" style="float:left;width:25px;color: blue; "><?php if($start_date_time != 0){date('m', $start_date_time);}else{if($this->langtype == '_ch'){echo '月';}else{echo 'mm';}}?></div>
            					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
            					<div id="<?php echo $section_name;?>_year" style="float:left;width:40px;color: purple;"><?php if($start_date_time != 0){date('Y', $start_date_time);}else{if($this->langtype == '_ch'){echo '年';}else{echo 'YYYY';}}?></div>
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
                	<div style="float:left;line-height:35px;margin-right:10px;">
                		~ 
                	</div>
                	<div style="float:left;width:170px;margin-right:10px;">
                    	<?php 
            			     $section_name = "end_date";
            			     if($end_date != ''){
            			         $end_date_time = strtotime($end_date);
            			     }else{
            			         $end_date_time = 0;
            			     }
            			?>
            			<div style="position:relative;float:left;width:100%;">
                    		<input name="<?php echo $section_name;?>" type="date" id="<?php echo $section_name;?>" value="<?php echo $end_date;?>" style="float:left;width:170px;line-height:20px;border:0px;"/>
                    		<div style="position:absolute;top:2px;bottom:2px;left:2px;width:120px;line-height:36px;font-size: 14px;text-align:center;background-color: #EFEFEF;">
                    			<div id="<?php echo $section_name;?>_day" style="float:left;width:25px;color: green;margin-left:10px;"><?php if($end_date_time != 0){date('d', $end_date_time);}else{if($this->langtype == '_ch'){echo '日';}else{echo 'dd';}}?></div>
            					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
            					<div id="<?php echo $section_name;?>_month" style="float:left;width:25px;color: blue; "><?php if($end_date_time != 0){date('m', $end_date_time);}else{if($this->langtype == '_ch'){echo '月';}else{echo 'mm';}}?></div>
            					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
            					<div id="<?php echo $section_name;?>_year" style="float:left;width:40px;color: purple;"><?php if($end_date_time != 0){date('Y', $end_date_time);}else{if($this->langtype == '_ch'){echo '年';}else{echo 'YYYY';}}?></div>
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
    <div style="float:left;width:100%;border-bottom:1px solid #CCC;font-size:24px;font-weight:bold;margin-bottom:10px;">
    	<?php 
        	$subsql = " AND is_closed = 0 AND status = 0";
        	$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = '".$form_type."' ".$subsql." ORDER BY form_id DESC";
        	$res = $this->db->query($sql)->row_array();
        	if(!empty($res)){if($res['numcount'] != ''){$numcount = $res['numcount'];}else{$numcount = 0;}}else{$numcount = 0;}
    	?>
    	<div onclick="javascript:location.href='<?php echo base_url().'admin/formtable_record_list/'.$form_type;?>';" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#EFEFEF;color:gray;padding:10px 0px;border:0px;border-top-left-radius:10px;border-top-right-radius:10px;"><?php if($this->langtype == '_ch'){echo '待分配';}else{echo 'Pending';}?> <?php if($numcount != 0){echo '<span style="color:red;">('.$numcount.')</span>';}?></div>
    	<?php 
    	    $subsql = " AND is_closed = 0 AND status = 1";
        	$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = '".$form_type."' ".$subsql." ORDER BY form_id DESC";
        	$res = $this->db->query($sql)->row_array();
        	if(!empty($res)){if($res['numcount'] != ''){$numcount = $res['numcount'];}else{$numcount = 0;}}else{$numcount = 0;}
    	?>
    	<div onclick="javascript:location.href='<?php echo base_url().'admin/formtable_record_list_passed/'.$form_type;?>';" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#EFEFEF;color:gray;padding:10px 0px;border:0px;border-top-left-radius:10px;border-top-right-radius:10px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '已通过';}else{echo 'Passed';}?> <?php if($numcount != 0){echo '<span style="color:green;">('.$numcount.')</span>';}?></div>
    	<?php 
    	    $subsql = " AND is_closed = 0 AND status = 2";
        	$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = '".$form_type."' ".$subsql." ORDER BY form_id DESC";
        	$res = $this->db->query($sql)->row_array();
        	if(!empty($res)){if($res['numcount'] != ''){$numcount = $res['numcount'];}else{$numcount = 0;}}else{$numcount = 0;}
    	?>
    	<div onclick="javascript:location.href='<?php echo base_url().'admin/formtable_record_list_denied/'.$form_type;?>';" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#EFEFEF;color:gray;padding:10px 0px;border:0px;border-top-left-radius:10px;border-top-right-radius:10px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '已拒绝';}else{echo 'denied';}?> <?php if($numcount != 0){echo '<span style="color:red;">('.$numcount.')</span>';}?></div>
    	<?php 
    	    $subsql = " AND is_closed = 1";
        	$sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = '".$form_type."' ".$subsql." ORDER BY form_id DESC";
        	$res = $this->db->query($sql)->row_array();
        	if(!empty($res)){if($res['numcount'] != ''){$numcount = $res['numcount'];}else{$numcount = 0;}}else{$numcount = 0;}
    	?>
    	<div onclick="javascript:location.href='<?php echo base_url().'admin/formtable_record_list_closed/'.$form_type;?>';" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:gray;color:white;padding:10px 0px;border:0px;border-top-left-radius:10px;border-top-right-radius:10px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '已关闭';}else{echo 'Closed';}?> <?php if($numcount != 0){echo '<span style="">('.$numcount.')</span>';}?></div>
    </div>
    <?php 
        $add_minuswidth = 0;
        $add_minuswidth += 60;
        $add_minuswidth += 60;
    ?>
	<div class="sectiontitle">
        <div style="float:left;width:60px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '头像';}else{echo 'Avatar';}?></div>
        <div style="float:left;width:calc(100% - 120px - 120px - 120px - 120px - 60px - 60px - 60px - 140px);font-size:16px;"><?php if($this->langtype == '_ch'){echo '表单';}else{echo 'Form';}?></div>
    	<div style="float:left;width:120px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '有动物吗？';}else{echo 'Have Animal?';}?></div>
		<div style="float:left;width:60px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?></div>
		<div style="float:left;width:60px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '年龄';}else{echo 'Age';}?></div>
    	<div style="float:left;width:120px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '当前健康';}else{echo 'Current Health';}?></div>
    	<div style="float:left;width:120px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '状态';}else{echo 'Status';}?></div>
    	<div style="float:left;width:120px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '时间';}else{echo 'Time';}?></div>
    	<div style="float:left;width:140px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></div>
	</div>
</div>
<?php 
    $subsql = " AND is_closed = 1";
    if($start_date != '' && $end_date != ''){
        $subsql .= " AND created >= ".strtotime($start_date.' 00:00:00')." AND created <= ".strtotime($end_date.' 23:59:59');
    }else if($start_date != ''){
        $subsql .= " AND created >= ".strtotime($start_date.' 00:00:00');
    }else if($end_date != ''){
        $subsql .= " AND created <= ".strtotime($end_date.' 23:59:59');
    }
    if($gender != '' && $gender != 0){
        $subsql .= " AND select_id_1 = ".$gender;
    }
    if($fearanimal_id != '' && $fearanimal_id != 0){
        $subsql .= " AND select_id_7 = ".$fearanimal_id;
    }
    if($address_id != '' && $address_id != 0){
        $subsql .= " AND select_id_23 = ".$address_id;
    }
    if($health_id != '' && $health_id != 0){
        $subsql .= " AND select_id_8 = ".$health_id;
    }
    if($keyword != ''){
        $subsql .= " AND ((input_1 LIKE '%".$keyword."%') OR (input_4 LIKE '%".$keyword."%') OR (input_5 LIKE '%".$keyword."%') OR (input_6 LIKE '%".$keyword."%') OR (form_number LIKE '%".$keyword."%'))";
    }
	$sql = "SELECT * FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = '".$form_type."' ".$subsql." ORDER BY form_id DESC";
	$recordlist = $this->db->query($sql)->result_array();
?>

<div class="formtable_homepage">
	<?php if(!empty($recordlist)){for ($i = 0; $i < count($recordlist); $i++) {?>
        <div class="sectiontitle">
        	<div style="float:left;width:60px;">
    			<?php 
        			$uploadFile1 = $recordlist[$i]['form_pic_1_path'];
        			$file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        			$uploadFile1_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $uploadFile1);
        			echo '<img style="float:left;width:60px;height:60px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_100x100.'?datetime='.time().'"/>';
    			?>
    		</div>
        	<div style="float:left;width:calc(100% - 120px - 120px - 120px - 120px - 60px - 60px - 60px - 140px);line-height:25px;font-size:15px;">
        		<div class="formnumber_showname_<?php echo $recordlist[$i]['form_id']?>" style="float:left;width:calc(100% - 10px);margin-left:10px;font-weight:normal;line-height:20px;"><?php echo actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['form_number']);?></div>
        		<div style="float:left;width:calc(100% - 10px);margin-left:10px;line-height:20px;">
            		<div style="float:left;"><?php echo actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_1']);?></div>
            		
            		<div style="float:left;cursor:pointer;margin-left:20px;font-weight:normal;">
                        <div style="float:left;">
                        	<?php echo $this->WelModel->getarea_show($recordlist[$i]['select_id_23']).' '.actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_5']);;?>
                        </div>
                    </div>
                    <div style="float:left;cursor:pointer;font-weight:normal;">
                        <?php echo $this->WelModel->getlanguage_show_colorful($recordlist[$i], 'checkbox_id_2', 'input_3');?>
                    </div>
    			</div>
    			<div style="float:left;width:calc(100% - 10px);margin-left:10px;line-height:20px;">
            		<div style="float:left;cursor:pointer;font-weight:normal;">
                        <?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Contact';}?>: <?php echo actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_4']);?>
                        <?php if($this->langtype == '_ch'){echo '邮箱';}else{echo 'Email';}?>: <?php echo actionsearchdaxiaoxiezimu($keyword, $recordlist[$i]['input_6']);?>
                    </div>
    			</div>
        	</div>
        	<div style="float:left;width:120px;line-height:25px;font-size:15px;text-align:center;display: flex;flex-direction: row;justify-content: center;align-items: center;">
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
    		<div style="float:left;width:60px;line-height:25px;font-size:15px;text-align:center;">
    			<?php 
                    if($recordlist[$i]['select_id_1'] == 1){
        			    echo '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_male.jpg"/>';
                    }else if($recordlist[$i]['select_id_1'] == 2){
                        echo '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_female.jpg"/>';
                    }
    			?>
    			&nbsp;
    		</div>
    		<div style="float:left;width:60px;line-height:25px;font-size:15px;text-align:center;">
    			<?php 
                    if($recordlist[$i]['select_id_2'] != 0){
                        echo $recordlist[$i]['select_id_2'];if($this->langtype == '_ch'){echo '岁';}else{echo '';}
        			}
    			?>
    			&nbsp;
    		</div>
    		<div style="float:left;width:120px;line-height:25px;font-size:15px;text-align:center;display: flex;flex-direction: row;justify-content: center;align-items: center;">
    			<div style="float:left;">
    				<?php if($recordlist[$i]['select_id_8'] == 1){?>
            			<div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
            			<div style="float:left;line-height:20px;margin-left:6px;color:green;"><?php if($this->langtype == '_ch'){echo '良好';}else{echo 'Good';}?></div>
        			<?php }else if($recordlist[$i]['select_id_8'] == 2){?>
            			<div style="float:left;"><input type="radio" class="mgr mgr-primary mgr-lg" checked disabled="disabled"></div>
            			<div style="float:left;line-height:20px;margin-left:6px;color:#337ab7;"><?php if($this->langtype == '_ch'){echo '正常';}else{echo 'Normal';}?></div>
        			<?php }else if($recordlist[$i]['select_id_8'] == 3){?>
            			<div style="float:left;"><input type="radio" class="mgr mgr-warning mgr-lg" checked disabled="disabled"></div>
            			<div style="float:left;line-height:20px;margin-left:6px;color:#f0ad4e;"><?php if($this->langtype == '_ch'){echo '状况不佳';}else{echo 'Poor/Weak';}?></div>
        			<?php }else if($recordlist[$i]['select_id_8'] == 4){?>
            			<div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
            			<div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;"><?php if($this->langtype == '_ch'){echo '卧床不起';}else{echo 'Bed Bound';}?></div>
        			<?php }?>
        			&nbsp;
        		</div>
    		</div>
        	<div style="float:left;width:120px;line-height:25px;font-size:15px;text-align:center;">
        		<?php 
            		if($recordlist[$i]['is_closed'] == 1){
            		    if($this->langtype == '_ch'){
            		        echo '<span style="color:gray;">已关闭</span>';
            		    }else{
            		        echo '<span style="color:gray;">Closed</span>';
            		    }
            		}else{
            		    if($recordlist[$i]['status'] == 1){
            		        if($this->langtype == '_ch'){
            		            echo '<span style="color:green;">通过</span>';
            		        }else{
            		            echo '<span style="color:green;">Passed</span>';
            		        }
            		    }else if($recordlist[$i]['status'] == 2){
            		        if($this->langtype == '_ch'){
            		            echo '<span style="color:red;">拒绝</span>';
            		        }else{
            		            echo '<span style="color:red;">Denied</span>';
            		        }
            		    }else{
            		        if($this->langtype == '_ch'){
            		            echo '<span style="color:orange;">待处理</span>';
            		        }else{
            		            echo '<span style="color:orange;">Pending</span>';
            		        }
            		    }
            		}
        		?>
        	</div>
        	<div style="float:left;width:120px;line-height:25px;font-size:15px;">
        		<?php echo date('d/m/Y H:i', $recordlist[$i]['created']);?>
        	</div>
        	<div style="float:left;width:140px;">
        		<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;">
            		<a href="<?php echo base_url().'admin/formtable_record_edit/'.$form_type.'/'.$recordlist[$i]['form_id']?>" style="float:left;">
            			<img style="width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/revamp.png'?>"/>
            		</a>
            		
            		<a href="<?php echo base_url().'admin/formtable_record_info/'.$form_type.'/'.$recordlist[$i]['form_id']?>" style="float:left;margin-left:10px;">
            			<img style="width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/icon_view_orange.png'?>"/>
            		</a>
            		
            		<a href="javascript:;" onclick="todel_restorenotice(<?php echo $recordlist[$i]['form_id']?>)" style="float:left;margin-left:10px;">
            			<img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/icon_restore_blue.png'?>"/>
            		</a>
        		</div>
        		<div style="float:left;width:100%;margin-top:10px;font-size:12px;line-height:18px;">
        			<?php if($this->langtype == '_ch'){echo '关闭原因：';}else{echo 'Closed Reason: ';}?>
        			<span style="font-weight:normal;"><?php echo $recordlist[$i]['is_closed_reason'];?></span>
        		</div>
        	</div>
        	
        	
        	<?php 
    			$sql = "SELECT * FROM ".DB_PRE()."form_list WHERE parent = ".$recordlist[$i]['form_id']." ORDER BY form_id ASC";
    			$subrecordlist = $this->db->query($sql)->result_array();
    			if(!empty($subrecordlist)){
    			    echo '<div style="float:left;width:calc(100% - 60px);margin-left:60px;background:#EFEFEF;padding:10px 0px;border-radius:6px;">';
    			    for ($s = 0; $s < count($subrecordlist); $s++) {
    			        echo '
                        <div style="float:left;width:calc(100% - 10px);margin-left:10px;">
                            <div style="float:left;width:calc(100% - 140px);font-weight:normal;line-height:20px;">'.$subrecordlist[$s]['form_number'].'</div>
		                    <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:140px;">
                        		<a href="'.base_url().'admin/formtable_record_edit/'.$form_type.'/'.$subrecordlist[$s]['form_id'].'" style="float:left;">
                        			<img style="width:25px;height:25px;" src="'.base_url().'themes/default/images/revamp.png'.'"/>
                        		</a>
                        		<a href="'.base_url().'admin/formtable_record_info/'.$form_type.'/'.$subrecordlist[$s]['form_id'].'" style="float:left;margin-left:10px;">
                        			<img style="width:25px;height:25px;" src="'.base_url().'themes/default/images/icon_view_orange.png'.'"/>
                        		</a>
                        		
                        		<a href="javascript:;" onclick="todel_notice('.$subrecordlist[$s]['form_id'].')" style="float:left;margin-left:10px;">
                        			<img style="float:left;width:20px;height:20px;" src="'.base_url().'themes/default/images/icon_close_red.png'.'"/>
                        		</a>
                    	    </div>
                        </div>';
    			    }
    			    echo '</div>';
    			}
			?>
        </div>
    <?php }}?>
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
	//if(isNull.test(is_closed_reason)){ispass = 0;$('.is_closed_reason_error').show();}else{$('.is_closed_reason_error').hide();}
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
function todel_restorenotice(id){
	var name = $('.formnumber_showname_'+id).html();
	var title = '<?php if($this->langtype == '_ch'){echo '您确定要还原 ';}else{echo 'Are you sure to restore ';}?><font style="color:red;">【'+name+'】</font><?php if($this->langtype == '_ch'){echo '吗？';}else{echo '?';}?>';
	var subtitle = '';
	del_url = encodeURI(baseurl+"admin/torestoreclose_case/"+id);
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
					<div style="display:none;float:left;width:80%;margin:0px 10%;font-size:14px;line-height:17px;color:black;margin-top:4px;">
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