<?php
if ($module == ""){
	include "modul/welcome.php";
}elseif ($module == "tentang"){
	include "modul/tentang.php";
}
elseif ($module == "bantuan"){
	include "modul/bantuan.php";
}

elseif ($module == "diseaseSaverty"){
	include "modul/diseaseSaverty/keparahanpenyakit.php";

}

elseif ($module == "intensitasKerusakan"){
	include "modul/intensitasKerusakan/intensitaskerusakan.php";
}

elseif ($module == "diseaseIncidence"){
	include "modul/diseaseIncidence/presentasetanaman.php";

}
elseif ($module == "diagnosa"){
	include "modul/diagnosa/diagnosa.php";
}elseif ($module == "diagnosahama"){
	include "modul/diagnosa/diagnosahama.php";
}

elseif ($module == "rekomendasi"){
	include "modul/rekomendasi/rekomendasi.php";
}

elseif ($module == "penyakit"){
	include "modul/penyakit/penyakit.php";


}
elseif ($module == "hama"){
	include "modul/hama/hama.php";
}

elseif ($module == "post"){
	include "modul/post/post.php";
}

elseif ($module == "admin"){
	include "modul/admin/admin.php";
}

elseif ($module == "gejala"){
	include "modul/gejala/gejala.php";
}
elseif ($module == "pengetahuan"){
	include "modul/pengetahuan/pengetahuan.php";
}
elseif ($module == "pengetahuanHama"){
	include "modul/pengetahuan/pengetahuanHama.php";
}

elseif ($module == "password"){
	include "modul/password/password.php";
}elseif ($module == "keterangan"){
	include "modul/keterangan.php";
}elseif ($module == "riwayat"){
	include "modul/riwayat/riwayat.php";
}elseif ($module == "riwayat-detail"){
	include "modul/riwayat/detail.php";
}elseif ($module == "formlogin"){
	include "modul/formlogin.php";
}
?>