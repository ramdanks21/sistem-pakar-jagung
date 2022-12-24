<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
   <title>Tentang Kami</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='aset/tentang/style.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
   <link rel="stylesheet" href="aset/login/css/style.css">
  
  
</head>
<style>
@media only screen and (max-width: 400px) {
    img {
        width: 100%;
    }
}
</style>
<body>

  <div class="ma3">
  <article class="tc w-75 center pt5 pb2 ph3 mw6-ns ba bw1 b--light-gray" style="background: #fff;">
    <header class="mb4">
		<img class="br-100" src="favicon.png" alt="Profile headshot" />
      <h1 class="f3 lh-title mv2">Certainty Factor V.2</h1>
	   <h2 class="f5 mt2 mb1">Implementasi Sistem Pakar Metode Certainty Factor</h2>
	  <h2 class="f5 mt2 mb1">Copyright © 2020 <a class="link dim"><a href="http://www.mycoding.net">My Coding</a></h2>
	  <br>
      <a class="link dim"  style="font-size: 40px;"><i class="fa fa-chrome" aria-hidden="true"></i></a>
      <a class="link dim"  style="font-size: 40px;"><i class="fa fa-firefox" aria-hidden="true"></i></a>
      <a class="link dim"  style="font-size: 40px;"><i class="fa fa-edge" aria-hidden="true"></i></a>
	  <a class="link dim"  style="font-size: 40px;"><i class="fa fa-safari" aria-hidden="true"></i></a>
    </header>
    <p class="f6 tl lh-copy" style="margin: 20px;">Sistem pakar yang mampu mendiagnosa penyakit pada ayam berdasarkan pengetahuan yang diberikan langsung dari pakar/ahlinya dan melalui studi  literatur. Penelitian ini menggunakan metode perhitungan Certainty Factor (CF) dalam menghitung tingkat kepakaran. Data penelitian ini terdiri dari data gejala dan data penyakit ayam, serta data aturan. Sistem pakar pada organisasi ditujukan  untuk penambahan  value, peningkatan produktivitas serta area manajerial yang dapat mengambil kesimpulan dengan cepat.</p>
    <p/>
    <p class="f6 tl lh-copy" style="margin: 20px;">Certainty Factor (CF) merupakan salah satu teknik yang digunakan untuk mengatasi ketidakpastian dalam pengambilan keputusan. Certainty Factor (CF) dapat terjadi dengan berbagai kondisi.</p>
    <p/>
    <p class="f6 tl lh-copy" style="margin: 20px;">Diantara kondisi yang terjadi adalah terdapat beberapa antensenden (dalam rule yang berbeda) dengan satu konsekuen yang sama. Dalam kasus ini, kita harus mengagregasikan nilai CF keseluruhan dari setiap kondisi yang ada. Berikut formula yang digunakan:</p>
    <p/>
    <p class="f6 tl lh-copy" style="margin: 20px;">
    CFc (CF1,CF2) = CF1 + CF2 (1- CF1) ; jika CF1 dan CF2 keduanya posistif<br/>
    CFc (CF1,CF2) = CF1 + CF2 (1+ CF1) ; jika CF1 dan CF2 keduanya negative<br/>
    CFc (CF1,CF2) = {CF1 + CF2} / (1-min{| CF1|,| CF2|}) ; jika salah satu negatif<br/></p>
    <p/>
    <p class="f6 tl lh-copy" style="margin: 20px;">
    Contoh :<br/>
    [R1] : IF fever THEN thypus {cf : -0.40}<br/>
    [R2] : IF amount of tromobsit low THEN thypus {cf : -0.50}<br/>
    [R3] : IF body is weak THEN thypus {cf : 0.75}<br/>
    [R4] :IF diarhea THEN thypus {cf : 0.60}<br/><br/>
    Tentukan Nilai dari CF gabungannya:<br/><br/>
    Jawaban:<br/><br/>
    1. R1 dan R2 ::  CFc (CF1,CF2) = CF1 + CF2 (1+ CF1)<br/>
        = -0,40 + (-0,50)(1+(-0,40))<br/>
        = -0,40 + (-0,50)(0,60)<br/>
        = -0,40 – 0,30<br/>
        = -0,70<br/><br/>
    2. R3 dan R4 :: CFc (CF1,CF2) = CF1 + CF2 (1- CF1)<br/>
        = 0,75 + 0,6 (1-0,75)<br/>
        = 0,75 + 0,6. 0,25<br/>
        = 0,75 + 0,15<br/>
        = 0,9<br/><br/>
    3. Gabungkan (a) dan (b) :: CFc (CF1,CF2) = {CF1 + CF2} / (1-min{| CF1|,| CF2|})<br/>
        = {-0,70+0,9}/(1-min{|-0,70|,|0,90|})<br/>
        = 0,20 / ( 1-{0,70})<br/>
        = 0,20 / 0,30<br/>
        = 0,67<br/><br/></p>
    <p class="f6 tl lh-copy" style="margin: 20px;">
    Kesimpulannya: Suatu penyakit thypus disebabkan oleh gejala-gejala tersebut di atas memiliki nilai Certainty Factor ( CF) sebesar 0,67</p>
    <p/>        
    <p/>
  </article>
</div>
</body>

</html>