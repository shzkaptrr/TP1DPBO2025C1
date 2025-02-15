#include <bits/stdc++.h>
#include "Petshop.cpp"

using namespace std;

int main() {
    list<Petshop> daftar_produk;  // List produk disimpan di sini
    Petshop petshop_jakarta;  // Objek petshop_jakarta digunakan untuk memanggil method
    string req; // Variabel untuk menyimpan masukan user

    cout << "1. Tampilkan produk\n2. Tambah produk\n3. Update produk\n4. Hapus produk\n6. Mencari produk\nex = Keluar\n";
        
    while (true) {
        cout << "Masukkan request: ";
        cin >> req;

        if (req == "1") {
            petshop_jakarta.tampilkan_produk(daftar_produk);
        } 
        else if (req == "2") {
            petshop_jakarta.tambah_produk(daftar_produk);
        } 
        else if (req == "3") {
            petshop_jakarta.update_produk(daftar_produk);
        } 
        else if (req == "4") {
            petshop_jakarta.hapus_produk(daftar_produk);
        } 
        else if (req == "6") {
            petshop_jakarta.mencari_produk(daftar_produk);
        } 
        else if (req == "ex") {
            break;
        } 
        else {
            cout << "Request tidak ada\n";
        }
    }
}
