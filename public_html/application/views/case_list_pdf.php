<?php
require_once('lib/tcpdf_6_3_2/config/lang/eng.php');
require_once('lib/tcpdf_6_3_2/tcpdf.php');

class MYPDF extends TCPDF {
    //Page header
    public function Header($project_name=null) {
        //				echo 121212;exit;
        // Set font
        //				$this->SetFont('helvetica', 'B', 16);
        $this->SetFont('stsongstdlight', 'B', 16);
        // Title
        $this->SetY(8);
        $this->Cell_header_l(0, 15, '       1212', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Cell_header_r(0, 15, '       4545', 0, false, 'R', 0, '', 0, false, 'M', 'M');
    }
}

// create new PDF document
// 		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setMypdf_projectname('');
$pdf->setMypdf_username('');

//		$pdf->Header($project_name);
//set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle(' ');
$pdf->SetSubject('');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default header data
//		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' project', PDF_HEADER_STRING);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', PDF_HEADER_STRING);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', '16'));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetPrintHeader(false);//显示页眉
$pdf->SetPrintFooter(false);//隐藏页脚

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
//		$pdf->SetFont('helvetica', '', 10);
$pdf->SetFont('stsongstdlight', '', 10);
// add a page


$weekarray = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日');

$plist_str = '';

//选择数据--开始
    
    
    
//     $pdf->setMypdf_qrcode_pic($scan_onlyone_qrcode);
        
        
    $pdf->AddPage();
    
    if($this->langtype == '_ch'){
        $text_xuhao = '序号';
        $text_enrolment = '关怀者';
        $text_yigong = '义工';
        $text_driver = '司机';
        $text_nexttime = '下次家访日期';
    }else{
        $text_xuhao = 'SN';
        $text_enrolment = 'Enrolment';
        $text_yigong = 'Volunteer';
        $text_driver = 'Driver';
        $text_nexttime = 'Next Time';
    }
    
    $thistablist_one = '';
    for($qqq = 0; $qqq < count($recordlist); $qqq++){
        if($qqq == 0){
            $listcssborder = 'border-top:1px solid #DDDDDD;';
        }else{
            $listcssborder = '';
        }
        
        if(($qqq % 2) == 0){
            $listcssbg = 'background-color:#F9F9F9;';
        }else{
            $listcssbg = 'background-color:white;';
        }
        
        if($recordlist[$qqq]['datetime_last_duan'] == 1){
            if($this->langtype == '_ch'){$duan_name = '上午';}else{$duan_name = 'AM';}
        }else{
            if($this->langtype == '_ch'){$duan_name = '下午';}else{$duan_name = 'PM';}
        }
        
        if($this->langtype == '_ch'){
            $text_currenthealth = '当前健康';
            $text_currenthealth_good = '良好';
            $text_currenthealth_normal = '正常';
            $text_currenthealth_poor = '状况不佳';
            $text_currenthealth_bedbound = '卧床不起';
        }else{
            $text_currenthealth = 'Current Health';
            $text_currenthealth_good = 'Good';
            $text_currenthealth_normal = 'Normal';
            $text_currenthealth_poor = 'Poor/Weak';
            $text_currenthealth_bedbound = 'Bed Bound';
        }
            
        if($this->langtype == '_ch'){
            $text_yearsold = '年龄: '.$recordlist[$qqq]['select_id_2'].'岁';
        }else{
            $text_yearsold = 'Age: '.$recordlist[$qqq]['select_id_2'].'years old';
        }
        if($this->langtype == '_ch'){
            $text_language_show = '语言: '.$this->WelModel->getlanguage_show($recordlist[$qqq], 'checkbox_id_2', 'input_3');
        }else{
            $text_language_show = 'Language: '.$this->WelModel->getlanguage_show($recordlist[$qqq], 'checkbox_id_2', 'input_3');
        }
        if($recordlist[$qqq]['assign_memo'] != ''){
            $text_language_show .= '<br /><b>'.$recordlist[$qqq]['assign_memo'].'</b>';
        }
        
        
        $followupwidthmethod_show = '';
        $section_name = "checkbox_id_1";
        $valuelist = array();
        $valuelist[] = array('value_id'=>1, 'value_name_en'=>'Home visit to provide Buddhism emotional support', 'value_name_ch'=>'家访 提供佛教情感支持');
        $valuelist[] = array('value_id'=>2, 'value_name_en'=>'Home visits include prayer assistance (10 to 30 minutes) and a referral to a contact person to assist with Buddhist funeral rites', 'value_name_ch'=>'家访包括提供助念（10 到 30 分钟） 以及介绍联络人提供佛教葬礼仪式的协助');
        $valuelist[] = array('value_id'=>3, 'value_name_en'=>'Phone Follow Up', 'value_name_ch'=>'电话慰问');
        $valuelist[] = array('value_id'=>4, 'value_name_en'=>'No Follow Up Required', 'value_name_ch'=>'无需跟进');
        if(!empty($valuelist)){for ($v = 0; $v < count($valuelist); $v++) {
            $ischecked = 0;
            for($ccc = 1; $ccc <= 10; $ccc++){
                if($recordlist[$qqq][$section_name.'_'.$ccc.'_last'] == $valuelist[$v]['value_id']){
                    $ischecked = 1;
                }
            }
            if($ischecked == 1){
                $followupwidthmethod_show .= $valuelist[$v]['value_name'.$this->langtype];
            }
        }}
        
        if($recordlist[$qqq]['datetime_last'] > time()){
            $have_days = ceil(($recordlist[$qqq]['datetime_last'] - time()) / 86400);
            if(($recordlist[$qqq]['datetime_last'] - 86400*3) > time()){
                $nextdate_show = '<span style="color:green;font-weight:bold;">'.date('d/m/Y', $recordlist[$qqq]['datetime_last']).' '.$duan_name.'</span>';
            }else{
                $nextdate_show = '<span style="color:orange;font-weight:bold;">'.date('d/m/Y', $recordlist[$qqq]['datetime_last']).' '.$duan_name.'</span>';
            }
        }else{
            $have_days = ceil((time() - $recordlist[$qqq]['datetime_last']) / 86400);
            $nextdate_show = '<span style="color:red;font-weight:bold;">'.date('d/m/Y', $recordlist[$qqq]['datetime_last']).' '.$duan_name.'</span>';
        }
        
        if($recordlist[$qqq]['health_id_last'] == 1){
            $health_id_last_show = ''.$text_currenthealth.': <span style="color:green;">'.$text_currenthealth_good.'</span>';
		}else if($recordlist[$qqq]['health_id_last'] == 2){
		    $health_id_last_show = ''.$text_currenthealth.': <span style="color:#337ab7;">'.$text_currenthealth_normal.'</span>';
		}else if($recordlist[$qqq]['health_id_last'] == 3){
			$health_id_last_show = ''.$text_currenthealth.': <span style="color:#f0ad4e;">'.$text_currenthealth_poor.'</span>';
		}else if($recordlist[$qqq]['health_id_last'] == 4){
			$health_id_last_show = ''.$text_currenthealth.': <span style="color:#cf3b3a;">'.$text_currenthealth_bedbound.'</span>';
		}else{
		    $health_id_last_show = '';
		}
		
		
        
        //义工
        $yigonglist = '<table>';
        if($recordlist[$qqq]['volunteer_1_name'] != '' || $recordlist[$qqq]['volunteer_2_name'] != '' || $recordlist[$qqq]['volunteer_3_name'] != '' || $recordlist[$qqq]['volunteer_4_name'] != '' || $recordlist[$qqq]['volunteer_5_name'] != '' || $recordlist[$qqq]['volunteer_6_name'] != ''){
            if($recordlist[$qqq]['volunteer_1_name'] != ''){
                $yigonglist .= '<tr>';
                if($recordlist[$qqq]['volunteer_1_pic_1_path'] != '' && file_exists($recordlist[$qqq]['volunteer_1_pic_1_path'])){
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().$recordlist[$qqq]['volunteer_1_pic_1_path'].'?datetime='.time().'"/></td>';
                }else{
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().'themes/default/images/default_avatar_gray.png"/></td>';
                }
                $yigonglist .= '<td>'.$recordlist[$qqq]['volunteer_1_name'].'</td>';
                $yigonglist .= '</tr>';
            }
            if($recordlist[$qqq]['volunteer_2_name'] != ''){
                $yigonglist .= '<tr>';
                if($recordlist[$qqq]['volunteer_2_pic_1_path'] != '' && file_exists($recordlist[$qqq]['volunteer_2_pic_1_path'])){
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().$recordlist[$qqq]['volunteer_2_pic_1_path'].'?datetime='.time().'"/></td>';
                }else{
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().'themes/default/images/default_avatar_gray.png"/></td>';
                }
                $yigonglist .= '<td>'.$recordlist[$qqq]['volunteer_2_name'].'</td>';
                $yigonglist .= '</tr>';
            }
            if($recordlist[$qqq]['volunteer_3_name'] != ''){
                $yigonglist .= '<tr>';
                if($recordlist[$qqq]['volunteer_3_pic_1_path'] != '' && file_exists($recordlist[$qqq]['volunteer_3_pic_1_path'])){
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().$recordlist[$qqq]['volunteer_3_pic_1_path'].'?datetime='.time().'"/></td>';
                }else{
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().'themes/default/images/default_avatar_gray.png"/></td>';
                }
                $yigonglist .= '<td>'.$recordlist[$qqq]['volunteer_3_name'].'</td>';
                $yigonglist .= '</tr>';
            }
            if($recordlist[$qqq]['volunteer_4_name'] != ''){
                $yigonglist .= '<tr>';
                if($recordlist[$qqq]['volunteer_4_pic_1_path'] != '' && file_exists($recordlist[$qqq]['volunteer_4_pic_1_path'])){
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().$recordlist[$qqq]['volunteer_4_pic_1_path'].'?datetime='.time().'"/></td>';
                }else{
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().'themes/default/images/default_avatar_gray.png"/></td>';
                }
                $yigonglist .= '<td>'.$recordlist[$qqq]['volunteer_4_name'].'</td>';
                $yigonglist .= '</tr>';
            }
            if($recordlist[$qqq]['volunteer_5_name'] != ''){
                $yigonglist .= '<tr>';
                if($recordlist[$qqq]['volunteer_5_pic_1_path'] != '' && file_exists($recordlist[$qqq]['volunteer_5_pic_1_path'])){
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().$recordlist[$qqq]['volunteer_5_pic_1_path'].'?datetime='.time().'"/></td>';
                }else{
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().'themes/default/images/default_avatar_gray.png"/></td>';
                }
                $yigonglist .= '<td>'.$recordlist[$qqq]['volunteer_5_name'].'</td>';
                $yigonglist .= '</tr>';
            }
            if($recordlist[$qqq]['volunteer_6_name'] != ''){
                $yigonglist .= '<tr>';
                if($recordlist[$qqq]['volunteer_6_pic_1_path'] != '' && file_exists($recordlist[$qqq]['volunteer_6_pic_1_path'])){
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().$recordlist[$qqq]['volunteer_6_pic_1_path'].'?datetime='.time().'"/></td>';
                }else{
                    $yigonglist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().'themes/default/images/default_avatar_gray.png"/></td>';
                }
                $yigonglist .= '<td>'.$recordlist[$qqq]['volunteer_6_name'].'</td>';
                $yigonglist .= '</tr>';
            }
		}else{
		    $yigonglist .= '<tr>';
		    $yigonglist .= '<td></td>';
		    $yigonglist .= '</tr>';
		}
		$yigonglist .= '</table>';
		
		
		
		//司机
		$sijilist = '<table>';
		if($recordlist[$qqq]['driver_name'] != ''){
		    if($recordlist[$qqq]['driver_name'] != ''){
		        $sijilist .= '<tr>';
		        if($recordlist[$qqq]['driver_pic_1_path'] != '' && file_exists($recordlist[$qqq]['driver_pic_1_path'])){
		            $sijilist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().$recordlist[$qqq]['driver_pic_1_path'].'?datetime='.time().'"/></td>';
		        }else{
		            $sijilist .= '<td width="20"><img style="width:15px;height:15px;border-radius:50%;" src="'.base_url().'themes/default/images/default_avatar_gray.png"/></td>';
		        }
		        $sijilist .= '<td>'.$recordlist[$qqq]['driver_name'].'</td>';
		        $sijilist .= '</tr>';
		    }
		}else{
		    $sijilist .= '<tr>';
		    $sijilist .= '<td></td>';
		    $sijilist .= '</tr>';
		}
		$sijilist .= '</table>';
        
        $thistablist_one .= '
            <tr><td colspan="5" style="'.$listcssbg.'line-height:5px;'.$listcssborder.'">&nbsp;</td></tr>
            <tr>
                <td align="center" style="'.$listcssbg.'">'.($qqq + 1).'</td>
                <td align="left" style="'.$listcssbg.'"><span style="font-weight:bold;">'.str_replace('ABSSP', 'ABSSC', $recordlist[$qqq]['form_number']).' - '.$recordlist[$qqq]['input_1'].'</span><br />家访地址：<span style="font-weight:normal;">'.$this->WelModel->getarea_show($recordlist[$qqq]['select_id_23']).' '.$recordlist[$qqq]['input_5'].'</span><br />'.$health_id_last_show.'<br />'.$text_yearsold.'<br />'.$followupwidthmethod_show.'<br />'.$text_language_show.'</td>
                <td align="center" style="'.$listcssbg.'">'.$yigonglist.'</td>
                <td align="center" style="'.$listcssbg.'">'.$sijilist.'</td>
                <td align="center" style="'.$listcssbg.'">'.$nextdate_show.'</td>
            </tr>
            <tr><td colspan="5" style="'.$listcssbg.'line-height:5px;border-bottom:1px solid #DDDDDD;">&nbsp;</td></tr>
        ';
    }
    
//     <tr><td colspan="2" style="line-height:0.5px;"></td></tr>
//     <tr>
//     <td width="100" align="left" style="font-size:13px;font-weight:bold;">订单日期 / Date</td>
//     <td align="left" style="font-size:13px;">顶顶顶顶</td>
//     </tr>
    $plist_str = '
                <table style="float:left;">
                    <tr>
                        <td width="90" align="left" style="font-size:13px;font-weight:bold;"></td>
                        <td width="400" align="left" style="font-size:13px;"></td>
                        <td width="80" height="80" align="left"><img style="width:80px;height:80px;" src="'.base_url().'themes/default/images/logo_1.png"/></td>
                    </tr>

                    <tr><td colspan="5" style="line-height:8px;">&nbsp;</td></tr>

                    <tr><td width="566" colspan="5" style="border-top:2px solid black;line-height:10px;">&nbsp;</td></tr>
                    <tr>
                        <td width="40" align="center" style="font-weight:bold;font-size:13px;">'.$text_xuhao.'</td>
                        <td width="236" align="left" style="font-weight:bold;font-size:13px;">'.$text_enrolment.'</td>
                        <td width="95" align="center" style="font-weight:bold;font-size:13px;">'.$text_yigong.'</td>
                        <td width="95" align="center" style="font-weight:bold;font-size:13px;">'.$text_driver.'</td>
                        <td width="110" align="center" style="font-weight:bold;font-size:13px;">'.$text_nexttime.'</td>
                    </tr>
                    <tr><td colspan="5" style="line-height:10px;">&nbsp;</td></tr>
                    '.$thistablist_one.'
                            

                    
                    <tr><td colspan="5" style="line-height:2px;"></td></tr>
                            
                            
                            
                </table>
            ';
    
    
    
    
    
    // define some HTML content with style
    $html = <<<EOF
		<!-- EXAMPLE OF CSS STYLE -->
		<style>
		
		</style>
		$plist_str
		    
EOF;
    // output the HTML content
    
    $pdf->writeHTML($html, true, false, true, false, '');
    
    
//选择数据--结束




$pdf->lastPage ();


$download_path = date('Y_m_d_H_i_s').'.pdf';
// $pdf->Output ( $download_path, 'FD' );//保存到本地
		$pdf->Output ( $download_path, 'D' );//下载
// $pdf->Output ( $download_path, 'I' );//直接预览
//============================================================+
// END OF FILE
//============================================================+


?>
