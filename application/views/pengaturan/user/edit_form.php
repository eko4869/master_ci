<div class="row-fluid">
<div class="span10" style="padding:15px;" id="form">
<h4><?php echo $judul;?></h4>
</br>
<form method='post' id='myform'>
<table style="font-size:14px;">
<tr>
	<td>Username</td>								
	<td>:</td>
	<td><?php echo form_input(array("name"   =>"username",
									"value"  =>$edit_list->username,
									"id"	 =>"username",
									"class"  =>"input-large",
									));?>		<input type="hidden" name="hidden_username" value="<?php echo $edit_list->username;?>">
	</td>
	<td><div style="color:red;"><?php echo form_error('username');?></div></td>
</tr>
<tr>
	<td>Password</td>
	<td>:</td>
	<td><?php echo form_password(array("name"    =>"password",
										"value"  =>"",
										"id"     =>"password",
										"class"  =>"input-large",
										));?>  <input type="hidden" name="hidden_password" value="<?php echo $edit_list->password;?>">
	</td>
	<td><div style="color:red;"><?php echo form_error('password');?></div></td>
</tr>
<tr>
	<td>Konfirm Password</td>
	<td>:</td>
	<td><?php echo form_password(array("name"    =>"konfirm_password",
										"id"     =>"konfirm_password",
										"class"  =>"input-large",
										));?>
	</td>
	<td><div style="color:red;"><?php echo form_error('konfirm_password');?></div></td>
</tr>
<tr>
	<td>Level</td>
	<td>:</td>
	<td><?php echo form_dropdown("id_level",$dropdown_level,$edit_list->id_level);?>
	</td>
	<td><div style="color:red;"><?php echo form_error('id_level');?></div></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="button" class="btn btn-info btn-small" value="simpan" 
			   onclick="edit('<?php echo base_url()."pengaturan/user/update/".$edit_list->id_user ?>',
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
 function edit(site,ref)
	 {
	 	var dat = $('#myform').serialize();
	 	
	 	ajax_simpan_edit(dat,site,ref);
	 } 
</script>
