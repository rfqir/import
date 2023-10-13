<?php
if (isset($_POST["import"])) {

// Dapatkan informasi file yang diunggah
$csv_file = $_FILES["csv_file"]["tmp_name"];

// Buka file CSV untuk dibaca
$file = fopen($csv_file, "r");

// Loop untuk membaca setiap baris dalam file CSV
while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
    // Dapatkan data dari baris CSV
    $invoice = $data[1];
    $pembayaran = $data[2];
    $nama_product = $data[8];
    $sku_toko = $data[10];
    $jumlah_dibeli = $data[13];
    $penerima = $data[27];
    $kurir = $data[32];
    $tipe = $data[33];
    $resi = $data[34];
    $tanggal_kirim = $data[35];
    $waktu_kirim = $data[36];
    $tgl_kirim = $tanggal_kirim . ' ' . $waktu_kirim;
    $tanggal_kirim3 = date('Y-m-d H:i:s', strtotime(str_replace('/', ' ', $tgl_kirim)));

    // ... tambahkan kolom lainnya sesuai dengan struktur tabel Anda

    if (strpos($invoice, 'INV') === 0) {
        // Memeriksa apakah $pembayaran adalah datetime yang valid
        if (strtotime($pembayaran) !== false) {
            $tanggal = new DateTime($pembayaran);
            $tanggal_bayar = $tanggal->format('Y-m-d H:i:s'); // Format tanggal ke dalam bentuk yang sesuai dengan MySQL

            $tanggal1 = new DateTime($tanggal_kirim);
            $tanggal_kirim2 = $tanggal1->format('Y-m-d');

            $waktu2 = new DateTime($waktu_kirim);
            $waktu_kirim2 = $waktu2->format('H:i:s');

            $select = mysqli_query($conn, "SELECT id_product, id_toko,sku_toko FROM toko_id WHERE sku_toko='$sku_toko'");
            $dataselect = mysqli_fetch_array($select);
            $toko =  $dataselect['sku_toko'];
            $id_product = $dataselect['id_product'];
            $id_toko = $dataselect['id_toko'];

            $ambil = mysqli_query($conn, "SELECT resi FROM shop_id where resi = '$resi'");
            $list = mysqli_fetch_array($ambil);
            $resibaru = $list['resi'];
            if ($resi == $resibaru) {
            } else {
                if (empty($resi)) {
                } else {

                    $sql = "INSERT INTO shop_id (invoice, tanggal_bayar, id_product, sku_toko, jumlah,penerima,kurir,tipe,resi,tanggal_pengiriman,waktu_pengiriman,nama_product ) VALUES ('$invoice', '$tanggal_bayar','$id_product','$toko   ','$jumlah_dibeli','$penerima','$kurir','$tipe','$resi','$tanggal_kirim3','$waktu_kirim2','$nama_product')";
                    if ($conn->query($sql) !== TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        } else {
            echo "Data pembayaran tidak valid: " . $pembayaran . "<br>";
        }
    }
}



// Tutup file CSV
fclose($file);

// Tutup koneksi ke database
$conn->close();

echo "Data berhasil diimpor.";
}


if (isset($_POST['adminresi'])) {
$resi = $_POST['resi'];
$grup = $_POST['grup'];
$insert = mysqli_query($conn, "INSERT INTO tracking (no_resi,admin,kelompok) VALUES ('$resi','check','$grup')");
}
