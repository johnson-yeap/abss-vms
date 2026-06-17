<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Volunteer extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$lang = $this->session->userdata('lang');
		if($lang == 'ch'){
		    $this->session->set_userdata('lang', 'ch');
		    $this->langtype = '_ch';
		}else{
		    $this->session->set_userdata('lang', 'en');
		    $this->langtype = '_en';
		}
	}
	//进行中的案例
	function index(){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $this->load->view('volunteer_home', $data);
	}
	function case_complete(){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $this->load->view('volunteer_case_complete', $data);
	}
	function case_closed(){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $this->load->view('volunteer_case_closed', $data);
	}
	
	function homevisit_record_list($enrolmentform_id){
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
	    
	    $this->load->view('volunteer_record_homevisit_list', $data);
	}
	
	function formtable_record_edit($form_type, $enrolmentform_id, $form_id){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
	    
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $this->load->view('volunteer_record_edit', $data);
	}
	
	function todownload_case($statusname){
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
	    $form_id_str = $this->input->get('form_id_str');
// 	    if($statusname == 'closed'){
// 	        $subsql = " AND a.is_closed = 1";
// 	    }else if($statusname == 'complete'){
// 	        $subsql = " AND a.is_closed = 0 AND a.is_finished = 1";
// 	    }else if($statusname == 'success'){
// 	        $subsql = " AND a.is_closed = 0 AND a.is_assigned = 1 AND a.is_finished = 0";
// 	    }else{
	        $subsql = "";
// 	    }
	    
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
                
            WHERE a.form_type = 'enrolmentform' ".$subsql." AND a.status = 1
            AND
            (
                (a.volunteer_1_id = ".$this->volunteer_id.")
                OR (a.volunteer_2_id = ".$this->volunteer_id.")
                OR (a.volunteer_3_id = ".$this->volunteer_id.")
                OR (a.volunteer_4_id = ".$this->volunteer_id.")
                OR (a.volunteer_5_id = ".$this->volunteer_id.")
                OR (a.volunteer_6_id = ".$this->volunteer_id.")
                OR (a.driver_id = ".$this->volunteer_id.")
            )
            AND a.form_id IN (".$form_id_str.")
            ORDER BY a.form_id DESC
        ";
	    $recordlist = $this->db->query($sql)->result_array();
	    $data['recordlist'] = $recordlist;
	    
	    $recordinfo = $this->WelModel->getrecordinfo($this->volunteer_id);//获取记录详细
	    if($recordinfo['select_id_6'] == 1){
	        if($this->langtype == '_ch'){$role_name = '关怀义工';}else{$role_name = 'Caring Volunteer';}
	    }else if($recordinfo['select_id_6'] == 2){
	        if($this->langtype == '_ch'){$role_name = '关怀司机';}else{$role_name = 'Caring Driver';}
	    }else if($recordinfo['select_id_6'] == 3){
	        if($this->langtype == '_ch'){$role_name = '司机和关怀义工';}else{$role_name = 'Caring Volunteer and Driver';}
	    }else{
	        $role_name = '';
	    }
	    $data['recordinfo'] = $recordinfo;
	    $data['role_name'] = $role_name;
	    
	    $this->load->view('volunteer_case_list_pdf', $data);
	}
	
	function logout() {
	    $this->load->helper('cookie');
	    delete_cookie(DB_PRE().'volunteerinfo');
	    redirect(base_url().'volunteer');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */