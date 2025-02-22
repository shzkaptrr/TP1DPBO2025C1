<?php
require_once 'Petshop.php';

// memeriksa hasil dari form tambah dengan method="post" dan atribut name="tambah"
// diperiksa dengan isset($_POST['']) 
if (isset($_POST['tambah'])) { // jika hasilnya adalah 'tambah'
    // membuat objek baru Petshop dengan parameter yang diambil dari form
    $produk = new Petshop($_POST['id'], $_POST['namaProduk'], $_POST['kategoriProduk'], $_POST['harga'], '');
    
    // mengecek apakah file foto yang diunggah kosong atau tidak
    if (!empty($_FILES['foto']['name'])) { // jika tidak kosong
        if ($produk->save()) { // menyimpan produk ke dalam session dengan funsgi save tadi
            echo "Produk berhasil ditambahkan"; // tandai
        } 
        else { // jika tidak berhasil
            echo "ID sudah ada";
        }
    } 
    else { // jika kosong
        echo "upload foto produk";
    }
}

// jika hasil dari form menghasilkan update
if (isset($_POST['update'])) {
    // membuat objek baru Petshop dengan parameter yang diambil dari form
    $produk = new Petshop($_POST['id'], $_POST['namaProduk'], $_POST['kategoriProduk'], $_POST['harga'], '');
    // memnaggil fungsi update
    if ($produk->update()) { // jika produk ditemukan dan berhasail
        echo "Produk diperbarui"; // tandai
    } 
    else {
        echo "Produk tidak ada"; // jika tidak ditemukan
    }
}

// jika hasil dari form menghasilkan hapus
if (isset($_POST['hapus'])) {
    // memanggil fungsi delete dengan parameter id yang diambil dari form
    if (Petshop::delete($_POST['id'])) { // langsung memanggil fungsi delete tanpa membuat objek
        echo "Produk dihapus";
    } 
    else {
        echo "Produk tidak ada";
    }
}

// menmpilkan semua produk
$produkList = Petshop::getAll(); // mengambil semua produk dari session dan disimpan ke variabel $produkList

// jika hasil dari form menghasilkan cari dan idi yang dimasukan tidak kosong
if (isset($_POST['cari']) && !empty($_POST['search_id'])) {
    $produk = (new Petshop())->cari($_POST['search_id']); // mencari produk berdasarkan id yang dimasukan
    if ($produk) { // jika produk ditemukan
        $produkList = [$produk]; // $produkList diisi dengan produk yang ditemukan
    } 
    else { // jika tidak ditemukan
        $produkList = []; // diisi array kosong
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF2F2;
            margin: 20px;
            text-align: center;
        }
        .container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, button {
            padding: 10px;
            margin: 5px;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #2D336B;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #A9B5DF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #E5989B;
            color: white;
        }
        img {
            width: 100px;
            height: auto;
            border-radius: 2px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 10px;
        }
        .btn-update {
            display: inline-block;
            padding: 10px 15px;
            background-color: #7886C7;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        
    </style>
</head>
<body>

<h2>Tambah Produk</h2>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="id" placeholder="ID Produk" required><br>
    <input type="text" name="namaProduk" placeholder="Nama Produk" required><br>
    <input type="text" name="kategoriProduk" placeholder="Kategori Produk" required><br>
    <input type="number" name="harga" placeholder="Harga" required><br>
    <input type="file" name="foto" required><br>
    <button type="submit" name="tambah">Tambah</button>
</form>

<h2>Cari Produk</h2>
<form method="post">
    <input type="text" name="search_id" placeholder="Masukkan ID Produk">
    <button type="submit" name="cari">Cari</button>
</form>

<h2>Daftar Produk</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Foto</th>
        <th>Aksi</th>
    </tr>
    <?php if (!empty($produkList)): ?>
        <?php foreach ($produkList as $produk): ?>
        <tr>
            <td><?= $produk->getId() ?></td>
            <td><?= $produk->getNamaProduk() ?></td>
            <td><?= $produk->getKategoriProduk() ?></td>
            <td><?= $produk->getHarga() ?></td>
            <td>
                <?php if (!empty($produk->getFoto())): ?>
                    <img src="<?= $produk->getFoto() ?>" alt="Foto Produk" width="50">
                <?php else: ?>
                    Tidak ada foto
                <?php endif; ?>
            </td>
            <td>
                <a href="update.php?id=<?= $produk->getId(); ?>" class="btn-update">Update</a>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $produk->getId() ?>">
                    <button type="submit" name="hapus"  class="btn-update">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">Produk tidak ditemukan</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>
