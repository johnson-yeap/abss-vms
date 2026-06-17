<?php $this->load->view('header')?>
<style>

</style>
<?php $this->load->view('admin_common_leftmenu');?>
<div style="float:left;width:calc(100% - 200px);margin-left:200px;">
	<div style="width:96%;max-width:1400px;margin:0 auto;">
		<div style="float:left;width:100%;">
			<div class="formtable_loading">
                <div class="innercontent"><img src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>"/></div>
            </div>
            <?php 
                $this->load->view('case_record_edit_'.$form_type.'_content');
            ?>
    	</div>
    </div>
</div>
<?php $this->load->view('footer')?>