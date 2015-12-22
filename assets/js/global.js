$(function(){    
  $( ".datepicker" ).datepicker({
    changeMonth: true,
    changeYear: true,
    cache: false,
    dateFormat : "dd-mm-yy"
  });

  $(document).ajaxStart(function(){
    $("#pageload").show();
  });

  $(document).ajaxStop(function(){
    $("#pageload").hide();
  });
});

var loading   = '<img src="'+site+'assets/loading.gif" style="margin-top:-3px;"> Loading Data ..';

function ajax_modals(title, dta, address) {
  $('#myModalLabel').text(title);
  $('#modal-teks').html(loading);
  $('#myModal').modal('show');
  $.ajax({
    type:'POST', data:dta, url:site+address, success:function(i){
      $('#modal-teks').html(i);
    }
  });
}

function test_countdown(bid)
{
  $.ajax({
    type:'POST', data:'', url:site+'hal_dpn/pendaftaran/countdown', success:function(datas){
      if(datas == 'timeup')
      {
        var dta=$('form').serialize();
        $.ajax({
          type:'POST',
          data:dta,
          url:$('form').attr('action'),
          success:function(i){
            var pch = i.split('|||||');
            if(pch[0] == 'yuhu')
            {
              alert("Waktu anda habis !!");
              location.href=site + 'hal_dpn/pendaftaran/hasil/detail/' + pch[1];
            }
          }
        });
      }
      else
      {
        $("#" + bid).html(datas);
      }
    }
  });
  
}
  
function ajax_data(dta, address) {
  var result = "";
  $.ajax({
    type:'POST', data:dta, url:site+address, async:false, success:function(datas){
      result = datas;
    }
  });
  return result;
}
function eksekusi(url, bid, dta) {

  $.ajax({
    type:'POST', data:dta, url:site+url, success:function(i) {
      $("#"+bid).html(i);
      if(window.location != site+url) {
        window.history.pushState({path: "+window.location+"}, "", site+url);
      }

    }
  });
}

function aksi(url, bid, dta) {
  $.ajax({
    type:'POST', data:dta, url:site+url, success:function(i) {
      $("#"+bid).html(i);
    }
  });
}

function tampil(url, tampil) {
  $("#"+tampil).load(site+url);

  if(window.location != site+url) {
    window.history.pushState({path: "+window.location+"}, "", site+url);
  }
}

function submit_form(formId, bidLoading) {
  if(formId != undefined) {
    var dta = $("#"+formId).serialize();
    var url_address = $("#"+formId).attr('action');
  } else {
    var dta = $('form').serialize();
    var url_address = $('form').attr('action');
  }

  $('#'+bidLoading).html(loading);

  $.ajax({
    type:'POST',
    data:dta,
    url:url_address,
    success:function(i) {
      var pch = i.split("|||||");

      if(pch[0] == 'sukses') {

        $('#primarycontent').html(pch[1]);
        $('#myModal').modal('hide');

      } else {

        alert(pch[0]);

      }

      $('#'+bidLoading).html('');
    }
  });
}