// import library
#include <iostream>
#include <string>
#include <list>

using namespace std;

class Petshop{
    // Private atribut
    private:
        string id;
        string nama_produk;
        string kategori_produk;
        int harga_produk;


    public:
        // contructors
        Petshop(){
            this->id = "";
            this->nama_produk = "";
            this->kategori_produk = "";
            this->harga_produk = 0;
        }

        Petshop(string id, string nama_produk, string kategori_produk, int harga_produk){
            this->id = id;
            this->nama_produk = nama_produk;
            this->kategori_produk = kategori_produk;
            this->harga_produk = harga_produk;
        }

        // Getter
        string get_id(){
            return this->id;
        }
        string get_nama_produk(){
            return this->nama_produk;
        }
        string get_kategori_produk(){
            return this->kategori_produk;
        }
        int get_harga_produk(){
            return this->harga_produk;
        }

        // Setter
        void set_id(string id){
            this->id = id;
        }
        void set_nama_produk(string nama_produk){
            this->nama_produk = nama_produk;
        }
        void set_kategori_produk(string kategori_produk){
            this->kategori_produk = kategori_produk;
        }
        void set_harga_produk(int harga_produk){
            this->harga_produk = harga_produk;
        }

// Method

    // Method menambahkan produk
    void tambah_produk(list<Petshop>& daftar_produk) {
        string id, nama_produk, kategori_produk;
        int harga_produk;
        cout << "id, nama produk, kategori, harga :";
        cin >> id >> nama_produk >> kategori_produk >> harga_produk;
        // Memasukkan produk ke list daftar_produk dengan push_back
        daftar_produk.push_back(Petshop(id, nama_produk, kategori_produk, harga_produk));
    }

    // Method menampilkan semua produk
    void tampilkan_produk(list<Petshop>& daftar_produk) { // Parameter merujuk ke list daftar_produk sebagai referensinya
        if (daftar_produk.empty()) { // Jika list nya kosong
            cout << "Tidak ada produk\n";
        } 
        else { // Jika list tidak kosong, maka tampilkan datanya
            for (auto &produk : daftar_produk) { // Looping sebanyak data yang ada di list, dengan produk adalah referensi yang menunjek ke setiap bagian list daftar_produk
                cout << produk.id << " " 
                     << produk.nama_produk << " " 
                     << produk.kategori_produk << " " 
                     << produk.harga_produk << "\n";
            }
        }
    }

    // Method mencari produk berdasarkan ID
    void mencari_produk(list<Petshop>& daftar_produk) {
        string id;
        cout << "id yang ingin dicari: ";
        cin >> id;

        for (auto &produk : daftar_produk) { // Looping sebanyak data yang ada di list, dengan produk adalah referensi yang menunjek ke setiap bagian list daftar_produk
            if (produk.get_id() == id) { // Jika id produk sama dengan id yang dicari
                cout << "Produk ditemukan:\n";
                cout << produk.id << " " 
                     << produk.nama_produk << " " 
                     << produk.kategori_produk << " " 
                     << produk.harga_produk << "\n";
                return;
            }
        }
        cout << "Produk dengan ID " << id << " tidak ditemukan\n";
    }

    // Method menghapus produk berdasarkan ID
    void hapus_produk(list<Petshop>& daftar_produk) {
        string id;
        cout << "id produk yang ingin dihapus: ";
        cin >> id;

        auto it = daftar_produk.begin(); // Iterator yang menunjuk ke awal list daftar_produk
        while (it != daftar_produk.end()) { // Selama iterator tidak menunjuk ke akhir list
            if (it->get_id() == id) { // Jika id produk sama dengan id yang dicari
                it = daftar_produk.erase(it); // Hapus produk dari list
                cout << "Produk berhasil dihapus\n";
                return;
            } 
            else {
                ++it; // Pindah ke data selanjutnya
            }
        }
        cout << "Produk dengan ID " << id << " tidak ditemukan\n";
    }

    // Method mengupdate produk berdasarkan ID
    void update_produk(list<Petshop>& daftar_produk) {
        string id;
        cout << "id produk yang ingin diupdate: ";
        cin >> id;

        for (auto &produk : daftar_produk) { // Looping sebanyak data yang ada di list, dengan produk adalah referensi yang menunjek ke setiap bagian list daftar_produk
            if (produk.get_id() == id) { // Jika id produk sama dengan id yang dicari
                string nama_produk, kategori_produk;
                int harga_produk;

                cout << "nama produk, kategori, harga yang baru: ";
                cin >> nama_produk;
                cin >> kategori_produk;
                cin >> harga_produk;

                produk.set_nama_produk(nama_produk);
                produk.set_kategori_produk(kategori_produk);
                produk.set_harga_produk(harga_produk);

                cout << "Produk sudah diupdate\n";
                return;
            }
        }
        cout << "Produk dengan ID " << id << " tidak ditemukan\n";
    }

    // Destructor
    ~Petshop(){
        
    }
};
