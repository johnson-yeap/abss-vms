<div style="float:left;width:calc(100% - 40px);padding:20px 20px 100px 20px;background:white;">
    <div style="float:left;width:calc(100% - 40px);padding:20px 20px;line-height:30px;font-size:17px;margin-top:20px;border-radius:6px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
        <div style="float:left;width:290px;">
        	<div style="float:left;width:100%;margin-top:10px;">
            	<div style="float:left;width:90px;line-height:17px;margin-top:10px;margin-bottom:6px;">
                    <?php if($this->langtype == '_ch'){echo '邮箱';}else{echo 'Email';}?>
                </div>
                <div style="float:left;width:200px;">
                    <div style="float:left;width:100%;"><input name="email" type="text" style="width:200px;" value=""/></div>
            		<div class="email_error" style="display:none;float:left;width:100%;line-height:20px;margin-top:5px;margin-bottom:5px;font-size:17px;margin-top:10px;color:red;text-align:center;">
                      <?php if($this->langtype == '_ch'){echo '邮箱不能为空';}else{echo 'Email cannot be empty';}?>
                    </div>
            	</div>
            </div>
            <div style="float:left;width:100%;margin-top:10px;">
            	<div style="float:left;width:90px;line-height:17px;margin-top:10px;margin-bottom:6px;">
                    <?php if($this->langtype == '_ch'){echo '密码';}else{echo 'Password';}?>
                </div>
                <div style="float:left;width:200px;">
                    <div style="float:left;width:100%;"><input name="password" type="password" style="width:200px;" value=""/></div>
            		<div class="password_error" style="display:none;float:left;width:100%;line-height:20px;margin-top:5px;margin-bottom:5px;font-size:17px;margin-top:10px;color:red;text-align:center;">
                      <?php if($this->langtype == '_ch'){echo '密码不能为空';}else{echo 'Password cannot be empty';}?>
                    </div>
                    <div class="emailorpassword_cuowu" style="display:none;float:left;width:100%;line-height:20px;margin-top:5px;margin-bottom:5px;font-size:17px;margin-top:10px;color:red;text-align:center;">
                       <?php if($this->langtype == '_ch'){echo '邮箱或密码错误';}else{echo 'Email or Password error';}?>
                    </div>
            	</div>
            </div>
            <?php
                $hash = base64_encode(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVXYZ'), 0, 4));
            ?>
            <div style="float:left;width:100%;margin-top:20px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <div style="float:left;width:250px;background:white;border:1px solid black;padding:10px 10px;border-radius:4px;">
                	<div style="float:left;width:100%;font-weight:bold;">
                    	Security Check
                    </div>
                    <div style="float:left;width:100%;">
                    	Enter words below
                    </div>
                    <div style="float:left;width:140px;height:40px;">
                    	<div class="captchha_img_area" style="float:left;width:100%;cursor:pointer;">
                        	<img class="captchha_img" onclick="torefresh_captchha()" src="<?php echo base_url()?>lib/captcha.php?hash=<?php echo $hash; ?>" alt="image verification">
                        	<input type="hidden" id="captchha_hash" name="captchha_hash" value="<?php echo $hash; ?>">
                        	&nbsp;
                    	</div>
                    	<div class="captchha_loading_area" style="display:none;float:left;width:calc(100% - 2px);height:38px;border:1px solid #CCC;">
                        	<img style="cursor:pointer;float:left;width:26px;height:26px;margin-top:6px;margin-left:calc(50% - 13px);" src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>">
                    	</div>
                    </div>
                    <div style="float:left;width:100px;margin-left:10px;margin-top:0px;">
                    	<div style="float:left;width:100%;"><input name="captcha_code" type="text" style="width:100px;line-height:19px;" value="" /></div>
            		</div>
        		</div>
        		<script>
					function torefresh_captchha(){
						$('.captchha_img_area').hide();
						$('.captchha_loading_area').show();
						var postOBJ = new Object();
						postOBJ.canshu = 1;
						$.post(baseurl+'welcome/torefresh_captchha', postOBJ, function (data){
							$('.captchha_img_area').html(data);

							$('.captchha_img_area').show();
							$('.captchha_loading_area').hide();
						})
					}
        		</script>
        	</div>
        	<div class="captcha_code_error" style="display:none;float:left;width:100%;">
                <div style="float:left;width:100%;margin-top:10px;display: flex;flex-direction: row;justify-content: center;align-items: center;">
                    <div style="float:left;color:red;">
                    	CAPTCHA code cannot be empty
                    </div>
            	</div>
        	</div>
        	<div class="captcha_code_cuowu" style="display:none;float:left;width:100%;line-height:20px;margin-top:5px;margin-bottom:5px;font-size:17px;margin-top:10px;color:red;text-align:center;">
               <?php if($this->langtype == '_ch'){echo '验证码错误';}else{echo 'CAPTCHA code error';}?>
            </div>
        </div>
    </div>
    <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;line-height:40px;font-size:17px;margin-top:20px;">
        <div class="btn_form_submit" onclick="tosubmit_form()" style="float:left;background:#DF9C4D;color:white;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '登录';}else{echo 'Login';}?></div>
    	<div class="btn_form_loading" style="display:none;float:left;background:#EFEFEF;color:gray;line-height:40px;padding:0px 40px;border-radius:20px;"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
    </div>
</div>

<script type="text/javascript">
function tosubmit_form(){
	var isNull = /^[\s' ']*$/;
	var ispass = 1;
	var email = $('input[name="email"]').val();
	var password = $('input[name="password"]').val();
	var captcha_code = $('input[name="captcha_code"]').val();
	var captchha_hash = $('input[name="captchha_hash"]').val();

	if(isNull.test(email)){ispass = 0;$('.email_error').show();}else{$('.email_error').hide();}
	if(isNull.test(password)){ispass = 0;$('.password_error').show();}else{$('.password_error').hide();}
	if(isNull.test(captcha_code)){ispass = 0;$('.captcha_code_error').show();}else{$('.captcha_code_error').hide();}
	
	$('.emailorpassword_cuowu').hide();
	$('.captcha_code_cuowu').hide();
	
	if(ispass == 1){
		$('.btn_form_submit').hide();
		$('.btn_form_loading').show();

		var postOBJ = new Object();
		postOBJ.email = email;
		postOBJ.password = password;
		postOBJ.captcha_code = captcha_code;
		postOBJ.captchha_hash = captchha_hash;
		$.post('<?php echo base_url().'index.php/welcome/login_volunteer'?>', postOBJ, function (data){
// 			alert(data);
			if(data == 'yes'){
				$('.emailorpassword_cuowu').hide();
				location.reload();
			}else if(data == 'error_captcha'){
				$('.captcha_code_cuowu').show();
				
				$('.btn_form_submit').show();
				$('.btn_form_loading').hide();
			}else{
				$('.emailorpassword_cuowu').show();
				
				$('.btn_form_submit').show();
				$('.btn_form_loading').hide();
			}
		})
	}
}
</script>