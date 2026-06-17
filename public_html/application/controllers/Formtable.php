<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Formtable extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){
            $this->session->set_userdata('lang', 'ch');
            $this->langtype = '_ch';
        }else{
            $this->session->set_userdata('lang', 'en');
            $this->langtype = '_en';
        }
    }
    function homevisit(){
        if($this->langtype == '_ch'){
            $data['website_title'] = '关怀组家访表格';
            $data['website_description'] = '关怀组家方表格是一种用于记录和管理关怀组成员及其家庭信息的表格。';
        }else{
            $data['website_title'] = 'Caring Unit Home Visit Form';
            $data['website_description'] = 'The Care Group Family Form is a form used to record and manage information about care group members and their families.';
        }
        $data['form_type'] = 'homevisit';
        
        $this->load->view('formtable_homevisit', $data);
    }
    function homevisit_1st($enrolmentform_id = 0){
        if($this->langtype == '_ch'){
            $data['website_title'] = '关怀组家访表格 （初次）';
            $data['website_description'] = '关怀组家方表格是一种用于记录和管理关怀组成员及其家庭信息的表格。';
        }else{
            $data['website_title'] = 'Caring Unit Home Visit Form (1st visit)';
            $data['website_description'] = 'The Care Group Family Form is a form used to record and manage information about care group members and their families.';
        }
        $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
        
        $data['form_type'] = 'homevisit_1st';
        
        $this->load->view('formtable_homevisit_1st', $data);
    }
    function homevisit_followupvisit($enrolmentform_id = 0){
        if($this->langtype == '_ch'){
            $data['website_title'] = '家访跟进表';
            $data['website_description'] = '';
        }else{
            $data['website_title'] = 'Home Visit Form (follow up visit)';
            $data['website_description'] = '';
        }
        $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
        
        $data['form_type'] = 'homevisit_followupvisit';
        
        $this->load->view('formtable_homevisit_followupvisit', $data);
    }
    
    function enrolmentform(){
        if($this->langtype == '_ch'){
            $data['website_title'] = '接受关怀登记表';
            $data['website_description'] = '';
        }else{
            $data['website_title'] = 'Caring Form';
            $data['website_description'] = '';
        }
        $data['form_type'] = 'enrolmentform';
        $this->load->view('formtable_enrolmentform', $data);
    }
    
    function applyformforvolunteers(){
        if($this->langtype == '_ch'){
            $data['website_title'] = '关怀义工申请表格';
            $data['website_description'] = '';
        }else{
            $data['website_title'] = 'Caring Volunteer Application Form';
            $data['website_description'] = '';
        }
        $data['form_type'] = 'applyformforvolunteers';
        $this->load->view('formtable_applyformforvolunteers', $data);
    }
    

}