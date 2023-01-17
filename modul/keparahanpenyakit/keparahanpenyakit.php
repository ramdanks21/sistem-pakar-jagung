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
	$aksi="modul/pengetahuan/aksi_pengetahuanHama.php";
	switch($_GET[act]){
	// Tampil pengetahuan
		default:
		$offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
		$limit = 15;
		if (empty ($offset)) {
			$offset = 0;
		}
		$tampil=mysql_query("SELECT * FROM keparahan_penyakit   ");
		echo "<form method=POST action='?module=pengetahuanHama' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
		<br><br><table class='table table-bordered'>
		<tr><td><input class='btn bg-olive margin' type=button name=tambah value='Tambah Basis Pengetahuan' onclick=\"window.location.href='keparahanpenyakit/keparahanakibatpenyakit';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Ketik dan tekan cari...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Cari   ' name=Go></td> </tr>
		</table></form>";
		$baris=mysql_num_rows($tampil);
		if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM keparahan_penyakit"));
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
				$hasil = mysql_query("SELECT * FROM keparahan_penyakit ");
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
				<th>Jumlah Sample</th>
				<th>Nilai Skor</th>
				<th>Jumlah Totoal Sampe Di Amati</th>
				<th>Nilai Skor Tertinggi</th>
				<th width='21%'>Aksi</th>
				</tr>
				</thead>
				<tbody>
				"; 
				$hasil = mysql_query("SELECT * FROM keparahan_penyakit ORDER BY id_keparahan limit $offset,$limit");
				$no = 1;
				$no = 1 + $offset;
				$counter = 1;
				while ($r=mysql_fetch_array($hasil)){
					if ($counter % 2 == 0) $warna = "dark";
					else $warna = "light";
					$sql = mysql_query("SELECT * FROM keparahan_penyakit");
					$rgejala=mysql_fetch_array($sql);
					$sql2 = mysql_query("SELECT * FROM keparahan_penyakit ");
					$rpenyakit=mysql_fetch_array($sql2);
					echo "<tr class='".$warna."'>
					<td align=center>$no</td>
					<td>$rpenyakit[jml_sample]</td>
					<td>$rgejala[nilai_skor]</td>
					<td align=center>$r[total_sample]</td>
					<td align=center>$r[total_sample]</td>
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

	//cek halaman akhir
	if(!(($offset/$limit)+1==$halaman) && $halaman !=1){

		//jika bukan halaman terakhir maka berikan next
		$newoffset = $offset + $limit;
		echo "<span class=prevnext><a href=index.php?module=pengetahuanHama&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
}else{
	echo "<br><b>Data Kosong !</b>";
}
}
break;

case "keparahanakibatpenyakit":
echo "	<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
<h5>
Petunjuk pengisian
</h5>
<table class='table  text-white'>
<thead>
<th>Skor</th>
<th>Kisaran Intensitas Penyakit %</th>
<th>Kategori</th>
</thead>
<tbody style='color:white'>
<tr>
<td>0 (Tidak Terserang)</td>
<td>Tidak Ada penyakit</td>
<td>Tidak Terserang</td>
</tr>

<tr>
<td> 1 (Sangant rendah)</td>
<td> < 20</td>
<td> Intensitas sangat rendah </td>
</tr>

<tr>
<td> 2 (Rendah)</td>
<td> 20 - 40 </td>
<td> Intensitas  Rendah</td>
</tr>

<tr>
<td> 3 (Sedang)</td>
<td> 40 -60 </td>
<td> Intensitas sedang</td>
</tr>

<tr>
<td> 4 (Tinggi)</td>
<td> 60 - 80 </td>
<td> Intensitas Tinggi</td>
</tr>

<tr>
<td> 5 (Sangat tinggi)</td>
<td>  80 - 100 </td>
<td> Sangat tinggi</td>
</tr>
</tbody>
</table>

</div>





<form name=text_form method=POST action='$aksi?module=pengetahuanHama&act=input' onsubmit='return Blank_TextField_Validator()'>
<br><br><table class='table table-bordered'>
<tr><td width=120>Jm Sampel</td><td><select class='form-control' name='kode_hama'  id='kode_hama'><option value=''>- Pilih Hama -</option>";
$hasil4 = mysql_query("SELECT * FROM hama order by nama_hama");
while($r4=mysql_fetch_array($hasil4)){
	echo "<option value='$r4[kode_hama]'>$r4[nama_hama]</option>";
}
echo	"</select></td></tr>
<tr><td>Gejala</td><td><select class='form-control' name='kode_gejala' id='kode_gejala'><option value=''>- Pilih Gejala -</option>";
$hasil4 = mysql_query("SELECT * FROM gejala order by nama_gejala");
while($r4=mysql_fetch_array($hasil4)){
	echo "<option value='$r4[kode_gejala]'>$r4[nama_gejala]</option>";
}
echo	"</select></td></tr>
<tr><td>MB</td><td><input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control' name='mb' size=15 ></td></tr>
<tr><td>MD</td><td><input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control' name='md' size=15 ></td></tr>
<tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
<input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=pengetahuanHama';\"></td></tr>
</table></form>";
break;

case "editpengetahuan":
$edit=mysql_query("SELECT * FROM basis_pengetahuan_hama WHERE kode_pengetahuan='$_GET[id]'");
$r=mysql_fetch_array($edit);

echo "<br>
<br>
<form name=text_form method=POST action='$aksi?module=pengetahuanHama&act=update' onsubmit='return Blank_TextField_Validator()'>
<input type=hidden name=id value='$r[kode_pengetahuan]'>
<br><br><table class='table table-bordered'>
<tr><td width=120>Penyakit</td><td><select class='form-control' name='kode_hama' id='kode_hama'>";
$hasil4 = mysql_query("SELECT * FROM hama order by nama_hama");
while($r4=mysql_fetch_array($hasil4)){
	echo "<option value='$r4[kode_hama]'"; if($r[kode_hama]==$r4[kode_hama]) echo "selected";
	echo ">$r4[nama_hama]</option>";
}
echo	"</select></td></tr>
<tr><td>Gejala</td><td><select class='form-control' name='kode_gejala' id='kode_gejala'>";
$hasil4 = mysql_query("SELECT * FROM gejala order by nama_gejala");
while($r4=mysql_fetch_array($hasil4)){
	echo "<option value='$r4[kode_gejala]'"; if($r[kode_gejala]==$r4[kode_gejala]) echo "selected";
	echo ">$r4[nama_gejala]</option>";
}
echo	"</select></td></tr>
<tr><td>MB</td><td><input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control' name='mb' size=15 value='$r[mb]'></td></tr>
<tr><td>MD</td><td><input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control' name='md' size=15 value='$r[md]'></td></tr>
<tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
<input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=pengetahuanHama';\"></td></tr>
</table></form>";
break;  
}
?>
<?php } ?>



