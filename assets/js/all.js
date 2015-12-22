$(function(){

	$("#loading").hide();
	$("#logout").show();

	$( ".datepicker" ).datepicker({
	    changeMonth: true,
	    changeYear: true,
	    cache: false,
	    dateFormat : "dd-mm-yy"
	  });

	$(".timeentry").timeEntry({
	  	show24Hours: true,
	  	showSeconds: true
	  });
	$(document).ajaxStart(function(){
		$("#loading").show();
		
	});
	$(document).ajaxStop(function(){
		$("#loading").hide();
	
    	$( ".datepicker" ).datepicker({
		    changeMonth: true,
		    changeYear: true,
		    cache: false,
		    dateFormat : "dd-mm-yy"
		  });
    	
    	$(".timeentry").timeEntry({
		  	show24Hours: true,
		  	showSeconds: true
	  });
  	});
	$('.ajak').on('click',function(e){

		e.preventDefault();
		var hal = $(this).attr('href');

		$.ajax({
			url : hal,
			type: 'POST',
			data:null,
			success:function(i)
			{
				$('#maincontent').html(i);
				if(window.location != hal)
				 {
        			window.history.pushState({path: "+window.location+"}, "", hal);
      			 }
			}
		});
	});

	$(window).bind("popstate",function(){
		$.ajax({
			url    : location.pathname,
			type   :'GET',
			success:function(i)
			{
				$("#maincontent").html(i);
			}
		})
	})
});
function ajax_link(hal,ref)
{
	$.ajax({
			url    : hal,
			type   :'POST',
			data   :null,
			success:function(i)
			{
				if(ref == undefined)
				{
					$('#maincontent').html(i);
				}
				else
				{
					$('#'+ref).html(i);
				}
				if(window.location != hal)
				 {
        			window.history.pushState({path: "+window.location+"}, "", hal);
      			 }
			}
		});	
}
function ajax_sort(hal,ref)
{
	$.ajax({
			url    : hal,
			type   :'POST',
			data   :null,
			success:function(i)
			{
				if(ref == undefined)
				{
					$('#maincontent').html(i);
				}
				else
				{
					$('#'+ref).html(i);
				}
				
			}
		});	
}
function hapus(site,no,ref)
{
	$.ajax({
			url    : site+no,
			type   :'POST',
			data   :null,
			success:function(i)
			{
				$('#tr_'+ref).html(i);
			}
		});
}
function hapus_conf(site,no,ref)
{
	if(confirm('Anda yakin ingin menghapus data ini?'))
	{
		$.ajax({
			url    : site+no,
			type   :'POST',
			data   :null,
			success:function(i)
			{
				$('#tr_'+ref).html(i);
			}
		});
	}
}
function ajax_simpan_edit(dat,site,ref)
 {
	if(confirm('Anda Yakin?'))
	{
		$.ajax({
			url    : site,
			type   :"POST",
			data   :dat,
			success:function(i)
			{
				if(i=='ok')
				{
					ajax_link(ref);
					
				}
				else
				{
					alert(i);
				}
				
			}
		});
	}
 	
 } 
 function ajax_simpan_edit_modal(dat,site,ref)
 {
 	$.ajax({
			url    : site,
			type   :"POST",
			data   :dat,
			success:function(i)
			{
				if(i=='ok')
				{
					
					$('#myModal').modal('hide');
					//ajax_link(ref);
					location.href=ref;
				}
				else
				{
					alert(i);
				}
				
			}
		});
 } 
 function ajax_modal(site,at)
 {
 	
 	if(at != undefined)
 	{
 		$('#myModal').attr('style',at);	
 	}
 	else
 	{
 		$('#myModal').removeAttr('style');	
 	}

 	$('#myModal').modal('show');
 	

 	$.ajax({
 		url:site,
 		data:null,
 		success:function(i)
 		{
 			$('#isi-modal').html(i);
 		}
 	})
 }
