<?php $this->load->view('admin/common_header')?>
<div style="float:left;width:calc(100% - 40px);margin-left:20px;">
	
<?php 
$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url = current_url();
$current_url_encode=str_replace('/','slash_tag',base64_encode($current_url.$get_str));

$notice_id = $this->input->get('notice_id');
$brand_id = $this->input->get('brand_id');
$keyword = $this->input->get('keyword');

check_SQLinjection($keyword);//防止sql注入，防止js注入
?>
<table class="gksel_normal_tabaction">
	<tr>
		<td>
			<div style="float:left;">
				<a href="<?php echo base_url().'admins/notice/toadd_notice'?>">
					<font class="nav_on">
						<font class="plus">
							<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
							<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
						</font>
						<span>
							<?php if($this->langtype == '_ch'){echo '添加通知';}else{echo 'Add notice';}?>
						</span>
					</font>
				</a>
			</div>
		</td>
		<td>
			<div class="searcharea">
				<form action = "<?php echo base_url().'admins/notice/index'?>" method="get">
					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
					<input type="submit" value="<?php echo lang('cy_search')?>"/>
				</form>
			</div>
		</td>
	</tr>
</table>
<div style="float:left;width:calc(100% - 20px);background-color:white;padding:10px 10px;border-radius:8px;">
	<table class="gksel_normal_tablist">
		<thead>
			<tr>
				<td width="50" align="center"><?php echo lang('cy_sn')?></td>
				<!-- 
				<td width="120" align="center"><p><?php if($this->langtype == '_ch'){echo '图片';}else{echo 'Picture';}?></p></td>
				 -->
				<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '标题';}else{echo 'Title';}?></p></td>
				<td width="200" align="center"><p><?php if($this->langtype == '_ch'){echo '语言';}else{echo 'Language';}?></p></td>
				<td width="120" align="center"><p><?php if($this->langtype == '_ch'){echo '最后修改时间';}else{echo 'Last Time';}?></p></td>
				<td width="160" align="center"><p><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></p></td>
			</tr>
		</thead>
	</table>
	<ul id="tasks" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
		<?php if(isset($noticelist)){for ($i = 0; $i < count($noticelist); $i++) {?>
			<li class="articlelist" id="<?php echo $noticelist[$i]['notice_id']?>" iid="<?php echo $i+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
				<table class="gksel_normal_tablist" style="margin-top: 0px;<?php if($noticelist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
					<tbody>
						<tr>
							<td width="50" align="center" style="padding-left:0px;padding-right:0px;"><?php echo ($i+1)?></td>
							<!-- 
							<td width="120" align="center" style="padding-left:0px;padding-right:0px;">
								<?php
				    	    		$uploadFile1 = $noticelist[$i]['notice_pic_path'];
				    	    		if($uploadFile1 != ''){
				    	    			$file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
				    	    			$uploadFile1_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $uploadFile1);
				    	    		}else{
				    	    			$uploadFile1_100x100 = '';
				    	    		}
				    			?>
								<?php if($uploadFile1_100x100 != ''){?>
									<img style="width:100px;height:100px;border-radius:4px;" src="<?php echo CDN_URL().$uploadFile1_100x100?>"/>
								<?php }else{?>
									<img style="width:100px;height:100px;border-radius:4px;" src="<?php echo CDN_URL().'themes/default/images/none_notice.png'?>"/>
								<?php }?>
							</td>
							 -->
							<td valign="top" style="padding-left:0px;padding-right:0px;">
								<div style="float:left;width: 100%;font-size:14px;font-weight:bold;">
									<?php if($noticelist[$i]['langtype'.$this->langtype] == 1){?>
										<?php echo actionsearchdaxiaoxiezimu($keyword, debaseurlcontent($noticelist[$i]['notice_name'.$this->langtype]));?>
									<?php }else{?>
										<?php if($noticelist[$i]['langtype_en'] == 1){?>
											<?php echo actionsearchdaxiaoxiezimu($keyword, debaseurlcontent($noticelist[$i]['notice_name_en']));?>
										<?php }else if($noticelist[$i]['langtype_ch'] == 1){?>
											<?php echo actionsearchdaxiaoxiezimu($keyword, debaseurlcontent($noticelist[$i]['notice_name_ch']));?>
										<?php }else if($noticelist[$i]['langtype_jp'] == 1){?>
											<?php echo actionsearchdaxiaoxiezimu($keyword, debaseurlcontent($noticelist[$i]['notice_name_jp']));?>
										<?php }else if($noticelist[$i]['langtype_sk'] == 1){?>
											<?php echo actionsearchdaxiaoxiezimu($keyword, debaseurlcontent($noticelist[$i]['notice_name_sk']));?>
										<?php }else if($noticelist[$i]['langtype_ru'] == 1){?>
											<?php echo actionsearchdaxiaoxiezimu($keyword, debaseurlcontent($noticelist[$i]['notice_name_ru']));?>
										<?php }?>
									<?php }?>
								</div>
								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;">
									<?php if($this->langtype == '_ch'){echo '通知时间';}else{echo 'Date Time';}?>：<?php echo date('Y-m-d H:i', $noticelist[$i]['notice_date_time']);?>
								</div>
								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;">
									<?php if($this->langtype == '_ch'){echo '编辑';}else{echo 'Source';}?>：<?php if($noticelist[$i]['notice_source'.$this->langtype] != ''){echo $noticelist[$i]['notice_source'.$this->langtype];}else{echo '-';}?>
								</div>
								<?php if($noticelist[$i]['short_url'] != ''){?>
    								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;color:#CCC;">
    									<?php echo base_url().''.$this->reland.'/notice/'.$noticelist[$i]['short_url'];?>
    								</div>
								<?php }?>
							</td>
							<td width="200" align="center" style="padding-left:0px;padding-right:0px;">
								<?php 
    								if($noticelist[$i]['langtype_en'] == 1){
    								    echo '<div style="float:left;background:#2C82DF;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
    								    if($this->langtype == '_ch'){echo 'English';}else{echo 'English';}
    								    echo '</div>';
    								}
    								if($noticelist[$i]['langtype_ch'] == 1){
    								    echo '<div style="float:left;background:#1ED76D;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
    								    if($this->langtype == '_ch'){echo '中文';}else{echo '中文';}
    								    echo '</div>';
    								}
    								if($noticelist[$i]['langtype_jp'] == 1){
    								    echo '<div style="float:left;background:#FFD766;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
    								    if($this->langtype == '_ch'){echo '日本語';}else{echo '日本語';}
    								    echo '</div>';
    								}
    								if($noticelist[$i]['langtype_sk'] == 1){
    								    echo '<div style="float:left;background:#EF7320;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
    								    if($this->langtype == '_ch'){echo '한국어';}else{echo '한국어';}
    								    echo '</div>';
    								}
    								if($noticelist[$i]['langtype_ru'] == 1){
    								    echo '<div style="float:left;background:#FF2442;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
    								    if($this->langtype == '_ch'){echo 'Русский';}else{echo 'Русский';}
    								    echo '</div>';
    								}
								?>
							</td>
							<td width="120" align="center" style="padding-left:0px;padding-right:0px;">
								<div style="float:left;width:100%;">
									<?php echo date('Y-m-d H:i', $noticelist[$i]['edited'])?>
								</div>
								<div style="float:left;width:100%;margin-top:5px;color:#CCC;">
									<?php echo $noticelist[$i]['edited_author']?>
								</div>
							</td>
							<td width="160" align="center" style="padding-left:0px;padding-right:0px;">
								<div style="float:right;">
									<?php 
										echo '<a href="'.base_url().'admins/notice/toedit_notice/'.$noticelist[$i]['notice_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
											
										echo '<a onclick="todel_notice('.$noticelist[$i]['notice_id'].', \''.$noticelist[$i]['notice_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
									?>
								</div>
							</td>
						</tr>
					<tbody>
				</table>
			</li>
		<?php }}?>
	</ul>
	<table class="gksel_normal_tablist" style="margin-top: 10px;margin-bottom: 0px;">
		<thead>
			<tr>
				<td align="left" style="border-top: none;text-indent:15px;line-height:30px;border-bottom:0px;">
					<?php if(isset($fy)){echo $fy;}?>
					<div style="float:right;">
    					<?php 
    						if($this->langtype == '_ch'){
    							echo '按照新闻事件由近到远显示';
    						}else{
    							echo 'Display by date time from near to far';
    						}
    					?>
					</div>
				</td>
			</tr>
		</thead>
	</table>
</div>
</div>

<!--
<script src="<?php echo base_url()?>themes/default/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		$('.articlelist').each(function (){
			var height=$(this).find('table').height();
			$(this).css({'height':height+'px'});
		})
		$('#tasks').sortable({
			opacity:0.8,
			revert:true,
			forceHelperSize:true,
			placeholder: 'draggable-placeholder',
			forcePlaceholderSize:true,
			tolerance:'pointer',
			stop: function( event,ui) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
				$(ui.item).css('z-index', 'auto');
				var noticerot=[];
				var idarr=[];
				var i=0;
				$('.articlelist').each(function (){
					i++;
					noticerot.push(i);
					idarr.push($(this).attr('id'));
				})
				$.post(baseurl+'index.php/admins/notice/editnotice_sort',{idarr:idarr,noticerot:noticerot},function (data){
					
				})
			},
			scroll: true,
		});
		
	})
</script>
-->

<script type="text/javascript">
//删除商品
function todel_notice(id, name){
	var title = '<?php if($this->langtype == '_ch'){echo '您确定要删除 ';}else{echo 'Are you sure to delete ';}?><font style="color:red;">【'+name+'】</font><?php if($this->langtype == '_ch'){echo '吗？';}else{echo '?';}?>';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/notice/del_notice/"+id);
	todel(title, subtitle);
}
</script>
<?php $this->load->view('admin/common_footer')?>