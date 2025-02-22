<?php
session_start();

class Petshop {
    // private attributes
    private $id;
    private $namaProduk;
    private $kategoriProduk;
    private $harga;
    private $foto;

    // constructor
    public function __construct($id = '', $namaProduk = '', $kategoriProduk = '', $harga = '', $foto = '') {
        $this->id = $id;
        $this->namaProduk = $namaProduk;
        $this->kategoriProduk = $kategoriProduk;
        $this->harga = $harga;
        $this->foto = $foto;
    }

    // getter
    public function getId() {
        return $this->id;
    }
    public function getNamaProduk() {
        return $this->namaProduk;
    }
    public function getKategoriProduk() {
        return $this->kategoriProduk;
    }
    public function getHarga() {
        return $this->harga;
    }
    public function getFoto() {
        return $this->foto;
    }

    // setter
    public function setId($id) {
        $this->id = $id;
    }
    public function setNamaProduk($namaProduk) {
        $this->namaProduk = $namaProduk;
    }
    public function setKategoriProduk($kategoriProduk) {
        $this->kategoriProduk = $kategoriProduk;
    }
    public function setHarga($harga) {
        $this->harga = $harga;
    }
    public function setFoto($foto) {
        $this->foto = $foto;
    }

    // menyimpan data produk ke sesi / session
    public function save() {
        // disimpan ke session agar data tersimpan sementara
        // produk adalah array yang menyimpan data produk
        // mengecek apakah elemen produk dalam array sesi / session sudah ada dan tidak null
        if (!isset($_SESSION['produk'])) { // jika tidak ada, maka buat array kosong
            $_SESSION['produk'] = []; // membuat array kosong
        }

        // cek apakah id saat ini sudah ada dalam sesi 
        if (isset($_SESSION['produk'][$this->id])) {
            return false; // jika sudah ada maka false / tidak menyimpan produk
        }

        // simpan foto
        // memanggil fungsi upload foto, lalu $_FILES['foto'] adalah file yang diupload, dan $this->id adalah id produk
        $fotoPath = $this->uploadFoto($_FILES['foto'], $this->id); 
        $this->setFoto($fotoPath); // memanggil fungsi set foto untuk menyimpan path foto ke atribut foto

        $_SESSION['produk'][$this->id] = $this; // menyimpan data produk ke dalam array sesi / session
        // produk yang ditambahkan akan tersimpan dalam sesi (nama, kategori, harga, dan foto)
        return true;
    }

    // mengambil semua produk dari sesi / session
    public static function getAll() {
        // cek apakah $_SESSION['produk'] sudah ada atau belum
        if (isset($_SESSION['produk'])) {  // jika sudah ada
            return $_SESSION['produk']; // return daftar produk 
        }
        else { // jika belum ada
            return []; // return array kosong
        }
        
    }

    // mengupdate data produk di session
    public function update() {
        if (isset($_SESSION['produk'][$this->id])) { // mengecek apakah id produk sudah ada dalam sesi
            // cek apakah ada foto baru yang diupload
            // jika ada foto baru, hapus foto lama dan upload yang baru
            if (!empty($_FILES['foto']['name'])) {
                $oldFoto = $_SESSION['produk'][$this->id]->getFoto(); // path foto lama
                if (!empty($oldFoto) && file_exists($oldFoto)) { // jika foto lama tidak kosong dan file foto lama ada
                    unlink($oldFoto); // hapus foto lama
                }

                $fotoPath = $this->uploadFoto($_FILES['foto'], $this->id); // upload foto baru
                $this->setFoto($fotoPath); // simpan path foto baru
            }  
            else { // jika tidak ada foto baru, pakai foto lama
                $this->setFoto($_SESSION['produk'][$this->id]->getFoto()); // ambil path fotonya dari session 
            }

            $_SESSION['produk'][$this->id] = $this; // simpan perubahan ke dalam session
            return true; // return true jika berhasil update
        }
        return false; // return false jika produk tidak ada dalam sesi
    }

    // menghapus produk dan foto dari session
    // dibuat static karna diapus berdasarkan id, tidak perlu buat obj petshop
    public static function delete($id) {
        if (isset($_SESSION['produk'][$id])) { // cek apakah produk ada dalam session
            $foto = $_SESSION['produk'][$id]->getFoto(); // ambil path foto produk
            if (!empty($foto) && file_exists($foto)) { // jika path foto tidak kosong dan file foto ada
                unlink($foto); // hapus foto
            }
            unset($_SESSION['produk'][$id]); // hapus produk dari sesi
            return true; // return true jika berhasil hapus
        }
        return false; // return false jika produk tidak ada dalam sesi
    }

    // Mmngupload foto ke folder uploads
    private function uploadFoto($file, $id) {
        $targetDir = "uploads/"; // folder tujuan penymipanan foto
        if (!is_dir($targetDir)) { // jika folder tidak ada
            mkdir($targetDir, 0777, true); // buat folder baru, o777 adalah aksese untuk semua user
        }
        // menamai file
        $fileName = $id . "_" . basename($file["name"]); // basename($file["name"]) itu mengambil nama asli file yang diunggah, lalu ditambahkan id didepannya
        $targetFilePath = $targetDir . $fileName; // menyimpan path akhir file
        // menyimpan file ke folder uploads
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) { // memindahkan file dari tmp_name ke targetFilePath(uploads)
            return $targetFilePath; // return path file jika berhasil upload
        }
        return ""; // return kosong jika gagal upload
    }

    // mencari produk berdasarkan id
    public function cari($id) {
        // mengecek apakah ada produk dalam sesi
        if (!isset($_SESSION['produk'])) { // jika tidak ada produk dalam sesi
            return null; // return null
        }
    
        foreach ($_SESSION['produk'] as $produk) { // looping untuk mengecek tiap produk dalam sesi
            if ($produk->getId() == $id) { // jika id produk sesuai dengan id yang dicari
                return $produk; // return produk yang dicari
            }
        }
    
        return null; // return null jika tidak ada produk yang sesuai
    }
    
    
}
?>
