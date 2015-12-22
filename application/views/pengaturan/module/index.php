<h4><?php echo $judul ?></h4>

<table>
<tr>
	<td><a href="javascript:void();" onclick="ajax_link('<?php echo base_url()."pengaturan/module/tambah";?>')" class='btn btn-info btn-small btn-small'>
		<i class="icon-plus icon-white"></i>Tambah</a>
	</td>
</tr>
</table>
	
<br>
<br>
	<?php if($this->session->flashdata('sukses') !=''): ?>
    <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $this->session->flashdata('sukses') ?>
    </div>
	<?php endif ?>
<table class="table table-striped table-bordered" style="font-size:14px;width:98%;">
<thead bgcolor="#bbb">
<tr>
	<th style='text-align:center' width="20">No</th>
	<th width="250">Nama Module</th>
	<th style='text-align:center' width="50">Icon Module</th>
	<th width="100">URL Module</th>
	<th style='text-align:center' width="50">Urutan</th>
	<th style='text-align:center' width="10">Aksi</th>
</tr>
</thead>
	<?php $no=1; foreach($data_list as $list):?>
<tbody>
<tr id='tr_<?php echo $no?>' style='font-weight:bold;'>
	<td style='text-align:center'><?php echo $no;?>.</td>
	<td><?php echo $list->nama_module;?></td>
	<td style='text-align:center'><?php echo '<i class= icon-'.$list->icon_module.'</i>';?></td>
	<td><span class="label label-primary"><?php echo $list->url_module;?></span></td>
	<td style='text-align:center'><?php echo $list->order;?></td>
	<td style='text-align:center'>
		<a href="javascript:void();" onclick="ajax_link('<?php echo base_url()."pengaturan/module/edit/".$list->id_module;?>')"><i class="icon-pencil"></i></a>&nbsp;
		<a href="javascript:void();" onclick="hapus_conf('<?php echo base_url()."pengaturan/module/hapus/"?>',<?php echo $list->id_module ?>,'<?php echo $no ?>')"><i class="icon-trash"></i></a>
	</td>
</tr>
<?php 
    $ci =& get_instance();
	$child = $ci->get_child($list->id_module);
	foreach($child as $ch):
 ?>
<tr>
	<td></td>
	<td><i class='icon-chevron-right'></i> <?php echo $ch->nama_module ?></td>
	<td><?php echo $ch->icon_module;?></td>
	<td><span class="label label-primary"><?php echo $ch->url_module;?></span></td>
	<td style='text-align:center'><?php echo $ch->order;?></td>
	<td style='text-align:center'>
		<a href="javascript:void();" onclick="ajax_link('<?php echo base_url()."pengaturan/module/edit/".$ch->id_module;?>')"><i class="icon-pencil"></i></a>&nbsp;
		<a href="javascript:void();" onclick="hapus_mod('<?php echo base_url()."pengaturan/module/hapus/".$ch->id_module?>','<?php echo current_url() ?>')"><i class="icon-trash"></i></a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
	<?php $no++; endforeach;?>
</table>
<script type='text/javascript'>
$(function(){
	$(".alert").fadeOut(3000);
});
</script>
