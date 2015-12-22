<div class="row-fluid">
<div class="span10" style="padding:15px;" id="form">
<h4><?php echo $judul;?></h4>
</br>
<form method='POST' id='myform'>
<table style="font-size:14px;">
<tr>
	<td>Username</td>
	<td>:</td>
	<td><?php echo form_input(array("name"   =>"username",
									"value"  =>set_value("username"),
									"id"	 =>"username",
									"class"  =>"input-large",
									));?>
	</td>
	<td><div style="color:red;"><?php echo form_error('username');?></div></td>
</tr>
<tr>
	<td>Password</td>
	<td>:</td>
	<td><?php echo form_password(array("name"    =>"password",
										"id"     =>"password",
										"class"  =>"input-large",
										));?>
	</td>
	<td><div style="color:red;"><?php echo form_error('password');?></div></td>
</tr>
<tr>
	<td>Konfirm Password</td>
	<td>:</td>
	<td><?php echo form_password(array("name"    =>"konfirm_password",
										"id"     =>"password",
										"class"  =>"input-large",
										));?>
	</td>
	<td><div style="color:red;"><?php echo form_error('konfirm_password');?></div></td>
</tr>
<tr>
	<td>Level</td>
	<td>:</td>
	<td><?php echo form_dropdown("id_level",$dropdown_level);?>
	</td>
	<td><div style="color:red;"><?php echo form_error('id_level');?></div></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="button" class="btn btn-info btn-small" value="simpan" 
			   onclick="simpan('<?php echo base_url()."pengaturan/user/simpan" ?>',
	           				   '<?php echo base_url()."pengaturan/user" ?>')"/>
		<input type="button" class="btn btn-info btn-small" value="batal" 
			   onclick="ajax_link('<?php echo base_url()."pengaturan/user" ?>')"/>
	</td>
</tr>
</table>
<?php echo form_close();?>
</div>
</div>
<script type='text/javascript'>
 function simpan(site,ref)
	 {
	 	var dat = $('#myform').serialize();
	 	
	 	ajax_simpan_edit(dat,site,ref);
	 } 
</script>
