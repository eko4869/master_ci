<div class="row-fluid">
<div class="span10" style="padding:15px;" id="form">
<h4><?php echo $judul;?></h4>
</br>
<form method='post' id='myform'>
<table style="font-size:14px;">
<tr>
	<td width='100'>Level</td>
	<td width='5'>:</td>
	<td><?php echo form_input(array("name"   =>"level",
									"value"  =>$edit_list->level,
									"id"	 =>"level",
									"class"  =>"input-large",
									));?>
	</td>
	<td><?php echo form_error('level');?></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="button" class="btn btn-info btn-small" value="simpan" 
			   onclick="edit('<?php echo base_url()."pengaturan/user_level/update/".$edit_list->id_level ?>',
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
 function edit(site,ref)
	 {
	 	var dat = $('#myform').serialize();
	 	
	 	ajax_simpan_edit(dat,site,ref);
	 } 
</script>

