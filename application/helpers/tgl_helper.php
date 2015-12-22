<?php

// mengubah tgl format mySql menjadi dd-mm-yyyy
function dd_mm_yyyy($string='')
{
	if($string == '' || $string == '0000-00-00')
		return '-';

	$pch 	= explode("-", $string);
	$format	= $pch[2]."-".$pch[1]."-".$pch[0];
	
	return $format;
}

function dd_mm_yyyy2($string='')
{
	if($string == '' || $string == '0000-00-00')
		return '0000-00-00';

	$pch 	= explode("-", $string);
	$format	= $pch[2]."-".$pch[1]."-".$pch[0];
	
	return $format;
}

function frmt_indo($string='')
{
	if($string == '' || $string == '0000-00-00')
		return '-';

	$pch 	= explode("-",$string);
	$format	= $pch[2]."/".$pch[1]."/".$pch[0];

	return $format;
}

function tgl_sql($string='')
{
	$tgl = substr($string,0,2);
	$bln = substr($string,3,2);
	$thn = substr($string,6,4);
	
	return $thn."-".$bln."-".$tgl;
}

function tgl($string)
{
	if($string == '' || $string == '0000-00-00')
		return '-';
	
	$tgl = substr($string,8,2);
	$bln = substr($string,5,2);
	$thn = substr($string,0,4);
	
	return $tgl."-".$bln."-".$thn;
}

// mengubah tgl format mySql menjadi dd Januari yyyy
function tgl_indo($string='')
{
	if($string == '' || $string == '0000-00-00')
		return '-';

	$tgl = substr($string,8,2);
	$bln = substr($string,5,2);
	$thn = substr($string,0,4);
	
	switch($bln)
	{
		case "01" : 
			$bulan = "Januari";
		break;
		
		case "02" : 
			$bulan = "Februari";
		break;
		
		case "03" : 
			$bulan = "Maret";
		break;
		
		case "04" : 
			$bulan = "April";
		break;
		case "05" : 
			$bulan = "Mei";
		break;
		
		case "06" : 
			$bulan = "Juni";
		break;
		
		case "07" : 
			$bulan = "Juli";
		break;
		
		case "08" : 
			$bulan = "Agustus";
		break;
		
		case "09" : 
			$bulan = "September";
		break;
		
		case "10" : 
			$bulan = "Oktober";
		break;
		
		case "11" : 
			$bulan = "November";
		break;
		
		case "12" : 
			$bulan = "Desember";
		break;
	}
	
	return $tgl." ".$bulan." ".$thn;
}

function bulan_indo($string='')
{
	if($string == '' || $string == '0000-00-00')
		return '-';

	switch($string)
	{
		case "01" : 
			return "Januari";
		break;
		
		case "02" : 
			return "Februari";
		break;
		
		case "03" : 
			return "Maret";
		break;
		
		case "04" : 
			return "April";
		break;
		case "05" : 
			return "Mei";
		break;
		
		case "06" : 
			return "Juni";
		break;
		
		case "07" : 
			return "Juli";
		break;
		
		case "08" : 
			return "Agustus";
		break;
		
		case "09" : 
			return "September";
		break;
		
		case "10" : 
			return "Oktober";
		break;
		
		case "11" : 
			return "November";
		break;
		
		case "12" : 
			return "Desember";
		break;
	}
	
	return $bulan;
}

function hitung_umur($tgl)
{
	$pecah1 	= explode("-", $tgl);
	$date1 		= $pecah1[2];
	$month1 	= $pecah1[1];
	$year1 		= $pecah1[0];
	// memecah string tanggal akhir untuk mendapatkan

	// tanggal, bulan, tahun
	$pecah2 	= explode("-", date('Y-m-d'));
	$date2 		= $pecah2[2];
	$month2 	= $pecah2[1];
	$year2 		= $pecah2[0];

	// mencari total selisih hari dari tanggal awal dan akhir
	$jd1 = GregorianToJD($month1, $date1, $year1);
	$jd2 = GregorianToJD($month2, $date2, $year2);

	$selisih = $jd2 - $jd1;

	$tahun 	= (int)($selisih/365);
	$bulan 	= (int)(($selisih%365)/30);
	$hari 	= ($selisih%365)%30;

	$tahun 	= $tahun == 0 ? '' : $tahun.' tahun ';
	$bulan 	= $bulan == 0 ? '' : $bulan.' bulan ';

	return $tahun.$bulan.$hari.' hari';	
}

function hitung_lama($tgl_1, $tgl_2, $indo = FALSE)
{
	$pecah1 	= explode("-", $tgl_1);
	$date1 		= ($indo == TRUE) ? $pecah1[0] : $pecah1[2];
	$month1 	= ($indo == TRUE) ? $pecah1[1] : $pecah1[1];
	$year1 		= ($indo == TRUE) ? $pecah1[2] : $pecah1[0];
	// memecah string tanggal akhir untuk mendapatkan

	// tanggal, bulan, tahun
	$pecah2 	= explode("-", $tgl_2);
	$date2 		= ($indo == TRUE) ? $pecah2[0] : $pecah2[2];
	$month2 	= ($indo == TRUE) ? $pecah2[1] : $pecah2[1];
	$year2 		= ($indo == TRUE) ? $pecah2[2] : $pecah2[0];

	// mencari total selisih hari dari tanggal awal dan akhir
	$jd1 = GregorianToJD($month1, $date1, $year1);
	$jd2 = GregorianToJD($month2, $date2, $year2);

	return $jd2 - $jd1;
}

function dropdown_bulan()
{
	$hasil 	= array();

	for($i=1; $i<=12; $i++)
	{
		$hasil[$i] = bulan_indo($i);
	}

	return $hasil;
}

function date_time($string, $date_time = 'date_time', $indo = TRUE)
{
	if($string == '' || $string == '0000-00-00')
		return '0000-00-00';

	$string 	= explode(' ', $string);
	$time 		= explode(':', $string[1]);
	$time 		= $time[0] . ':' . $time[1];
	
	if($date_time == 'date_time')
	{
		if($indo == TRUE)
		 	return tgl_indo($string[0]) . ' / ' . $time;
		else
		 	return tgl($string[0]) . ' / ' . $time;
	} 
	elseif($date_time == 'date')
	{
		if($indo == TRUE)
		 	return tgl_indo($string[0]);
		else
		 	return tgl($string[0]);
	}
	elseif($date_time == 'time')
	{
		return $time;
	}
}

?>
