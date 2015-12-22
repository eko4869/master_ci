<?php echo form_button(array("content"=>"Kembali",
										 "class"  =>"btn btn-info btn-small btn-small",
										 "Onclick"=>"back();"));  ?>
<?php echo form_open('pengaturan/user_level/set_hak_akses');?>
	<table>
	<tr>
		<td><input type="hidden" name="id_level" value=<?php echo $level->id_level;?>>
		<b><?php echo $level->level;?></b></td>
	</tr>
	</table>
	</br>
	<?php $CI=& get_instance();
		$hak_akses = $CI->load->model('users_model');
	?>
	<table class="table table-bordered table-striped" style="font-size:14px; width:40%;">
	<thead  bgcolor="#bbb">
	<tr>
		<th style="text-align:center;" width="5">No</th>
		<th width="150">Module</th>
		<th width="50" style="text-align:center;">Setting</th>
	</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($list_module as $list):?>
	<tr>
		<td style="text-align:center;"><?php echo $no;?>.</td>
		<td><?php echo $list->nama_module;?></td>
		<td style="text-align:center;">
		<?php $status=$CI->users_model->cek_hak_akses($level->id_level,$list->id_module);
			if($status === FALSE)
					{
						echo "<a href='".base_url()."pengaturan/user_level/aktifkan/".$level->id_level."/".$list->id_module."' title='aktifkan'><i class='icon-remove'></i></a>";
					}
			else
					{
						echo "<a href='".base_url()."pengaturan/user_level/nonaktifkan/".$level->id_level."/".$list->id_module."' title='nonaktifkan'><i class='icon-ok'></i></a>";
					}
		;?>	
		</td>
	</tr>
		<?php $no++; endforeach;?>
	</tbody>
	</table>
<?php echo form_close()?>
<script type='text/javascript'>
function back(){
ajax_link('<?php echo base_url()."pengaturan/user_level" ?>');
}
</script>


