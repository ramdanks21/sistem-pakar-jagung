<?php
//KONVERSI PHP KE PHP 7
require_once "parser-php-version.php";

$server = "localhost";
$username = "root";
$password = "";
$database = "spcertaintyfactorv2";

mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Maaf, Database tidak bisa dibuka");
?>