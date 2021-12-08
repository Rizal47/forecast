<?php
include("connection/koneksi.php");

$data_asli = $_GET["id"];



$insert = mysqli_query($conn, "DELETE from kesalahan Where id_kesalahan = $data_asli");

if ($insert) {
?>
    <script>
        alert("Delete Berhasil");
        document.location = "kesalahan.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Delete Gagal !");
        document.location = "kesalahan";
    </script>
<?php
}
?>