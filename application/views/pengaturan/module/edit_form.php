<div class="row-fluid">
<div class="span10" style="padding:15px;" id="form">
<h4><?php echo $judul;?></h4>
</br>
<form method="POST" id="myform" action="<?php echo base_url()."pengaturan/module/update/".$edit_list->id_module ?>">
<table style="font-size:14px;">
<tr>
	<td width='100'>Nama Module</td>
	<td width='5'>:</td>
	<td><?php echo form_input(array("name"   =>"nama_module",
									"value"  =>$edit_list->nama_module,
									"id"	 =>"nama",
									"class"  =>"input-large",
									));?>
	</td>
	<td><?php echo form_error('nama_module');?></td>
</tr>
<tr>
	<td>Icon</td>
	<td>:</td>
	<td><?php echo form_input(array("name"   =>"icon_module",
									"value"  =>$edit_list->icon_module,
									"id"	 =>"icon_module",
									"class"  =>"input-large",
									));?>
	</td>
	<td>*untuk child menu tdk perlu icon</td>
</tr>
<tr>
	<td>URL</td>
	<td>:</td>
	<td><?php echo form_input(array("name"   =>"url_module",
									"value"  =>$edit_list->url_module,
									"id"     =>"url",
									"class"  =>"input-large",
									));?>
	</td>
</tr>
<tr>
	<td>Parent</td>
	<td>:</td>
	<td><?php echo form_dropdown("parent",$dropdown_parent,$edit_list->parent);?>
	</td>
</tr>
<tr>
	<td>Order</td>
	<td>:</td>
	<td><?php echo form_input(array("name"	 =>"order",
									"value"  =>$edit_list->order,
									"id"     =>"order",
									"class"  =>"input-mini",
									));?>
	</td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" class="btn btn-info btn-small" value="simpan"/>
		<input type="button" class="btn btn-info btn-small" value="batal" 
			   onclick="ajax_link('<?php echo base_url()."pengaturan/module" ?>')"/>
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
