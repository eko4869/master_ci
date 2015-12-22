<h4><?php echo $judul ?></h4>

<table>
<tr>
	<td><a href="javascript:void();" onclick="ajax_link('<?php echo base_url()."pengaturan/user/tambah";?>')" class='btn btn-info btn-small'>
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
<table class="table table-striped table-bordered" style="font-size:14px;width:65%;">
<thead bgcolor="#bbb">
<tr>
	<th style='text-align:center' width='10'>No</th>
	<th width="250">Username</th>
	<th width="100">Level</th>
	<th style='text-align:center' width="15">Aksi</th>
</tr>
</thead>
	<?php $no=1+$this->uri->segment(4); foreach($data_list as $list):?>
<tbody bgcolor="#eee">
<tr id='tr_<?php echo $no?>'>
	<td style='text-align:center'><?php echo $no ;?>.</td>
	<td><?php echo $list->username;?></td>
	<td><?php echo id_to_name('user_level','id_level',$list->id_level,'level');?></td>
	<td style='text-align:center'><a href="javascript:void();" onclick= "ajax_link('<?php echo base_url()."pengaturan/user/edit/".$list->id_user;?>')"><i class="icon-pencil"></i></a>&nbsp;
		<a href="javascript:void();" onclick= "hapus_conf('<?php echo base_url()."pengaturan/user/hapus/"?>',<?php echo $list->id_user?>,<?php echo $no ?>)" ><i class="icon-trash"></i></a></td>
</tr>
</tbody>
	<?php $no++; endforeach;?>
</table>
<?php echo $paging ?>
<script type='text/javascript'>
$(function(){
	$(".alert").fadeOut(3000);

	$('#cbg').on('change',function(){
		ajax_link('<?php echo base_url()."pengaturan/user/index?cbg=" ?>'+$('#cbg').val());
	});
});
</script>


