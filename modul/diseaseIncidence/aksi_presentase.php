<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
	header('location:index.php');
	exit();
} else {
	?>
	<?php
	session_start();
	include "../../config/koneksi.php";

	$module=$_GET['module'];
	$act=$_GET['act'];

// Hapus pengetahuan
	if ($module=='keparahanpenyakit' AND $act=='hapus'){
		mysql_query("DELETE FROM keparahan_penyakit WHERE id_keparahan='$_GET[id_keparahan]'");
		header('location:../../index.php?module='.$module);
	}

// Input pengetahuan
	elseif ($module=='keparahanpenyakit' AND $act=='input'){
		$jml_sample=$_POST[jml_sample];
		$nilai_skor=$_POST[nilai_skor];
		$total_sample=$_POST[total_sample];
		mysql_query("INSERT INTO keparahan_penyakit(
			jml_sample,nilai_skore,total_sample) 
		VALUES(
			'$jml_sample','$nilai_skor','$total_sample')");
		header('location:../../index.php?module='.$module);
	}

// Update pengetahuan
	elseif ($module=='intensitaskerusakan' AND $act=='update'){
		$jml_sample=$_POST[jml_sample];
		$nilai_skor=$_POST[nilai_skor];
		$total_sample=$_POST[total_sample];
		mysql_query("UPDATE basis_pengetahuan SET
			jml_sample   = '$jml_sample',
			nilai_skor   = '$nilai_skor',

			WHERE id_keparahan       = '$_POST[id_keparahan]'");
		header('location:../../index.php?module='.$module);
	}
	
	?>
	<?php } ?>