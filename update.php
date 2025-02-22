<?php
require_once 'Petshop.php';

// mengupdate data produk berdasarkan id yang dikirm melalui metode get
$Petshop = new Petshop(); // membuat objek baru Petshop, yang digunakan untuk mengakses fungsi dalam class Petshop

// id dikirim melalui GET
if (!isset($_GET['id'])) { // jika id tidak ada
    die("ID tidak ada"); // tandai
}

$id = $_GET['id']; // mengambil id dari GET
$produk = $Petshop->cari($id); // memanggil fungsi cari dari class Petshop untuk mencari id tersbut

// jika produk tidak ditemukan
if (!$produk) {
    die("Produk tidak ada"); // tandai
}

// memproses update saat user mengirim form dengan metode post
if ($_SERVER["REQUEST_METHOD"] === "POST") { // mengecek apakah halaman menerima post (form sudah dikirim)
    $namaProduk = $_POST["namaProduk"]; // mengambil data nama produk dari form input
    $kategoriProduk = $_POST["kategoriProduk"]; // mengambil data kategori produk dari form input
    $harga = $_POST["harga"]; // mengambil data harga produk dari form input

    // cek apakah ada file foto baru diunggah
    if (!empty($_FILES["foto"]["name"])) { // jika tidak kosong
        $foto = $_FILES["foto"]; // mengambil file foto dari form input
        $fotoNama = basename($foto["name"]); // mengambil nama asli file foto
        $targetDir = "uploads/"; // folder tempat menyimpan file foto
        $targetFile = $targetDir . $fotoNama; // path lengkap file foto yang akan disimpan

        // memindahkan file dari penyimpannan sementra ke folder uploads
        if (move_uploaded_file($foto["tmp_name"], $targetFile)) { // jika berhasil
            $produk->setFoto($targetFile); // simpan path foto ke dalam objek produk
        } 
        else {
            die("Gagal"); // jika gagal
        }
    }

    // mengupdate produk dalam sesi / session dengan data baru
    $produk->setNamaProduk($namaProduk);
    $produk->setKategoriProduk($kategoriProduk);
    $produk->setHarga($harga);

    // user dikmbalikan ke halaman awal
    header("Location: index.php");
    exit(); // memastikan kode berhenti
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: 0 auto;
        }
        input, button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
            width: 100px;
            height: 40px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        .small-text {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Update Produk</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $produk->getId() ?>">
        <div class="form-group">
            <label for="namaProduk">Nama Produk</label>
            <input type="text" name="namaProduk" value="<?= $produk->getNamaProduk() ?>" required>
        </div>
        <div class="form-group">
            <label for="kategoriProduk">Kategori Produk</label>
            <input type="text" name="kategoriProduk" value="<?= $produk->getKategoriProduk() ?>" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" value="<?= $produk->getHarga() ?>" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto Produk</label>
            <input type="file" name="foto">
            <p class="small-text">*Kosongkan jika tidak ingin mengganti foto</p>
        </div>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
