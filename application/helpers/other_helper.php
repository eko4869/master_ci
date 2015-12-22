<?php

function id_to_name($table, $field, $id, $output_name) 
{
	$db = mysql_query("SELECT ".$output_name." FROM ".$table." WHERE ".$field."='".$id."' LIMIT 1");

	while($db = mysql_fetch_array($db)) 
    {
		return $db[$output_name];
	}
    return '-';
}

function akses_crud($url, $text, $level, $id_module, $tipe, $attr=NULL)
{
    $tipe   = strtolower($tipe);
    $anchor = "<a href='".$url."'  ".$attr.">".$text."</a>";
    $db     = mysql_query("SELECT * FROM user_akses WHERE id_level='".$level."' && id_module='".$id_module."' LIMIT 1");
    $izin   = "";

    while($row = mysql_fetch_array($db)) {
        $izin = $row[$tipe];
    }

    return ($izin == "1") ? $anchor : "";
}

// jika tidak mempunyai izin content di sembunyikan
function akses_form($content, $level, $id_module, $tipe)
{
    $tipe   = strtolower($tipe);
    $db     = mysql_query("SELECT * FROM user_akses WHERE id_level='".$level."' && id_module='".$id_module."' LIMIT 1");
    $izin   = "";

    while($row = mysql_fetch_array($db)) {
        $izin = $row[$tipe];
    }

    return ($izin == "1") ? $content : "";
}

// jika tidak mempunyai izin content di tampilkan
function akses_form_reverse($content, $level, $id_module, $tipe)
{
    $tipe   = strtolower($tipe);
    $db     = mysql_query("SELECT * FROM user_akses WHERE id_level='".$level."' && id_module='".$id_module."' LIMIT 1");
    $izin   = "";

    while($row = mysql_fetch_array($db)) {
        $izin = $row[$tipe];
    }

    return ($izin == "1") ? "&nbsp;" : $content;
}

// function cek mempunyai izin atau tidak
function hak_akses($level, $id_module, $tipe)
{
    $tipe   = strtolower($tipe);
    $db     = mysql_query("SELECT * FROM user_akses WHERE id_level='".$level."' && id_module='".$id_module."' LIMIT 1");
    $izin   = "";

    while($row = mysql_fetch_array($db)) {
        $izin = $row[$tipe];
    }

    return ($izin == "1") ? TRUE : FALSE ;
}

function currency($data)
{
    $currency = 'Rp '.number_format($data,2,",",".");

    return $currency;
}

function title($name, $url_refresh=null)
{
    if(is_array($name))
    {
        $no = 1;
        $ret = '<ul class="breadcrumb">';

        foreach($name as $val)
        {
            $ret .= '<li><b>'.$val.'</b> '.(count($name) != $no ? '<span class="divider">&raquo;&nbsp;</span>' : '').'</li>';
            $no++;
        }

        if($url_refresh != null) {
            $ret .= '<li class="pull-right"><a href="javascript:void(0);" onclick=\'eksekusi("' . $url_refresh . '")\'><i class="icon-repeat"></i>&nbsp;Refresh</a></li>';
        }

        $ret .= '</ul><hr />';

        return $ret;
    }
    else
    {
        return '<ul class="breadcrumb"><li><b>'.$name.'</b></li></ul><hr />';
    }
}

function header_atas($retail=null)
{
    if($retail == null)
    {
        return '<img src="'.base_url().'assets/image/logo.gif" width="500" height="100">
        <hr> ';    
    }
    else
    {
        return '<img src="'.base_url().'assets/image/logo.gif" width="400" height="75">
        <hr> '; 
    }
    
}

function ambil_class($filename = '', $folder = '', $app_folder = 'controllers')
{
    $path = './application/'. $app_folder .'/'. ($folder == '' ? '' : $folder .'/') . strtolower($filename) .'.php';

    if ( ! file_exists($path))
        die('File '. $filename .'.php tidak ditemukan kawan, coba deh. cek penulisannya dan filenya');

    require_once($path);

    $obj = new $filename(false);

    return $obj;
}

function msg($msg)
{
    return str_replace("\n", '\n', strip_tags($msg));
}

/* LAST EDITED 26-MARET-2014 */
?>