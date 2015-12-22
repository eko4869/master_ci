<h4><?php echo $judul ?></h4>

<table>
<tr>
	<td>
		<a href="javascript:void();" onclick="ajax_link('<?php echo base_url()."pengaturan/user_level/tambah";?>')" class='btn btn-info btn-small btn-small'>
		<i class="icon-plus icon-white"></i>Tambah</a>
	</td>
</tr>
</table>
<br>
<?php if($this->session->flashdata('sukses') !=''): ?>
    <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $this->session->flashdata('sukses') ?>
    </div>
<?php endif ?>
<table class="table table-bordered table-striped table-hover" style="font-size:14px; width:40%;">
<thead bgcolor='#bbb'>
<tr>
	<th style='text-align:center;' width="5">No</th>
	<th width="150">Level</th>
	<th width="50" style="text-align:center;">Aksi</th>
</tr>
</thead>
<tbody bgcolor='#eee'>
	<?php $no=1; foreach($data_list as $list):?>
<tr id='tr_<?php echo $no?>'>
	<td style='text-align:center;'><?php echo $no;?>.</td>
	<td><?php echo $list->level;?></td>
	<td style="text-align:center;">
	<?php if($list->id_level !='1'): ?>
		<a href="javascript:void();" onclick= "ajax_link('<?php echo base_url()."pengaturan/user_level/edit/".$list->id_level;?>')"><i class="icon-pencil" title="edit"></i></a>&nbsp;
		<a href="javascript:void();" onclick="hapus_conf('<?php echo base_url()."pengaturan/user_level/hapus/"?>','<?php echo $list->id_level ?>','<?php echo $no ?>')" title="hapus"><i class="icon-trash"></i></a>
	<?php else: ?>
		<i class='icon-lock'></i>
	<?php endif ?>
		<a href="javascript:void();" onclick="ajax_link('<?php echo base_url()."pengaturan/user_level/hak_akses/".$list->id_level;?>')"><i class="icon-wrench" title="setting hak akses"></i></a>
	</td>
</tr>
	<?php $no++; endforeach;?>
</tbody>
</table>
<script type='text/javascript'>
$(function(){
	$(".alert").fadeOut(3000);
});
</script>


