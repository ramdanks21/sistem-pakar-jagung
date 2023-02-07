<title>Hama - Certainty Factor V.2</title>

<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
  header('location:index.php');
  exit();
} else {
  ?>
  <script type="text/javascript">
    function Blank_TextField_Validator()
    {
      if (text_form.nama_hama.value == "")
      {
        alert("Nama hama tidak boleh kosong !");
        text_form.nama_hama.focus();
        return (false);
      }
      return (true);
    }
    function Blank_TextField_Validator_Cari()
    {
      if (text_form.keyword.value == "")
      {
        alert("Isi dulu keyword pencarian !");
        text_form.keyword.focus();
        return (false);
      }
      return (true);
    }
  </script>
  <?php

  include "config/fungsi_alert.php";
  $aksi = "modul/hama/aksi_hama.php";
  switch ($_GET['act']) {
    // Tampil hama
    default:
    $offset = $_GET['offset'];
      //jumlah data yang ditampilkan perpage
    $limit = 15;
    if (empty($offset)) {
      $offset = 0;
    }
    $tampil = mysql_query("SELECT * FROM hama ORDER BY kode_hama");
    echo "<form method=POST action='?module=hama' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
    <br><br><table class='table table-bordered'>
    <tr><td><input class='btn bg-olive margin' type=button name=tambah value='Tambah hama' onclick=\"window.location.href='hama/tambahhama';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Cari   ' name=Go></td> </tr>
    </table></form>";
    $baris = mysql_num_rows($tampil);
    if ($_POST['Go']) {
      $numrows = mysql_num_rows(mysql_query("SELECT * FROM hama where nama_hama like '%$_POST[keyword]%'"));
      if ($numrows > 0) {
        echo "<div class='alert alert-success alert-dismissible'>
        <h4><i class='icon fa fa-check'></i> Sukses!</h4>
        hama yang anda cari di temukan.
        </div>";
        $i = 1;
        echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
        <thead>
        <tr>
        <th>No</th>
        <th>Nama Hama</th>
        <th>Detail Hama</th>
        <th>Pengendalian</th>
        <th>Aksi</th>
        </tr>
        </thead>
        <tbody>";
        $hasil = mysql_query("SELECT * FROM hama where nama_hama like '%$_POST[keyword]%'");
        $no = 1;
        $counter = 1;
        while ($r = mysql_fetch_array($hasil)) {
          if ($counter % 2 == 0)
            $warna = "dark";
          else
            $warna = "light";
          echo "<tr class='" . $warna . "'>
          <td align=center>$no</td>
          <td>$r[nama_hama]</td>
          <td>$r[det_hama]</td>
          <td>$r[srn_hama]</td>
          <td align=center><a type='button' class='btn btn-block btn-success' href=hama/edithama/$r[kode_hama]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
          <a type='button' class='btn btn-block btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=hama&act=hapus&id=$r[kode_hama]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"> <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
          </td></tr>";
          $no++;
          $counter++;
        }
        echo "</tbody></table>";
      }
      else {
        echo "<div class='alert alert-danger alert-dismissible'>
        <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
        Maaf, Hama yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
        </div>";
      }
    } else {

      if ($baris > 0) {
        echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
        <thead>
        <tr>
        <th>No</th>
        <th>Nama Hama</th>
        <th>Detail Hama</th>
        <th>Pengendalian</th>
        <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        ";
        $hasil = mysql_query("SELECT * FROM hama ORDER BY kode_hama limit $offset,$limit");
        $no = 1;
        $no = 1 + $offset;
        $counter = 1;
        while ($r = mysql_fetch_array($hasil)) {
          if ($counter % 2 == 0)
            $warna = "dark";
          else
            $warna = "light";
          echo "<tr class='" . $warna . "'>
          <td align=center>$no</td>
          <td>$r[nama_hama]</td>
          <td>$r[det_hama]</td>
          <td>$r[srn_hama]</td>
          <td align=center>
          
          <a type='button' class='btn btn-block btn-success' href=hama/edithama/$r[kode_hama]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
          <a type='button' class='btn btn-block btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=hama&act=hapus&id=$r[kode_hama]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
          <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
          </td></tr>";
          $no++;
          $counter++;
        }
        echo "</tbody></table>";
        echo "<div class=paging>";

        if ($offset != 0) {
          $prevoffset = $offset - 10;
          echo "<span class=prevnext> <a href=index.php?module=hama&offset=$prevoffset>Back</a></span>";
        } else {
            echo "<span class=disabled>Back</span>"; //cetak halaman tanpa link
          }
          //hitung jumlah halaman
          $halaman = intval($baris / $limit); //Pembulatan

          if ($baris % $limit) {
            $halaman++;
          }
          for ($i = 1; $i <= $halaman; $i++) {
            $newoffset = $limit * ($i - 1);
            if ($offset != $newoffset) {
              echo "<a href=index.php?module=hama&offset=$newoffset>$i</a>";
              //cetak halaman
            } else {
              echo "<span class=current>" . $i . "</span>"; //cetak halaman tanpa link
            }
          }

          //cek halaman akhir
          if (!(($offset / $limit) + 1 == $halaman) && $halaman != 1) {

            //jika bukan halaman terakhir maka berikan next
            $newoffset = $offset + $limit;
            echo "<span class=prevnext><a href=index.php?module=hama&offset=$newoffset>Next</a>";
          } else {
            echo "<span class=disabled>Next</span>"; //cetak halaman tanpa link
          }

          echo "</div>";
        } else {
          echo "<br><b>Data Kosong !</b>";
        }
      }
      break;

      case "tambahhama":
      echo "<form name=text_form method=POST action='$aksi?module=hama&act=input' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
      <br><br><table class='table table-bordered'>
      <tr><td width=120>Nama hama</td><td><input autocomplete='off' type=text placeholder='Masukkan hama baru...' class='form-control' name='nama_hama' size=30></td></tr>
      <tr><td width=120>Detail hama</td><td> <textarea rows='4' cols='50' class='form-control' name='det_hama'type=text placeholder='Masukkan detail hama baru...'></textarea></td></tr>
      <tr><td width=120>Pengendalian</td><td><textarea rows='4' cols='50' class='form-control' name='srn_hama'type=text placeholder='Masukkan Pengendalian baru...'></textarea></td></tr>
      <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input type='file' class='form-control' name='gambar' required /></td></tr>		  
      <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
      <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=hama';\"></td></tr>
      </table></form>";
      break;

      case "edithama":
      $edit = mysql_query("SELECT * FROM hama WHERE kode_hama='$_GET[id]'");
      $r = mysql_fetch_array($edit);
      if ($r['gambar']) {
        $gambar = 'gambar/hama/' . $r['gambar'];
      } else {
        $gambar = 'gambar/noimage.png';
      }

      echo "<form name=text_form method=POST action='$aksi?module=hama&act=update' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
      <input type=hidden name=id value='$r[kode_hama]'>
      <br><br><table class='table table-bordered'>
      <tr><td width=120>Nama hama</td><td><input autocomplete='off' type=text class='form-control' name='nama_hama' size=30 value=\"$r[nama_hama]\"></td></tr>
      <tr><td width=120>Detail hama</td><td><textarea rows='4' cols='50' type=text class='form-control' name='det_hama'>$r[det_hama]</textarea></td></tr>
      <tr><td width=120>Pengendalian</td><td><textarea rows='4' cols='50' type=text class='form-control' name='srn_hama'>$r[srn_hama]</textarea></td></tr>
      <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input id='upload' type='file' class='form-control' name='gambar' required /></td></tr>
      <tr><td></td><td><img id='preview' src='$gambar' width=200></td></tr>          
      <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
      <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=hama';\"></td></tr>
      </table></form>";
      break;
    }
    ?>
  <?php } ?>

  <script>
    function readURL(input) {

      if (input.files &&
        input.files[0]) {
        var reader = new FileReader();
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#upload").change(function () {
    readURL(this);
  });




</script>
