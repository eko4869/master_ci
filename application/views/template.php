<!DOCTYPE HTML>
<html>
	<head>
		<title>My Software ver 2.0</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href='<?php echo base_url().'assets/image/lp-maarif.jpg';?>'/>
		<link rel="stylesheet" href='<?php echo base_url().'assets/css/layout_style.css';?>'/>
		<link rel="stylesheet" href='<?php echo base_url().'assets/css/bootstrap.css';?>'/>
		<link rel="stylesheet" href='<?php echo base_url().'assets/css/menu_style.css';?>'/>
		<link rel="stylesheet" href='<?php echo base_url().'assets/css/ui-themes/jquery.ui.base.css';?>'/>
		<link rel="stylesheet" href='<?php echo base_url().'assets/css/ui-themes/jquery.ui.theme.css';?>'/>
		<link rel="stylesheet" href='<?php echo base_url().'assets/css/ui-themes/jquery.ui.datepicker.css';?>'/>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/jquery.js';?>'></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/jquery.price.js';?>'></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/bootstrap-modal.js';?>'></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/ui/jquery.ui.core.js';?>'></script>
		<script language="javascript" src="<?php echo base_url()."assets/js/ui/jquery.ui.widget.js";?>"></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/ui/jquery.ui.datepicker.js';?>'></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/jquery.plugin.js';?>'></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/jquery.timeentry.js';?>'></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/all.js';?>'></script>
		<script type="text/javascript" src='<?php echo base_url().'assets/js/ui/jquery.ui.effect.js';?>'></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
			<?php echo $_header;?>
			</div>
			<div id="menu">
			<?php
					$CI =& get_instance();
					$CI->load->library('Template');
				?>
					<ul id="nav">
					<?php
					
						foreach($_menu as $index)
						{
							echo "<ul><li>";
									
									if(!empty($index->url_module))
									{
										echo"
										<a class='ajak' href='".base_url().$index->url_module."'>
											<i class='icon-".$index->icon_module."'></i>".$index->nama_module."
										</a>";
									}
									else 
									{ 
										echo"
										<a class='ajak' href='#'>
											<i class='icon-".$index->icon_module."'></i>&nbsp;".$index->nama_module."
										</a>";
									}
									
							// dropdown pertama
							$sub_menu_1 = $CI->template->sub_menu($index->id_module);
							if($sub_menu_1 != FALSE)
							{
								echo "<ul>";
								foreach($sub_menu_1 as $index_sub_1)
								{
									if(!empty($index_sub_1->url_module))
									{
										echo "<li><a class='ajak' href='".base_url().$index_sub_1->url_module."'>".$index_sub_1->nama_module."</a>";
									}
										else
										{
											echo "<li><a href='#'>".$index_sub_1->nama_module."</a>";
										}

									// dropdown kedua
									$sub_menu_2 = $CI->template->sub_menu($index_sub_1->id_module);
									if($sub_menu_2 != FALSE)
									{
										echo "<ul>";
										foreach($sub_menu_2 as $index_sub_2)
										{	
											if(!empty($index_sub_2->url_module))
											{
												echo "<li><a class='ajak' href='".base_url().$index_sub_2->url_module."'>".$index_sub_2->nama_module."</a></li>";
											}
												else
												{
													echo "<li><a href='#'>".$index_sub_2->nama_module."</a></li>";
												}
										}
										echo "</ul>";
									}
									echo"</li>";
								}

								echo "</ul>";
							}
							
							echo"</li></ul>";
							
						}
						echo "<li><a href='javascript:void();' onclick='logout()'><i class='icon-user icon-white'></i>&nbsp;Keluar</a></li>";
					?>
					</ul>
			</div>
			<div id="content">
				<div class="row-fluid">
					<div class="span12" id='maincontent' style="padding-left:15px; padding-top: 15px;">
						<?php echo $_content;?>
					</div>
				</div>	
			</div>
			<div id='loading'>
				<img src='<?php echo base_url().'assets/image/loading_blue.gif';?>'>
			</div>
			<div id="footer">
				<small>Copyright © 2015 My Software | Developed by : <a href ="#" style='text-decoration:none;' title='BBM : 266F34BB'>Eko Susilo</a></small>
			</div>
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" data-dismiss="modal" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-header">
			        <h3 id="myModalLabel"></h3>
			    </div>
			    <div class="modal-body">  
			    	<p id='isi-modal'></p>        
			    </div>
			</div>
		</div>
		<div style="position:absolute; top:5px; right:5px;">

		<button type='button' class='btn btn-small btn-inverse'><i class='icon-user icon-white'></i>&nbsp;Login sebagai <?php echo $this->session->userdata('level'); ?></button>
		</div>
		<script type='text/javascript'>
			function logout()
			{
				if(confirm('Anda yakin ingin keluar dari sistem?'))
				{
					location.href='<?php echo base_url()."login/logout" ?>';	
				}	
			}
		</script>
	</body>
</html>