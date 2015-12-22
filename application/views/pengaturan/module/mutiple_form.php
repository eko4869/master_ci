<div class="row-fluid">
	<div class="span12" style="padding:15px;" id="form">
		<h4><?php echo $judul;?></h4>
		</br>
		<div style="color:red;"><p><i><?php echo $this->session->flashdata('error');?></i></p></div>
		<table class="table table-bordered table-striped table-hover" style="width:80% ">
		<tr>
			<th>No</th>
			<th>Nama Module</th>
			<th>Icon</th>
			<th>URL</th>
			<th>Parent</th>
			<th>Order</th>
		</tr>
		
		<?php echo form_open('pengaturan/module/simpan_mutiple',array('id'=>'form_mutiple'));?>
		<?php for($i=1;$i<=$banyak_data;$i++):?>
		
		<tr>
			<td><?php echo $i ;?></td><input type="hidden" name="banyak_data" value="<?php echo $this->uri->segment(4)?>">
			<td><input type='text' name="nama_module[<?php echo $i;?>]" class="input-large" style="height:30px;"></td>
			<td><?php echo form_input(array("name"   =>"icon_module[$i]",
									"id"	 =>"nama",
									"class"  =>"input-large",
									));?></td>
			<td><input type='text' name="url_module[<?php echo $i;?>]" class="input-large" style="height:30px;"></td>
			<td><?php echo form_dropdown("parent[$i]",$dropdown_parent);?></td>
			<td><input type='text' name="order[<?php echo $i;?>]" class="input-mini" style="height:30px;"></td>
		</tr>
		
		<?php endfor;?>
		<tr>
			<td colspan="6" style="text-align:right;">
			<?php echo form_button(array("content"=>"Kembali",
									 "class"  =>"btn btn-info btn-small",
									 "Onclick"=>"location.href='".base_url()."pengaturan/module'"));  ?>
			<input type="submit" name="simpan" value="simpan" class="btn btn-info btn-small" onclick="return confirm('Apakah anda yakin?')">
			</td>
		</tr>
		<?php echo form_close();?>
		
		</table>
	</div>
</div>
