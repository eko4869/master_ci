<div class="row-fluid">
<div class="span10" style="padding:15px;" id="form">
<h4><?php echo $judul;?></h4>
<br>
<form method='post' id='myform'>
<table style="font-size:14px;">
<tr>
	<td width='100'>Level</td>
	<td width='5'>:</td>
	<td><?php echo form_input(array("name"   =>"level",
									"value"  =>set_value("level"),
									"id"	 =>"level",
									"class"  =>"input-large",
									));?>
	</td>
	<td><div style="color:red;"><?php echo form_error('level');?></div></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="button" class="btn btn-info btn-small" value="simpan" 
			   onclick="simpan('<?php echo base_url()."pengaturan/user_level/simpan" ?>',
	           				   '<?php echo base_url()."pengaturan/user_level" ?>')"/>
		<input type="button" class="btn btn-info btn-small" value="batal" 
			   onclick="ajax_link('<?php echo base_url()."pengaturan/user_level" ?>')"/>
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
