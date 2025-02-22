import java.util.LinkedList;

public class Petshop {
    // atribut
    private String id;
    private String namaProduk;
    private String kategoriProduk;
    private int harga;
    private LinkedList<Petshop> daftarProduk; // membuat linkedlist namanya adalah daftarProduk yang menyimpan objek Petshop
    
    // constructor
    public Petshop() {
        this.daftarProduk = new LinkedList<>(); // menginisialisasi daftarProduk sebagai list kosong
    }

    public Petshop(String id, String namaProduk, String kategoriProduk, int harga) {
        this.id = id;
        this.namaProduk = namaProduk;
        this.kategoriProduk = kategoriProduk;
        this.harga = harga;
    }

    // getter
    public String getId() { return this.id; }
    public String getNamaProduk() { return this.namaProduk; }
    public String getKategoriProduk() { return this.kategoriProduk; }
    public int getHarga() { return this.harga; }

    // setter
    public void setId(String id) { this.id = id; }
    public void setNamaProduk(String namaProduk) { this.namaProduk = namaProduk; }
    public void setKategoriProduk(String kategoriProduk) { this.kategoriProduk = kategoriProduk; }
    public void setHarga(int harga) { this.harga = harga; }

    // method untuk ngeprint produk
    public void printProduk() {
        System.out.println("> " + this.id + " " + this.namaProduk + " " + this.kategoriProduk + " " + this.harga);
    }

    // method menampilkan produk
    public void tampilkanProduk() {
        if (daftarProduk.isEmpty()) { // jika list daftarProduk kosong
            System.out.println("Tidak ada produk"); 
        } 
        else { // jika list daftarProduk tidak kosong
            System.out.println("+++++++++++++++++++++");
            System.out.println("|   Daftar Produk   |");
            System.out.println("+++++++++++++++++++++");
            // looping setiap elemen dalam list daftarProduk
            for (Petshop produk : daftarProduk) { // foreach loop karna lebih efisien untuk linkedlist
            // setiap elemen dalam list daftarProduk disimpan ke produk, untuk menyimpan objek Petshop yang sedang digunakan/diakses
                produk.printProduk(); // memanggil method printProduk
            }
        }
    }

    // method untuk menambahkan produk
    public void tambahProduk(String id, String namaProduk, String kategoriProduk, int harga) {
        // memanggil method addLast ke dalam list dengan parameter objek baru dan dibuat menggunakan constructor
        daftarProduk.addLast(new Petshop(id, namaProduk, kategoriProduk, harga)); 
    }

    // method untuk mengupdate produk
    public void updateProduk(String id, String namaBaru, String kategoriBaru, int hargaBaru) {
        for (Petshop produk : daftarProduk) { // looping setiap elemen dalam list daftarProduk
            if (produk.getId().equals(id)) { // jika id produk sama dengan id yang dicari
                produk.setNamaProduk(namaBaru); // perbarui nama produk dengan memanggil setter dengan parameter namaBaru
                produk.setKategoriProduk(kategoriBaru); // perbarui kategori produk dengan memanggil setter dengan parameter kategoriBaru
                produk.setHarga(hargaBaru); // perbarui harga produk dengan memanggil setter dengan parameter hargaBaru
                return;
            }
        }
        System.out.println("Tidak ada id " + id + "");
    }

    // Method untuk menghapus produk
    public void hapusProduk(String id) {
        for (int i = 0; i < daftarProduk.size(); i++) { // looping setiap elemen dalam list daftarProduk
        // menggunakan loop biasa karna untuk remove butuh indeks elemen tapi tidak bisa menggunakan foreach 
            if (daftarProduk.get(i).getId().equals(id)) { // jika id produk sama dengan id yang dicari
                daftarProduk.remove(i); // hapus produk dengan indeks i
                return;
            }
        }
        System.out.println("Tidak ada id " + id + "");
    }

    // method untuk mencari produk
    public void cariProduk(String id) {
        int ditemukan = 0;  // variabel untuk menamdai apakah produk ditemukan atau tidak
        for (Petshop produk : daftarProduk) { // looping setiap elemen dalam list daftarProduk
            if (produk.getId().equals(id)) { // jika id produk sama dengan id yang dicari
                produk.printProduk(); // panggil method printProduk untuk menampilkan produk yang dicari
                ditemukan = 1; // tandai bahwa produk ditemukan
            }
        }
        if (ditemukan == 0) { // jika produk tidak ditemukan
            System.out.println("id " + id + " tidak ditemukan");
        }
    }

}
