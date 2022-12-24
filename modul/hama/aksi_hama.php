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

  $module = $_GET[module];
  $act = $_GET[act];

// Hapus hama
  if ($module == 'hama' AND $act == 'hapus') {
    mysql_query("DELETE FROM hama WHERE kode_hama='$_GET[id]'");
    header('location:../../index.php?module=' . $module);
  }

// Input hama
  elseif ($module == 'hama' AND $act == 'input') {
    $nama_hama = $_POST[nama_hama];
    $det_hama = $_POST[det_hama];
    $srn_hama = $_POST[srn_hama];
    $fileName = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../../gambar/hama/" . $_FILES['gambar']['name']);
    mysql_query("INSERT INTO hama(
			      nama_hama,det_hama,srn_hama,gambar) 
	                       VALUES(
				'$nama_hama','$det_hama','$srn_hama','$fileName')");

    header('location:../../index.php?module=' . $module);
  }

// Update hama
  elseif ($module == 'hama' AND $act == 'update') {
    $nama_hama = $_POST[nama_hama];
    $det_hama = $_POST[det_hama];
    $srn_hama = $_POST[srn_hama];

    $fileName = $_FILES['gambar']['name'];
    if ($fileName) {
      move_uploaded_file($_FILES['gambar']['tmp_name'], "../../gambar/hama/" . $_FILES['gambar']['name']);

      mysql_query("UPDATE hama SET
					nama_hama   = '$nama_hama',
					det_hama   = '$det_hama',
					srn_hama   = '$srn_hama',
                      gambar   = '$fileName'
               WHERE kode_hama       = '$_POST[id]'");
    } else {
      mysql_query("UPDATE hama SET
					nama_hama   = '$nama_hama',
					det_hama   = '$det_hama',
					srn_hama   = '$srn_hama'
               WHERE kode_hama       = '$_POST[id]'");
    }
    header('location:../../index.php?module=' . $module);
  }
  ?>
<?php } ?>