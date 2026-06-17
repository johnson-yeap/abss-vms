<style>
    .chooserolearea{float:left;width:100%;height:100%;}
    .chooserolecontent{float:left;width:100%;height:calc(100% - 40px - 60px);overflow-x:hidden;overflow-y:auto;border-radius:5px;-webkit-overflow-scrolling: touch;}
    .chooserolecontent .itemlist{cursor:pointer;float:left;width:100%;padding:5px 0px;margin-top:10px;background:#EFEFEF;}
    .chooserolecontent .itemlist:nth-child(2n-1){background:white;}
    <?php 
    if($role_name == 'driver'){
        $tabthemeslist_color = '#C2E3F9';
    }else{
        $tabthemeslist_color = '#B2F4D3';
    }
    ?>
    .chooserolecontent .itemlist:hover{background:<?php echo $tabthemeslist_color?>;}
    .chooserolecontent .itemlist:hover table tr{background:<?php echo $tabthemeslist_color?>;}
</style>
<div class="chooserolearea">
<?php 
if($this->langtype == '_ch'){
    $text_ishave_animal = '有动物吗？';
    $text_gender = '性别';
    $text_area = '区域';
    $text_language = '语言';
    $text_language_1 = ' 说';
    $text_language_2 = ' 写';
    $text_time = '是否匹配时间';
    $text_health = '当前健康';
    $text_health_good = '良好';
    $text_health_normal = '正常';
    $text_health_poorweek = '状况不佳';
    $text_health_bedbound = '卧床不起';
    $text_health_enrolment = '关怀者';
    if($role_name == 'driver'){
        $text_choose_volunteer = '选择司机';
        $text_provideravailabletime = '司机可提供家访的时间';
    }else{
        $text_choose_volunteer = '选择义工';
        $text_provideravailabletime = '义工可提供家访的时间';
    }
    $text_choose_fearofanimal = '害怕动物?';
    $text_choose_address = '地址';
    $text_choose = '选择';
    $text_avatar = '头像';
    $text_name = '姓名';
    $text_yes = '是';
    $text_no = '否';
    $text_search = '搜索';
    $text_clearhistory = '清除历史';
}else{
    $text_ishave_animal = 'Have Animal?';
    $text_gender = 'Gender';
    $text_area = 'Area';
    $text_language = 'Language';
    $text_language_1 = ' Spoken';
    $text_language_2 = ' Written';
    $text_time = 'Match time?';
    $text_health = 'Current Health';
    $text_health_good = 'Good';
    $text_health_normal = 'Normal';
    $text_health_poorweek = 'Poor/Weak';
    $text_health_bedbound = 'Bed Bound';
    $text_health_enrolment = 'Enrolment';
    if($role_name == 'driver'){
        $text_choose_volunteer = 'Choose Driver';
        $text_provideravailabletime = 'Driver Available';
    }else{
        $text_choose_volunteer = 'Choose Volunteer';
        $text_provideravailabletime = 'Volunteer Available';
    }
    $text_choose_fearofanimal = 'Fear of Animal?';
    $text_choose_address = 'Address';
    $text_choose = 'Choose';
    $text_avatar = 'Avatar';
    $text_name = 'Name';
    $text_yes = 'Yes';
    $text_no = 'No';
    $text_search = 'Search';
    $text_clearhistory = 'Clear History';
}

//API 获取 leftjoin 列表
$volunteer_id = $this->input->post($role_name.'_id');
$popup_gender_id = $this->input->post('popup_gender_id');
$popup_language_id = $this->input->post('popup_language_id');
$popup_time_id = $this->input->post('popup_time_id');
$popup_address_id = $this->input->post('popup_address_id');
$popup_fearanimal_id = $this->input->post('popup_fearanimal_id');
$popup_keyword = $this->input->post('popup_keyword');

$subsql = "";
$addon_sql = "";
if($popup_gender_id != '' && $popup_gender_id != 0){
    $subsql .= ' AND select_id_1 = '.$popup_gender_id;
}
if($popup_address_id != '' && $popup_address_id != 0){
    $subsql .= ' AND select_id_23 = '.$popup_address_id;
}
if($popup_fearanimal_id != '' && $popup_fearanimal_id != 0){
    $subsql .= ' AND select_id_8 = '.$popup_fearanimal_id;
}
if($popup_language_id != '' && $popup_language_id != 0){
    $innersql = "(";
    for($ccc = 1; $ccc <= 10; $ccc++){
        if($ccc != 1){
            $innersql .= " OR ";
            $innersql .= " (checkbox_id_2_".$ccc." = ".$popup_language_id.") OR (checkbox_id_3_".$ccc." = ".$popup_language_id.")";
        }else{
            $innersql .= "(checkbox_id_2_".$ccc." = ".$popup_language_id.") OR (checkbox_id_3_".$ccc." = ".$popup_language_id.")";
        }
    }
    $innersql .= ")";
    $subsql .= " AND ".$innersql;
}

if($popup_time_id != '' && $popup_time_id == 1){
    for($bbb = 9; $bbb <= 22; $bbb++){
        if($recordinfo['select_id_'.$bbb] == 1){
            $addon_sql .= " AND select_id_".$bbb." = 1";
        }
    }
}
if($popup_keyword != ''){
    $subsql .= " AND ((input_1 LIKE '%".$popup_keyword."%') OR (input_4 LIKE '%".$popup_keyword."%'))";
}
if($role_name == 'driver'){
    $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_6 IN (2, 3) AND status = 1 AND is_closed = 0 ".$subsql." ".$addon_sql." ORDER BY form_id DESC LIMIT 0, 1000";
}else{
    $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_6 IN (1, 3) AND status = 1 AND is_closed = 0 ".$subsql." ".$addon_sql." ORDER BY form_id DESC LIMIT 0, 1000";
}
$volunteer_list = $this->db->query($sql)->result_array();

if($popup_address_id != '' && $popup_address_id != 0){
    $thiscolor_1 = 'color:black;';
}else{
    $thiscolor_1 = 'color:#999;';
}
$address_selectoption = '<option value="0">'.$text_area.'</option>';
$address_selectoption .= $this->WelModel->getarea_select($popup_address_id);

if($popup_gender_id != '' && $popup_gender_id != 0){
    $thiscolor_2 = 'color:black;';
}else{
    $thiscolor_2 = 'color:#999;';
}
if($this->langtype == '_ch'){
    $gender_selectoption = '<option value="0">性别</option>';
    if($popup_gender_id != '' && $popup_gender_id == 1){$is_selected = 'selected';}else{$is_selected = '';}
    $gender_selectoption .= '<option value="1" '.$is_selected.'>男</option>';
    if($popup_gender_id != '' && $popup_gender_id == 2){$is_selected = 'selected';}else{$is_selected = '';}
    $gender_selectoption .= '<option value="2" '.$is_selected.'>女</option>';
}else{
    $gender_selectoption = '<option value="0">Gender</option>';
    if($popup_gender_id != '' && $popup_gender_id == 1){$is_selected = 'selected';}else{$is_selected = '';}
    $gender_selectoption .= '<option value="1" '.$is_selected.'>Male</option>';
    if($popup_gender_id != '' && $popup_gender_id == 2){$is_selected = 'selected';}else{$is_selected = '';}
    $gender_selectoption .= '<option value="2" '.$is_selected.'>Female</option>';
}



if($popup_fearanimal_id != '' && $popup_fearanimal_id != 0){
    $thiscolor_3 = 'color:black;';
}else{
    $thiscolor_3 = 'color:#999;';
}
if($this->langtype == '_ch'){
    $fearanimal_selectoption = '<option value="0">害怕动物?</option>';
    if($popup_fearanimal_id != '' && $popup_fearanimal_id == 1){$is_selected = 'selected';}else{$is_selected = '';}
    $fearanimal_selectoption .= '<option value="1" '.$is_selected.'>害怕动物? 是</option>';
    if($popup_fearanimal_id != '' && $popup_fearanimal_id == 2){$is_selected = 'selected';}else{$is_selected = '';}
    $fearanimal_selectoption .= '<option value="2" '.$is_selected.'>害怕动物? 否</option>';
}else{
    $fearanimal_selectoption = '<option value="0">Fear of Animal?</option>';
    if($popup_fearanimal_id != '' && $popup_fearanimal_id == 1){$is_selected = 'selected';}else{$is_selected = '';}
    $fearanimal_selectoption .= '<option value="1" '.$is_selected.'>Fear of Animal? Yes</option>';
    if($popup_fearanimal_id != '' && $popup_fearanimal_id == 2){$is_selected = 'selected';}else{$is_selected = '';}
    $fearanimal_selectoption .= '<option value="2" '.$is_selected.'>Fear of Animal? No</option>';
}

if($popup_language_id != '' && $popup_language_id != 0){
    $thiscolor_4 = 'color:black;';
}else{
    $thiscolor_4 = 'color:#999;';
}
$language_selectoption = '<option value="0">'.$text_language.'</option>';
$language_selectoption .= $this->WelModel->getlanguage_select($popup_language_id);

if($popup_time_id != '' && $popup_time_id != 0){
    $thiscolor_5 = 'color:black;';
}else{
    $thiscolor_5 = 'color:#999;';
}
$time_selectoption = '<option value="0">'.$text_time.'</option>';
$time_selectoption .= $this->WelModel->gettime_select($popup_time_id);



if($recordinfo['select_id_7'] == 1){//家里有动物
    $haipaidongwu_css = '';
}else{
    $haipaidongwu_css = 'display:none;';
}

echo '
    <div style="float:left;width:100%;">
        <div style="float:left;height:35px;margin-left:10px;font-weight:bold;font-size:16px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
            '.$text_choose_volunteer.'
        </div>
        <div style="float:left;">
            <div style="float:left;margin-left:10px;">
                <select onchange="tochoose_popup_address_id(this.value)" name="popup_address_id" style="float:left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thiscolor_1.'appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:70px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">'.$address_selectoption.'</select>
            </div>
            <div style="'.$haipaidongwu_css.'float:left;margin-left:10px;">
                <select onchange="tochoose_popup_fearanimal_id(this.value)" name="popup_fearanimal_id" style="float:left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thiscolor_3.'appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:160px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">'.$fearanimal_selectoption.'</select>
            </div>
            <div style="float:left;margin-left:10px;">
                <select onchange="tochoose_popup_gender_id(this.value)" name="popup_gender_id" style="float:left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thiscolor_2.'appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">'.$gender_selectoption.'</select>
            </div>
            <div style="float:left;margin-left:10px;">
                <select onchange="tochoose_popup_language_id(this.value)" name="popup_language_id" style="float:left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thiscolor_4.'appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">'.$language_selectoption.'</select>
            </div>
            <div style="float:left;margin-left:10px;">
                <select onchange="tochoose_popup_time_id(this.value)" name="popup_time_id" style="float:left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thiscolor_5.'appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">'.$time_selectoption.'</select>
            </div>
            <div style="float:left;margin-left:10px;">
                <input type="text" name="popup_keyword" placeholder="'.lang('cy_enter_keyword').'" style="width:120px;line-height:12px;padding-top:9px;padding-bottom:9px;" value="'.$popup_keyword.'"/>
            </div>
            <div style="float:left;margin-left:10px;">
                <div onclick="tochoose'.$role_name.'(2)" style="cursor:pointer;float:left;line-height:35px;padding:0px 15px;background-color:#E85252;color:white;border-radius:4px;cursor:pointer;font-size:14px;">'.$text_search.'</div>
            </div>
        </div>
    </div>
    <div style="float:left;width:100%;margin-top:5px;font-size:12px;line-height:40px;font-weight:bold;background:'.$tabthemeslist_color.';">
        <div style="float:left;width:50px;text-align:center;">'.$text_choose.'</div>        
        <div style="float:left;width:100px;text-align:center;">'.$text_avatar.'</div>
        <div style="float:left;width:calc(100% - 50px - 100px - 20px);margin-left:20px;">
            <div style="float:left;width:300px;text-align:left;font-size:14px;">'.$text_name.'</div>
            <div style="float:left;width:calc(100% - 300px);text-align:left;font-size:14px;">'.$text_provideravailabletime.'</div>
        </div>
    </div>
';
echo '<div class="chooserolecontent choose_'.$role_name.'_content_2">';
if(!empty($volunteer_list)){
    for($i = 0; $i < count($volunteer_list); $i++){
        
        $filename = $volunteer_list[$i]['form_pic_1_path'];
        $filename_arr = explode('.', $filename);
        $file_type = end($filename_arr);
        if($filename != ''){
            $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
        }else{
            $filename_100x100 = '';
        }
        
        if($volunteer_list[$i]['select_id_1'] == 1){
            $gender_show = '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/sex_male.jpg"/>';
        }else if($volunteer_list[$i]['select_id_1'] == 2){
            $gender_show = '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/sex_female.jpg"/>';
        }else{
            echo '&nbsp;';
        }
        
        if($volunteer_list[$i]['select_id_8'] == 1){
            $fearanimal_show = '
                <div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
                <div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;">'.$text_yes.'</div>
            ';
        }else if($volunteer_list[$i]['select_id_8'] == 2){
            $fearanimal_show = '
                <div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
                <div style="float:left;line-height:20px;margin-left:6px;color:green;">'.$text_no.'</div>
            ';
        }else{
            $fearanimal_show = '&nbsp;';
        }
        
        if($volunteer_list[$i]['select_id_2'] != 0){
            $age_show = $volunteer_list[$i]['select_id_2'];if($this->langtype == '_ch'){$age_show .= '岁';}else{$age_show .= ' years old';}
        }else{
            $age_show = '&nbsp;';
        }
        
        if($volunteer_list[$i]['select_id_6'] == 3){
            $drinver_shenfen_show = '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/icon_driver_both_blue.png"/>';
            $drinver_shenfen_color = 'color:#0788FF;';
            $drinver_shenfen_value = 1;
        }else{
            $drinver_shenfen_show = '';
            $drinver_shenfen_color = '';
            $drinver_shenfen_value = 0;
        }
        
        $address_select = $this->WelModel->getarea_show($volunteer_list[$i]['select_id_23']).' '.$volunteer_list[$i]['input_5'];
        
        if($volunteer_id == $volunteer_list[$i]['form_id']){
            $current_selected = '
                <div style="float:left;width:100%;height:100px;margin-top:-100px;background-color:rgba(0,0,0,0.5);border-radius:4px;">
                    <img style="float:left;width:30px;height:30px;margin:35px 35px;" src="'.base_url().'themes/default/images/icon_gou_white.png"/>
                </div>
            ';
            $checkbox_ischecked = 'checked';
        }else{
            $current_selected = '';
            $checkbox_ischecked = '';
        }
        
        $availabletime_show = $this->WelModel->availabletimetableshow($volunteer_list[$i]);//显示可利用的时间
        
        //获取当前义工或司机正在进行中的case 有多少个
        $havecaseres_num = $this->WelModel->getprocessing_casenum($volunteer_list[$i]['form_id']);
        if($havecaseres_num != 0){
            $havecaseres_num_show = '<div style="float:left;width:20px;height:20px;line-height:20px;border-radius:50%;background:red;color:white;text-align:center;margin-left:5px;">'.$havecaseres_num.'</div>';
        }else{
            $havecaseres_num_show = '<div style="float:left;width:20px;height:20px;line-height:20px;border-radius:50%;background:#EFEFEF;color:gray;text-align:center;margin-left:5px;">'.$havecaseres_num.'</div>';
        }
        
        $onclick_show = ' onclick="choose'.$role_name.'('.$volunteer_list[$i]['form_id'].', \''.base_url().$filename_100x100.'\', \''.$volunteer_list[$i]['input_1'].'\', '.$drinver_shenfen_value.')"';
        
        
//         for($ttt = 0; $ttt < 10; $ttt++){
            echo '
                <div '.$onclick_show.' class="itemlist">
                    <div style="float:left;width:50px;height:100px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                        <input type="radio" name="checkbox_needtochecked" class="mgr mgr-success mgr-lg" value="'.$volunteer_list[$i]['form_id'].'" '.$checkbox_ischecked.'>
                    </div>
                    <div style="float:left;width:100px;height:120px;">
                        <div style="cursor:pointer;float:left;width:100px;margin-left:10px;">
                            <div style="float:left;width:100px;height:100px;border-radius:4px;">
                                <div style="float:left;width:98px;height:98px;border:1px solid #EFEFEF;border-radius:4px;background:url('.base_url().$filename_100x100.') center center / cover no-repeat;">&nbsp;</div>
                            </div>
                            '.$current_selected.'
                        </div>
                        <div style="float:left;width:100%;line-height:20px;font-size:12px;text-align:center;">'.actionsearchdaxiaoxiezimu($popup_keyword, strip_tags($volunteer_list[$i]['input_4'])).'</div>
                    </div>
                    <div style="float:left;width:calc(100% - 50px - 100px - 20px);margin-left:20px;height:120px;">
                        <div style="float:left;width:300px;line-height:20px;text-align:left;font-size:14px;">
                            <div style="float:left;width:100%;height:20px;font-weight:bold;">
                                <div style="float:left;'.$drinver_shenfen_color.'">'.actionsearchdaxiaoxiezimu($popup_keyword, strip_tags($volunteer_list[$i]['input_1'])).' '.$gender_show.' '.$drinver_shenfen_show.'</div>
                                '.$havecaseres_num_show.'
                            </div>                        
                            <div style="float:left;width:100%;height:20px;">
                               <div style="float:left;">'.$age_show.'</div>
                            </div>
                            <div style="float:left;width:100%;height:20px;">
                               <div style="float:left;">'.$text_choose_fearofanimal.'</div><div style="float:left;margin-left:5px;">'.$fearanimal_show.'</div>
                            </div>
                            <div style="float:left;width:100%;height:20px;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;word-break: break-all;">
                               '.$text_choose_address.'：'.$address_select.'
                            </div>
                            <div style="float:left;width:100%;height:20px;">
                                <div style="float:left;margin-right:5px;"><div style="float:left;">'.$text_language_1.'：</div><div style="float:left;">'.$this->WelModel->getlanguage_show_colorful($volunteer_list[$i], 'checkbox_id_2', 'input_2').'</div></div>
                                <div style="float:left;"><div style="float:left;">'.$text_language_2.'：</div><div style="float:left;">'.$this->WelModel->getlanguage_show_colorful($volunteer_list[$i], 'checkbox_id_3', 'input_3').'</div></div>
                            </div>
                        </div>
                        <div style="float:left;width:calc(100% - 300px);line-height:12px;text-align:left;font-size:14px;margin-top:4px;">
                            '.$availabletime_show.'
                        </div>
                    </div>
                </div>
            ';
//         }
    }
}

echo '
    <div style="float:left;width:100%;margin-top:10px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        <div onclick="choose'.$role_name.'(0, \'\', \'\')" style="float:left;line-height:35px;padding:0px 15px;background-color:#E85252;color:white;border-radius:4px;cursor:pointer;font-size:14px;">'.$text_clearhistory.'</div>
    </div>
';
echo '</div>';
?>
</div>