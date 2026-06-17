<?php $this->load->view('header')?>
<style>

</style>
<?php 
if(isset($_COOKIE[DB_PRE().'codeinfo'])){
    $codeinfo = unserialize($_COOKIE[DB_PRE().'codeinfo']);
    $this->code = $codeinfo['code'];
    $this->admin_id = $codeinfo['admin_id'];
    
    //重新续期cookie
    $arr = array('admin_id'=>$codeinfo['admin_id'], 'code'=>$codeinfo['code']);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'codeinfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->code = '';
    $this->admin_id = 0;
}

$agreepurpose_num = 2;
if(isset($_COOKIE[DB_PRE().'agreepurposeinfo_'.$agreepurpose_num])){
    $agreepurposeinfo = unserialize($_COOKIE[DB_PRE().'agreepurposeinfo_'.$agreepurpose_num]);
    $this->agreepurpose = $agreepurposeinfo['agreepurpose_'.$agreepurpose_num];
    
    //重新续期cookie
    $arr = array('agreepurpose_'.$agreepurpose_num=>$agreepurposeinfo['agreepurpose_'.$agreepurpose_num]);
    $arr = serialize($arr);
    $this->input->set_cookie(DB_PRE().'agreepurposeinfo_'.$agreepurpose_num, $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
}else{
    $this->agreepurpose = '';
}
?>

<div style="float:left;width:100%;">
	<div style="width:96%;max-width:1400px;margin:0 auto;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php if($this->code != ''){?>
            	<?php if($this->agreepurpose != ''){?>
                	<div class="formtable_submit">
                        <div class="sectiontitle"><?php if($this->langtype == '_ch'){echo '关怀组家访表格';}else{echo 'Caring Unit Home Visit Form';}?></div>
                        <div class="sectionsummary"><?php if($this->langtype == '_ch'){echo '关怀组家方表格是一种用于记录和管理关怀组成员及其家庭信息的表格。';}else{echo 'The Care Group Family Form is a form used to record and manage information about care group members and their families.';}?></div>
                        
                        <div class="bodycontentarea">
                            <table cellpadding="0">
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '拜访日期 、时间';}else{echo 'Date and time of visit';}?></td>
                                	<td>
                                		<input name="input_1" type="date" id="dateInput" style="float:left;width:170px;line-height:25px;border:0px;"/>
                                	</td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '信众姓名';}else{echo 'Name';}?></td>
                                	<td><input name="input_2" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;"/></td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '性别';}else{echo 'Gender';}?></td>
                                	<td>
                                    	<select style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:80px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                                    		<option value="0"></option>
                                    		<option value="1"><?php if($this->langtype == '_ch'){echo '男';}else{echo 'Male';}?></option>
                                    		<option value="2"><?php if($this->langtype == '_ch'){echo '女';}else{echo 'Female';}?></option>
                                    	</select>
                                	</td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '年龄';}else{echo 'Age';}?></td>
                                	<td>
                                		<select style="float:left;background: url(<?php echo base_url().'themes/default/images/select_arrow.png'?>) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:black;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:120px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;">
                                    		<option value="0"></option>
                                    		<?php for($i = 16; $i <= 110; $i++){?>
                                    		<option value="<?php echo $i?>"><?php echo $i?><?php if($this->langtype == '_ch'){echo '岁';}else{echo ' years old';}?></option>
                                    		<?php }?>
                                    	</select>
                                	</td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '联系方式';}else{echo 'Contact number';}?></td>
                                	<td><input name="input_2" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;"/></td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '家庭地址';}else{echo 'Visiting address';}?></td>
                                	<td><input name="input_3" type="text" style="float:left;width:calc(100% - 6px);" /></td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '拜访主题';}else{echo 'Purpose';}?></td>
                                	<td><textarea name="input_4" style="float:left;width:calc(100% - 6px);height:80px;"></textarea></td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '信众需求';}else{echo 'Needs';}?></td>
                                	<td><textarea name="input_5" style="float:left;width:calc(100% - 6px);height:80px;"></textarea></td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '身心状况';}else{echo 'Physical and mental conditions';}?></td>
                                	<td><textarea name="input_6" style="float:left;width:calc(100% - 6px);height:80px;"></textarea></td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '小组建议';}else{echo 'Recommendations';}?></td>
                                	<td><textarea name="input_7" style="float:left;width:calc(100% - 6px);height:80px;"></textarea></td>
                            	</tr>
                            	<tr>
                                	<td class="tdleftside"><?php if($this->langtype == '_ch'){echo '跟进下一次访问';}else{echo 'To follow up the next visit';}?></td>
                                	<td><textarea name="input_8" style="float:left;width:calc(100% - 6px);height:80px;"></textarea></td>
                            	</tr>
                            </table>
                        </div>
                        
                        <div class="signincontent">
    						<div class="left"><?php if($this->langtype == '_ch'){echo '义工人员';}else{echo 'Volunteer name';}?></div>
    						<div class="right"><input name="input_3" type="text" style="float:left;width:calc(100% - 6px);max-width:200px;border-radius:0px;border:0px;border-bottom:1px solid black;" /></div>
                        </div>
                        
                        
                        <div class="remarkscontent">
    <b><?php if($this->langtype == '_ch'){echo '备注';}else{echo 'Remarks';}?></b>
    <br /><?php if($this->langtype == '_ch'){echo '其他需要注意的事项';}else{echo 'Other things to keep in mind';}?>：
    <br /><?php if($this->langtype == '_ch'){echo '您可以根据具体需求添加或修改以上内容，以确保表格能够全面、准确地记录关怀组成员及其家庭的信息';}else{echo 'You can add or modify the above to ensure that the form provides a comprehensive and accurate record.';}?>
                        </div>
                        <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
                            <div class="btn_form_submit" onclick="tosubmit_form()" style="float:left;background:#DF9C4D;color:white;line-height:50px;padding:0px 50px;border-radius:20px;font-size:20px;"><?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?></div>
                        	<div class="btn_form_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
                        </div>
                    </div>
                <?php }else{?>
                	<?php 
                	    $data['agreepurpose_num'] = $agreepurpose_num;
                		$this->load->view('common_agreetermsandconditions', $data);
            		?>
                <?php }?>
            <?php }else{?>
            	<?php $this->load->view('common_entercode')?>
            <?php }?>
            
            <div class="formtable_result_1" style="display:none;float:left;width:calc(100% - 40px);padding:20px;background:white">
                <div style="float:left;width:100%;line-height:30px;font-size:17px;margin-top:20px;margin-bottom:20px;">
                    Thank you,<br />
                    We look forward to seeing you soon in Singapore!<br />
                    Junhan & Aya
                </div>
                
                <div style="float:left;width:100%;line-height:24px;font-size:17px;margin-top:20px;">
                    For any enquires, feel free to contact us at <a href="tel:6744 7444" style="letter-spacing: 0px;color:red;text-decoration:underline;">6744 7444</a>
                </div>
        	</div>
        	<div class="formtable_result_2" style="display:none;float:left;width:calc(100% - 40px);padding:20px;background:white">
                <div style="float:left;width:100%;line-height:30px;font-size:17px;margin-top:20px;margin-bottom:20px;">
                    Thank you, <br />
    				We look forward to meeting you soon.<br />
    				Junhan & Aya
                </div>
                
                <div style="float:left;width:100%;line-height:24px;font-size:17px;margin-top:20px;">
                    For any enquires, feel free to contact us at <a href="tel:6744 7444" style="letter-spacing: 0px;color:red;text-decoration:underline;">6744 7444</a>
                </div>
        	</div>
    	</div>
    </div>
</div>

<?php $this->load->view('footer')?>