<title>Pengetahuan - Certainty Factor V.2</title>
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
			if (text_form.kode_hama.value == "")
			{
				alert("Pilih dulu penyakit !");
				text_form.kode_hama.focus();
				return (false);
			}
			if (text_form.kode_gejala.value == "")
			{
				alert("Pilih dulu gejala !");
				text_form.kode_gejala.focus();
				return (false);
			}
			if (text_form.mb.value == "")
			{
				alert("Isi dulu MB !");
				text_form.mb.focus();
				return (false);
			}
			if (text_form.md.value == "")
			{
				alert("Isi dulu MD !");
				text_form.md.focus();
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
		// -->
	</script>


	<?php
	include "config/fungsi_alert.php";
	$aksi="modul/keparahanpenyakit/keparahanpenyakit.php";
	switch($_GET[act]){
	// Tampil pengetahuan<?php
	include "config/fungsi_alert.php";
	$aksi="modul/keparahanpenyakit/keparahanpenyakit.php";
	switch($_GET[act]){
	// Tampil pengetahuan
		default:
		$offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
		$limit = 15;
		if (empty ($offset)) {
			$offset = 0;
		}
		$tampil=mysql_query("SELECT * FROM basis_pengetahuan_hama   ORDER BY kode_pengetahuan");
		echo "<form method=POST action='?module=pengetahuanHama' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
		
		<br><br>

		<table class='table table-bordered'>
		<tr><td><input class='btn bg-olive margin' type=button name=tambah value='Tambah Basis Pengetahuan' onclick=\"window.location.href='pengetahuanHama/tambahpengetahuan';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Cari   ' name=Go></td> </tr>
		</table>

		</form>";
		$baris=mysql_num_rows($tampil);
		if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM basis_pengetahuan b,hama h where b.kode_hama=h.kode_hama AND h.nama_hama like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
				<h4><i class='icon fa fa-check'></i> Sukses!</h4>
				Pengetahuan yang anda cari di temukan.
				</div>";
				$i = 1;
				echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
				<thead>
				<tr>
				<th>No</th>
				<th>Hama</th>
				<th>Gejala</th>
				<th>MB</th>
				<th>MD</th>
				<th width='21%'>Aksi</th>
				</tr>
				</thead>
				<tbody>"; 
				$hasil = mysql_query("SELECT * FROM basis_pengetahuan_hama b, hama p where b.kode_hama=p.kode_hama AND p.nama_hama like '%$_POST[keyword]%'");
				$no = 1;
				$counter = 1;
				while ($r=mysql_fetch_array($hasil)){
					if ($counter % 2 == 0) $warna = "dark";
					else $warna = "light";
					$sql = mysql_query("SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
					$rgejala=mysql_fetch_array($sql);
					echo "<tr class='".$warna."'>
					<td align=center>$no</td>
					<td>$r[nama_hama]</td>
					<td>$rgejala[nama_gejala]</td>
					<td align=center>$r[mb]</td>
					<td align=center>$r[md]</td>
					<td align=center><a type='button' class='btn btn-success margin' href=pengetahuanHama/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
					<a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuanHama&act=hapus&id=$r[kode_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
					</td></tr>";
					$no++;
					$counter++;
				}
				echo "</tbody></table>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
				<h4><i class='icon fa fa-ban'></i> Gagal!</h4>
				Maaf, Pengetahuan yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
				</div>";
			}
		}else{
			
			if($baris>0){
				echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
				<thead>
				<tr>
				<th>No</th>
				<th>Hama</th>
				<th>Gejala</th>
				<th>MB</th>
				<th>MD</th>
				<th width='21%'>Aksi</th>
				</tr>
				</thead>
				<tbody>
				"; 
				$hasil = mysql_query("SELECT * FROM basis_pengetahuan_hama ORDER BY kode_pengetahuan limit $offset,$limit");
				$no = 1;
				$no = 1 + $offset;
				$counter = 1;
				while ($r=mysql_fetch_array($hasil)){
					if ($counter % 2 == 0) $warna = "dark";
					else $warna = "light";
					$sql = mysql_query("SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
					$rgejala=mysql_fetch_array($sql);
					$sql2 = mysql_query("SELECT * FROM hama where kode_hama = '$r[kode_hama]'");
					$rpenyakit=mysql_fetch_array($sql2);
					echo "<tr class='".$warna."'>
					<td align=center>$no</td>
					<td>$rpenyakit[nama_hama]</td>
					<td>$rgejala[nama_gejala]</td>
					<td align=center>$r[mb]</td>
					<td align=center>$r[md]</td>
					<td align=center>
					<a type='button' class='btn btn-success margin' href=pengetahuanHama/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
					<a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuanHama&act=hapus&id=$r[kode_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
					<i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
					</td></tr>";
					$no++;
					$counter++;
				}
				echo "</tbody></table>";
				echo "<div class=paging>";

				if ($offset!=0) {
					$prevoffset = $offset-10;
					echo "<span class=prevnext> <a href=index.php?module=pengetahuanHama&offset=$prevoffset>Back</a></span>";
				}
				else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			echo "<a href=index.php?module=pengetahuanHama&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}

		default:
		$offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
		$limit = 15;
		if (empty ($offset)) {
			$offset = 0;
		}
		$tampil=mysql_query("SELECT * FROM basis_pengetahuan_hama   ORDER BY kode_pengetahuan");
		echo "<form method=POST action='?module=pengetahuanHama' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
		
		<br><br>

		<table class='table table-bordered'>
		<tr><td><input class='btn bg-olive margin' type=button name=tambah value='Tambah Basis Pengetahuan' onclick=\"window.location.href='pengetahuanHama/tambahpengetahuan';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Cari   ' name=Go></td> </tr>
		</table>

		</form>";
		$baris=mysql_num_rows($tampil);
		if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM basis_pengetahuan b,hama h where b.kode_hama=h.kode_hama AND h.nama_hama like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
				<h4><i class='icon fa fa-check'></i> Sukses!</h4>
				Pengetahuan yang anda cari di temukan.
				</div>";
				$i = 1;
				echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
				<thead>
				<tr>
				<th>No</th>
				<th>Hama</th>
				<th>Gejala</th>
				<th>MB</th>
				<th>MD</th>
				<th width='21%'>Aksi</th>
				</tr>
				</thead>
				<tbody>"; 
				$hasil = mysql_query("SELECT * FROM basis_pengetahuan_hama b, hama p where b.kode_hama=p.kode_hama AND p.nama_hama like '%$_POST[keyword]%'");
				$no = 1;
				$counter = 1;
				while ($r=mysql_fetch_array($hasil)){
					if ($counter % 2 == 0) $warna = "dark";
					else $warna = "light";
					$sql = mysql_query("SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
					$rgejala=mysql_fetch_array($sql);
					echo "<tr class='".$warna."'>
					<td align=center>$no</td>
					<td>$r[nama_hama]</td>
					<td>$rgejala[nama_gejala]</td>
					<td align=center>$r[mb]</td>
					<td align=center>$r[md]</td>
					<td align=center><a type='button' class='btn btn-success margin' href=pengetahuanHama/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
					<a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuanHama&act=hapus&id=$r[kode_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
					</td></tr>";
					$no++;
					$counter++;
				}
				echo "</tbody></table>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
				<h4><i class='icon fa fa-ban'></i> Gagal!</h4>
				Maaf, Pengetahuan yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
				</div>";
			}
		}else{
			
			if($baris>0){
				echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
				<thead>
				<tr>
				<th>No</th>
				<th>Hama</th>
				<th>Gejala</th>
				<th>MB</th>
				<th>MD</th>
				<th width='21%'>Aksi</th>
				</tr>
				</thead>
				<tbody>
				"; 
				$hasil = mysql_query("SELECT * FROM basis_pengetahuan_hama ORDER BY kode_pengetahuan limit $offset,$limit");
				$no = 1;
				$no = 1 + $offset;
				$counter = 1;
				while ($r=mysql_fetch_array($hasil)){
					if ($counter % 2 == 0) $warna = "dark";
					else $warna = "light";
					$sql = mysql_query("SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
					$rgejala=mysql_fetch_array($sql);
					$sql2 = mysql_query("SELECT * FROM hama where kode_hama = '$r[kode_hama]'");
					$rpenyakit=mysql_fetch_array($sql2);
					echo "<tr class='".$warna."'>
					<td align=center>$no</td>
					<td>$rpenyakit[nama_hama]</td>
					<td>$rgejala[nama_gejala]</td>
					<td align=center>$r[mb]</td>
					<td align=center>$r[md]</td>
					<td align=center>
					<a type='button' class='btn btn-success margin' href=pengetahuanHama/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
					<a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuanHama&act=hapus&id=$r[kode_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
					<i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
					</td></tr>";
					$no++;
					$counter++;
				}
				echo "</tbody></table>";
				echo "<div class=paging>";

				if ($offset!=0) {
					$prevoffset = $offset-10;
					echo "<span class=prevnext> <a href=index.php?module=pengetahuanHama&offset=$prevoffset>Back</a></span>";
				}
				else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			echo "<a href=index.php?module=pengetahuanHama&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}
