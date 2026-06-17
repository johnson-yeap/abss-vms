<?php $this->load->view('header_volunteer')?>
<?php 
    $subsql = "";
    $sql = "
        SELECT a.*
            , b.form_pic_1_path AS volunteer_1_pic_1_path
            , b.input_1 AS volunteer_1_name
            , b.select_id_6 AS volunteer_1_shenfen
	        
            , c.form_pic_1_path AS volunteer_2_pic_1_path
            , c.input_1 AS volunteer_2_name
            , c.select_id_6 AS volunteer_2_shenfen
	        
            , d.form_pic_1_path AS volunteer_3_pic_1_path
            , d.input_1 AS volunteer_3_name
            , d.select_id_6 AS volunteer_3_shenfen
	        
            , f.form_pic_1_path AS volunteer_4_pic_1_path
            , f.input_1 AS volunteer_4_name
	        , f.select_id_6 AS volunteer_4_shenfen
	        
            , g.form_pic_1_path AS volunteer_5_pic_1_path
            , g.input_1 AS volunteer_5_name
            , g.select_id_6 AS volunteer_5_shenfen
	        
            , i.form_pic_1_path AS volunteer_6_pic_1_path
            , i.input_1 AS volunteer_6_name
            , i.select_id_6 AS volunteer_6_shenfen

            , e.form_pic_1_path AS driver_pic_1_path
            , e.input_1 AS driver_name
            , e.select_id_6 AS driver_shenfen
        FROM ".DB_PRE()."form_list AS a

        LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
        LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
        LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id

        LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
        LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
        LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id

        LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id

        WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit') AND a.enrolmentform_id = ".$enrolmentforminfo['form_id']."
        ORDER BY a.form_id DESC
    ";
    $recordlist = $this->db->query($sql)->result_array();
?>
<style>
    .availabletime{}
    .availabletime table{float:left;width:100%;background:black;border-spacing: 1px;border-collapse: separate;margin-top:5px;}
    .availabletime table tr{background:white;}
</style>
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
    $text_enrolment = '关怀者';
    $text_choose_volunteer = '选择义工';
    $text_volunteer = '义工';
    $text_driver = '司机';
    $text_choose_fearofanimal = '害怕动物?';
    $text_choose_address = '地址';
    $text_needcarefortime = '关怀者需要家访的时间';
    $text_yes = '是';
    $text_no = '否';
    $text_address = '地址';
    $text_nexthomevisitdate = '下次家访日期';
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
    $text_enrolment = 'Enrollment Patient';
    $text_choose_volunteer = 'Choose Volunteer';
    $text_volunteer = 'Volunteer';
    $text_driver = 'Driver';
    $text_choose_fearofanimal = 'Fear of Animal?';
    $text_choose_address = 'Address';
    $text_needcarefortime = 'Enrolment Available';
    $text_yes = 'Yes';
    $text_no = 'No';
    $text_address = 'Address';
    $text_nexthomevisitdate = 'Next Visit Date';
}
if($enrolmentforminfo['select_id_7'] == 1){
    $ishave_animal = '
        <div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;">'.$text_yes.'</div>
    ';
}else if($enrolmentforminfo['select_id_7'] == 2){
    $ishave_animal = '
        <div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:green;">'.$text_no.'</div>
    ';
}else{
    $ishave_animal = '';
}
if($enrolmentforminfo['select_id_1'] == 1){
    $form_gender_show = '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_male.jpg"/>';
}else if($enrolmentforminfo['select_id_1'] == 2){
    $form_gender_show = '<img style="width:20px;height:20px;" src="'.base_url().'themes/default/images/sex_female.jpg"/>';
}else{
    $form_gender_show = '&nbsp;';
}
$form_language_show = '';
for($ccc = 1; $ccc <= 10; $ccc++){
    if($enrolmentforminfo['checkbox_id_2_'.$ccc] == 1){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= '中文';}else{$form_language_show .= 'Chinese';}
    }else if($enrolmentforminfo['checkbox_id_2_'.$ccc] == 2){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= '英文';}else{$form_language_show .= 'English';}
    }else if($enrolmentforminfo['checkbox_id_2_'.$ccc] == 3){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Teochew';}else{$form_language_show .= 'Teochew';}
    }else if($enrolmentforminfo['checkbox_id_2_'.$ccc] == 4){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Cantonese';}else{$form_language_show .= 'Cantonese';}
    }else if($enrolmentforminfo['checkbox_id_2_'.$ccc] == 5){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Hakka';}else{$form_language_show .= 'Hakka';}
    }else if($enrolmentforminfo['checkbox_id_2_'.$ccc] == 6){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= 'Hokkien';}else{$form_language_show .= 'Hokkien';}
    }else if($enrolmentforminfo['checkbox_id_2_'.$ccc] == 7){
        if($form_language_show != ''){$form_language_show .= ',';}
        if($this->langtype == '_ch'){$form_language_show .= '其他: '.$enrolmentforminfo['input_3'];}else{$form_language_show .= 'Others: '.$enrolmentforminfo['input_3'];}
    }
}
if($form_language_show == ''){
    $form_language_show = '&nbsp;';
}

if($enrolmentforminfo['select_id_8'] == 1){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:green;">'.$text_health_good.'</div>
    ';
}else if($enrolmentforminfo['select_id_8'] == 2){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-primary mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#337ab7;">'.$text_health_normal.'</div>
    ';
}else if($enrolmentforminfo['select_id_8'] == 3){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-warning mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#f0ad4e;">'.$text_health_poorweek.'</div>
    ';
}else if($enrolmentforminfo['select_id_8'] == 4){
    $form_health_show = '
        <div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
        <div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;">'.$text_health_bedbound.'</div>
    ';
}else{
    $form_health_show = '';
}


if(isset($_COOKIE[DB_PRE().'volunteerinfo'])){
    $volunteerinfo = unserialize($_COOKIE[DB_PRE().'volunteerinfo']);
    $this->volunteer_id = $volunteerinfo['volunteer_id'];
    
    //重新续期cookie
    $arr = array('volunteer_id'=>$volunteerinfo['volunteer_id']);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'volunteerinfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->volunteer_id = 0;
}
if($this->volunteer_id != 0){
    $logininfo = $this->WelModel->getrecordinfo($this->volunteer_id);
}else{
    $logininfo = array();//获取记录详细
}

$addform = '';
if($enrolmentforminfo['is_closed'] == 0){//没有关闭
    if(empty($recordlist)){
        if($this->langtype == '_ch'){
            $text_addform_jiafang = '添加关怀组家访表格 （初次）';
        }else{
            $text_addform_jiafang = 'Add JF001A - Caring Unit Home Visit Form (1<sup>st</sup> visit)';
        }
        $link_addform_jiafang = base_url().'formtable/homevisit_1st/'.$enrolmentforminfo['form_id'];
        if(!empty($logininfo)){
            if($logininfo['select_id_6'] == 1 || $logininfo['select_id_6'] == 3){
                $addform .= '
                    <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-top:10px;">
                        <div onclick="javascript:location.href=\''.$link_addform_jiafang.'\';" style="cursor:pointer;float:left;text-align:center;font-size:15px;background:rgba(255, 153, 255, 0.3);color:black;padding:10px 15px;border:0px;border-radius:10px;">'.$text_addform_jiafang.'</div>
                    </div>
                ';
            }else{
                $addform .= '
                    <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-top:10px;">
                        <div style="float:left;text-align:center;font-size:15px;background:#EFEFEF;color:gray;padding:10px 15px;border:0px;border-radius:10px;">'.$text_addform_jiafang.'</div>
                    </div>
                ';
            }
        }
    }
    if(!empty($recordlist)){
        if($this->langtype == '_ch'){
            $text_addform_jiafang = '添加家访跟进表';
        }else{
            $text_addform_jiafang = 'Add JF002B - Home Visit Form (follow up visit)';
        }
        $link_addform_jiafang = base_url().'formtable/homevisit_followupvisit/'.$enrolmentforminfo['form_id'];
        if(!empty($logininfo)){
            if($logininfo['select_id_6'] == 1 || $logininfo['select_id_6'] == 3){
                $addform .= '
                    <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-top:10px;">
                        <div onclick="javascript:location.href=\''.$link_addform_jiafang.'\';" style="cursor:pointer;float:left;text-align:center;font-size:15px;background:rgba(178, 89, 0, 0.3);color:black;padding:10px 15px;border:0px;border-radius:10px;">'.$text_addform_jiafang.'</div>
                    </div>
                ';
            }else{
                $addform .= '
                    <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-top:10px;">
                        <div style="float:left;text-align:center;font-size:15px;background:#EFEFEF;color:gray;padding:10px 15px;border:0px;border-radius:10px;">'.$text_addform_jiafang.'</div>
                    </div>
                ';
            }
        }
    }
}
?>
<div style="float:left;width:calc(100% - 0px);">
	<div style="float:left;width:100%;">
		<div style="float:left;width:calc(100% - 20px);margin-left:10px;margin-top:20px;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
            	<div onclick="togotobackpage()" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#DF9C4D;color:white;padding:10px 0px;border:0px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '返回';}else{echo 'Back';}?></div>
            	<script type="text/javascript">
            		function togotobackpage(){
            			<?php if($enrolmentforminfo['is_closed'] == 1){?>
                			window.location.href = baseurl+'volunteer/case_closed';
                    	<?php }else if($enrolmentforminfo['is_finished'] == 1){?>
                    		window.location.href = baseurl+'volunteer/case_complete';
                    	<?php }else{?>
                    		window.location.href = baseurl+'volunteer';
                    	<?php }?>
            		}
            	</script>
            	<div style="float:left;line-height:40px;margin-left:10px;">
                	<?php echo str_replace('ABSSP', 'ABSSC', $enrolmentforminfo['form_number']);?> - <?php echo $enrolmentforminfo['input_1']?>
            	</div>
            	<div style="float:right;line-height:40px;margin-left:10px;">
            		<?php 
                		if($enrolmentforminfo['is_closed'] == 1){
                		    if($this->langtype == '_ch'){echo '<span style="color:gray;">已关闭</span>';}else{echo '<span style="color:gray;">Closed</span>';}
                		}else if($enrolmentforminfo['is_finished'] == 1){
                		    if($this->langtype == '_ch'){echo '<span style="color:green;">已完成</span>';}else{echo '<span style="color:green;">Completed</span>';}
                		}else if($enrolmentforminfo['is_assigned'] == 1){
                		    if($this->langtype == '_ch'){echo '<span style="color:orange;">进行中</span>';}else{echo '<span style="color:orange;">In Progress</span>';}
                		}else if($enrolmentforminfo['is_assigned'] == 0){
                		    if($this->langtype == '_ch'){echo '<span style="color:red;">待分配</span>';}else{echo '<span style="color:red;">Pending</span>';}
                		}
            		?>
            	</div>
            </div>
            <div style="float:left;width:100%;font-size:24px;font-weight:bold;margin-bottom:10px;">
            	<div style="float:left;width:100%;padding:20px 0px;height:calc(100% - 40px);border-radius:4px;background-color:white;">
    				<?php 
    				    $itemlistbox = '';
        				for($v = 1; $v <= 6; $v++){
        				    if($enrolmentforminfo['volunteer_'.$v.'_name'] != ''){
        				        $volunteerinfo = $this->WelModel->getrecordinfo($enrolmentforminfo['volunteer_'.$v.'_id']);//获取记录详细
        				        $itemlistbox .= '<div style="float:left;width:100%;margin-bottom:8px;padding-bottom:8px;border-bottom:1px solid #EFEFEF;">'.$this->WelModel->toshowvolunteer_listbox($volunteerinfo, array('isneed_timeavailable'=>0, 'isneed_address'=>0, 'isneed_age'=>0)).'</div>';
        				    }
        				}
        				
        				$driverlistbox = '';
    				    if($enrolmentforminfo['driver_name'] != ''){
    				        $driverinfo = $this->WelModel->getrecordinfo($enrolmentforminfo['driver_id']);//获取记录详细
    				        $driverlistbox .= '<div style="float:left;width:100%;margin-bottom:8px;padding-bottom:8px;border-bottom:1px solid #EFEFEF;">'.$this->WelModel->toshowvolunteer_listbox($driverinfo, array('isneed_timeavailable'=>0, 'isneed_address'=>0, 'isneed_age'=>0)).'</div>';
    				    }
    				    
    				    //下次家访日期的显示 ------- START
    				    if($enrolmentforminfo['datetime_last'] != 0){
    				        if($enrolmentforminfo['datetime_last_duan'] == 1){
    				            if($this->langtype == '_ch'){$duan_name = '上午';}else{$duan_name = 'AM';}
    				        }else{
    				            if($this->langtype == '_ch'){$duan_name = '下午';}else{$duan_name = 'PM';}
    				        }
    				        if($this->langtype == '_ch'){
    				            $text_remain = '还有';
    				            $text_days = '天';
    				            $text_hasexpired = '已过期';
    				        }else{
    				            $text_remain = '';
    				            if($enrolmentforminfo['datetime_last'] > time()){
    				                $text_days = 'days left';
    				            }else{
    				                $text_days = 'days';
    				            }
    				            $text_hasexpired = 'Expired';
    				        }
    				        if($enrolmentforminfo['datetime_last'] > time()){
    				            $have_days = ceil(($enrolmentforminfo['datetime_last'] - time()) / 86400);
    				            if(($enrolmentforminfo['datetime_last'] - 86400*3) > time()){
    				                $nextdate_show = '<span style="color:green;font-weight:bold;">'.date('d/m/Y', $enrolmentforminfo['datetime_last']).' '.$duan_name.'</span>';
    				            }else{
    				                $nextdate_show = '<span style="color:orange;font-weight:bold;">'.date('d/m/Y', $enrolmentforminfo['datetime_last']).' '.$duan_name.'</span>';
    				            }
    				        }else{
    				            $have_days = ceil((time() - $enrolmentforminfo['datetime_last']) / 86400);
    				            $nextdate_show = '<span style="color:red;font-weight:bold;">'.date('d/m/Y', $enrolmentforminfo['datetime_last']).' '.$duan_name.'</span>';
    				        }
    				        if($enrolmentforminfo['datetime_last'] > time()){
    				            $have_days = ceil(($enrolmentforminfo['datetime_last'] - time()) / 86400);
    				            if(($enrolmentforminfo['datetime_last'] - 86400*3) > time()){
    				                $nextdateremain_show = '<span style="color:green;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
    				            }else{
    				                $nextdateremain_show = '<span style="color:orange;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
    				            }
    				        }else{
    				            $have_days = ceil((time() - $enrolmentforminfo['datetime_last']) / 86400);
    				            $nextdateremain_show = '<span style="color:red;font-weight:normal;">'.$text_hasexpired.' '.$have_days.' '.$text_days.'</span>';
    				        }
    				        $next_jiafang_dateshow = '
                                <div style="float:left;width:115px;line-height:19px;margin-left:5px;">
                        			<div style="float:left;width:100%;">
                            			<img style="float:left;width:17px;height:17px;margin-top:1px;" src="'.base_url().'themes/default/images/icon_date_blue.png"/>
                            			<div style="float:left;margin-left:5px;">'.$nextdate_show.'</div>
                        			</div>
                                    <div style="float:left;width:100%;margin-top:0px;text-align:center;">'.$nextdateremain_show.'</div>
                                </div>
                            ';
                        }else{
                            $next_jiafang_dateshow = '';
                        }
                        if($enrolmentforminfo['assign_memo'] != ''){
                            $assign_memo_how = '
                                <div style="float:left;width:100%;">
            				        <div style="float:left;background:#EFEFEF;border:1px solid gray;padding:3px 5px;border-radius:4px;">'.$enrolmentforminfo['assign_memo'].'</div>
            				    </div>
                            ';
                        }else{
                            $assign_memo_how = '';
                        }
                        if($enrolmentforminfo['is_finished'] == 1){
                            if($this->langtype == '_ch'){
                                $next_jiafang_dateshow = '
                                    <div style="float:left;width:115px;line-height:19px;margin-left:5px;">
                            			<div style="float:left;width:100%;">
                                			<div style="float:left;background:green;color:white;padding:0px 5px;border-radius:4px;">已完成</div>
                            			</div>
                                    </div>
                                ';
                            }else{
                                $next_jiafang_dateshow = '
                                    <div style="float:left;width:115px;line-height:19px;margin-left:5px;">
                            			<div style="float:left;width:100%;">
                                			<div style="float:left;background:green;color:white;padding:0px 5px;border-radius:4px;">Completed</div>
                            			</div>
                                    </div>
                                ';
                            }
                        }
                        //下次家访日期的显示 ------- END
    				    
    					echo '
                            <div style="float:left;width:100%;font-size:12px;">
                                <div style="float:left;width:55%;">
                                    <div style="float:left;width:100%;text-align:left;font-weight:bold;font-size:18px;">
                                        '.$text_enrolment.'
                                    </div>
                                    <div style="float:left;width:100%;margin-top:5px;">
                                    	<div style="float:left;width:340px;">
                                            <div style="float:left;width:100px;height:100px;background:#EFEFEF;border-radius:6px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                                '.$enrolmentforminfo['input_1'].'
                                            </div>
                                            <div style="float:left;width:210px;margin-left:10px;">
                                                <div style="float:left;width:100%;">
                                                    '.$text_area.': '.$this->WelModel->getarea_show($enrolmentforminfo['select_id_23']).'
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
                                                <div style="float:left;width:100%;">
                                                    <div style="float:left;">'.$text_nexthomevisitdate.': </div>
                                                    <div style="float:left;">'.$next_jiafang_dateshow.'</div>
                                                </div>
                                                '.$assign_memo_how.'
                                            </div>
                                            <div style="float:left;width:100%;margin-top:5px;">
                                                <div style="float:left;width:100%;line-height:20px;font-size:15px;">
                                				    <div style="float:left;cursor:pointer;">
                                				    <div style="float:left;"><img style="float:left;width:20px;height:20px;" src="'.base_url().'themes/default/images/adress_tianlan.png"/></div>
                                				    <div style="float:left;margin-left:10px;color:#00D9D9;">'.$text_address.': '.$this->WelModel->getarea_show($enrolmentforminfo['select_id_23']).' '.$enrolmentforminfo['input_5'].'</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="float:left;width:calc(100% - 340px);line-height:13px;">
                                            <div style="float:left;width:100%;font-weight:bold;margin-bottom:7px;">'.$text_needcarefortime.'</div>
                                            <div class="availabletime" style="float:left;width:100%;">
                                                '.$this->WelModel->availabletimetableshow($enrolmentforminfo).'
                                           </div>
                                        </div>
                                    </div>
                                    <div style="float:left;width:100%;margin-top:5px;">'.$addform.'</div>
                                </div>
                                <div style="float:left;width:calc(45% - 10px);margin-left:10px;">
                                    <div style="float:left;width:100%;text-align:left;font-weight:bold;font-size:18px;">
                                        '.$text_volunteer.'
                                    </div>
                                    <div class="availabletime" style="float:left;width:100%;margin-top:5px;">
                                        '.$itemlistbox.'
                                    </div>
                                    <div style="float:left;width:100%;text-align:left;font-weight:bold;font-size:18px;margin-top:10px;">
                                        '.$text_driver.'
                                    </div>
                                    <div class="availabletime" style="float:left;width:100%;margin-top:5px;">
                                        '.$driverlistbox.'
                                    </div>
                                </div>
                            </div>
                        ';
    				?>
    			</div>
            </div>
            
            <?php 
                if(isset($_COOKIE[DB_PRE().'volunteerinfo'])){
                    $volunteerinfo = unserialize($_COOKIE[DB_PRE().'volunteerinfo']);
                    $this->volunteer_id = $volunteerinfo['volunteer_id'];
                    
                    //重新续期cookie
                    $arr = array('volunteer_id'=>$volunteerinfo['volunteer_id']);
                    $arr = serialize($arr);
                    $this->input->set_cookie(DB_PRE().'volunteerinfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
                }else{
                    $this->volunteer_id = 0;
                }
            ?>
            <style>
                @media screen and (max-width: 700px) {
                    .formtable_tabletitle{padding:0px 0px 0px 0px;}
                    .formtable_tabletitle .sectiontitle{line-height:24px;font-size:16px;padding:13px 15px;font-weight:bold;}
                    
                    .formtable_homepage{padding:20px 0px 20px 0px;}
                    .formtable_homepage .sectiontitle{line-height:24px;font-size:16px;padding:13px 15px;font-weight:bold;margin-bottom:20px;}
                }
                @media screen and (min-width: 700px){
                    .formtable_tabletitle{padding:0px 0px 0px 0px;}
                    .formtable_tabletitle .sectiontitle{line-height:50px;font-size:20px;padding:10px 15px;font-weight:bold;}
                
                    .formtable_homepage{padding:20px 0px 20px 0px;}
                    .formtable_homepage .sectiontitle{line-height:50px;font-size:20px;padding:10px 15px;font-weight:bold;margin-bottom:20px;}
                }
                .formtable_tabletitle{float:left;width:100%;}
                .formtable_tabletitle .sectiontitle{float:left;width:calc(100% - 30px);background:#DF9C4D;color:black;border-top-left-radius:18px;border-top-right-radius:18px;}
            
                .formtable_homepage{float:left;width:100%;background:rgba(223,156,77, 0.3);border-bottom-left-radius:18px;border-bottom-right-radius:18px;margin-bottom:20px;}
                .formtable_homepage .sectiontitle{float:left;width:calc(100% - 30px);border-bottom:1px solid #DF9C4D;color:black;}
            </style>
            <div class="formtable_tabletitle">
                	<div class="sectiontitle">
                        <div style="float:left;width:calc(100% - 250px - 200px - 140px - 100px - 100px);font-size:16px;"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Home Visit';}?></div>
                    	<div style="float:left;width:250px;font-size:16px;text-align:center;line-height:20px;margin-top:15px;margin-bottom:15px;"><?php if($this->langtype == '_ch'){echo '信众需求/评估';}else{echo 'Needs/Assessment';}?></div>
                    	<div style="float:left;width:200px;font-size:16px;text-align:center;line-height:20px;margin-top:15px;margin-bottom:15px;"><?php if($this->langtype == '_ch'){echo '身心状况';}else{echo 'Physical and mental conditions';}?></div>
                    	<div style="float:left;width:140px;font-size:16px;text-align:center;line-height:20px;margin-top:15px;margin-bottom:15px;"><?php if($this->langtype == '_ch'){echo '跟进下一次访问';}else{echo 'To follow up the next visit';}?></div>
                    	<div style="float:left;width:100px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '时间';}else{echo 'Time';}?></div>
                    	<div style="float:left;width:100px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></div>
                	</div>
            	</div>
            	<div class="formtable_homepage">
            		<?php if(!empty($recordlist)){for ($i = 0; $i < count($recordlist); $i++) {?>
                        <div class="sectiontitle">
                            <div style="float:left;width:100%;">
                            	<div style="float:left;width:calc(100% - 250px - 200px - 140px - 100px - 100px);line-height:25px;font-size:15px;">
                            		<div style="float:left;width:calc(100% - 5px);">
                                		<div style="float:left;">
                                    		<span style="font-weight: normal;">
                                    			<?php if($recordlist[$i]['form_type'] == 'homevisit_1st'){?>
                                    				<?php echo 'JF001A - '.$recordlist[$i]['form_number'];?>
                                    			<?php }else{?>
                                    				<?php echo 'JF002B - '.$recordlist[$i]['form_number'];?>
                                    			<?php }?>
                                    		</span>
                                		</div>
                        			</div>
                            	</div>
                            	<div style="float:left;width:250px;line-height:25px;font-size:12px;text-align:left;font-weight:normal;">
                        			<div style="float:left;width:100%;">
                            			<?php 
                                		      $section_name = "checkbox_id_1";
                                		      $valuelist = array();
                                		      $valuelist[] = array('value_id'=>1, 'value_name_en'=>'Home visit to provide Buddhism emotional support', 'value_name_ch'=>'家访 提供佛教情感支持');
                                		      $valuelist[] = array('value_id'=>2, 'value_name_en'=>'Home visits include prayer assistance (10 to 30 minutes) and a referral to a contact person to assist with Buddhist funeral rites', 'value_name_ch'=>'家访包括提供助念（10 到 30 分钟） 以及介绍联络人提供佛教葬礼仪式的协助');
                                		      $valuelist[] = array('value_id'=>3, 'value_name_en'=>'Phone Follow Up', 'value_name_ch'=>'电话慰问');
                                		      $valuelist[] = array('value_id'=>4, 'value_name_en'=>'No Follow Up Required', 'value_name_ch'=>'无需跟进');
                                		?>
                                		<?php if(!empty($valuelist)){for ($nnn = 0; $nnn < count($valuelist); $nnn++) {?>
                                			<?php 
                                			     $is_checked = '';
                                			     for($ccc = 1; $ccc <= 10; $ccc++){
                                			         if($recordlist[$i][$section_name.'_'.$ccc.'_last'] == $valuelist[$nnn]['value_id']){
                                			             $is_checked = ' checked';
                                			         }
                                			     }
                                			?>
                                    		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                                        		<div style="float:left;width:25px;"><input name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$nnn]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$nnn]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                                        		<label for="<?php echo $section_name?>_<?php echo $valuelist[$nnn]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$nnn]['value_name'.$this->langtype]?></label>
                                    		</div>
                                		<?php }}?>
                            		</div>
                            		<?php if($recordlist[$i]['textarea_1'] != ''){?>
                                		<div style="float:left;width:100%;">
                                			<?php echo nl2br($recordlist[$i]['textarea_1'])?>&nbsp;
                                		</div>
                            		<?php }?>
                        		</div>
                        		<div style="float:left;width:200px;line-height:25px;font-size:15px;text-align:center;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                        			<div style="float:left;">
                        				<?php if($recordlist[$i]['select_id_3'] == 1){?>
                                			<div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
                                			<div style="float:left;line-height:20px;margin-left:6px;color:green;"><?php if($this->langtype == '_ch'){echo '良好';}else{echo 'Good';}?></div>
                            			<?php }else if($recordlist[$i]['select_id_3'] == 2){?>
                                			<div style="float:left;"><input type="radio" class="mgr mgr-primary mgr-lg" checked disabled="disabled"></div>
                                			<div style="float:left;line-height:20px;margin-left:6px;color:#337ab7;"><?php if($this->langtype == '_ch'){echo '正常';}else{echo 'Normal';}?></div>
                            			<?php }else if($recordlist[$i]['select_id_3'] == 3){?>
                                			<div style="float:left;"><input type="radio" class="mgr mgr-warning mgr-lg" checked disabled="disabled"></div>
                                			<div style="float:left;line-height:20px;margin-left:6px;color:#f0ad4e;"><?php if($this->langtype == '_ch'){echo '状况不佳';}else{echo 'Poor/Weak';}?></div>
                            			<?php }else if($recordlist[$i]['select_id_3'] == 4){?>
                                			<div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
                                			<div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;"><?php if($this->langtype == '_ch'){echo '卧床不起';}else{echo 'Bed Bound';}?></div>
                            			<?php }?>
                            			&nbsp;
                            		</div>
                        		</div>
                        		<div style="float:left;width:140px;line-height:25px;font-size:12px;text-align:center;">
                            			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                    		<?php 
                                    		      $section_name = "select_id_4";
                                    		      $valuelist = array();
                                    		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Yes', 'value_name_ch'=>'是');
                                    		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-danger', 'value_name_en'=>'No', 'value_name_ch'=>'否');
                                    		?>
                                    		<?php if(!empty($valuelist)){for ($nnn = 0; $nnn < count($valuelist); $nnn++) {?>
                                    			<?php if($recordlist[$i][$section_name] == $valuelist[$nnn]['value_id']){?>
                                            		<div style="float:left;line-height:20px;">
                                                		<div style="float:left;width:25px;"><input type="radio"class="mgr <?php echo $valuelist[$nnn]['radioclass']?> mgr-lg" checked="checked" disabled="disabled"/></div>
                                                		<label style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$nnn]['value_name'.$this->langtype]?></label>
                                            		</div>
                                        		<?php }?>
                                    		<?php }}?>
                                		</div>
                                		<?php if($recordlist[$i][$section_name] == 1){?>
                                			<?php if($recordlist[$i]['datetime_2'] != 0){?>
                                    			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        			<div style="float:left;">
                                            			<img style="float:left;width:17px;height:17px;margin-top:4px;" src="<?php echo base_url().'themes/default/images/icon_date_blue.png'?>"/>
                                            			<div style="float:left;margin-left:5px;">
                                                			<?php 
                                                    			if($recordlist[$i]['datetime_2_duan'] == 1){
                                                    			    if($this->langtype == '_ch'){$duan_name = '上午';}else{$duan_name = 'AM';}
                                                    			}else{
                                                    			    if($this->langtype == '_ch'){$duan_name = '下午';}else{$duan_name = 'PM';}
                                                    			}
                                                    			if($recordlist[$i]['datetime_2'] > time()){
                                                    			    $have_days = ceil(($recordlist[$i]['datetime_2'] - time()) / 86400);
                                                    			    if(($recordlist[$i]['datetime_2'] - 86400*3) > time()){
                                                    			        echo '<span style="color:green;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_2']).' '.$duan_name.'</span>';
                                                    			    }else{
                                                    			        echo '<span style="color:orange;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_2']).' '.$duan_name.'</span>';
                                                    			    }
                                                    			}else{
                                                    			    $have_days = ceil((time() - $recordlist[$i]['datetime_2']) / 86400);
                                                    			    echo '<span style="color:black;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_2']).' '.$duan_name.'</span>';
                                                    			}
                                                			?>
                                            			</div>
                                        			</div>
                                    			</div>
                                    			<div style="float:left;width:100%;margin-top:0px;text-align:center;">
                                        			<?php 
                                            			if($this->langtype == '_ch'){
                                            			    $text_remain = '还有';
                                            			    $text_days = '天';
                                            			    $text_hasexpired = '已过期';
                                            			}else{
                                            			    $text_remain = '';
                                            			    if($recordlist[$i]['datetime_last'] > time()){
                                            			        $text_days = 'days left';
                                            			    }else{
                                            			        $text_days = 'days';
                                            			    }
                                            			    $text_hasexpired = 'Expired';
                                            			}
                                            			if($recordlist[$i]['datetime_2'] > time()){
                                            			    $have_days = ceil(($recordlist[$i]['datetime_2'] - time()) / 86400);
                                            			    if(($recordlist[$i]['datetime_2'] - 86400*3) > time()){
                                            			        echo '<span style="color:green;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
                                            			    }else{
                                            			        echo '<span style="color:orange;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
                                            			    }
                                            			}else{
                                            			    $have_days = ceil((time() - $recordlist[$i]['datetime_2']) / 86400);
                                            			    echo '<span style="color:black;font-weight:normal;">'.$text_hasexpired.' '.$have_days.' '.$text_days.'</span>';
                                            			}
                                        			?>
                                    			</div>
                                    		<?php }else{?>
                                    			&nbsp;
                                    		<?php }?>
                                		<?php }else{?>
                                			&nbsp;
                                		<?php }?>
                        		</div>
                            	<div style="float:left;width:100px;line-height:25px;font-size:12px;font-weight:normal;text-align:center;">
                            		<div style="float:left;width:100%;"><?php echo date('d/m/Y H:i', $recordlist[$i]['created']);?></div>
                            		<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '义工';}else{echo 'Volunteer';}?>：</div>
                            		<?php if($recordlist[$i]['volunteer_1_name'] != '' || $recordlist[$i]['volunteer_2_name'] != '' || $recordlist[$i]['volunteer_3_name'] != '' || $recordlist[$i]['volunteer_4_name'] != '' || $recordlist[$i]['volunteer_5_name'] != '' || $recordlist[$i]['volunteer_6_name'] != ''){?>
                        				<?php for($v = 1; $v <= 6; $v++){?>
                            				<?php if($recordlist[$i]['volunteer_'.$v.'_name'] != ''){?>
                                				<div style="float:left;width:100%;">
                                					<?php 
                                					   $filename = $recordlist[$i]['volunteer_'.$v.'_pic_1_path'];
                                					   $filename_arr = explode('.', $filename);
                                					   $file_type = end($filename_arr);
                                					   $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                                					?>
                                        			<img style="float:left;width:20px;height:20px;border-radius:50%;" src="<?php echo base_url().$filename_100x100?>"/>
                                        			<div style="float:left;width:calc(100% - 20px - 3px);margin-left:3px;min-height:14px;padding:3px 0px;line-height:12px;background:#EFEFEF;font-weight:normal;font-size:12px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($recordlist[$i]['volunteer_'.$v.'_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $recordlist[$i]['volunteer_'.$v.'_name']?> <?php if($recordlist[$i]['volunteer_'.$v.'_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></div>
                                        		</div>
                                    		<?php }?>
                                		<?php }?>
                        			<?php }?>
                        			<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?>：</div>
                            		<?php if($recordlist[$i]['driver_name'] != ''){?>
                        				<div style="float:left;width:100%;">
                        					<?php 
                        					   $filename = $recordlist[$i]['driver_pic_1_path'];
                        					   $filename_arr = explode('.', $filename);
                        					   $file_type = end($filename_arr);
                        					   $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                        					?>
                                			<img style="float:left;width:20px;height:20px;border-radius:50%;" src="<?php echo base_url().$filename_100x100?>"/>
                                			<div style="float:left;width:calc(100% - 20px - 3px);margin-left:3px;min-height:14px;padding:3px 0px;line-height:12px;background:#EFEFEF;font-weight:normal;font-size:12px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($recordlist[$i]['driver_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $recordlist[$i]['driver_name']?> <?php if($recordlist[$i]['driver_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></div>
                                		</div>
                        			<?php }else{?>
                        				<div style="float:left;width:100%;">
                                			<img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/avatar_default.png'?>"/>
                                			<div style="float:left;width:calc(100% - 20px - 3px);margin-left:3px;height:20px;background:#EFEFEF;">&nbsp;</div>
                                		</div>
                        			<?php }?>
                            	</div>
                            	<div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100px;">
                            		<?php if($enrolmentforminfo['is_closed'] == 0){//没有关闭?>
                                		<?php if(!empty($logininfo)){?>
                                		    <?php if($logininfo['select_id_6'] == 1 || $logininfo['select_id_6'] == 3){?>
                                		        <?php if(($recordlist[$i]['created'] + 86400*7) > time()){?>
                                    		        <a href="<?php echo base_url().'volunteer/formtable_record_edit/'.$recordlist[$i]['form_type'].'/'.$enrolmentforminfo['form_id'].'/'.$recordlist[$i]['form_id']?>" style="float:left;">
                                            			<img style="width:25px;height:25px;" src="<?php echo base_url().'themes/default/images/revamp.png'?>"/>
                                            		</a>
                                        		<?php }else{?>
                        							-
                                    		    <?php }?>
                                		    <?php }else{?>
                    							-
                                		    <?php }?>
                                		<?php }else{?>
                                		    -
                                		<?php }?>
                            		<?php }else{?>
                            			-
                            		<?php }?>
                            	</div>
                            </div>
                            <div style="float:left;width:100%;">
                            	<div style="float:left;width:calc(100% - 120px - 120px - 120px - 120px - 120px - 120px - 120px - 60px - 60px);line-height:25px;font-size:15px;">
                        			<div style="float:left;width:calc(100% - 10px);margin-left:10px;font-weight:normal;">
                                        <div style="float:left;width:100%;line-height:20px;font-size:15px;">
                                            <div style="float:left;cursor:pointer;font-weight:normal;">
                                                <?php echo $this->WelModel->getlanguage_show_colorful($recordlist[$i], 'checkbox_id_2', 'input_3');?>
                                            </div>
                                        </div>
                                    </div>
                            	</div>
                            </div>
                        </div>
                    <?php }}?>
                </div>
                
                
                
                
                <style>
                    @media screen and (max-width: 700px) {
                        .history_formtable_tabletitle{padding:0px 0px 0px 0px;}
                        .history_formtable_tabletitle .sectiontitle{line-height:24px;font-size:16px;padding:13px 15px;font-weight:bold;}
                        
                        .history_formtable_homepage{padding:20px 0px 20px 0px;}
                        .history_formtable_homepage .sectiontitle{line-height:24px;font-size:16px;padding:13px 15px;font-weight:bold;margin-bottom:20px;}
                    }
                    @media screen and (min-width: 700px){
                        .history_formtable_tabletitle{padding:0px 0px 0px 0px;}
                        .history_formtable_tabletitle .sectiontitle{line-height:50px;font-size:20px;padding:10px 15px;font-weight:bold;}
                    
                        .history_formtable_homepage{padding:20px 0px 20px 0px;}
                        .history_formtable_homepage .sectiontitle{line-height:50px;font-size:20px;padding:10px 15px;font-weight:bold;margin-bottom:20px;}
                    }
                    .history_formtable_tabletitle{float:left;width:100%;}
                    .history_formtable_tabletitle .sectiontitle{float:left;width:calc(100% - 30px);background:#EFEFEF;color:black;border-top-left-radius:18px;border-top-right-radius:18px;}
                
                    .history_formtable_homepage{float:left;width:100%;background:#EFEFEF;border-bottom-left-radius:18px;border-bottom-right-radius:18px;margin-bottom:20px;}
                    .history_formtable_homepage .sectiontitle{float:left;width:calc(100% - 30px);border-bottom:1px solid #DF9C4D;color:black;}
                </style>
                <?php 
                    if($enrolmentforminfo['parent'] != 0){
                        $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_id = ".$enrolmentforminfo['parent']." OR parent = ".$enrolmentforminfo['parent']." AND  form_id != ".$enrolmentforminfo['form_id']." ORDER BY form_id ASC";
                        $sub_enrolmentfromlist = $this->db->query($sql)->result_array();
                    }else{
                        $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE parent = ".$enrolmentforminfo['form_id']." AND  form_id != ".$enrolmentforminfo['form_id']." ORDER BY form_id ASC";
                        $sub_enrolmentfromlist = $this->db->query($sql)->result_array();
                    }
                ?>
                <?php if(!empty($sub_enrolmentfromlist)){for($s = 0; $s < count($sub_enrolmentfromlist); $s++){?>
                    <?php 
                        $sql = "
                            SELECT a.*
                                , b.form_pic_1_path AS volunteer_1_pic_1_path
                                , b.input_1 AS volunteer_1_name
                                , b.select_id_6 AS volunteer_1_shenfen
                    	        
                                , c.form_pic_1_path AS volunteer_2_pic_1_path
                                , c.input_1 AS volunteer_2_name
                                , c.select_id_6 AS volunteer_2_shenfen
                    	        
                                , d.form_pic_1_path AS volunteer_3_pic_1_path
                                , d.input_1 AS volunteer_3_name
                                , d.select_id_6 AS volunteer_3_shenfen
                    	        
                                , f.form_pic_1_path AS volunteer_4_pic_1_path
                                , f.input_1 AS volunteer_4_name
                    	        , f.select_id_6 AS volunteer_4_shenfen
                    	        
                                , g.form_pic_1_path AS volunteer_5_pic_1_path
                                , g.input_1 AS volunteer_5_name
                                , g.select_id_6 AS volunteer_5_shenfen
                    	        
                                , i.form_pic_1_path AS volunteer_6_pic_1_path
                                , i.input_1 AS volunteer_6_name
                                , i.select_id_6 AS volunteer_6_shenfen
                    
                                , e.form_pic_1_path AS driver_pic_1_path
                                , e.input_1 AS driver_name
                                , e.select_id_6 AS driver_shenfen
                    
                            FROM ".DB_PRE()."form_list AS a
                    
                            LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                    
                            LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
                            LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                    
                            LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                    
                            WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit') AND a.enrolmentform_id = ".$sub_enrolmentfromlist[$s]['form_id']."
                            ORDER BY a.form_id DESC
                        ";
                        $recordlist = $this->db->query($sql)->result_array();
                    ?>
                    <div style="display:none;float:left;width:100%;font-weight:bold;font-size:18px;line-height:36px;margin-bottom:10px;">
                    	<div style="float:left;border:1px solid black;padding:0px 10px;border-radius:18px;">
                        	History Home Visit - <?php echo str_replace('ABSSP', 'ABSSC', $sub_enrolmentfromlist[$s]['form_number']);?> - <?php echo $sub_enrolmentfromlist[$s]['input_1']?>
                        </div>
                    </div>
                	<div class="history_formtable_tabletitle" style="display:none;">
                    	<div class="sectiontitle">
                            <div style="float:left;width:calc(100% - 250px - 200px - 140px - 100px);font-size:16px;"><?php if($this->langtype == '_ch'){echo '家访';}else{echo 'Home Visit';}?></div>
                        	<div style="float:left;width:250px;font-size:16px;text-align:center;line-height:20px;margin-top:15px;margin-bottom:15px;"><?php if($this->langtype == '_ch'){echo '信众需求/评估';}else{echo 'Needs/Assessment';}?></div>
                        	<div style="float:left;width:200px;font-size:16px;text-align:center;line-height:20px;margin-top:15px;margin-bottom:15px;"><?php if($this->langtype == '_ch'){echo '身心状况';}else{echo 'Physical and mental conditions';}?></div>
                        	<div style="float:left;width:140px;font-size:16px;text-align:center;line-height:20px;margin-top:15px;margin-bottom:15px;"><?php if($this->langtype == '_ch'){echo '跟进下一次访问';}else{echo 'To follow up the next visit';}?></div>
                        	<div style="float:left;width:100px;font-size:16px;text-align:center;"><?php if($this->langtype == '_ch'){echo '时间';}else{echo 'Time';}?></div>
                    	</div>
                	</div>
                	<div class="history_formtable_homepage" style="display:none;">
                		<?php if(!empty($recordlist)){for ($i = 0; $i < count($recordlist); $i++) {?>
                            <div class="sectiontitle">
                                <div style="float:left;width:100%;">
                                	<div style="float:left;width:calc(100% - 250px - 200px - 140px - 100px);line-height:25px;font-size:15px;">
                                		<div style="float:left;width:calc(100% - 5px);">
                                    		<div style="float:left;">
                                        		<span style="font-weight: normal;">
                                        			<?php if($recordlist[$i]['form_type'] == 'homevisit_1st'){?>
                                        				<?php echo 'JF001A - '.$recordlist[$i]['form_number'];?>
                                        			<?php }else{?>
                                        				<?php echo 'JF002B - '.$recordlist[$i]['form_number'];?>
                                        			<?php }?>
                                        		</span>
                                    		</div>
                            			</div>
                                	</div>
                                	<div style="float:left;width:250px;line-height:25px;font-size:12px;text-align:left;font-weight:normal;">
                            			<div style="float:left;width:100%;">
                                			<?php 
                                    		      $section_name = "checkbox_id_1";
                                    		      $valuelist = array();
                                    		      $valuelist[] = array('value_id'=>1, 'value_name_en'=>'Home visit to provide Buddhism emotional support', 'value_name_ch'=>'家访 提供佛教情感支持');
                                    		      $valuelist[] = array('value_id'=>2, 'value_name_en'=>'Home visits include prayer assistance (10 to 30 minutes) and a referral to a contact person to assist with Buddhist funeral rites', 'value_name_ch'=>'家访包括提供助念（10 到 30 分钟） 以及介绍联络人提供佛教葬礼仪式的协助');
                                    		      $valuelist[] = array('value_id'=>3, 'value_name_en'=>'Phone Follow Up', 'value_name_ch'=>'电话慰问');
                                    		      $valuelist[] = array('value_id'=>4, 'value_name_en'=>'No Follow Up Required', 'value_name_ch'=>'无需跟进');
                                    		?>
                                    		<?php if(!empty($valuelist)){for ($nnn = 0; $nnn < count($valuelist); $nnn++) {?>
                                    			<?php 
                                    			     $is_checked = '';
                                    			     for($ccc = 1; $ccc <= 10; $ccc++){
                                    			         if($recordlist[$i][$section_name.'_'.$ccc.'_last'] == $valuelist[$nnn]['value_id']){
                                    			             $is_checked = ' checked';
                                    			         }
                                    			     }
                                    			?>
                                        		<div style="float:left;width:100%;line-height:20px;<?php if($i != 0){echo 'margin-top:8px;';}?>">
                                            		<div style="float:left;width:25px;"><input name="<?php echo $section_name?>[]" id="<?php echo $section_name?>_<?php echo $valuelist[$nnn]['value_id']?>" type="checkbox" class="mgc mgc-success mgc-lg" value="<?php echo $valuelist[$nnn]['value_id']?>" <?php echo $is_checked;?> disabled="disabled"/></div>
                                            		<label for="<?php echo $section_name?>_<?php echo $valuelist[$nnn]['value_id']?>" style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$nnn]['value_name'.$this->langtype]?></label>
                                        		</div>
                                    		<?php }}?>
                                		</div>
                                		<?php if($recordlist[$i]['textarea_1'] != ''){?>
                                    		<div style="float:left;width:100%;">
                                    			<?php echo nl2br($recordlist[$i]['textarea_1'])?>&nbsp;
                                    		</div>
                                		<?php }?>
                            		</div>
                            		<div style="float:left;width:200px;line-height:25px;font-size:15px;text-align:center;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                            			<div style="float:left;">
                            				<?php if($recordlist[$i]['select_id_3'] == 1){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:green;"><?php if($this->langtype == '_ch'){echo '良好';}else{echo 'Good';}?></div>
                                			<?php }else if($recordlist[$i]['select_id_3'] == 2){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-primary mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:#337ab7;"><?php if($this->langtype == '_ch'){echo '正常';}else{echo 'Normal';}?></div>
                                			<?php }else if($recordlist[$i]['select_id_3'] == 3){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-warning mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:#f0ad4e;"><?php if($this->langtype == '_ch'){echo '状况不佳';}else{echo 'Poor/Weak';}?></div>
                                			<?php }else if($recordlist[$i]['select_id_3'] == 4){?>
                                    			<div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
                                    			<div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;"><?php if($this->langtype == '_ch'){echo '卧床不起';}else{echo 'Bed Bound';}?></div>
                                			<?php }?>
                                			&nbsp;
                                		</div>
                            		</div>
                            		<div style="float:left;width:140px;line-height:25px;font-size:12px;text-align:center;">
                                			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                        		<?php 
                                        		      $section_name = "select_id_4";
                                        		      $valuelist = array();
                                        		      $valuelist[] = array('value_id'=>1, 'radioclass'=>'mgr-success', 'value_name_en'=>'Yes', 'value_name_ch'=>'是');
                                        		      $valuelist[] = array('value_id'=>2, 'radioclass'=>'mgr-danger', 'value_name_en'=>'No', 'value_name_ch'=>'否');
                                        		?>
                                        		<?php if(!empty($valuelist)){for ($nnn = 0; $nnn < count($valuelist); $nnn++) {?>
                                        			<?php if($recordlist[$i][$section_name] == $valuelist[$nnn]['value_id']){?>
                                                		<div style="float:left;line-height:20px;">
                                                    		<div style="float:left;width:25px;"><input type="radio"class="mgr <?php echo $valuelist[$nnn]['radioclass']?> mgr-lg" checked="checked" disabled="disabled"/></div>
                                                    		<label style="float:left;width:calc(100% - 25px);"><?php echo $valuelist[$nnn]['value_name'.$this->langtype]?></label>
                                                		</div>
                                            		<?php }?>
                                        		<?php }}?>
                                    		</div>
                                    		<?php if($recordlist[$i][$section_name] == 1){?>
                                    			<?php if($recordlist[$i]['datetime_2'] != 0){?>
                                        			<div style="float:left;width:100%;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                            			<div style="float:left;">
                                                			<img style="float:left;width:17px;height:17px;margin-top:4px;" src="<?php echo base_url().'themes/default/images/icon_date_blue.png'?>"/>
                                                			<div style="float:left;margin-left:5px;">
                                                    			<?php 
                                                        			if($recordlist[$i]['datetime_2_duan'] == 1){
                                                        			    if($this->langtype == '_ch'){$duan_name = '上午';}else{$duan_name = 'AM';}
                                                        			}else{
                                                        			    if($this->langtype == '_ch'){$duan_name = '下午';}else{$duan_name = 'PM';}
                                                        			}
                                                        			if($recordlist[$i]['datetime_2'] > time()){
                                                        			    $have_days = ceil(($recordlist[$i]['datetime_2'] - time()) / 86400);
                                                        			    if(($recordlist[$i]['datetime_2'] - 86400*3) > time()){
                                                        			        echo '<span style="color:green;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_2']).' '.$duan_name.'</span>';
                                                        			    }else{
                                                        			        echo '<span style="color:orange;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_2']).' '.$duan_name.'</span>';
                                                        			    }
                                                        			}else{
                                                        			    $have_days = ceil((time() - $recordlist[$i]['datetime_2']) / 86400);
                                                        			    echo '<span style="color:black;font-weight:bold;">'.date('d/m/Y', $recordlist[$i]['datetime_2']).' '.$duan_name.'</span>';
                                                        			}
                                                    			?>
                                                			</div>
                                            			</div>
                                        			</div>
                                        			<div style="float:left;width:100%;margin-top:0px;text-align:center;">
                                            			<?php 
                                                			if($this->langtype == '_ch'){
                                                			    $text_remain = '还有';
                                                			    $text_days = '天';
                                                			    $text_hasexpired = '已过期';
                                                			}else{
                                                			    $text_remain = '';
                                                			    if($recordlist[$i]['datetime_last'] > time()){
                                                			        $text_days = 'days left';
                                                			    }else{
                                                			        $text_days = 'days';
                                                			    }
                                                			    $text_hasexpired = 'Expired';
                                                			}
                                                			if($recordlist[$i]['datetime_2'] > time()){
                                                			    $have_days = ceil(($recordlist[$i]['datetime_2'] - time()) / 86400);
                                                			    if(($recordlist[$i]['datetime_2'] - 86400*3) > time()){
                                                			        echo '<span style="color:green;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
                                                			    }else{
                                                			        echo '<span style="color:orange;font-weight:normal;">'.$text_remain.' '.$have_days.' '.$text_days.'</span>';
                                                			    }
                                                			}else{
                                                			    $have_days = ceil((time() - $recordlist[$i]['datetime_2']) / 86400);
                                                			    echo '<span style="color:black;font-weight:normal;">'.$text_hasexpired.' '.$have_days.' '.$text_days.'</span>';
                                                			}
                                            			?>
                                        			</div>
                                        		<?php }else{?>
                                        			&nbsp;
                                        		<?php }?>
                                    		<?php }else{?>
                                    			&nbsp;
                                    		<?php }?>
                            		</div>
                                	<div style="float:left;width:100px;line-height:25px;font-size:12px;font-weight:normal;text-align:center;">
                                		<div style="float:left;width:100%;"><?php echo date('d/m/Y H:i', $recordlist[$i]['created']);?></div>
                                		<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '义工';}else{echo 'Volunteer';}?>：</div>
                                		<?php if($recordlist[$i]['volunteer_1_name'] != '' || $recordlist[$i]['volunteer_2_name'] != '' || $recordlist[$i]['volunteer_3_name'] != '' || $recordlist[$i]['volunteer_4_name'] != '' || $recordlist[$i]['volunteer_5_name'] != '' || $recordlist[$i]['volunteer_6_name'] != ''){?>
                            				<?php for($v = 1; $v <= 6; $v++){?>
                                				<?php if($recordlist[$i]['volunteer_'.$v.'_name'] != ''){?>
                                    				<div style="float:left;width:100%;">
                                    					<?php 
                                    					   $filename = $recordlist[$i]['volunteer_'.$v.'_pic_1_path'];
                                    					   $filename_arr = explode('.', $filename);
                                    					   $file_type = end($filename_arr);
                                    					   $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                                    					?>
                                            			<img style="float:left;width:20px;height:20px;border-radius:50%;" src="<?php echo base_url().$filename_100x100?>"/>
                                            			<div style="float:left;width:calc(100% - 20px - 3px);margin-left:3px;min-height:14px;padding:3px 0px;line-height:12px;background:#EFEFEF;font-weight:normal;font-size:12px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($recordlist[$i]['volunteer_'.$v.'_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $recordlist[$i]['volunteer_'.$v.'_name']?> <?php if($recordlist[$i]['volunteer_'.$v.'_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></div>
                                            		</div>
                                        		<?php }?>
                                    		<?php }?>
                            			<?php }?>
                            			<div style="float:left;width:100%;"><?php if($this->langtype == '_ch'){echo '司机';}else{echo 'Driver';}?>：</div>
                                		<?php if($recordlist[$i]['driver_name'] != ''){?>
                            				<div style="float:left;width:100%;">
                            					<?php 
                            					   $filename = $recordlist[$i]['driver_pic_1_path'];
                            					   $filename_arr = explode('.', $filename);
                            					   $file_type = end($filename_arr);
                            					   $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                            					?>
                                    			<img style="float:left;width:20px;height:20px;border-radius:50%;" src="<?php echo base_url().$filename_100x100?>"/>
                                    			<div style="float:left;width:calc(100% - 20px - 3px);margin-left:3px;min-height:14px;padding:3px 0px;line-height:12px;background:#EFEFEF;font-weight:normal;font-size:12px;text-align:left;display: flex;flex-direction: row;justify-content: left;align-items: center;"><div style="float:left;margin-left:3px;<?php if($recordlist[$i]['driver_shenfen'] == 3){echo 'color:#0788FF;';}?>"><?php echo $recordlist[$i]['driver_name']?> <?php if($recordlist[$i]['driver_shenfen'] == 3){?><img style="width:12px;height:12px;" src="<?php echo base_url().'themes/default/images/icon_driver_both_blue.png'?>"/><?php }?></div></div>
                                    		</div>
                            			<?php }else{?>
                            				<div style="float:left;width:100%;">
                                    			<img style="float:left;width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/avatar_default.png'?>"/>
                                    			<div style="float:left;width:calc(100% - 20px - 3px);margin-left:3px;height:20px;background:#EFEFEF;">&nbsp;</div>
                                    		</div>
                            			<?php }?>
                                	</div>
                                </div>
                                <div style="float:left;width:100%;">
                                	<div style="float:left;width:calc(100% - 120px - 120px - 120px - 120px - 120px - 120px - 120px - 60px - 60px);line-height:25px;font-size:15px;">
                            			<div style="float:left;width:calc(100% - 10px);margin-left:10px;font-weight:normal;">
                                            <div style="float:left;width:100%;line-height:20px;font-size:15px;">
                                                <div style="float:left;cursor:pointer;font-weight:normal;">
                                                    <?php echo $this->WelModel->getlanguage_show_colorful($recordlist[$i], 'checkbox_id_2', 'input_3');?>
                                                </div>
                                            </div>
                                        </div>
                                	</div>
                                </div>
                            </div>
                        <?php }}?>
                    </div>
                <?php }}?>
                
                
                
             </div>
    	</div>
    </div>
