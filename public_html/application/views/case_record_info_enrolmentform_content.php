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
<?php 
if($this->langtype == '_ch'){
    $text_ishave_animal = '有动物吗？';
    $text_gender = '性别';
    $text_area = '区域';
    $text_language = '语言';
    $text_health = '当前健康';
    $text_health_good = '良好';
    $text_health_normal = '正常';
    $text_health_poorweek = '状况不佳';
    $text_health_bedbound = '卧床不起';
    $text_health_enrolment = '关怀者';
    $text_choose_volunteer = '选择义工';
    $text_choose_fearofanimal = '害怕动物?';
    $text_choose_address = '地址';
    $text_needcarefortime = '关怀者需要家访的时间';
    $text_yes = '是';
    $text_no = '否';
}else{
    $text_ishave_animal = 'Have Animal?';
    $text_gender = 'Gender';
    $text_area = 'Area';
    $text_language = 'Language';
    $text_health = 'Current Health';
    $text_health_good = 'Good';
    $text_health_normal = 'Normal';
    $text_health_poorweek = 'Poor/Weak';
    $text_health_bedbound = 'Bed Bound';
    $text_health_enrolment = 'Enrolment';
    $text_choose_volunteer = 'Choose Volunteer';
    $text_choose_fearofanimal = 'Fear of Animal?';
    $text_choose_address = 'Address';
    $text_needcarefortime = 'Enrolment Available';
    $text_yes = 'Yes';
    $text_no = 'No';
}
if($recordinfo['select_id_7'] == 1){
    $ishave_animal = '
        <div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;">'.$text_yes.'</div>
    ';
}else if($recordinfo['select_id_7'] == 2){
    $ishave_animal = '
        <div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:green;">'.$text_no.'</div>
    ';
}else{
    $ishave_animal = '';
}
if($recordinfo['select_id_1'] == 1){
    $form_gender_show = '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_male.jpg"/>';
}else if($recordinfo['select_id_1'] == 2){
    $form_gender_show = '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_female.jpg"/>';
}else{
    $form_gender_show = '&nbsp;';
}
$form_language_show = '';
for($ccc = 1; $ccc <= 10; $ccc++){
    if($recordinfo['checkbox_id_2_'.$ccc] == 1){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= '中文';}else{$form_language_show .= 'Chinese';}
    }else if($recordinfo['checkbox_id_2_'.$ccc] == 2){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= '英文';}else{$form_language_show .= 'English';}
    }else if($recordinfo['checkbox_id_2_'.$ccc] == 3){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Teochew';}else{$form_language_show .= 'Teochew';}
    }else if($recordinfo['checkbox_id_2_'.$ccc] == 4){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Cantonese';}else{$form_language_show .= 'Cantonese';}
    }else if($recordinfo['checkbox_id_2_'.$ccc] == 5){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Hakka';}else{$form_language_show .= 'Hakka';}
    }else if($recordinfo['checkbox_id_2_'.$ccc] == 6){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Hokkien';}else{$form_language_show .= 'Hokkien';}
    }else if($recordinfo['checkbox_id_2_'.$ccc] == 7){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= '其他: '.$recordinfo['input_3'];}else{$form_language_show .= 'Others: '.$recordinfo['input_3'];}
    }
}
if($form_language_show == ''){
    $form_language_show = '&nbsp;';
}

if($recordinfo['select_id_8'] == 1){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:green;">'.$text_health_good.'</div>
    ';
}else if($recordinfo['select_id_8'] == 2){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-primary mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#337ab7;">'.$text_health_normal.'</div>
    ';
}else if($recordinfo['select_id_8'] == 3){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-warning mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#f0ad4e;">'.$text_health_poorweek.'</div>
    ';
}else if($recordinfo['select_id_8'] == 4){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;">'.$text_health_bedbound.'</div>
    ';
}else{
    $form_health_show = '';
}
?>
<div class="formtable_submit">
    <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
    	<div onclick="togotobackpage()" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#DF9C4D;color:white;padding:10px 0px;border:0px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '返回';}else{echo 'Back';}?></div>
		<script type="text/javascript">
    		function togotobackpage(){
        		<?php if($this->session->userdata('menu') == 'over48hrs'){?>
        			window.location.href = baseurl+'admin/case_over48hrs';
        		<?php }else{?>
            		<?php if($recordinfo['is_closed'] == 1){?>
            			window.location.href = baseurl+'admin/case_closed';
                	<?php }else if($recordinfo['is_finished'] == 1){?>
                		window.location.href = baseurl+'admin/case_complete';
                	<?php }else if($recordinfo['is_assigned'] == 1){?>
                		window.location.href = baseurl+'admin/case_success';
                	<?php }else if($recordinfo['is_assigned'] == 0){?>
                		window.location.href = baseurl+'admin/case_pending';
                	<?php }?>
        		<?php }?>
    		}
    	</script>
    	<div style="float:right;line-height:40px;margin-left:10px;">
    		<?php 
                if($recordinfo['is_closed'] == 1){
        		    if($this->langtype == '_ch'){echo '<span style="color:gray;">已关闭</span>';}else{echo '<span style="color:gray;">Closed</span>';}
                }else if($recordinfo['is_finished'] == 1){
        		    if($this->langtype == '_ch'){echo '<span style="color:green;">已完成</span>';}else{echo '<span style="color:green;">Completed</span>';}
                }else if($recordinfo['is_assigned'] == 1){
        		    if($this->langtype == '_ch'){echo '<span style="color:orange;">进行中</span>';}else{echo '<span style="color:orange;">In Progress</span>';}
                }else if($recordinfo['is_assigned'] == 0){
        		    if($this->langtype == '_ch'){echo '<span style="color:red;">待分配</span>';}else{echo '<span style="color:red;">Pending</span>';}
                }
    		?>
    	</div>
    </div>
    <div class="sectiontitle" style="width:calc(100% - 20px);padding:10px 10px 10px 10px;background:rgba(54, 162, 235, 0.3);"><?php echo $recordinfo['form_number'];?> - P001A - <?php if($this->langtype == '_ch'){echo '接受关怀登记表';}else{echo 'Caring Form';}?></div>
    <div class="sectionsummary"><?php //if($this->langtype == '_ch'){echo '欢迎您登记接受关怀，请填写以下信息，以便我们为您提供更好的关怀服务';}else{echo 'Welcome to register for care. Please fill in the following information so that we can provide you with better care services';}?></div>
    <?php 
	    $is_careforphone = 0;
	    if($recordinfo['checkbox_id_1_1'] == 3){
	        $is_careforphone = 1;
	    }
// 	    if($recordinfo['is_assigned'] == 0 || $recordinfo['is_assigned'] == 1){
	?>
	
	<?php 
//         if($recordinfo['is_closed'] == 1){
// 		    if($this->langtype == '_ch'){echo '<span style="color:gray;">已关闭</span>';}else{echo '<span style="color:gray;">Closed</span>';}
//         }else if($recordinfo['is_finished'] == 1){
// 		    if($this->langtype == '_ch'){echo '<span style="color:green;">已完成</span>';}else{echo '<span style="color:green;">Completed</span>';}
//         }else if($recordinfo['is_assigned'] == 1){
// 		    if($this->langtype == '_ch'){echo '<span style="color:orange;">进行中</span>';}else{echo '<span style="color:orange;">In Progress</span>';}
//         }else if($recordinfo['is_assigned'] == 0){
// 		    if($this->langtype == '_ch'){echo '<span style="color:red;">待分配</span>';}else{echo '<span style="color:red;">Pending</span>';}
//         }
	?>
	<?php if($recordinfo['is_assigned_time'] != 0){?>
    	<div style="float:left;width:100%;line-height:28px;font-size:16px;margin-top:20px;">
            <b><?php if($this->langtype == '_ch'){echo '最后分配时间';}else{echo 'Last Assign Time';}?>：</b> <?php echo date('Y-m-d H:i', $recordinfo['is_assigned_time'])?>
        </div>
    <?php }?>
	<?php if($is_careforphone != 11111111111111111111111111111 && $recordinfo['is_closed'] == 0 && $recordinfo['is_finished'] == 0){//不是电话慰问?>
    	<script>
            function tochoose_popup_address_id(popup_address_id){
        		if(popup_address_id != '' && popup_address_id != 0){
        			$('select[name="popup_address_id"]').css({'color': 'black'});
        		}else{
        			$('select[name="popup_address_id"]').css({'color': '#999'});
        		}
        	}
        	function tochoose_popup_gender_id(popup_gender_id){
        		if(popup_gender_id != '' && popup_gender_id != 0){
        			$('select[name="popup_gender_id"]').css({'color': 'black'});
        		}else{
        			$('select[name="popup_gender_id"]').css({'color': '#999'});
        		}
        	}
        	function tochoose_popup_fearanimal_id(popup_fearanimal_id){
        		if(popup_fearanimal_id != '' && popup_fearanimal_id != 0){
        			$('select[name="popup_fearanimal_id"]').css({'color': 'black'});
        		}else{
        			$('select[name="popup_fearanimal_id"]').css({'color': '#999'});
        		}
        	}
        	function tochoose_popup_language_id(popup_language_id){
        		if(popup_language_id != '' && popup_language_id != 0){
        			$('select[name="popup_language_id"]').css({'color': 'black'});
        		}else{
        			$('select[name="popup_language_id"]').css({'color': '#999'});
        		}
        	}
        	function tochoose_popup_time_id(popup_time_id){
        		if(popup_time_id != '' && popup_time_id != 0){
        			$('select[name="popup_time_id"]').css({'color': 'black'});
        		}else{
        			$('select[name="popup_time_id"]').css({'color': '#999'});
        		}
        	}
    	</script>
    	<div style="<?php //if($is_careforphone != 1){}else{echo 'display:none;';}?>float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
            <?php if($this->langtype == '_ch'){echo '分配义工';}else{echo 'Assign Volunteer';}?>
        </div>
    	<div class="bodycontentarea" <?php //if($is_careforphone != 1){}else{echo 'style="display:none;"';}?>>
            <table cellpadding="0">
            	<?php for($r = 1; $r <= 6; $r++){?>
            		<?php $role_name = 'volunteer_'.$r;?>
                	<tr style="background:#EFEFEF;">
                    	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '义工 '.$r;}else{echo 'Volunteer '.$r;}?></td>
                		<td>
                    		<input type="hidden" name="<?php echo $role_name?>_id" value="<?php echo $recordinfo[$role_name.'_id']?>"/>
                			<div style="float:left;width:200px;">
                				<div class="show<?php echo $role_name?>_avatar" style="float:left;width:35px;">
                					<?php 
                					    $filename = $recordinfo[$role_name.'_pic_1_path'];
                    					$filename_arr = explode('.', $filename);
                    					$file_type = end($filename_arr);
                    					if($filename != ''){
                    					    $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                    					}else{
                    					    $filename_100x100 = 'themes/default/images/avatar_default.png';
                    					}
                    					echo '<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'.base_url().$filename_100x100.'?datetime='.time().'"/>';
                					?>
                				</div>
                    			<div class="show<?php echo $role_name?>_name" style="float:left;width:calc(150px - 5px);margin-left:5px;line-height:20px;padding:5px 0px 5px 5px;background:#CCC;font-size:14px;<?php if($recordinfo[$role_name.'_shenfen'] == 3){echo 'color:#0788FF;';}?>">
                    				<?php if($recordinfo[$role_name.'_name'] != ''){echo $recordinfo[$role_name.'_name'];}else{echo '&nbsp;';}?>
                    				<?php if($recordinfo[$role_name.'_shenfen'] == 3){echo '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/icon_driver_both_blue.png"/>';}?>
                    			</div>
                    		</div>
                    		<div onclick="tochoose<?php echo $role_name?>(1)" style="cursor:pointer;float:left;font-size:14px;line-height:30px;padding:0px 10px;border-radius:4px;font-weight:bold;background:rgba(0, 217, 109, 0.3);">
                    			<?php if($this->langtype == '_ch'){echo '选择义工';}else{echo 'Choose Volunteer';}?>
                    		</div>
                    		<div onclick="todelete<?php echo $role_name?>(1)" style="cursor:pointer;float:left;margin-left:10px;">
                    			<img style="float:left;width:20px;height:20px;" src="<?php echo base_url()?>themes/default/images/icon_close_red.png">
                    		</div>
                    		<div class="<?php echo $role_name?>_id_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                        		<?php if($this->langtype == '_ch'){echo '请选择义工';}else{echo 'Please choose volunteer';}?>
                        	</div>
            				<script>
            					function todelete<?php echo $role_name?>(click_type){
            						$('input[name="<?php echo $role_name?>_id"]').val(0);
        							$('.show<?php echo $role_name?>_avatar').html('<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'+baseurl+'themes/default/images/avatar_default.png"/>');
            						$('.show<?php echo $role_name?>_name').html('&nbsp;');
            					}
            					function tochoose<?php echo $role_name?>(click_type){
            						var <?php echo $role_name?>_id = $('input[name="<?php echo $role_name?>_id"]').val();
            						var popup_gender_id = $('select[name="popup_gender_id"]').val();
            						if(popup_gender_id == undefined){
            							popup_gender_id = 0;
            						}
            						var popup_address_id = $('select[name="popup_address_id"]').val();
            						if(popup_address_id == undefined){
            							popup_address_id = 0;
            						}
            						//if(popup_address_id == 0){
            							//popup_address_id = <?php echo $recordinfo['select_id_23']?>;
            						//}
            						var popup_fearanimal_id = $('select[name="popup_fearanimal_id"]').val();
            						if(popup_fearanimal_id == undefined){
            							popup_fearanimal_id = 0;
            						}
            						<?php if($recordinfo['select_id_7'] == 1){//家里有动物?>
                						//if(popup_fearanimal_id == 0){
            							//popup_fearanimal_id = 2;//默认选择不害怕动物的。
            							//}
                					<?php }?>
                					var popup_language_id = $('select[name="popup_language_id"]').val();
            						if(popup_language_id == undefined || popup_language_id == ''){
            							popup_language_id = 0;
            						}
            						var popup_time_id = $('select[name="popup_time_id"]').val();
            						if(popup_time_id == undefined || popup_time_id == ''){
            							popup_time_id = 0;
            						}
            						//if(popup_time_id == 0){
            							//popup_time_id = 1;//默认选择匹配时间
            						//}
                					
            						var popup_keyword = $('input[name="popup_keyword"]').val();
            						if(popup_keyword == undefined){
            							popup_keyword = '';
            						}
            						$('.choose_<?php echo $role_name?>_area').show();
            						if(click_type == 1){
            							$('.choose_<?php echo $role_name?>_content').html('<img style="float:left;width:20px;height:20px;margin-left:calc(50% - 10px);margin-top:20px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/>');
                					}else{
                						$('.choose_<?php echo $role_name?>_content_2').html('<img style="float:left;width:20px;height:20px;margin-left:calc(50% - 10px);margin-top:20px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/>');
                                    }
            						var postOBJ = new Object();
                                    postOBJ.<?php echo $role_name?>_id = <?php echo $role_name?>_id;
                                    postOBJ.popup_gender_id = popup_gender_id;
                                    postOBJ.popup_address_id = popup_address_id;
                                    postOBJ.popup_fearanimal_id = popup_fearanimal_id;
                                    postOBJ.popup_language_id = popup_language_id;
                                    postOBJ.popup_time_id = popup_time_id;
                                    postOBJ.popup_keyword = popup_keyword;
            
            						$.post(baseurl+'admin/tochoose<?php echo $role_name?>/<?php echo $recordinfo['form_id']?>', postOBJ, function (data){
            							$('.choose_<?php echo $role_name?>_content').html(data);
            						})
            					}
            					
            					function choose<?php echo $role_name?>(volunteer_id, wechat_avatar, admin_username, drinver_shenfen_value){
            						if(drinver_shenfen_value == 1){
                						var drinver_shenfen_show = '<img style="width:16px;height:16px;" src="'+baseurl+'themes/default/images/icon_driver_both_blue.png"/>';
                						var drinver_shenfen_color = 'color:#0788FF;';
                        			}else{
                						var drinver_shenfen_show = '';
                						var drinver_shenfen_color = 'color:#0788FF;';
                    				}
            						$('input[name="<?php echo $role_name?>_id"]').val(volunteer_id);
            						if(volunteer_id == 0){
            							$('.show<?php echo $role_name?>_avatar').html('<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'+baseurl+'themes/default/images/avatar_default.png"/>');
                						$('.show<?php echo $role_name?>_name').html('&nbsp;');
                					}else{
                						$('.show<?php echo $role_name?>_avatar').html('<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'+wechat_avatar+'"/>');
                						$('.show<?php echo $role_name?>_name').html('<div style="float:left;'+drinver_shenfen_color+'">'+admin_username+' '+drinver_shenfen_show+'<div>');
                					}
            
            						toclose_choose<?php echo $role_name?>();
            					}
            					function toclose_choose<?php echo $role_name?>(){
            						$('.choose_<?php echo $role_name?>_content').html('');
            						$('.choose_<?php echo $role_name?>_area').hide();
            					}
            				</script>
            				<div class="choose_<?php echo $role_name?>_area" style="display:none;position:fixed;top:0px;bottom:0px;left:0px;right:0px;background-color:rgba(0,0,0,0.5);z-index:1100;">
            					<div style="width:100%;max-width:900px;margin:0 auto;">
                					<div style="position:fixed;top:0px;bottom:0px;width:100%;max-width:900px;">
                    					<div style="float:left;width:calc(100% - 10px);margin-left:5px;height:100%;">
                							<div style="float:left;width:100%;height:35px;margin-top:5px;">
                								<div style="float:left;color:white;font-size:20px;"><?php if($this->langtype == '_ch'){echo '选择义工';}else{echo 'Choose Volunteer';}?></div>
                        						<img onclick="toclose_choose<?php echo $role_name?>()" style="float:right;width:30px;height:30px;cursor:pointer;margin-right:3px;" src="<?php echo base_url().'themes/default/images/close_white.png'?>"/>
                        					</div>
                        					<div style="float:left;width:100%;padding:20px 0px;height:calc(100% - 40px);border-radius:4px;background-color:white;">
                            					<?php 
                                					echo '
                                                        <div style="float:left;width:100%;font-size:12px;">
                                                            <div style="float:left;width:100px;height:100px;margin-left:10px;font-weight:bold;font-size:16px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                                                '.$text_health_enrolment.'
                                                            </div>
                                                            <div style="float:left;width:100px;height:100px;background:#EFEFEF;border-radius:6px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                                                '.$recordinfo['input_1'].'
                                                            </div>
                                                            <div style="float:left;width:calc(100% - 100px - 100px - 10px - 10px);margin-left:10px;line-height:20px;">
                                                                <div style="float:left;width:300px;">
                                                                    <div style="float:left;width:100%;">
                                                                        '.$text_area.': '.$this->WelModel->getarea_show($recordinfo['select_id_23']).'
                                                                    </div>
                                                                    <div style="float:left;width:100%;">
                                                                        <div style="float:left;">'.$text_ishave_animal.'</div>'.$ishave_animal.'
                                                                    </div>
                                                                    <div style="float:left;width:100%;">
                                                                        <div style="float:left;">'.$text_gender.': </div>
                                                                        <div style="float:left;">'.$form_gender_show.'</div>
                                                                    </div>
                                                                    <div style="float:left;width:100%;">
                                                                        <div style="float:left;">'.$text_language.': </div>
                                                                        <div style="float:left;">'.$form_language_show.'</div>
                                                                    </div>
                                                                    <div style="float:left;width:100%;">
                                                                        <div style="float:left;">'.$text_health.': </div>
                                                                        <div style="float:left;">'.$form_health_show.'</div>
                                                                    </div>
                                                                </div>
                                                                <div style="float:left;width:calc(100% - 300px);line-height:13px;">
                                                                    <div style="float:left;width:100%;font-weight:bold;margin-bottom:7px;">'.$text_needcarefortime.'</div>
                                                                    <div style="float:left;width:100%;">
                                                                        '.$this->WelModel->availabletimetableshow($recordinfo).'
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                					?>
                            						<div class="choose_<?php echo $role_name?>_content" style="float:left;width:100%;padding:20px 0px;height:calc(100% - 100px - 40px);border-radius:4px;background-color:white;">
                                    					
                                    				</div>
                            				</div>
                        				</div>
                    				</div>
                				</div>
            				</div>
                		</td>
                	</tr>
            	<?php }?>
            </table>
        </div>
        
        <div style="<?php //if($is_careforphone != 1){}else{echo 'display:none;';}?>float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
            <?php if($this->langtype == '_ch'){echo '分配司机';}else{echo 'Assign Driver';}?>
        </div>
        <div class="bodycontentarea" <?php //if($is_careforphone != 1){}else{echo 'style="display:none;"';}?>>
            <table cellpadding="0">
        		<?php $role_name = 'driver';?>
            	<tr style="background:#EFEFEF;">
                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?></td>
            		<td>
                		<input type="hidden" name="<?php echo $role_name?>_id" value="<?php echo $recordinfo[$role_name.'_id']?>"/>
            			<div style="float:left;width:200px;">
            				<div class="show<?php echo $role_name?>_avatar" style="float:left;width:35px;">
            					<?php 
            					    $filename = $recordinfo[$role_name.'_pic_1_path'];
                					$filename_arr = explode('.', $filename);
                					$file_type = end($filename_arr);
                					if($filename != ''){
                					    $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                					}else{
                					    $filename_100x100 = 'themes/default/images/avatar_default.png';
                					}
                					echo '<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'.base_url().$filename_100x100.'?datetime='.time().'"/>';
            					?>
            				</div>
                			<div class="show<?php echo $role_name?>_name" style="float:left;width:calc(150px - 5px);margin-left:5px;line-height:20px;padding:5px 0px 5px 5px;background:#CCC;font-size:14px;<?php if($recordinfo[$role_name.'_shenfen'] == 3){echo 'color:#0788FF;';}?>">
                				<?php if($recordinfo[$role_name.'_name'] != ''){echo $recordinfo[$role_name.'_name'];}else{echo '&nbsp;';}?>
                				<?php if($recordinfo[$role_name.'_shenfen'] == 3){echo '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/icon_driver_both_blue.png"/>';}?>
                			</div>
                		</div>
            						
                		<div onclick="tochoose<?php echo $role_name?>(1)" style="cursor:pointer;float:left;font-size:14px;line-height:30px;padding:0px 10px;border-radius:4px;font-weight:bold;background:#C2E3F9;">
                			<?php if($this->langtype == '_ch'){echo '选择司机';}else{echo 'Choose Driver';}?>
                		</div>
                		<div onclick="todelete<?php echo $role_name?>(1)" style="cursor:pointer;float:left;margin-left:10px;">
                			<img style="float:left;width:20px;height:20px;" src="<?php echo base_url()?>themes/default/images/icon_close_red.png">
                		</div>
                		<div class="<?php echo $role_name?>_id_error" style="display:none;color:red;float:left;width:100%;margin-top:5px;">
                    		<?php if($this->langtype == '_ch'){echo '请选择司机';}else{echo 'Please choose Driver';}?>
                    	</div>
        				<script>
            				function todelete<?php echo $role_name?>(click_type){
        						$('input[name="<?php echo $role_name?>_id"]').val(0);
    							$('.show<?php echo $role_name?>_avatar').html('<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'+baseurl+'themes/default/images/avatar_default.png"/>');
        						$('.show<?php echo $role_name?>_name').html('&nbsp;');
        					}
        					function tochoose<?php echo $role_name?>(click_type){
        						var <?php echo $role_name?>_id = $('input[name="<?php echo $role_name?>_id"]').val();
        						var popup_gender_id = $('select[name="popup_gender_id"]').val();
        						if(popup_gender_id == undefined){
        							popup_gender_id = 0;
        						}
        						var popup_address_id = $('select[name="popup_address_id"]').val();
        						if(popup_address_id == undefined){
        							popup_address_id = 0;
        						}
        						//if(popup_address_id == 0){
        						//popup_address_id = <?php echo $recordinfo['select_id_23']?>;
        						//}
        						var popup_fearanimal_id = $('select[name="popup_fearanimal_id"]').val();
        						if(popup_fearanimal_id == undefined){
        							popup_fearanimal_id = 0;
        						}
        						<?php if($recordinfo['select_id_7'] == 1){//家里有动物?>
        							//if(popup_fearanimal_id == 0){
        							//popup_fearanimal_id = 2;//默认选择不害怕动物的。
        							//}
            					<?php }?>
            					var popup_language_id = $('select[name="popup_language_id"]').val();
        						if(popup_language_id == undefined){
        							popup_language_id = 0;
        						}
        						var popup_keyword = $('input[name="popup_keyword"]').val();
        						if(popup_keyword == undefined){
        							popup_keyword = '';
        						}
        						$('.choose_<?php echo $role_name?>_area').show();
        						if(click_type == 1){
        							$('.choose_<?php echo $role_name?>_content').html('<img style="float:left;width:20px;height:20px;margin-left:calc(50% - 10px);margin-top:20px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/>');
            					}else{
            						$('.choose_<?php echo $role_name?>_content_2').html('<img style="float:left;width:20px;height:20px;margin-left:calc(50% - 10px);margin-top:20px;" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/>');
                                }
        						var postOBJ = new Object();
                                postOBJ.<?php echo $role_name?>_id = <?php echo $role_name?>_id;
                                postOBJ.popup_gender_id = popup_gender_id;
                                postOBJ.popup_address_id = popup_address_id;
                                postOBJ.popup_fearanimal_id = popup_fearanimal_id;
                                postOBJ.popup_language_id = popup_language_id;
                                postOBJ.popup_keyword = popup_keyword;
        
        						$.post(baseurl+'admin/tochoose<?php echo $role_name?>/<?php echo $recordinfo['form_id']?>', postOBJ, function (data){
        							$('.choose_<?php echo $role_name?>_content').html(data);
        						})
        					}
        					
        					function choose<?php echo $role_name?>(volunteer_id, wechat_avatar, admin_username, drinver_shenfen_value){
        						if(drinver_shenfen_value == 1){
            						var drinver_shenfen_show = '<img style="width:16px;height:16px;" src="'+baseurl+'themes/default/images/icon_driver_both_blue.png"/>';
            						var drinver_shenfen_color = 'color:#0788FF;';
                    			}else{
            						var drinver_shenfen_show = '';
            						var drinver_shenfen_color = 'color:#0788FF;';
                				}
        						$('input[name="<?php echo $role_name?>_id"]').val(volunteer_id);
        						if(volunteer_id == 0){
        							$('.show<?php echo $role_name?>_avatar').html('<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'+baseurl+'themes/default/images/avatar_default.png"/>');
            						$('.show<?php echo $role_name?>_name').html('&nbsp;');
            					}else{
            						$('.show<?php echo $role_name?>_avatar').html('<img style="float:left;width:30px;height:30px;margin-left:5px;border-radius:50%;" src="'+wechat_avatar+'"/>');
            						$('.show<?php echo $role_name?>_name').html('<div style="float:left;'+drinver_shenfen_color+'">'+admin_username+' '+drinver_shenfen_show+'<div>');
            					}
        
        						toclose_choose<?php echo $role_name?>();
        					}
        					function toclose_choose<?php echo $role_name?>(){
        						$('.choose_<?php echo $role_name?>_content').html('');
        						$('.choose_<?php echo $role_name?>_area').hide();
        					}
        				</script>
        				<div class="choose_<?php echo $role_name?>_area" style="display:none;position:fixed;top:0px;bottom:0px;left:0px;right:0px;background-color:rgba(0,0,0,0.5);z-index:1100;">
        					<div style="width:100%;max-width:900px;margin:0 auto;">
            					<div style="position:fixed;top:0px;bottom:0px;width:100%;max-width:900px;">
                					<div style="float:left;width:calc(100% - 10px);margin-left:5px;height:100%;">
            							<div style="float:left;width:100%;height:35px;margin-top:5px;">
            								<div style="float:left;color:white;font-size:20px;"><?php if($this->langtype == '_ch'){echo '选择司机';}else{echo 'Choose Driver';}?></div>
                    						<img onclick="toclose_choose<?php echo $role_name?>()" style="float:right;width:30px;height:30px;cursor:pointer;margin-right:3px;" src="<?php echo base_url().'themes/default/images/close_white.png'?>"/>
                    					</div>
                    					<div style="float:left;width:100%;padding:20px 0px;height:calc(100% - 40px);border-radius:4px;background-color:white;">
                        					<?php 
                            					echo '
                                                    <div style="float:left;width:100%;font-size:12px;">
                                                        <div style="float:left;width:100px;height:100px;margin-left:10px;font-weight:bold;font-size:16px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                                            '.$text_health_enrolment.'
                                                        </div>
                                                        <div style="float:left;width:100px;height:100px;background:#EFEFEF;border-radius:6px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                                            '.$recordinfo['input_1'].'
                                                        </div>
                                                        <div style="float:left;width:calc(100% - 100px - 100px - 10px - 10px);margin-left:10px;line-height:20px;">
                                                            <div style="float:left;width:300px;">
                                                                <div style="float:left;width:100%;">
                                                                    '.$text_area.': '.$this->WelModel->getarea_show($recordinfo['select_id_23']).'
                                                                </div>
                                                                <div style="float:left;width:100%;">
                                                                    <div style="float:left;">'.$text_ishave_animal.'</div>'.$ishave_animal.'
                                                                </div>
                                                                <div style="float:left;width:100%;">
                                                                    <div style="float:left;">'.$text_gender.': </div>
                                                                    <div style="float:left;">'.$form_gender_show.'</div>
                                                                </div>
                                                                <div style="float:left;width:100%;">
                                                                    <div style="float:left;">'.$text_language.': </div>
                                                                    <div style="float:left;">'.$form_language_show.'</div>
                                                                </div>
                                                                <div style="float:left;width:100%;">
                                                                    <div style="float:left;">'.$text_health.': </div>
                                                                    <div style="float:left;">'.$form_health_show.'</div>
                                                                </div>
                                                            </div>
                                                            <div style="float:left;width:calc(100% - 300px);line-height:13px;">
                                                                <div style="float:left;width:100%;font-weight:bold;margin-bottom:7px;">'.$text_needcarefortime.'</div>
                                                                <div style="float:left;width:100%;">
                                                                    '.$this->WelModel->availabletimetableshow($recordinfo).'
                                                               </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ';
                            					?>
                        						<div class="choose_<?php echo $role_name?>_content" style="float:left;width:100%;padding:20px 0px;height:calc(100% - 100px - 40px);border-radius:4px;background-color:white;">
                                					
                                				</div>
                        				</div>
                    				</div>
                				</div>
            				</div>
        				</div>
            		</td>
            	</tr>
            </table>
        </div>
        
        <div style="<?php //if($is_careforphone != 1){}else{echo 'display:none;';}?>float:left;width:100%;line-height:28px;font-size:20px;margin-top:20px;font-weight:bold;">
            <?php if($this->langtype == '_ch'){echo '家访日期 (初次)';}else{echo 'Home Visit Date (1<sup>st</sup> visit)';}?>
        </div>
        <div style="float:left;width:100%;">
        	<div style="<?php //if($is_careforphone != 1){}else{echo 'display:none;';}?>float:left;width:200px;">
            	<?php 
    			     $section_name = "datetime_2";
    			?>
    			<div style="position:relative;float:left;width:100%;margin-top:10px;">
            		<input name="<?php echo $section_name;?>" type="date" id="<?php echo $section_name;?>" value="<?php if($recordinfo['datetime_2'] != 0){echo date('Y-m-d', $recordinfo['datetime_2']);}?>" style="float:left;width:180px;line-height:20px;border:0px;"/>
            		<div style="position:absolute;top:2px;bottom:2px;left:2px;width:130px;line-height:35px;font-size: 14px;text-align:center;background-color: #EFEFEF;">
            			<div id="<?php echo $section_name;?>_day" style="float:left;width:25px;color: green;margin-left:10px;"><?php if($recordinfo['datetime_2'] != 0){echo date('d', $recordinfo['datetime_2']);}else{if($this->langtype == '_ch'){echo '日';}else{echo 'dd';}}?></div>
    					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
    					<div id="<?php echo $section_name;?>_month" style="float:left;width:25px;color: blue; "><?php if($recordinfo['datetime_2'] != 0){echo date('m', $recordinfo['datetime_2']);}else{if($this->langtype == '_ch'){echo '月';}else{echo 'mm';}}?></div>
    					<div style="float:left;width:10px;text-align:center;color: #2964d3; ">/</div>
    					<div id="<?php echo $section_name;?>_year" style="float:left;width:40px;color: purple;"><?php if($recordinfo['datetime_2'] != 0){echo date('Y', $recordinfo['datetime_2']);}else{if($this->langtype == '_ch'){echo '年';}else{echo 'YYYY';}}?></div>
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
        	<div style="<?php //if($is_careforphone != 1){}else{echo 'display:none;';}?>float:left;width:200px;margin-top:20px;">
        		<div style="float:left;width:100%;">
            		<?php 
            		      $section_name = "datetime_2_duan";
            		      $valuelist = array();
            		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'AM', 'value_name_ch'=>'上午');
            		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-success', 'value_name_en'=>'PM', 'value_name_ch'=>'下午');
            		?>
            		<?php if(!empty($valuelist)){for ($i = 0; $i < count($valuelist); $i++) {?>
            			<?php 
            			     $is_checked = '';
        			         if($recordinfo[$section_name] == $valuelist[$i]['value_id']){
        			             $is_checked = ' checked';
        			         }
            			?>
                		<div style="float:left;line-height:20px;margin-right:10px;">
                    		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?>/></div>
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
    		<div style="float:left;width:calc(100% - 200px - 200px);<?php if($is_careforphone != 1){echo 'margin-top:-26px;';}else{echo 'margin-top:0px;';}?>">
        		<div class="<?php echo $section_name;?>_error" style="float:left;width:100%;line-height:28px;font-size:20px;font-weight:bold;">
            		<?php if($this->langtype == '_ch'){echo '备注：';}else{echo 'Note: ';}?>
            	</div>
        		<div style="float:left;width:100%;margin-top:5px;">
            		<textarea name="assign_memo" style="float:left;width:calc(100% - 6px);height:80px;"><?php echo $recordinfo['assign_memo']?></textarea>
        		</div>
    		</div>
        </div>
        
        
        <div style="display: flex;flex-direction: row;<?php if($is_careforphone != 1){echo 'justify-content: center;';}else{echo 'justify-content: left;';}?>align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
            <div class="btn_approve_submit" onclick="toapprove_caseassign()" style="float:left;background:green;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '分配';}else{echo 'Assign';}?></div>
        	<div class="btn_approve_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
        </div>
    <?php }?>
    
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
        <?php if($this->langtype == '_ch'){echo '个人信息';}else{echo 'Personal Information';}?>
    </div>
    <div class="bodycontentarea">
        <table cellpadding="0">
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
                            				<div style="float:left;margin-left:5px;"><input name="input_3" type="text" value="<?php echo $recordinfo['input_3']?>" style="float:left;width:calc(100% - 6px);height:14px;max-width:100px;" disabled="disabled"/></div>
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
    </div>
    
    
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
                            		<div style="float:left;width:25px;"><input type="radio" name="<?php echo $section_name?>" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" class="mgr <?php echo $valuelist[$i]['radioclass']?> mgr-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                            		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
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
                            		<div style="float:left;width:25px;"><input name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$i]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                            		<label for="<?php echo $section_name?>_<?php echo $valuelist[$i]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$i]['value_name'.$this->langtype]?></label>
                        		</div>
                    		<?php }}?>
                		</div>
                	</td>
            	</tr>
            </table>
        </div>
    
    
</div>


<script type="text/javascript">
	function toapprove_caseassign(){
		var isNull = /^[\s' ']*$/;
		var ispass = 1;

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
		var assign_memo = $('textarea[name="assign_memo"]').val();
		//if(driver_id == 0){ispass = 0;$('.driver_id_error').show();}else{$('.driver_id_error').hide();}
		<?php if($is_careforphone != 1){?>
			if(volunteer_1_id == 0){ispass = 0;$('.volunteer_1_id_error').show();}else{$('.volunteer_1_id_error').hide();}
		<?php }?>
// 		if(volunteer_2_id == 0){ispass = 0;$('.volunteer_2_id_error').show();}else{$('.volunteer_2_id_error').hide();}
// 		if(volunteer_3_id == 0){ispass = 0;$('.volunteer_3_id_error').show();}else{$('.volunteer_3_id_error').hide();}
//		if(volunteer_4_id == 0){ispass = 0;$('.volunteer_4_id_error').show();}else{$('.volunteer_4_id_error').hide();}
//		if(volunteer_5_id == 0){ispass = 0;$('.volunteer_5_id_error').show();}else{$('.volunteer_5_id_error').hide();}
// 		if(volunteer_6_id == 0){ispass = 0;$('.volunteer_6_id_error').show();}else{$('.volunteer_6_id_error').hide();}
		<?php if($is_careforphone != 1){?>
    		if(datetime_2 == ''){ispass = 0;$('.datetime_2_error').show();}else{$('.datetime_2_error').hide();}
    		if(datetime_2_duan == 0){ispass = 0;$('.datetime_2_duan_error').show();}else{$('.datetime_2_duan_error').hide();}
		<?php }?>
		
		if(ispass == 1){
			$('.btn_approve_submit').hide();
			$('.btn_approve_loading').show();
			var postOBJ = new Object();
			postOBJ.driver_id = driver_id;
			postOBJ.volunteer_1_id = volunteer_1_id;
			postOBJ.volunteer_2_id = volunteer_2_id;
			postOBJ.volunteer_3_id = volunteer_3_id;
			postOBJ.volunteer_4_id = volunteer_4_id;
			postOBJ.volunteer_5_id = volunteer_5_id;
			postOBJ.volunteer_6_id = volunteer_6_id;
			postOBJ.driver_id = driver_id;
			
			postOBJ.datetime_2 = datetime_2+' 12:00';
			postOBJ.datetime_2_duan = datetime_2_duan;
			postOBJ.assign_memo = assign_memo;
			
			$.post(baseurl+'welcome/approve_caseassign/<?php echo $recordinfo['form_id']?>', postOBJ, function (data){
				//location.reload();
				location.href = baseurl+'admin/case_success';
			})
		}
	}
</script>