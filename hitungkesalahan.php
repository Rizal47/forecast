<?php
include("connection/koneksi.php");

$data_asli = $_POST["dataasli"];
$peramalan = $_POST["peramalan"];


$insert = mysqli_query($conn, "INSERT INTO kesalahan VALUES (null, '$data_asli', '$peramalan')");

if ($insert) {
?>
    <script>
        alert("Tambah Data Berhasil !");
        document.location = "kesalahan.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Dambah Data Gagal !");
        document.location = "kesalahan";
    </script>
<?php
}
?>