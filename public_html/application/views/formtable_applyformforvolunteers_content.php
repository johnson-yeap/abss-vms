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
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:10px 10px 10px 10px;background:rgba(0, 217, 109, 0.3);">V001A - <?php if($this->langtype == '_ch'){echo '关怀义工申请表格';}else{echo 'Caring Volunteer Application Form';}?></div>
    
    <div class="bodycontentarea">
        <table cellpadding="0">
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '头像';}else{echo 'Avatar';}?></td>
            	<td>
            		<?php
        				$data['upload_init_path'] = 'form';
        				$data['upload_init_type'] = 1;//1: 单选 2：多选
        				$data['upload_size_tips'] = '';
        				$data['upload_show_width'] = 200;
        				$data['upload_show_height'] = 200;
        				$data['upload_format'] = 'jpg, jpeg, png, gif';
        				$data['fujiangroup_name'] = 'linshi_pic_1';
        				$this->load->view('admin/user_normal_upfile_mul', $data);
        			?>
        			<div class="linshi_pic_1_path_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
        				<?php if($this->langtype == '_ch'){echo '请上传头像';}else{echo 'Please upload your avatar';}?>
        			</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<input name="input_1" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
            		</div>
            		<div class="input_1_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写姓名';}else{echo 'Please fill in name';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
                    	<select name="select_id_1" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                    		<option value="0"></option>
                    		<option value="1"><?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?></option>
                    		<option value="2"><?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?></option>
                    	</select>
                	</div>
                	<div class="select_id_1_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择性别';}else{echo 'Please choose gender';}?>
                	</div>
                	
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
                        		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                            		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                            		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                        		</div>
                    		<?php }}?>
                		</div>
                		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                    		<?php if($this->langtype == '_ch'){echo '请选择';}else{echo 'Please choose ';}?>
                    	</div>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '年龄';}else{echo 'Age';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
                		<select name="select_id_2" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                    		<option value="0"></option>
                    		<?php for($i = 16; $i <= 110; $i++){?>
                    		<option value="<?php echo $i?>"><?php echo $i?><?php if($this->langtype == '_ch'){echo '岁';}else{echo ' years old';}?></option>
                    		<?php }?>
                    	</select>
                	</div>
                	<div class="select_id_2_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择年龄';}else{echo 'Please choose age';}?>
                	</div>
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
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_select_id_4(<?php echo $valuelist[$i]['value_id']?>)" type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<!-- 
                        			<?php if($valuelist[$i]['value_id'] == 99){?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="select_id_4_others" style="display:none;float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_2" type="text" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;"/></div>
                            				<div class="input_2_error" style="display:none;color:red;float:left;max-width:100px;margin-left:5px;">
                                        		<?php if($this->langtype == '_ch'){echo '请填写其他';}else{echo 'Please fill in others';}?>
                                        	</div>
                                    	</div>
                        			<?php }else{?>
                        				<?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        			<?php }?>
                        			 -->
                        			<?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        		</label>
                    		</div>
                		<?php }}?>
                		<script>
// 							function tochoose_select_id_4(select_id_4){
// 								if(select_id_4 == 99){
// 									$('.select_id_4_others').show();
// 								}else{
// 									$('.select_id_4_others').hide();
// 								}
// 							}
                		</script>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择语言能力';}else{echo 'Please choose Language Skills';}?>
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
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_<?php echo $section_name?>()" name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?>/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<?php if($valuelist[$i]['value_id'] == 7){?>
                        				<?php 
                        				    $ishave_7 = 0;
                        				?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="<?php echo $section_name?>_others" style="<?php if($ishave_7 == 1){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_2" type="text" value="" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;"/></div>
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
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择语言能力';}else{echo 'Please choose Language Skills';}?>
                	</div>
                	<script>
						function tochoose_<?php echo $section_name?>(){
							var isselect_7_checked = 0;
							if($('input[id="<?php echo $section_name?>_7"]:checked').val() == 7){
								isselect_7_checked = 1;
							}
							if(isselect_7_checked == 1){
								$('.<?php echo $section_name?>_others').show();
							}else{
								$('.<?php echo $section_name?>_others').hide();
							}
						}
            		</script>
                	
                	
                	
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
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_select_id_5(<?php echo $valuelist[$i]['value_id']?>)" type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<!-- 
                        			<?php if($valuelist[$i]['value_id'] == 99){?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="select_id_5_others" style="display:none;float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_3" type="text" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;"/></div>
                            				<div class="input_3_error" style="display:none;color:red;float:left;max-width:100px;margin-left:5px;">
                                        		<?php if($this->langtype == '_ch'){echo '请填写其他';}else{echo 'Please fill in others';}?>
                                        	</div>
                                    	</div>
                        			<?php }else{?>
                        				<?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        			<?php }?>
                        			 -->
                        			 <?php echo $valuelist[$i]['value_name'.$this->langtype]?>
                        		</label>
                    		</div>
                		<?php }}?>
                		<script>
// 							function tochoose_select_id_5(select_id_5){
// 								if(select_id_5 == 99){
// 									$('.select_id_5_others').show();
// 								}else{
// 									$('.select_id_5_others').hide();
// 								}
// 							}
                		</script>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择语言能力';}else{echo 'Please choose Language Skills';}?>
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
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_<?php echo $section_name?>()" name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?>/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<?php if($valuelist[$i]['value_id'] == 7){?>
                        				<?php 
                        				    $ishave_7 = 0;
                        				?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="<?php echo $section_name?>_others" style="<?php if($ishave_7 == 1){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_3" type="text" value="" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;"/></div>
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
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择语言能力';}else{echo 'Please choose Language Skills';}?>
                	</div>
                	<script>
						function tochoose_<?php echo $section_name?>(){
							var isselect_7_checked = 0;
							if($('input[id="<?php echo $section_name?>_7"]:checked').val() == 7){
								isselect_7_checked = 1;
							}
							if(isselect_7_checked == 1){
								$('.<?php echo $section_name?>_others').show();
							}else{
								$('.<?php echo $section_name?>_others').hide();
							}
						}
            		</script>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '联系电话';}else{echo 'Contact numbers';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<input name="input_4" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;" />
            		</div>
            		<div class="input_4_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写电话号码';}else{echo 'Please fill in contact number';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '地址';}else{echo 'Address';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
                    	<select name="select_id_23" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                    		<option value="0"></option>
                    		<?php echo $this->WelModel->getarea_select();?>
                    	</select>
                    	<div style="float:left;margin-left:10px;margin-top:7px;cursor:pointer;" onclick="toshow_shipexpress()"><img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/icon_issue_blue.png'?>"/></div>
                	</div>
                	<div class="select_id_23_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择地址';}else{echo 'Please choose address';}?>
                	</div>
                	
                	<div style="float:left;width:100%;margin-top:10px;">
            			<input name="input_5" type="text" style="float:left;width:calc(100% - 6px);" />
            		</div>
            		<div class="input_5_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写地址';}else{echo 'Please fill in address';}?>
                	</div>
                	

                    <script>
                    	//打印装箱包装单 - 打开弹框
                    	function toshow_shipexpress(){
                    		$('.popup_shippingexpress_area').show();
                    	}
                    	//打印装箱包装单 - 关闭弹框
                    	function toclose_shippingexpress(){
                    		$('.popup_shippingexpress_area').hide();
                    	}
                    </script>
                    <div class="popup_shippingexpress_area" style="display:none;z-index:9001;position:fixed;top:0px;bottom:0px;left:0px;right:0px;background-color: rgba(0,0,0,0.6);">
                      <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;height:calc(100% - 40px);margin-top:20px;">
                        <div style="float:left;width:96%;max-width:500px;background-color: white;height:100%;overflow:auto;">
                          <div style="float:left;width:calc(100% - 60px);padding:20px 30px;">
                            <div style="float:left;width:100%;">
                            	<div style="cursor:pointer;float:right;width:45px;height:45px;margin-right:-10px;" onclick="toclose_shippingexpress()">
                                	<img style="float:left;width:25px;height:25px;margin:10px;" src="https://www.pawsomenutri.com/themes/default/images/close.png"/>
                            	</div>
                            </div>
							<div style="float:left;width:100%;font-size:18px;margin-top:10px;">
								<b style="background: yellow;color:black;line-height:30px;">&nbsp;North&nbsp;</b>
                            	<ul>
                            		<li>Woodlands</li>
                            		<li>Sembawang</li>
                            		<li>Yishun</li>
                            		<li>Mandai</li>
                            		<li>Chong Pang</li>
                            		<li>Admiralty</li>
                            		<li>Ang Mo Kio</li>
                            		<li>Punggol</li>
                            		<li>Seng Kang</li>
                            		<li>Hougang</li>
                            		<li>Serangoon</li>
                            		<li>Lorong Ah Soo</li>
                            		<li>Thomson or Upper Thomson</li>
                            		<li>Lentor</li>
                            		<li>Springleaf</li>
                            		<li>Seletar</li>
                            	</ul>
							</div>
							<div style="float:left;width:100%;font-size:18px;margin-top:10px;">
								<b style="background: yellow;color:black;line-height:30px;">&nbsp;South&nbsp;</b>
                            	<ul>
                            		<li>Bukit Merah</li>
                            		<li>Queenstown</li>
                            		<li>Harbour Front</li>
                            		<li>Sentosa</li>
                            		<li>Telok Blangah</li>
                            		<li>Dover</li>
                            		<li>Buona Vista</li>
                            		<li>Alexandra</li>
                            		<li>Tiong Bahru</li>
                            		<li>Chinatown</li>
                            		<li>Pasir Panjang</li>
                            		<li>Ulu Pandan</li>
                            		<li>Ghim Moh</li>
                            	</ul>
							</div>
							<div style="float:left;width:100%;font-size:18px;margin-top:10px;">
								<b style="background: yellow;color:black;line-height:30px;">&nbsp;East&nbsp;</b>
                            	<ul>
                            		<li>Tampines</li>
                            		<li>Pasir Ris</li>
                            		<li>Bedok</li>
                            		<li>Changi</li>
                            		<li>Simei</li>
                            		<li>Loyang</li>
                            		<li>Paya Lebar</li>
                            		<li>Eunos</li>
                            		<li>Ubi</li>
                            		<li>Geylang</li>
                            		<li>Aljuned</li>
                            		<li>Marine Parade</li>
                            		<li>Katong</li>
                            		<li>Joo Chiat</li>
                            		<li>Tanjong Rhu</li>
                            		<li>Kembangan </li>
                            		<li>Kaki Bukit</li>
                            		<li>Siglap</li>
                            		<li>Telok Kurau</li>
                            		<li>Bayshore</li>
                            		<li>Tanah Merah</li>
                            		<li>Upper Changi</li>
                            		<li>Upper East Coast</li>
                            	</ul>
							</div>
							<div style="float:left;width:100%;font-size:18px;margin-top:10px;">
								<b style="background: yellow;color:black;line-height:30px;">&nbsp;West&nbsp;</b>
                            	<ul>
                            		<li>Jurong East</li>
                            		<li>Jurong West</li>
                            		<li>Clementi</li>
                            		<li>Bukit Batok</li>
                            		<li>Bukit Panjang</li>
                            		<li>Choa Chu Kang</li>
                            		<li>Boon Lay</li>
                            		<li>Hillview</li>
                            		<li>West Coast</li>
                            		<li>Dairy Farm</li>
                            		<li>Tengah</li>
                            		<li>Lim Chu Kang</li>
                            		<li>Kranji</li>
                            	</ul>
							</div>
							<div style="float:left;width:100%;font-size:18px;margin-top:10px;">
								<b style="background: yellow;color:black;line-height:30px;">&nbsp;Central&nbsp;</b>
                            	<ul>
                            		<li>Downtown Core</li>
                            		<li>Marina South</li>
                            		<li>Marina East</li>
                            		<li>Orchard</li>
                            		<li>Newton</li>
                            		<li>Novena</li>
                            		<li>Tanglin</li>
                            		<li>Rochor</li>
                            		<li>Outram</li>
                            		<li>River Valley</li>
                            		<li>Toa Payoh</li>
                            		<li>Farrer Park</li>
                            		<li>Little India</li>
                            		<li>Balestier</li>
                            		<li>Whampoa</li>
                            		<li>Bendemeer </li>
                            		<li>Boon Keng</li>
                            		<li>Bugis</li>
                            		<li>Potong Pasir</li>
                            		<li>Macpherson</li>
                            		<li>Bishan</li>
                            		<li>Tanjong Pagar</li>
                            		<li>Beach Road</li>
                            		<li>Holland Road</li>
                            		<li>Tanglin Road</li>
                            		<li>Bukit Timah</li>
                            		<li>Cairnhill</li>
                            	</ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '电子邮件地址';}else{echo 'Email Address';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<input name="input_6" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;" />
            		</div>
            		<div class="input_6_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写电子邮件地址';}else{echo 'Please fill in email address';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '紧急联系人';}else{echo 'Emergency contact person';}?></td>
            	<td>
            		<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="input_7" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
            		</div>
            		<div class="input_7_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写紧急联系人姓名';}else{echo 'Please fill in emergency contact numbers';}?>
                	</div>
                	
                	<div style="float:left;width:100%;margin-top:5px;"><?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Contact';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="input_8" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
            		</div>
            		<div class="input_8_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写紧急联系人电话';}else{echo 'Please fill in emergency contact numbers';}?>
                	</div>
                	
                	<div style="float:left;width:100%;margin-top:5px;"><?php if($this->langtype == '_ch'){echo '关系';}else{echo 'Relationship';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="input_9" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
            		</div>
            		<div class="input_9_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写关系';}else{echo 'Please fill in relationship';}?>
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
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择首选角色';}else{echo 'Please choose Preferred Role';}?>
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
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择您能承诺至少 3 个月吗？';}else{echo 'Please choose Are you able to commit to a minimum of 3 months?';}?>
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
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>"/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择你害怕动物吗？如狗、猫和鸟等';}else{echo 'Please choose Are You In Fear of Animals？Eg. Dog, Cat and Bird etc';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '请列出您认为与您的志愿者工作相关的任何技能或才能';}else{echo 'Please list any skills or talents that you feel are relevant to your volunteer work';}?></td>
            	<td>
                    <div style="float:left;width:100%;">
                		<textarea name="textarea_1" style="float:left;width:calc(100% - 6px);min-height:100px;"></textarea>
            		</div>
            		<div class="textarea_1_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请列出您认为与您的志愿者工作相关的任何技能或才能';}else{echo 'Please list any skills or talents that you feel are relevant to your volunteer work';}?>
                	</div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_10';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_12';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_14';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_16';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_18';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_20';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_22';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1"/></div>
                			<div class="<?php echo $section_name;?>_0" style="float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="display:none;float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
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
    		<div style="float:left;width:25px;"><input name="shenming_1" id="shenming_1" type="checkbox" class="mgc mgc-success mgc-lg" value="1"/></div>
    		<label for="shenming_1" style="float:left;width:calc(100% - 25px - 10px);line-height:20px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '本人自愿加入关怀组， 承诺遵守组织的相关规定，积极参与关怀活动，保护服务对象的隐私，履行义工的责任。';}else{echo 'I voluntarily joined the care group and promised to abide by the relevant regulations of the organization, actively participate in care activities, protect the privacy of service users, and fulfill the responsibilities of volunteers.';}?></label>
    	</div>
    	<div class="shenming_1_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
    		<?php if($this->langtype == '_ch'){echo '请同意';}else{echo 'Please agree';}?>
    	</div>
    </div>
    <div class="agreecontent">
    	<div style="float:left;width:100%;">
    		<div style="float:left;width:25px;"><input name="shenming_2" id="shenming_2" type="checkbox" class="mgc mgc-success mgc-lg" value="1"/></div>
			<label for="shenming_2" style="float:left;width:calc(100% - 25px - 10px);line-height:20px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '本人特此声明，所提供的信息是真实和正确的。';}else{echo 'I hereby declare that the information provided is true and correct. ';}?></label>
    	</div>
    	<div class="shenming_2_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
    		<?php if($this->langtype == '_ch'){echo '请同意';}else{echo 'Please agree';}?>
    	</div>
    </div>
    
    
    <div class="signincontent">
		<div class="left3"><?php if($this->langtype == '_ch'){echo '申请人签名';}else{echo 'Signature';}?></div>
		<div class="right3">
			<div style="float:left;width:100%;">
    			<input name="signature_1" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" />
    		</div>
    		<div class="signature_1_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
        		<?php if($this->langtype == '_ch'){echo '请填写签名';}else{echo 'Please fill in signature';}?>
        	</div>
		</div>
    </div>
    <div class="signincontent">
		<div class="left3"><?php if($this->langtype == '_ch'){echo '日期';}else{echo 'Date';}?></div>
		<div class="right3">
			<?php 
			     $section_name = "datetime_1";
			?>
			<div style="position:relative;float:left;width:100%;">
        		<input name="<?php echo $section_name;?>" type="date" id="<?php echo $section_name;?>" style="float:left;width:180px;line-height:25px;border:0px;"/>
        		<div style="position:absolute;top:2px;bottom:2px;left:2px;width:130px;line-height:40px;font-size: 14px;text-align:center;background-color: #EFEFEF;">
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
    </div>
    
    
    
    
    <div style="display:none;float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
		<?php if($this->langtype == '_ch'){echo '关怀组委员会意见 （仅供内部填写）';}else{echo 'Comments From The Caring Committee (For Internal Information Only)';}?>
    </div>
    <div class="bodycontentarea" style="display:none;">
        <table cellpadding="0">
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '申请状态';}else{echo 'Application Status';}?></td>
        		<td>
        			<div style="float:left;"><input name="jiankang" id="jiankang_1" type="radio" class="mgr mgr-success mgr-lg" value="1" checked/></div>
            		<label for="jiankang_1" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '通过';}else{echo 'Passed';}?></label>
            		
            		<div style="float:left;"><input name="jiankang" id="jiankang_2" type="radio" class="mgr mgr-danger mgr-lg" value="2"/></div>
            		<label for="jiankang_2" style="float:left;line-height:20px;margin-left:10px;margin-right:20px;"><?php if($this->langtype == '_ch'){echo '拒绝';}else{echo 'Denied';}?></label>
        		</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '分配任务';}else{echo 'Assigned Task And Role';}?></td>
        		<td></td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '备注';}else{echo 'Remarks';}?></td>
        		<td></td>
        	</tr>
        </table>
    </div>
    
    
    
    <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
        <div class="btn_form_submit" onclick="tosubmit_form()" style="float:left;background:#DF9C4D;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?></div>
    	<div class="btn_form_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
    </div>
</div>



<script type="text/javascript">
	var form_type = '<?php echo $form_type?>';
	function tosubmit_form(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

		var textarea_1 = $('textarea[name="textarea_1"]').val();
		
		var datetime_1 = $('input[name="datetime_1"]').val();
		<?php for ($aaa = 1; $aaa <= 9; $aaa++) {?>
			var input_<?php echo $aaa?> = $('input[name="input_<?php echo $aaa?>"]').val();
		<?php }?>
		
		var select_id_1 = $('select[name="select_id_1"]').val();
		var select_id_2 = $('select[name="select_id_2"]').val();

		<?php for ($aaa = 3; $aaa <= 22; $aaa++) {?>
    		var select_id_<?php echo $aaa?> = $('input[name="select_id_<?php echo $aaa?>"]:checked').val();
    		if(select_id_<?php echo $aaa?> == undefined){select_id_<?php echo $aaa?> = 0;}
    	<?php }?>

    	var select_id_23 = $('select[name="select_id_23"]').val();

		<?php for ($aaa = 1; $aaa <= 1; $aaa++) {?>
			var signature_<?php echo $aaa?> = $('input[name="signature_<?php echo $aaa?>"]').val();
    	<?php }?>
    	
    	var linshi_pic_1_path_arr = $('input[name="linshi_pic_1_path[]"]');
		var linshi_pic_1_path = [];
		if(linshi_pic_1_path_arr.length > 0){
			for(var i = 0; i < linshi_pic_1_path_arr.length; i++){
				linshi_pic_1_path.push(linshi_pic_1_path_arr[i].value);
			}
		}
		var linshi_pic_1_name_arr = $('input[name="linshi_pic_1_name[]"]');
		var linshi_pic_1_name = [];
		if(linshi_pic_1_name_arr.length > 0){
			for(var i = 0; i < linshi_pic_1_name_arr.length; i++){
				linshi_pic_1_name.push(linshi_pic_1_name_arr[i].value);
			}
		}





    	

		if(datetime_1 == ''){ispass = 0;$('.datetime_1_error').show();}else{$('.datetime_1_error').hide();}

		<?php for ($aaa = 1; $aaa <= 9; $aaa++) {?>
			<?php if($aaa != 2 && $aaa != 3){?>
    			if(input_<?php echo $aaa?> == ''){ispass = 0;$('.input_<?php echo $aaa?>_error').show();}else{$('.input_<?php echo $aaa?>_error').hide();}
    		<?php }?>
		<?php }?>
		
        <?php for ($aaa = 1; $aaa <= 23; $aaa++) {?>
            <?php if($aaa <= 3 || ($aaa > 5 && $aaa <= 8) || $aaa == 23){?>
    			if(select_id_<?php echo $aaa?> == 0){ispass = 0;$('.select_id_<?php echo $aaa?>_error').show();}else{$('.select_id_<?php echo $aaa?>_error').hide();}
    		<?php }?>
    	<?php }?>

//     	var select_id_4 = $('input[name="select_id_4"]:checked').val();
// 		if(select_id_4 == undefined){select_id_4 = 0;}
// 		if(select_id_4 == 99){
// 			if(input_2 == ''){ispass = 0;$('.input_2_error').show();}else{$('.input_2_error').hide();}
//     	}else{
//     		$('.input_2_error').hide();
//     	}

//     	var select_id_5 = $('input[name="select_id_5"]:checked').val();
// 		if(select_id_5 == undefined){select_id_5 = 0;}
// 		if(select_id_5 == 99){
// 			if(input_3 == ''){ispass = 0;$('.input_3_error').show();}else{$('.input_3_error').hide();}
//     	}else{
//     		$('.input_3_error').hide();
//     	}
        var select_id_4 = 0;
        var select_id_5 = 0;
        
        var checkbox_id_2_arr = $('input[name="checkbox_id_2[]"]:checked');
        var checkbox_id_2 = [];
        if(checkbox_id_2_arr.length > 0){
        	for(i = 0; i < checkbox_id_2_arr.length; i++){
        		checkbox_id_2.push(checkbox_id_2_arr[i].value);
        	}
        }
        if(checkbox_id_2.length == 0){ispass = 0;$('.checkbox_id_2_error').show();}else{$('.checkbox_id_2_error').hide();}
        
        var checkbox_id_3_arr = $('input[name="checkbox_id_3[]"]:checked');
        var checkbox_id_3 = [];
        if(checkbox_id_3_arr.length > 0){
        	for(i = 0; i < checkbox_id_3_arr.length; i++){
        		checkbox_id_3.push(checkbox_id_3_arr[i].value);
        	}
        }
        if(checkbox_id_3.length == 0){ispass = 0;$('.checkbox_id_3_error').show();}else{$('.checkbox_id_3_error').hide();}
        
        
        
        
        var isselect_7_checked = 0;
        if($('input[id="checkbox_id_2_7"]:checked').val() == 7){
        	isselect_7_checked = 1;
        }
        if(isselect_7_checked == 1){
        	if(input_2 == ''){ispass = 0;$('.input_2_error').show();}else{$('.input_2_error').hide();}
        }else{
        	$('.input_2_error').hide();
        }
        var isselect_7_checked = 0;
        if($('input[id="checkbox_id_3_7"]:checked').val() == 7){
        	isselect_7_checked = 1;
        }
        if(isselect_7_checked == 1){
        	if(input_3 == ''){ispass = 0;$('.input_3_error').show();}else{$('.input_3_error').hide();}
        }else{
        	$('.input_3_error').hide();
        }
        

		if(signature_1 == ''){ispass = 0;$('.signature_1_error').show();}else{$('.signature_1_error').hide();}

// 		if(textarea_1 == ''){
// 			ispass = 0;
// 			$('.textarea_1_error').show();
//     	}else{
//     		$('.textarea_1_error').hide();
//     	}

// 		if(linshi_pic_1_path.length <= 0){
// 			ispass = 0;
// 			$('.linshi_pic_1_path_error').show();
// 		}else{
//     		$('.linshi_pic_1_path_error').hide();
//     	}

		var shenming_1 = $('input[name="shenming_1"]:checked').val();
		if(shenming_1 == undefined){shenming_1 = 0;}
		if(shenming_1 == 0){
			ispass = 0;
			$('.shenming_1_error').show();
    	}else{
    		$('.shenming_1_error').hide();
    	}

		var shenming_2 = $('input[name="shenming_2"]:checked').val();
		if(shenming_2 == undefined){shenming_2 = 0;}
		if(shenming_2 == 0){
			ispass = 0;
			$('.shenming_2_error').show();
    	}else{
    		$('.shenming_2_error').hide();
    	}

		if(ispass == 1){
			$('.btn_form_submit').hide();
			$('.btn_form_loading').show();

			var postOBJ = new Object();
			postOBJ.form_type = form_type;
			postOBJ.datetime_1 = datetime_1+' 12:00';

			postOBJ.textarea_1 = textarea_1;
			
			<?php for ($aaa = 1; $aaa <= 9; $aaa++) {?>
				postOBJ.input_<?php echo $aaa?> = input_<?php echo $aaa?>;
    		<?php }?>
			
    		<?php for ($aaa = 1; $aaa <= 23; $aaa++) {?>
    			postOBJ.select_id_<?php echo $aaa?> = select_id_<?php echo $aaa?>;
    		<?php }?>

    		<?php for ($aaa = 1; $aaa <= 1; $aaa++) {?>
    			postOBJ.signature_<?php echo $aaa?> = signature_<?php echo $aaa?>;
    		<?php }?>

    		postOBJ.checkbox_id_2 = checkbox_id_2;
    		postOBJ.checkbox_id_3 = checkbox_id_3;
    		
    		postOBJ.linshi_pic_1_path = linshi_pic_1_path;
    		postOBJ.linshi_pic_1_name = linshi_pic_1_name;
			
			$.post(baseurl+'welcome/action_formmethod', postOBJ, function (data){
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
    <div style="float:left;width:100%;line-height:30px;font-size:17px;margin-top:20px;margin-bottom:20px;text-align:center;">
        Thank you,<br />
        We look forward to seeing you soon!<br />
    </div>
    
    <div style="float:left;width:100%;line-height:24px;font-size:17px;margin-top:20px;text-align:center;">
        For any enquires, feel free to contact us at <a href="tel:6744 7444" style="letter-spacing: 0px;color:red;text-decoration:underline;">6744 7444</a>
    </div>
</div>
