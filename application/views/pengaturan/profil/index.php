<h4><?php echo $judul ?></h4>

<form method='post' id='profil_form'>
<table style='margin-top:10px;'>
	<tr>
		<td width='150'>Username</td>
		<td width='5'>:</td>
		<td><input type='hidden' name='id_user' value='<?php echo $profil->id_user ?>'>
			<?php echo form_input(array('name'=>'username','class'=>'input-large','value'=>$profil->username)); ?></td>
	</tr>
	<tr>
		<td width='150'>Password</td>
		<td width='5'>:</td>
		<td><?php echo form_password(array('name'=>'password','class'=>'input-large')); ?></td>
	</tr>
	<tr>
		<td width='150'>Konfirm Password</td>
		<td width='5'>:</td>
		<td><?php echo form_password(array('name'=>'k_password','class'=>'input-large')); ?></td>
	</tr>
	<tr>
		<td style='text-align:right;' colspan='3'><button type='button' onclick='update_profil()' class='btn btn-small btn-info'><i class='icon-ok icon-white'></i>&nbsp;update</button></td>
	</tr>
</table>
</form>
<script type='text/javascript'>
function update_profil()
{
	if(confirm('Anda yakin ingin mengubah setting?'))
	{
		$.ajax({
			type:'POST',
			url : '<?php echo base_url()."pengaturan/profil/update" ?>',
			data:$('#profil_form').serialize(),
			success:function(i)
			{
				alert(i);
				ajax_link('<?php echo current_url(); ?>');
			}
		});
	}
}
</script>
