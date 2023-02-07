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
	if ($module=='diseaseSaverty' AND $act=='hapus'){
		mysql_query("DELETE FROM keparahan_penyakit WHERE id_keparahan='$_GET[id_keparahan]'");
		header('location:../../index.php?module='.$module);
	}

// Input pengetahuan
	elseif ($module=='diseaseSaverty' AND $act=='input'){

		$jml_sample=$_POST[luas_daun_terserang];
		$nilai_skor=$_POST[skor];
		$total_sample=$_POST[jml_daun_skor_sama];
		$rekomendasi=$_POST[rekomendasi];

		// INSERT INTO `keparahan_penyakit` (`id_keparahan`, `luas_daun_terserang`, `skor`, `jml_daun_skor_sama`, `rekomendasi`) VALUES (NULL, '12', '12', '12', 'halah');




		mysql_query("INSERT INTO `keparahan_penyakit`(
			id_keparahan,luas_daun_terserang,skor,jml_daun_skor_sama,rekomendasi) 
		VALUES(
			NULL,'$jml_sample','$nilai_skor','$total_sample','$rekomendasi')");
		header('location:../../index.php?module='.$module);


		// mysql_query("INSERT INTO keparahan_penyakit(
		// 	luas_daun_terserang,skor,jml_daun_skor_sama,rekomendasi) 
		// VALUES(
		// 	'$jml_sample','$nilai_skor','$total_sample','$rekomendasi')");
		// header('location:../../index.php?module='.$module);
		
		


	}

// Update pengetahuan
	elseif ($module=='diseaseSaverty' AND $act=='update'){
		$jml_sample=$_POST[luas_daun_terserang];
		$nilai_skor=$_POST[skor];
		$total_sample=$_POST[jml_daun_skor_sama];
		$rekomendasi=$_POST[rekomendasi];

		mysql_query("UPDATE keparahan_penyakit SET
			luas_daun_terserang   = '$jml_sample',
			skor   = '$nilai_skor',
			jml_daun_skor_sama   = '$total_sample',
			rekomendasi   = '$rekomendasi',
			WHERE id_keparahan= '$_POST[id_keparahan]'");
		
		header('location:../../index.php?module='.$module);
	}
	
	?>
	<?php } ?>