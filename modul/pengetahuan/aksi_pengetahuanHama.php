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
	if ($module=='pengetahuanHama' AND $act=='hapus'){
		mysql_query("DELETE FROM basis_pengetahuan_hama WHERE kode_pengetahuan='$_GET[id]'");
		header('location:../../index.php?module='.$module);
	}

	

// Input pengetahuan
	elseif ($module=='pengetahuanHama' AND $act=='input'){
		$kode_hama=$_POST['kode_hama'];
		$kode_gejala=$_POST['kode_gejala'];
		$mb=$_POST['mb'];
		$md=$_POST['md'];
		mysql_query("INSERT INTO basis_pengetahuan_hama(
			kode_hama,kode_gejala,mb,md) 
		VALUES(
			'$kode_hama','$kode_gejala','$mb','$md')");
		header('location:../../index.php?module='.$module);
	}



// Update pengetahuan
	elseif ($module=='pengetahuanHama' AND $act=='update'){
		$kode_hama=$_POST['kode_hama'];
		$kode_gejala=$_POST['kode_gejala'];
		$mb=$_POST['mb'];
		$md=$_POST['md'];
		mysql_query("UPDATE basis_pengetahuan_hama SET
			kode_hama   = '$kode_hama',
			kode_gejala   = '$kode_gejala',
			mb   = '$mb',
			md   = '$md'
			WHERE kode_pengetahuan    = '$_POST[id]'");
		header('location:../../index.php?module='.$module);
	}

	?>
	<?php } ?>