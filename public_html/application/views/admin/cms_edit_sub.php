<?php $this->load->view('admin/common_header')?>
<?php $lancodelist = getlancodelist();?>


<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/lang/zh-cn/zh-cn.js"></script>
<!--以下两行加载秀米的ueditor插件的脚本和CSS，请编辑您的UEditor网页加入他们-->
<!--您也可以下载这两个文件并根据您的需要改动相关的内容，当然，改动后您必须将新文件存放到您的服务器上了-->
<!--
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/xiumi-ue-dialog-v5.js"></script>
<link rel="stylesheet" href="https://xiumi.us/connect/ue/v5/xiumi-ue-v5.css">
-->
<style type="text/css">
	.logo40{vertical-align: middle;}
	.tn-footer{font-size: 0.9em;}
	html, body{font-size:12px;}
</style>

<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td colspan="2" style="padding-top:10px;">
    			<span onclick="javascript:location.href='<?php echo base_url().'admins/cms/index?group_id='.$group_id;?>';" style="cursor:pointer;float:left;width:100px;text-align:center;font-size:15px;background:#DF9C4D;color:white;padding:10px 0px;border:0px;border-radius:20px;">返回</span>
			</td>
		</tr>
			<?php if($group_id == 207){?>
				<tr>
					<td align="right">
					<?php 
    					if($group_id == 207){
    					    if($this->langtype == '_ch'){echo '头像';}else{echo 'Avatar';}
    					}else{
    					    if($this->langtype == '_ch'){echo '图片';}else{echo 'Picture';}
    					}
					?>
					</td>
					<td>
		    			<?php
    		    			if($group_id == 207){
    		    			    $picturelist = array();
    		    			    $pic_maxnum = 1;//最大上传数量
    		    			    for ($ppp = 0; $ppp < $pic_maxnum; $ppp++) {
    		    			        $uploadFile1 = $cmsinfo['cms_pic_'.($ppp + 1).'_path'];
    		    			        if($uploadFile1 != '' && file_exists($uploadFile1)){
    		    			            $picturelist[] = array('uploadfile_path'=>$uploadFile1, 'uploadfile_name'=>$cmsinfo['cms_pic_'.($ppp + 1).'_name']);
    		    			        }
    		    			    }
    		    			    $data['upload_init_path'] = 'cms';
    		    			    $data['upload_init_type'] = 1;//1: 单选 2：多选
    		    			    if($cmsinfo['parent'] == 4849){
        		    			    $data['upload_size_tips'] = '800px * 560px';
        		    			    $data['upload_show_width'] = 200;
        		    			    $data['upload_show_height'] = 140;
    		    			    }else{
    		    			        $data['upload_size_tips'] = '800px * 800px';
    		    			        $data['upload_show_width'] = 200;
    		    			        $data['upload_show_height'] = 200;
    		    			    }
    		    			    $data['upload_format'] = 'jpg, png, gif';
    		    			    $data['picturelist'] = $picturelist;
    		    			    $data['fujiangroup_name'] = 'linshi_pic_1';
    		    			    $this->load->view('admin/user_normal_upfile_mul', $data);
    		    			}
    		    		?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
					</td>
				</tr>
		<?php }?>
		
			
		<tr style="display:none;">
			<td align="right"><?php if($this->langtype == '_ch'){echo '图片 2';}else{echo 'Picture 2';}?></td>
			<td>
    			<?php
    			    $picturelist = array();
    			    $uploadFile1 = $cmsinfo['cms_pic2_1_path'];
    			    if($uploadFile1 != '' && file_exists($uploadFile1)){
    			        $picturelist[] = array('uploadfile_path'=>$uploadFile1, 'uploadfile_name'=>$cmsinfo['cms_pic2_1_name']);
    			    }
    			    $data['upload_init_path'] = 'cms';
    			    $data['upload_init_type'] = 1;//1: 单选 2：多选
    			    $data['upload_size_tips'] = '2000px * 1070px';
    			    $data['upload_show_width'] = 200;
    			    $data['upload_show_height'] = 107;
    			    $data['upload_format'] = 'jpg, png, gif';
    			    $data['picturelist'] = $picturelist;
    			    $data['fujiangroup_name'] = 'linshi_pic_2';
    			    $this->load->view('admin/user_normal_upfile_mul', $data);
    		    ?>
			</td>
		</tr>
		<tr style="display:none;">
			<td colspan="2">
				<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			</td>
		</tr>
			
		<tr style="display:none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '网址';}else{echo 'URL';}?></td>
			<td align="left">
				<div style="float:left;line-height:28px;">
					<?php 
// 					echo base_url().''.$this->reland.'/alumni/stories/';
					?>
				</div>
				<div style="float:left;margin-left:2px;"><input type="text" id="short_url" name="short_url" onkeyup="this.value=this.value.replace(/[^a-z0-9-]/g,'');" style="width:350px;" value="<?php echo $cmsinfo['short_url']?>"/></div></div></div>
				<?php 
				    $sql = "SELECT * FROM ".DB_PRE()."cms_list WHERE group_id = ".$group_id." AND short_url = '".$cmsinfo['short_url']."' AND cms_id != ".$cmsinfo['cms_id'];
    				$checkres = $this->db->query($sql)->row_array();
    				if(!empty($checkres)){
    				    echo '<div class="short_url_check" style="float:left;line-height:28px;margin-left:8px;"><img style="float:left;width:18px;height:18px;margin-top:5px;" src="'.base_url().'themes/default/images/global_no.png"/></div>';
    				}else{
    				    echo '<div class="short_url_check" style="float:left;line-height:28px;margin-left:8px;"><img style="float:left;width:18px;height:18px;margin-top:5px;" src="'.base_url().'themes/default/images/global_ok.png"/></div>';
    				}
				?>
				
				<script>
        			$(document).ready(function(){
        				window.onload = function() {
            			    //粘贴监听，删除剪切板的空格后进行粘贴
            			    function paste_text(e) {
//             			        debugger;
            			        if ( e.clipboardData.items ) {
            			            ele = e.clipboardData.items
            			            //判断剪切板内复制的是文本
//             			            alert("type:"+ele[0].type+",kind:"+ele[0].kind);
            			            if(ele[0].type=='text/plain' && ele[0].kind=='string'){
            			                var text = e.clipboardData.getData('Text');
            			                text = text.toLowerCase();//大写转为小写
            			                text = text.trim();
            			                text = text.trim();
            			                text = text.trim();
            			                text = text.trim();
            			                text = text.trim();

            			                for(var aaa = 0; aaa < 30; aaa++){
            			                	text = text.replace(' ', '-');
    										text = text.replace('_', '-');
    										text = text.replace('/', '-');
    										text = text.replace("'", '-');
    										text = text.replace('"', '-');
    										text = text.replace('(', '');
    										text = text.replace(')', '');
    										text = text.replace('（', '');
    										text = text.replace('）', '');
                			            }

										text = text.replace('------', '-');
										text = text.replace('-----', '-');
										text = text.replace('----', '-');
										text = text.replace('---', '-');
										text = text.replace('--', '-');

            			                document.getElementById('short_url').value = text;

            			                $('input[name="short_url"]').hover();

            			                checkavailable_shorturl(text);
            			            }
            			        } else {
//             			            alert('non-chrome');
            			        }
            			    }
            			    document.getElementById('short_url').onpaste=function(){paste_text(event);return false;};
        			    }
        				/**
                         * @param flag: 用于标记是否是非直接的文字输入
     					* 即时搜索：对于ios自带输入法输入中文时多次触发input事件的处理
                         */
    					var flag = false;
        				$('input[name="short_url"]').on({
                            'compositionstart': function() {
                              flag = true;
                            },
                            'compositionend': function() {
                              flag = false;
                              if(!flag) {
                                //do something...
                            	  var short_url = $('input[name="short_url"]').val();
                            	  checkavailable_shorturl(short_url);
                              }
                            },
                            'input propertychange': function() {
                                if(!flag) {
                                  //do something...
                                	var short_url = $('input[name="short_url"]').val();
                                	checkavailable_shorturl(short_url);
                                }
                            }
        				})
        			})
        			//检查短网址是否可用
        			var taskpost = '';
        			function checkavailable_shorturl(short_url){
        				if(taskpost != ''){
        					taskpost.abort();
        				}
        				if(short_url != ''){
        					$('input[name="short_url"]').next().find('.requestbox').remove();
            			}else{
            				$('input[name="short_url"]').next().remove();
            				$('input[name="short_url"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '短网址';}else{echo 'Short Url';}?>'+L['cy_error_empty']));
                		}
        				if(short_url != ''){
        					$('.short_url_check').html('<img style="float:left;width:18px;height:18px;margin-top:5px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/>');
    						taskpost = $.post(baseurl+'index.php/admins/cms/checkavailable_shorturl/<?php echo $group_id?>/'+short_url+'/<?php echo $cmsinfo['cms_id']?>', function (data){
    							if(data == 1){
    								$('.short_url_check').html('<img style="float:left;width:18px;height:18px;margin-top:5px;" src="'+baseurl+'themes/default/images/global_ok.png"/>');
    							}else{
    								$('.short_url_check').html('<img style="float:left;width:18px;height:18px;margin-top:5px;" src="'+baseurl+'themes/default/images/global_no.png"/>');
    							}
    						})
            			}else{
            				$('.short_url_check').html('<img style="float:left;width:18px;height:18px;margin-top:5px;" src="'+baseurl+'themes/default/images/global_no.png"/>');
                		}
	            	}
    			</script>
			</td>
		</tr>
		<tr style="display:none;">
			<td colspan="2">
				<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<style>
		          .langcheckarea{display:none;float:left;width:100%;}
		          .langcheckarea .langcheck{cursor:pointer;float:left;width:80px;text-align:center;line-height:30px;padding:0px 10px;border-radius:4px;margin-right:10px;margin-bottom:10px;}
		        </style>
		        <script>
					function ontochooselan(lang){
						$('.alllanbody').hide();
						$('.lanbody'+lang).show();

						$('.langaction').removeClass('langaction_on').addClass('langaction_off');
						$('div[onclick="ontochooselan(\''+lang+'\')"]').removeClass('langaction_off').addClass('langaction_on');
					}
				</script>
				<div class="langcheckarea">
    				<div class="langcheck"><input name="langtype_en" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked <?php //if($cmsinfo['langtype_en'] == 1){echo 'checked';}?>/></div>
    				<div class="langcheck"><input name="langtype_ch" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked <?php //if($cmsinfo['langtype_ch'] == 1){echo 'checked';}?>/></div>
    				<div class="langcheck"><input name="langtype_jp" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked <?php //if($cmsinfo['langtype_jp'] == 1){echo 'checked';}?>/></div>
    				<div class="langcheck"><input name="langtype_sk" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked <?php //if($cmsinfo['langtype_sk'] == 1){echo 'checked';}?>/></div>
    				<div class="langcheck"><input name="langtype_ru" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked <?php //if($cmsinfo['langtype_ru'] == 1){echo 'checked';}?>/></div>
				</div>
				
				<style>
		          .langactionarea{float:left;width:100%;}
		          .langactionarea .langaction{cursor:pointer;float:left;width:80px;text-align:center;line-height:30px;padding:0px 10px;border-radius:4px;margin-right:10px;margin-bottom:10px;}
		          .langactionarea .langaction_off{background:rgba(163, 32, 53, 0.3);color:white;}
		          .langactionarea .langaction_on{background:#DF9C4D;color:white;}
		        </style>
		        <script>
					function ontochooselan(lang){
						$('.alllanbody').hide();
						$('.lanbody'+lang).show();

						$('.langaction').removeClass('langaction_on').addClass('langaction_off');
						$('div[onclick="ontochooselan(\''+lang+'\')"]').removeClass('langaction_off').addClass('langaction_on');
					}
				</script>
				<div class="langactionarea">
					<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
        				<div class="langaction <?php if($lancodelist[$lc]['langtype'] == '_en'){echo 'langaction_on';}else{echo 'langaction_off';}?>" onclick="ontochooselan('<?php echo $lancodelist[$lc]['langtype']?>')"><?php echo $lancodelist[$lc]['langname'];?></div>
    				<?php }?>
				</div>
			</td>
		</tr>
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tbody class="alllanbody lanbody<?php echo $lancodelist[$lc]['langtype'];?>" <?php if($lancodelist[$lc]['langtype'] != '_en'){echo 'style="display:none;"';}?>>
    			<tr>
    				<td align="right" width="150"><?php if($lancodelist[$lc]['langtype'] == '_ch'){echo '名称';}else if($lancodelist[$lc]['langtype'] == '_jp'){echo 'の名前をあげる';}else if($lancodelist[$lc]['langtype'] == '_sk'){echo '이름';}else if($lancodelist[$lc]['langtype'] == '_ru'){echo 'Имя';}else{echo 'Name';}?></td>
    				<td align="left">
    					<input type="text" name="cms_name<?php echo $lancodelist[$lc]['langtype']?>" style="width:<?php if($group_id == 207){echo 100;}else{echo 750;}?>px;" value="<?php echo $cmsinfo['cms_name'.$lancodelist[$lc]['langtype']]?>"/>
    					<div class="tipsgroupbox"><div class="request"></div></div>
    				</td>
    			</tr>
        		<tr>
    				<td align="right" width="150">
    					<?php if($lancodelist[$lc]['langtype'] == '_ch'){echo '职位';}else if($lancodelist[$lc]['langtype'] == '_jp'){echo 'ポジション';}else if($lancodelist[$lc]['langtype'] == '_sk'){echo '직위';}else if($lancodelist[$lc]['langtype'] == '_ru'){echo 'Должности';}else{echo 'Position';}?>
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_input_1<?php echo $lancodelist[$lc]['langtype']?>" style="width:100px;" value="<?php echo $cmsinfo['cms_input_1'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
        		<tr>
    				<td align="right" width="150">
    					<?php if($this->langtype == '_ch'){echo '邮箱';}else if($this->langtype == '_jp'){echo 'E-mail';}else if($this->langtype == '_sk'){echo '이메일';}else if($this->langtype == '_ru'){echo 'E-mail';}else{echo 'E-mail';}?>
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_input_2<?php echo $lancodelist[$lc]['langtype']?>" style="width:200px;" value="<?php echo $cmsinfo['cms_input_2'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			<tr style="<?php if($cmsinfo['parent'] != 4849){echo 'display:none;';}?>">
    				<td align="right" width="150">
    					<?php if($this->langtype == '_ch'){echo '电话';}else if($this->langtype == '_jp'){echo '電話';}else if($this->langtype == '_sk'){echo '전화';}else if($this->langtype == '_ru'){echo 'Тел';}else{echo 'Tel';}?>
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_input_3<?php echo $lancodelist[$lc]['langtype']?>" style="width:100px;" value="<?php echo $cmsinfo['cms_input_3'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			<tr style="display:none;">
    				<td align="right" width="150">
    					
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_input_4<?php echo $lancodelist[$lc]['langtype']?>" style="width:100px;" value="<?php echo $cmsinfo['cms_input_4'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			<tr style="display:none;">
    				<td align="right" width="150">
    					
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_input_5<?php echo $lancodelist[$lc]['langtype']?>" style="width:100px;" value="<?php echo $cmsinfo['cms_input_5'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			<tr style="display:none;">
    				<td align="right" width="150">
    					
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_input_6<?php echo $lancodelist[$lc]['langtype']?>" style="width:100px;" value="<?php echo $cmsinfo['cms_input_6'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			<tr style="display:none;">
    				<td align="right" width="150">
    					
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_input_7<?php echo $lancodelist[$lc]['langtype']?>" style="width:200px;" value="<?php echo $cmsinfo['cms_input_7'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			
    			<tr style="display:none;">
    				<td align="right" width="150"><?php if($lancodelist[$lc]['langtype'] == '_ch'){echo '第二行文字';}else if($lancodelist[$lc]['langtype'] == '_jp'){echo '2番目のテキスト';}else if($lancodelist[$lc]['langtype'] == '_sk'){echo '두 번째 텍스트';}else if($lancodelist[$lc]['langtype'] == '_ru'){echo 'Второй текст';}else{echo 'Second Text';}?></td>
    				<td align="left">
    					<input type="text" name="cms_subname<?php echo $lancodelist[$lc]['langtype']?>" style="width:750px;" value="<?php echo $cmsinfo['cms_subname'.$lancodelist[$lc]['langtype']]?>"/>
    					<div class="tipsgroupbox"><div class="request"><?php //if($lancodelist[$lc]['langtype'] != $this->langtype){echo '';}else{echo '*';}?></div></div>
    				</td>
    			</tr>
    			<tr style="display:none;">
    				<td align="right" width="150">
    					Author
    				</td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="cms_author<?php echo $lancodelist[$lc]['langtype']?>" style="width:200px;" value="<?php echo $cmsinfo['cms_author'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			<tr style="<?php if($cmsinfo['parent'] == 4849){echo 'display:none;';}?>">
    				<td align="right" width="150">
    					<?php if($lancodelist[$lc]['langtype'] == '_ch'){echo '简介';}else{echo 'Introduction';}?> 
    				</td>
    				<td align="left">
    					<textarea name="cms_comment<?php echo $lancodelist[$lc]['langtype']?>" style="width:600px;height:100px;"><?php echo str_replace('<br />', chr(13), $cmsinfo['cms_comment'.$lancodelist[$lc]['langtype']])?></textarea>
    					<div class="tipsgroupbox"><div class="request"></div></div>
    				</td>
    			</tr>
    			
    			<tr style="display:none;">
    				<td align="right" width="150"><?php if($lancodelist[$lc]['langtype'] == '_ch'){echo '描述';}else{echo 'Description';}?></td>
    				<td align="left">
    					<?php 
        					$cms_description = debaseurlcontent($cmsinfo['cms_description'. $lancodelist[$lc]['langtype']]);
        					$cms_description = str_replace('newsite/', '', $cms_description);
    					?>
    					<script id="cms_description<?php echo $lancodelist[$lc]['langtype']?>" type="text/plain" style="width:800px;height:300px;"><?php echo $cms_description;?></script>
    					<script type="text/javascript">
    						var cms_description<?php echo $lancodelist[$lc]['langtype']?> = UE.getEditor('cms_description<?php echo $lancodelist[$lc]['langtype']?>');
    					</script>
    				</td>
    			</tr>
			</tbody>
		<?php }?>
		<tr style="display:none;">
			<?php 
				$cmsinfo['cms_link'] = str_replace('/en/', '/'.$this->reland.'/', $cmsinfo['cms_link']);
				$cmsinfo['cms_link'] = str_replace('/cn/', '/'.$this->reland.'/', $cmsinfo['cms_link']);
			?>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '链接';}else{echo 'Link';}?></td>
			<td align="left">
				<input type="text" name="cms_link" style="width:800px;" value="<?php echo debaseurlcontent($cmsinfo['cms_link'])?>" />
				<div class="tipsgroupbox"><div class="request"></div></div>
			</td>
		</tr>
		<tr style="display:none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '时间';}else{echo 'Time';}?></td>
			<td>
				<div style="float:left;width:calc(100% - 60px);">
					<link href="<?php echo CDN_URL().'themes/default/dateselect/css/mobiscroll.css?date='.CACHE_USETIME()?>" rel="stylesheet" />
					<link href="<?php echo CDN_URL().'themes/default/dateselect/css/mobiscroll_date.css?date='.CACHE_USETIME()?>" rel="stylesheet" />
					<script src="<?php echo CDN_URL().'themes/default/dateselect/js/mobiscroll_date.js?date='.CACHE_USETIME()?>" charset="gb2312"></script> 
					<script src="<?php echo CDN_URL().'themes/default/dateselect/js/mobiscroll.js?date='.CACHE_USETIME()?>"></script>

    				<?php 
	    				if($cmsinfo['cms_date_time'] != '' && $cmsinfo['cms_date_time'] != 0){
	    					$cms_date = date('Y-m-d H:i', $cmsinfo['cms_date_time']);
	    				}else{
	    					$cms_date = date('Y-m-d H:i');
	    				}
    				?>
 
					<?php $date_index = 101;?>
					<input style="float:left;width:120px;line-height:20px;" type="text" readonly unselectable="on" name="cms_date" id="cms_date_<?php echo $date_index;?>" value="<?php echo $cms_date?>"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
    				<div style="float:left;line-height:28px;margin-left:8px;"><img style="float:left;width:18px;height:18px;margin-top:5px;" src="<?php echo base_url().'themes/default/images/global_ok.png'?>"/></div>
					<script type="text/javascript">
						(function($){
    						$(function () {
                                <?php if($cms_date != ''){?>
    								var start_date_<?php echo $date_index;?> = '<?php echo date('Y-m-d', strtotime($cms_date));?>';
    							<?php }else{?>
    								var start_date_<?php echo $date_index;?> = '<?php echo date('Y-m-d');?>';
    							<?php }?>
       				 			var arrselect_<?php echo $date_index;?> = start_date_<?php echo $date_index;?>.split("-");
       				 			var date_select_<?php echo $date_index;?> = new Date(arrselect_<?php echo $date_index;?>[0], (parseInt(arrselect_<?php echo $date_index;?>[1]) - 1), arrselect_<?php echo $date_index;?>[2]);
       				 			var time_select_<?php echo $date_index;?> = date_select_<?php echo $date_index;?>.getTime();
       				 			
    							var currYear_<?php echo $date_index;?> = date_select_<?php echo $date_index;?>.getFullYear();
							
    							var opt_<?php echo $date_index;?>={};
    							opt_<?php echo $date_index;?>.date = {preset : 'date'};
    							opt_<?php echo $date_index;?>.datetime = {preset : 'datetime'};
    							opt_<?php echo $date_index;?>.time = {preset : 'time'};
    							opt_<?php echo $date_index;?>.default = {
    								theme: 'android-ics light', //皮肤样式
    								display: 'bubble', //显示方式 
    								mode: 'scroller', //日期选择模式
    								dateFormat: 'yy-mm-dd',//yy-mm-dd, yyyy-mm-dd
    								lang: 'zh',
    								showNow: false,
    								nowText: "<?php if($this->langtype == '_ch'){echo '今天';}else{echo 'Today';}?>",
    								width: 70,
    								dayText: '<?php if($this->langtype == '_ch'){echo '日';}else{echo 'Day';}?>', 
    	    					    monthText: '<?php if($this->langtype == '_ch'){echo '月';}else{echo 'Month';}?>',
    	    					    yearText: '<?php if($this->langtype == '_ch'){echo '年';}else{echo 'Year';}?>', //面板中年月日文字
    	    					    hourText: '<?php if($this->langtype == '_ch'){echo '时';}else{echo 'Hour';}?>',
    	    					    minuteText: '<?php if($this->langtype == '_ch'){echo '分';}else{echo 'Minute';}?>',
    	    					    secText: '<?php if($this->langtype == '_ch'){echo '秒';}else{echo 'Second';}?>',
    	    					    setText: '<?php if($this->langtype == '_ch'){echo '确定';}else{echo 'Confirm';}?>', //确认按钮名称
    	    					    cancelText: '<?php if($this->langtype == '_ch'){echo '取消';}else{echo 'Cancel';}?>',//取消按钮名籍我
    								startYear: currYear_<?php echo $date_index;?> - 20, //开始年份
    								endYear: currYear_<?php echo $date_index;?> + 20 //结束年份
    							};
    							
    							$("#cms_date_<?php echo $date_index;?>").val('<?php echo $cms_date?>').mobiscroll($.extend(opt_<?php echo $date_index;?>['datetime'], opt_<?php echo $date_index;?>['default']));
        					});
						})(jQuery)
					 </script>
					<div class="cms_date_error" style="float:left;width:100%;color:red;display:none;">请选择时间</div>
    			</div>
			</td>
		</tr>
		<tr style="display:none;">
			<td colspan="2">
				<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('cy_status')?></td>
			<td align="left">
				<input name="status" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" <?php if($cmsinfo['status'] == 1){echo 'checked';}?>/>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_cmsinfo(<?php echo $cmsinfo['cms_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="height:20px;">&nbsp;</td>
		</tr>
	</table>
</form>
<script type="text/javascript">

//1、window.location.href(设置或获取整个 URL 为字符串)
var jsurl_fullurl = window.location.href;
//返回：http://i.cnblogs.com/EditPosts.aspx?opt=1

//2、window.location.protocol(设置或获取 URL 的协议部分)
var jsurl_protocol = window.location.protocol;
//返回：http:

//3、window.location.host(设置或获取 URL 的主机部分)
var jsurl_host = window.location.host;
//返回：i.cnblogs.com

var jsurl_sp = jsurl_fullurl.split(jsurl_host);

var jsurl_sp2 = jsurl_sp[1];
jsurl_sp2 = jsurl_sp2.split('/');
if(jsurl_sp2[1] != 'admins' && jsurl_sp2[1] != 'index.php'){
	var project_name = jsurl_sp2[1]+'/';
}else{
	var project_name = '';
}
var jsurl_baseurl = jsurl_protocol+'//'+jsurl_host+'/'+project_name;




//商品子分类---保存
function tosave_cmsinfo(cms_id){
	var lancodelist = getlancodelist();
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_cmsinfo('+cms_id+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span><?php if($this->langtype == '_ch'){echo '保存中...';}else{{echo 'Loading...';}}?></span>');
		
		//----定义的字段------START
			var GETOBJ = [];
			var GETOBJ_num = 0;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'status';
			GETOBJ[GETOBJ_num]['field_realname'] = 'status';
			GETOBJ[GETOBJ_num]['field_type'] = "checkboxradio";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '状态';}else{echo 'Status';}?>';

			GETOBJ_num = GETOBJ_num + 1;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'cms_link';
			GETOBJ[GETOBJ_num]['field_realname'] = 'cms_link';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '链接';}else{echo 'Link';}?>';

			GETOBJ_num = GETOBJ_num + 1;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'short_url';
			GETOBJ[GETOBJ_num]['field_realname'] = 'short_url';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '';
		//----定义的字段------END
		
		
			
		//----定义多语言的字段------START
			var GETLANGOBJ = new Array();
			var GETLANGOBJ_num = 0;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_name';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_subname';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = 'Second Text';
			
			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_comment';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "textarea";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_author';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_input_1';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';
			
			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_input_2';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_input_3';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_input_4';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_input_5';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_input_6';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_input_7';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?>';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_description';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "ueditor";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '<?php echo lang('dz_cms_description')?>';
			//----定义多语言的字段------END
		
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

			
			var linshi_pic_2_path_arr = $('input[name="linshi_pic_2_path[]"]');
			var linshi_pic_2_path = [];
			if(linshi_pic_2_path_arr.length > 0){
				for(var i = 0; i < linshi_pic_2_path_arr.length; i++){
					linshi_pic_2_path.push(linshi_pic_2_path_arr[i].value);
				}
			}
			var linshi_pic_2_name_arr = $('input[name="linshi_pic_2_name[]"]');
			var linshi_pic_2_name = [];
			if(linshi_pic_2_name_arr.length > 0){
				for(var i = 0; i < linshi_pic_2_name_arr.length; i++){
					linshi_pic_2_name.push(linshi_pic_2_name_arr[i].value);
				}
			}
		
		var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
		var postOBJ = returnOBJ.postOBJ;
		postOBJ.backurl = backurl;
		postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
		postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
		postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
		postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;

		postOBJ.linshi_pic_1_path = linshi_pic_1_path;
		postOBJ.linshi_pic_1_name = linshi_pic_1_name;

		postOBJ.linshi_pic_2_path = linshi_pic_2_path;
		postOBJ.linshi_pic_2_name = linshi_pic_2_name;

		var cms_date = $('input[name="cms_date"]').val();
		postOBJ.cms_date = cms_date;
// alert(linshi_picpath);
		
		if(returnOBJ.ispass == 1){
			$.post(baseurl+'index.php/admins/cms/edit_subcms/<?php echo $group_id;?>/'+cms_id, postOBJ, function (data){
// 				alert(data);
				var obj = eval( "(" + data + ")" );
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span><?php if($this->langtype == '_ch'){echo '保存成功';}else{echo 'Success';}?></span>');
				location.href = obj.backurl;
			})
		}else{
			actionsubmit_button.attr('class', 'gksel_btn_action_on');
			actionsubmit_button.html('<?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?>');
			isajaxsaveing = 0;//ajax正在保存中 --- 释放

			$('.requestbox').eq(0).each(function (){
				var togoto_top = parseInt($(this).offset().top);
		    	$('html, body').stop().animate({
		            scrollTop: (togoto_top - 0 - 2)
		        }, 1000);
			})
		}
	}
}

</script>
<?php $this->load->view('admin/common_footer')?>