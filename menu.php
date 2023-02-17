<?php
$module = $_GET['module'];
?>
<li><a <?php if ($module == "") echo 'class="active"'; ?> href="./"><i class="fa fa-home"></i> <span>Beranda</span></a><li>
  <div class="container"></div>
  <?php
  if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    ?>
    <li><a <?php if ($module == "admin") echo 'class="active"'; ?> href="admin"><i class="fa fa-user"></i> <span>Admin</span></a><li>
      <div class="container"></div>	

      <li><a <?php if ($module == "penyakit") echo 'class="active"'; ?> href="penyakit"><i class="fa fa-bug"></i> <span>Penyakit</span></a><li>

        <li><a <?php if ($module == "hama") echo 'class="active"'; ?> href="hama"><i class="fa fa-bug"></i> <span>Hama</span></a><li>

          <div class="container"></div>	
          <li><a <?php if ($module == "gejala") echo 'class="active"'; ?> href="gejala"><i class="fa fa-eyedropper"></i> <span>Gejala</span></a><li>

            <div class="container"></div>

            <li>
              <a <?php if ($module == "pengetahuan") echo 'class="active"'; ?> href="pengetahuan">
                <i class="fa fa-flask"></i> 
                <span>Pengetahuan Penyakit</span>
              </a>
            </li>    

            <li>
              <a <?php if ($module == "pengetahuanHama") echo 'class="active"'; ?> href="pengetahuanHama">
                <i class="fa fa-flask"></i> 
                <span>Pengetahuan Hama</span>
              </a>
            </li>

            <li>
              <a <?php if ($module == "diseaseSaverty") echo 'class="active"'; ?> href="diseaseSaverty">
                <i class="fa fa-flask"></i> 
                <span>
                  <i> Disease Severity</i>

                </span>
              </a>
            </li>
<!-- 
            <li>
              <a <?php if ($module == "diseaseIncidence") echo 'class="active"'; ?> href="diseaseIncidence">
                <i class="fa fa-flask"></i> 
                <span>
                  <i> Disease incidence</i>

                </span>
              </a>
            </li>  -->

            <li>
              <a <?php if ($module == "rekomendasi") echo 'class="active"'; ?> href="rekomendasi">
                <i class="fa fa-flask"></i> 
                <span>
                  <i> Rekomendasi</i>

                </span>
              </a>
            </li>






            


            <div class="container"></div>
            <!-- <li>
              <a <?php if ($module == "post") echo 'class="active"'; ?> href="post">
                <i class="fa fa-file-text"></i>
                <span>Post Keterangan</span>
              </a>
            </li> -->


            <div class="container"></div>
            <li>
              <a <?php if ($module == "password") echo 'class="active"'; ?> href="password">
                <i class="fa fa-edit">
                </i>
                <span>Ubah Password</span></a>
                <li>
                  <div class="container">

                  </div>
                  <?php

                      // tampilan awal  beranda

                }else {
                  ?>
                  <li>

                    <a <?php if ($module == "diagnosa") echo 'class="active"'; ?> href="diagnosa">

                      <i class="fa fa-search-plus"></i> 

                      <span>Diagnosa</span>
                    </li>
                  </a>

                  <li>

                    <a <?php if ($module == "diagnosahama") echo 'class="active"'; ?> href="diagnosahama">

                      <i class="fa fa-search-plus"></i> 

                      <span>Diagnosa Hama</span>
                    </a>
                  </li>  

                  <li>

                    <a <?php if ($module == "intensitasKerusakan") echo 'class="active"'; ?> href="intensitasKerusakan">

                      <i class="fa fa-search-plus"></i> 

                      <span>Intensitas Keruksakan</span>
                    </a>
                  </li>


                  <div class="container">

                  </div>
                  <li>
                    <a <?php if ($module == "riwayat") echo 'class="active"'; ?> href="riwayat">

                      <i class="fa fa-clock-o"></i> <span>Riwayat</span>
                    </a>


                    <li>

                      <div class="container"></div>

                      <a <?php if ($module == "keterangan") echo 'class="active"'; ?> href="keterangan">
                        <i class="fa fa-commenting-o"></i>

                        <span>Keterangan</span>
                      </a>
                    </li>



                    <div class="container"></div>


                    <?php
                  }

                  ?>
                  <li><a <?php if ($module == "tentang") echo 'class="active"'; ?> href="tentang"><i class="fa fa-info-circle"></i> <span>Tentang</span></a><li>
                    <div class="container"></div>