import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in); 

        // instansiasi dengan membuat objek baru dari kelas Petshop bernama petshop_jakarta
        Petshop petshop_jakarta = new Petshop(); 
            System.out.println("======== MENU PETSHOP =======");
            System.out.println("|    1. Tampilkan produk    |");
            System.out.println("|    2. Cari Produk         |");
            System.out.println("|    3. Tambah produk       |"); 
            System.out.println("|    4. Update produk       |");
            System.out.println("|    5. Hapus produk        |");
            System.out.println("|    6. Keluar              |");
            System.out.println("=============================");

        while (true) {  // membuat infinite loop karna true selalu benar sampai ada masukan 6(keluar)
            System.out.print("Request: "); 
            int pilihan = scanner.nextInt(); // membaca inputan dari user
            // menampilkan daftar produk
            if (pilihan == 1) { 
                petshop_jakarta.tampilkanProduk(); // memanggil method tampilkanProduk dari objek petshop_jakarta 
            } 
            // mencari produk
            else if(pilihan == 2) { 
                System.out.print("id produk yang dicari: ");
                scanner.nextLine(); 
                String idCari = scanner.nextLine(); // masukkan id yang dicari
                petshop_jakarta.cariProduk(idCari); // memanggil method cariProduk dari objek petshop_jakarta
            }
            // menambahkan produk
            else if (pilihan == 3) { 
                System.out.print("id, nama produk, kategori produk, dan harga produk:\n");
                String id = scanner.next(); // masukkan id
                String nama = scanner.next(); // masukkan nama produk
                String kategori = scanner.next(); // masukkan kategori produk
                int harga = scanner.nextInt(); // masukkan harga produk
                petshop_jakarta.tambahProduk(id, nama, kategori, harga); // memanggil method tambahProduk dari objek petshop_jakarta
            } 
            // mengupdate produk
            else if (pilihan == 4) {
                System.out.print("id produk yang ingin diupdate: ");
                String idUpdate = scanner.next(); // masukkan id produk yang ingin diupdate
                System.out.print("nama produk baru, kategori produk baru, dan harga produk baru:\n");
                String namaBaru = scanner.next(); // masukkan nama produk yang baru
                String kategoriBaru = scanner.next(); // masukkan kategori produk yang baru
                int hargaBaru = scanner.nextInt(); // masukkan harga produk yang baru
                petshop_jakarta.updateProduk(idUpdate, namaBaru, kategoriBaru, hargaBaru); // memanggil method updateProduk dari objek petshop_jakarta
            } 
            // menghapus produk
            else if (pilihan == 5) {
                System.out.print("id produk yang ingin dihapus: ");
                scanner.nextLine(); 
                String idHapus = scanner.nextLine(); // masukkan id produk yang ingin dihapus
                petshop_jakarta.hapusProduk(idHapus); // memanggil method hapusProduk dari objek petshop_jakarta
            } 
            // keluar 
            else if (pilihan == 6) {
                break;
            } 
            else { // selain 1-6 
                System.out.println("Request tidak ada");
            }
        }

        scanner.close();
    }
}
