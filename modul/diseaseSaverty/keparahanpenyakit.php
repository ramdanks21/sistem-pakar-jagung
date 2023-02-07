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
			if (text_form.luas_daun_terserang.value == "")
			{
				alert("Nama hama tidak boleh kosong !");
				text_form.luas_daun_terserang.focus();
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
	$aksi = "modul/diseaseSaverty/aksi_keparahan.php";
	switch ($_GET['act']) {
    // Tampil hama
		default:
		$offset = $_GET['offset'];
      //jumlah data yang ditampilkan perpage
		$limit = 15;
		if (empty($offset)) {
			$offset = 0;
		}
		$tampil = mysql_query("SELECT * FROM keparahan_penyakit ORDER BY id_keparahan");
		echo "<form method=POST action='?module=diseaseSaverty' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
		<br><br><table class='table table-bordered'>
		<tr><td><input class='btn bg-olive margin' type=button name=tambah value='Tambah hama' onclick=\"window.location.href='diseaseSaverty/tambahkeparahan';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Cari   ' name=Go></td> </tr>
		</table></form>";
		$baris = mysql_num_rows($tampil);
		if ($_POST['Go']) {
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM keparahan_penyakit where rekomendasi like '%$_POST[keyword]%'"));
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
				<th>Luas Daun Terserang</th>
				<th>Skor</th>
				<th>Jumlah Daun Skor Sama</th>
				<th>Rekomendasi</th>
				<th>Aksi</th>
				</tr>
				</thead>
				<tbody>";
				$hasil = mysql_query("SELECT * FROM keparahan_penyakit where rekomendasi like '%$_POST[keyword]%'");
				$no = 1;
				$counter = 1;
				while ($r = mysql_fetch_array($hasil)) {
					if ($counter % 2 == 0)
						$warna = "dark";
					else
						$warna = "light";
					echo "<tr class='" . $warna . "'>

					<td align=center>$no</td>
					<td>$r[luas_daun_terserang]</td>
					<td>$r[skor]</td>
					<td>$r[jml_daun_skor_sama]</td>
					<td>$r[rekomendasi]</td>


					<td align=center><a type='button' class='btn btn-block btn-success' href=diseaseSaverty/editkeparahan/$r[id_keparahan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;

					<a type='button' class='btn btn-block btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=diseaseSaverty&act=hapus&id=$r[id_keparahan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"> <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
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
				<th>L.DaunTerserang</th>
				<th>Skor</th>
				<th>Jumlah Daun Dengan Skor Sama</th>
				<th>Rekomendasi</th>
				<th>Aksi</th>



				</tr>
				</thead>
				<tbody>
				";
				$hasil = mysql_query("SELECT * FROM keparahan_penyakit ORDER BY id_keparahan limit $offset,$limit");
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
					<td>$r[luas_daun_terserang]</td>
					<td>$r[skor]</td>
					<td>$r[jml_daun_skor_sama]</td>
					<td>$r[rekomendasi]</td>
					<td align=center>

					<a type='button' class='btn btn-block btn-success' href=diseaseSaverty/editkeparahan/$r[id_keparahan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;

					<a type='button' class='btn btn-block btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=diseaseSaverty&act=hapus&id=$r[id_keparahan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">

					<i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
					</td></tr>";

					$no++;
					$counter++;
				}
				echo "</tbody></table>";
				echo "<div class=paging>";

				if ($offset != 0) {
					$prevoffset = $offset - 10;
					echo "<span class=prevnext> <a href=index.php?module=diseaseSaverty&offset=$prevoffset>Back</a></span>";
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
          		echo "<a href=index.php?module=diseaseSaverty&offset=$newoffset>$i</a>";
              //cetak halaman
          	} else {
              echo "<span class=current>" . $i . "</span>"; //cetak halaman tanpa link
            }
          }

          //cek halaman akhir
          if (!(($offset / $limit) + 1 == $halaman) && $halaman != 1) {

            //jika bukan halaman terakhir maka berikan next
          	$newoffset = $offset + $limit;
          	echo "<span class=prevnext><a href=index.php?module=diseaseSaverty&offset=$newoffset>Next</a>";
          } else {
            echo "<span class=disabled>Next</span>"; //cetak halaman tanpa link
          }

          echo "</div>";
        } else {
        	echo "<br><b>Data Kosong !</b>";
        }
      }
      break;


      case "tambahkeparahan":
      echo "<form name=text_form method=POST action='$aksi?module=diseaseSaverty&act=input' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
      <br><br><table class='table table-bordered'>


      <tr>
      <td width=120>Luas Daun Terserang</td>
      <td>
      <input autocomplete='off' type=text placeholder='Masukkan hama baru...' class='form-control' name='luas_daun_terserang' size=30>
      </td>
      </tr>

      <tr>
      <td width=120>Skor</td>
      <td>
      <input autocomplete='off' type=text placeholder='Masukkan hama baru...' class='form-control' name='skor' size=30>
      </td>
      </tr>

      <tr>
      <td width=120>Jumlah Daun Terserang</td>
      <td>
      <input autocomplete='off' type=text placeholder='Masukkan hama baru...' class='form-control' name='jml_daun_skor_sama' size=30>
      </td>
      </tr>

      <tr>
      <td width=120>Rekomendasi</td>
      <td>
      <input autocomplete='off' type=text placeholder='Masukkan hama baru...' class='form-control' name='rekomendasi' size=30>
      </td>
      </tr>



      <tr><td></td><td><input class='btn btn-danger' type=submit name=submit value='Simpan' >


      <input class='btn btn-success' type=button name=batal value='Batal' onclick=\"window.location.href='?module=diseaseSaverty';\"></td></tr>
      </table></form>";
      break;



      case "editkeparahan":
      $edit = mysql_query("SELECT * FROM keparahan_penyakit WHERE id_keparahan='$_GET[id]'");
      $r = mysql_fetch_array($edit);
      // if ($r['gambar']) {
      // 	$gambar = 'gambar/hama/' . $r['gambar'];
      // } else {
      // 	$gambar = 'gambar/noimage.png';
      // }

      echo "<form name=text_form method=POST action='$aksi?module=diseaseSaverty&act=update' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
      <input type=hidden name=id_keparahan value='$r[id_keparahan]'>
      <br><br><table class='table table-bordered'>
      <tr><td width=120>Luas Daun Terserang</td><td><input autocomplete='off' type=text class='form-control' name='luas_daun_terserang' size=30 value=\"$r[luas_daun_terserang]\"></td></tr>
      <tr><td width=120>SKor</td><td><textarea rows='4' cols='50' type=text class='form-control' name='skor'>$r[skor]</textarea></td></tr>

      <tr><td width=120>Jumlah Daun Skor Sama</td><td><textarea rows='4' cols='50' type=text class='form-control' name='jml_daun_skor_sama'>$r[jml_daun_skor_sama]</textarea></td></tr>

      <tr><td width=120>Rekomendasi</td><td><textarea rows='4' cols='50' type=text class='form-control' name='rekomendasi'>$r[rekomendasi]</textarea></td></tr>

      <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpasn' >

      <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=diseaseSaverty';\"></td></tr>
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
