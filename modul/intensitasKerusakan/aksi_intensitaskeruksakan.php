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
	if ($module=='intensitasKerusakan' AND $act=='hapus'){
		mysql_query("DELETE FROM rekomendasi WHERE id_keparahan='$_GET[id]'");
		header('location:../../index.php?module='.$module);
	}

// Input pengetahuan
	elseif ($module=='intensitasKerusakan' AND $act=='input'){

		$rekomendasi=$_POST[rekomendasi];


		mysql_query("INSERT INTO `rekomendasi`(
			id_keparahan,rekomendasi) 
		VALUES(
			NULL,'$rekomendasi')");
		header('location:../../index.php?module='.$module);

	}




// Update pengetahuan
	elseif ($module=='intensitasKerusakan' AND $act=='update'){
		$rekomendasi=$_POST[rekomendasi];

		mysql_query("UPDATE rekomendasi SET
			rekomendasi   = '$rekomendasi'
			WHERE id_keparahan= '$_POST[id]'");

		header('location:../../index.php?module='.$module);
	}

	?>
	<?php } ?>