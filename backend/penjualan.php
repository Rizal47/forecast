<?php
    include_once 'koneksi.php';

    class Penjualan{
        public $id_jual, $minggu, $bulan, $tahun, $jumlah, $estimasi;
        private $connection;

        function __construct($id_jual, $minggu, $bulan, $tahun, $jumlah){
            $database = new Database();
            $this->connection = $database->connect();

            $this->id_jual = $id_jual;
            $this->minggu = $minggu;
            $this->bulan = $bulan;
            $this->tahun = $tahun;
            $this->jumlah = $jumlah;
        }

        public function createData(){
            $query="INSERT INTO penjualan (minggu,bulan,tahun,jumlah) VALUES (
                '".$this->minggu."',
                '".$this->bulan."',
                '".$this->tahun."',
                '".$this->jumlah."')";

            $result = $this->connection->query($query) or die($this->connection->error);
        }

        public static function readAllData(){
            $arrayPenjualan = array(); // Menampung seluruh record yang dipanggil

            $query = "SELECT * FROM penjualan"; 
            $database = new Database();
            $connection = $database->connect();
            $result = $connection->query($query) or die($connection->error);

            // While untuk mengambil object hasil query, lalu mengubahnya menjadi array
            // untuk disimpan dalam variabel arrayPenjualan.
            while ($row=$result->fetch_assoc()){    
                $penjualan = new Penjualan(
                    $row['id_jual'],
                    $row['minggu'],
                    $row['bulan'],
                    $row['tahun'],
                    $row['jumlah']
                );

                // Memasukkan tiap-tiap record sebagai objek ke variabel array.
                $arrayPenjualan[$penjualan->id_jual] = $penjualan;
            }

            return $arrayPenjualan;
        }

        public function readSpecificData($id_jual){
            $query = "SELECT * FROM penjualan WHERE id_jual = $id_jual";
            $result = $this->connection->query($query) or die($this->connection->error);

            $row = $result->fetch_assoc();
            $this->id_jual = $row['id_jual'];
            $this->minggu = $row['minggu'];
            $this->bulan = $row['bulan'];
            $this->tahun = $row['tahun'];
            $this->jumlah = $row['jumlah'];
            
            return $result;
        }

        public function editData(){
            $query = "UPDATE penjualan SET
                minggu = $this->minggu,
                bulan = $this->bulan,
                tahun = $this->tahun,
                jumlah = $this->jumlah
                WHERE id_jual = $this->id_jual";

            $result = $this->connection->query($query) or die($this->connection->error);
        }

        public function deleteData(){
            $query = "DELETE FROM penjualan WHERE id_jual = $this->id_jual";
            $result = $this->connection->query($query) or die($this->connection->error);
        }
    }

?>