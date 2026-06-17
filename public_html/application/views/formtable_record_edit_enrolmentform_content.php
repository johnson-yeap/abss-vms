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
            			<input name="input_1" type="text" value="<?php echo $recordinfo['input_1']?>" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
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
            			<?php $section_name = "select_id_1";?>
                    	<select name="<?php echo $section_name?>" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                    		<option value="0"></option>
                    		<option value="1" <?php if($recordinfo[$section_name] == 1){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?></option>
                    		<option value="2" <?php if($recordinfo[$section_name] == 2){echo 'selected';}?>><?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?></option>
                    	</select>
                	</div>
                	<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择性别';}else{echo 'Please choose gender';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '年龄';}else{echo 'Age';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<?php $section_name = "select_id_2";?>
                		<select name="<?php echo $section_name?>" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                    		<option value="0"></option>
                    		<?php for($i = 16; $i <= 110; $i++){?>
                    			<option value="<?php echo $i?>" <?php if($recordinfo[$section_name] == $i){echo 'selected';}?>><?php echo $i?><?php if($this->langtype == '_ch'){echo '岁';}else{echo ' years old';}?></option>
                    		<?php }?>
                    	</select>
                	</div>
                	<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择年龄';}else{echo 'Please choose age';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '会员号码';}else{echo 'Membership';}?></td>
            	<td>
            		<?php $section_name = 'select_id_3';?>
            		<div style="float:left;width:100%;">
            			<div style="float:left;"><input onclick="tochoose_<?php echo $section_name;?>()" name="<?php echo $section_name;?>" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] != 0){echo 'checked';}?>></div>
            			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                		<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是 : 请注明';}else{echo 'Yes : please specify';}?></div>
            		</div>
            		<script>
						function tochoose_<?php echo $section_name;?>(){
							var section_value = $('input[name="select_id_3"]:checked').val();
				    		if(section_value == undefined){section_value = 0;}
				    		if(section_value == 1){
								$('.input_2_area').show();
								$('.<?php echo $section_name;?>_0').hide();
				    			$('.<?php echo $section_name;?>_1').show();
					    	}else{
								$('.input_2_area').hide();
								$('.<?php echo $section_name;?>_0').show();
				    			$('.<?php echo $section_name;?>_1').hide();
					    	}
						}
            		</script>
            		<div class="input_2_area" style="<?php if($recordinfo['select_id_3'] != 0){echo '';}else{echo 'display:none;';}?>float:left;width:100%;margin-top:5px;">
                		<div style="float:left;width:100%;">
                			<input name="input_2" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;" value="<?php echo $recordinfo['input_2']?>"/>
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
                            		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?>/></div>
                            		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                        		</div>
                    		<?php }}?>
                		</div>
                		<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
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
                        		<div style="float:left;width:25px;"><input onclick="tochoose_select_id_5(<?php echo $valuelist[$i]['value_id']?>)" type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked?>/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<!-- 
                        			<?php if($valuelist[$i]['value_id'] == 99){?>
                        				<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                            			<div class="<?php echo $section_name?>_others" style="<?php if($recordinfo[$section_name] == 99){}else{echo 'display:none;';}?>float:left;">
                            				<div style="float:left;margin-left:5px;"><input name="input_3" type="text" value="<?php echo $recordinfo['input_3']?>" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;"/></div>
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
    						<!--
    						function tochoose_<?php echo $section_name?>(select_id){
    							if(select_id == 99){
    								$('.<?php echo $section_name?>_others').show();
    							}else{
    								$('.<?php echo $section_name?>_others').hide();
    							}
    						}
    						-->
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
                			    for($ccc = 1; $ccc <= 10; $ccc++){
                			        if($recordinfo[$section_name.'_'.$ccc] == $valuelist[$i]['value_id']){
                			            $is_checked = ' checked';
                    			    }
                    			}
                			?>
                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                        		<div style="float:left;width:25px;"><input onclick="tochoose_<?php echo $section_name?>()" name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?>/></div>
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
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '电话号码';}else{echo 'Contact Number';}?></td>
            	<td>
            		<div style="float:left;width:100%;">
            			<input name="input_4" type="text" value="<?php echo $recordinfo['input_4']?>" style="float:left;width:calc(100% - 6px);max-width:200px;" />
            		</div>
            		<div class="input_4_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写电话号码';}else{echo 'Please fill in contact number';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '地址';}else{echo 'Address';}?></td>
            	<td>
            		<?php $section_name = "select_id_23";?>
            		<div style="float:left;width:100%;">
                    	<select name="<?php echo $section_name?>" style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                    		<option value="0"></option>
                    		<?php echo $this->WelModel->getarea_select($recordinfo[$section_name]);?>
                    	</select>
                    	<div style="float:left;margin-left:10px;margin-top:7px;cursor:pointer;" onclick="toshow_shipexpress()"><img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/icon_issue_blue.png'?>"/></div>
                	</div>
                	<div class="<?php echo $section_name?>_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择地址';}else{echo 'Please choose address';}?>
                	</div>
                	
                	<div style="float:left;width:100%;margin-top:10px;">
            			<input name="input_5" type="text" value="<?php echo $recordinfo['input_5']?>" style="float:left;width:calc(100% - 6px);" />
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
            			<input name="input_6" type="text" value="<?php echo $recordinfo['input_6']?>" style="float:left;width:calc(100% - 6px);max-width:200px;" />
            		</div>
            		<div class="input_6_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写电子邮件地址';}else{echo 'Please fill in email address';}?>
                	</div>
            	</td>
        	</tr>
        	<tr>
            	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '紧急联络人';}else{echo 'Emergency contact person';}?></td>
            	<td>
            		<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="input_7" type="text" value="<?php echo $recordinfo['input_7']?>" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
            		</div>
            		<div class="input_7_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写紧急联络人姓名';}else{echo 'Please fill in emergency contact numbers';}?>
                	</div>
                	
                	<div style="float:left;width:100%;margin-top:5px;"><?php if($this->langtype == '_ch'){echo '电话';}else{echo 'Contact';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="input_8" type="text" value="<?php echo $recordinfo['input_8']?>" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
            		</div>
            		<div class="input_8_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写紧急联络人电话';}else{echo 'Please fill in emergency contact numbers';}?>
                	</div>
                	
                	<div style="float:left;width:100%;margin-top:5px;"><?php if($this->langtype == '_ch'){echo '关系';}else{echo 'Relationship';}?></div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="input_9" type="text" value="<?php echo $recordinfo['input_9']?>" style="float:left;width:calc(100% - 6px);max-width:200px;"/>
            		</div>
            		<div class="input_9_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请填写关系';}else{echo 'Please fill in relationship';}?>
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
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?>/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="select_id_6_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择有没有非佛教徒的家庭成员';}else{echo 'Please choose Any Family Members Who Are NonBuddhism';}?>
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
                        		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?>/></div>
                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);">
                        			<div style="float:left;"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></div>
                        		</label>
                    		</div>
                		<?php }}?>
            		</div>
            		<div class="select_id_7_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                		<?php if($this->langtype == '_ch'){echo '请选择你家里有动物吗？如狗、猫和鸟等';}else{echo 'Please choose Do You Have Animals In Your Home? Eg. Dog, Cat and Bird etc';}?>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_10';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_12';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_14';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_16';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_18';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_20';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
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
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
                			<div class="<?php echo $section_name;?>_0" style="<?php if($recordinfo[$section_name] == 0){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '否';}else{echo 'No';}?></div>
                			<div class="<?php echo $section_name;?>_1" style="<?php if($recordinfo[$section_name] == 1){echo '';}else{echo 'display:none;';}?>float:left;line-height:38px;margin-left:10px;"><?php if($this->langtype == '_ch'){echo '是';}else{echo 'Yes';}?></div>
                		</div>
            		</div>
        		</td>
        		<td>
        			<?php $section_name = 'select_id_22';?>
        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            			<div style="float:left;">
                			<div style="float:left;"><input name="<?php echo $section_name;?>" onclick="tochoose_statuswidthtext('<?php echo $section_name;?>')" type="checkbox" class="mgc-switch mgc-lg" value="1" <?php if($recordinfo[$section_name] == 1){echo 'checked';}?>/></div>
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
		<div class="right3"><input name="signature_1" type="text" value="<?php echo $recordinfo['signature_1']?>" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" /></div>
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
		
// 		var datetime_1 = $('input[name="datetime_1"]').val();//不需要传
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

    	//不需要传	
		//if(datetime_1 == ''){ispass = 0;$('.datetime_1_error').show();}else{$('.datetime_1_error').hide();}

		<?php for ($aaa = 1; $aaa <= 9; $aaa++) {?>
			<?php if($aaa != 2 && $aaa != 3){?>
    			if(input_<?php echo $aaa?> == ''){ispass = 0;$('.input_<?php echo $aaa?>_error').show();}else{$('.input_<?php echo $aaa?>_error').hide();}
    		<?php }?>
		<?php }?>
		
        <?php for ($aaa = 1; $aaa <= 23; $aaa++) {?>
            <?php if($aaa <= 4 || ($aaa > 5 && $aaa <= 8) || $aaa == 23){?>
        		<?php if($aaa != 3 && $aaa != 4 && $aaa != 8){?>
        			if(select_id_<?php echo $aaa?> == 0){ispass = 0;$('.select_id_<?php echo $aaa?>_error').show();}else{$('.select_id_<?php echo $aaa?>_error').hide();}
        		<?php }?>
    		<?php }?>
    	<?php }?>

    	var select_id_3 = $('input[name="select_id_3"]:checked').val();
		if(select_id_3 == undefined){select_id_3 = 0;}
		if(select_id_3 == 1){
			if(select_id_4 == 0){ispass = 0;$('.select_id_4_error').show();}else{$('.select_id_4_error').hide();}
// 			if(input_2 == ''){ispass = 0;$('.input_2_error').show();}else{$('.input_2_error').hide();}
    	}else{
    		$('.input_2_error').hide();
    	}

//     	var select_id_5 = $('input[name="select_id_5"]:checked').val();
// 		if(select_id_5 == undefined){select_id_5 = 0;}
// 		if(select_id_5 == 99){
// 			if(input_3 == ''){ispass = 0;$('.input_3_error').show();}else{$('.input_3_error').hide();}
//     	}else{
//     		$('.input_3_error').hide();
//     	}
		var select_id_5 = 0;

		var checkbox_id_2_arr = $('input[name="checkbox_id_2[]"]:checked');
		var checkbox_id_2 = [];
		if(checkbox_id_2_arr.length > 0){
			for(i = 0; i < checkbox_id_2_arr.length; i++){
				checkbox_id_2.push(checkbox_id_2_arr[i].value);
			}
		}
		if(checkbox_id_2.length == 0){ispass = 0;$('.checkbox_id_2_error').show();}else{$('.checkbox_id_2_error').hide();}

		var isselect_7_checked = 0;
		if($('input[id="checkbox_id_2_7"]:checked').val() == 7){
			isselect_7_checked = 1;
		}
		if(isselect_7_checked == 1){
			if(input_3 == ''){ispass = 0;$('.input_3_error').show();}else{$('.input_3_error').hide();}
		}else{
			$('.input_3_error').hide();
		}

		if(signature_1 == ''){ispass = 0;$('.signature_1_error').show();}else{$('.signature_1_error').hide();}

		var shenming_1 = $('input[name="shenming_1"]:checked').val();
		if(shenming_1 == undefined){shenming_1 = 0;}
		if(shenming_1 == 0){
			ispass = 0;
			$('.shenming_1_error').show();
    	}else{
    		$('.shenming_1_error').hide();
    	}


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
		
		if(ispass == 1){
			$('.btn_form_submit').hide();
			$('.btn_form_loading').show();

			var postOBJ = new Object();
			postOBJ.form_type = form_type;
// 			postOBJ.datetime_1 = datetime_1+' 12:00';//不需要传
			
			<?php for ($aaa = 1; $aaa <= 9; $aaa++) {?>
				postOBJ.input_<?php echo $aaa?> = input_<?php echo $aaa?>;
    		<?php }?>
			
            <?php for ($aaa = 1; $aaa <= 23; $aaa++) {?>
                <?php if($aaa != 8){//审批时填写?>
    				postOBJ.select_id_<?php echo $aaa?> = select_id_<?php echo $aaa?>;
    			<?php }?>
    		<?php }?>

    		<?php for ($aaa = 1; $aaa <= 1; $aaa++) {?>
    			postOBJ.signature_<?php echo $aaa?> = signature_<?php echo $aaa?>;
    		<?php }?>

    		postOBJ.checkbox_id_2 = checkbox_id_2;

    		postOBJ.linshi_pic_1_path = linshi_pic_1_path;
    		postOBJ.linshi_pic_1_name = linshi_pic_1_name;
			
    		$.post(baseurl+'welcome/action_formmethod/<?php echo $recordinfo['form_id']?>', postOBJ, function (data){
    			if(data == 'feifacanshu'){
				    toopen_errortips();//打开错误提示
				}else{
	    			<?php if($recordinfo['is_closed'] == 1){?>
	    				location.href = baseurl+'admin/formtable_record_list_closed/<?php echo $form_type?>';
	    			<?php }else if($recordinfo['status'] == 1){?>
	    				location.href = baseurl+'admin/formtable_record_list_passed/<?php echo $form_type?>';
	    			<?php }else if($recordinfo['status'] == 2){?>
	    				location.href = baseurl+'admin/formtable_record_list_denied/<?php echo $form_type?>';
	    			<?php }else{?>
	    				location.href = baseurl+'admin/formtable_record_list/<?php echo $form_type?>';
	    			<?php }?>
				}
				$('.btn_form_submit').show();
				$('.btn_form_loading').hide();
			})
		}
	}
</script>