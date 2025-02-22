# deklarasi class
class Petshop:
    # atribut
    __id = ""
    __namaProduk = ""
    __kategoriProduk = ""
    __hargaProduk = 0

    def __init__(self, id="", namaProduk="", kategoriProduk="", hargaProduk=0):
        self.__id = id
        self.__namaProduk = namaProduk
        self.__kategoriProduk = kategoriProduk
        self.__hargaProduk = hargaProduk
        self.__daftarProduk = [] # list untuk menampung produk

    # getter
    def getId(self): return self.__id
    def getNamaProduk(self): return self.__namaProduk
    def getKategoriProduk(self): return self.__kategoriProduk
    def getHargaProduk(self): return self.__hargaProduk

    # setter
    def setId(self, id): self.__id = id
    def setNamaProduk(self, namaProduk): self.__namaProduk = namaProduk
    def setKategoriProduk(self, kategoriProduk): self.__kategoriProduk = kategoriProduk
    def setHargaProduk(self, hargaProduk): self.__hargaProduk = hargaProduk

    # method untuk ngeprint produk
    def printProduk(self):
        print(f"> {self.__id}, {self.__namaProduk}, {self.__kategoriProduk}, {self.__hargaProduk}")

    # menampilkan daftar produk
    def tampilkanProduk(self): # menggunakan parameter self, yaitu referensi ke objek yang sedang diakses
        if len(self.__daftarProduk) == 0: # jika jumlah elemen dalam list adalah kosong
            print("Tidak ada produk")
        else: # jika jumlah elemen dalam list tidak kosong
            print("++++++++++++++++++++++")
            print("|    Daftar Produk   |")
            print("++++++++++++++++++++++")
            for produk in self.__daftarProduk: # looping untuk menampilkan setiap produk
            # loop mengambil setiap elemen dalam list, lalu disimpan ke dalam variabel produk dan memanggil fungsi printProduk
                produk.printProduk()

    # method untuk menambahkan produk
    def tambahProduk(self, id, namaProduk, kategoriProduk, hargaProduk):
        produk_baru = Petshop(id, namaProduk, kategoriProduk, hargaProduk) # membuat objek dari class Petshop dan berisi data produk yang ditambahkan
        self.__daftarProduk.append(produk_baru)  # menambahkan produk ke dalam list

    # method untuk mengupdate produk
    def updateProduk(self, id, namaProduk, kategoriProduk, hargaProduk):
        for produk in self.__daftarProduk: # looping setiap elemen dalam list
            if produk.getId() == id: # jika id produk sama dengan id yang dicari
                produk.setNamaProduk(namaProduk) # memanggil setter untuk mengubah nilai atribut pada objek produk
                produk.setKategoriProduk(kategoriProduk) # memanggil setter untuk mengubah nilai atribut pada objek produk
                produk.setHargaProduk(hargaProduk) # memanggil setter untuk mengubah nilai atribut pada objek produk
                return
        print(f"Tidak ada id {id}")   

    # method untuk menghapus produk
    def hapusProduk(self, id):
        for i, produk in enumerate(self.__daftarProduk): # looping setiap elemen dalam list
            if produk.getId() == id: # jika id produk sama dengan id yang dicari
                self.__daftarProduk.pop(i) # menghapus indeks ke i dari list daftarProduk
                return
        print(f"Tidak ada id {id}")

    # method untuk mencari produk
    def cariProduk(self, id):
        ditemukan = 0  # variabel untuk menandai apakah produk ditemukan 
        for produk in self.__daftarProduk: # looping setiap elemen dalam list
            if produk.getId() == id: # jika id produk sama dengan id yang dicari
                produk.printProduk() # memanggil fungsi printProduk
                ditemukan = 1  # tandai produk ditemukan
        if ditemukan == 0: # jika produk tidak ditemukan
            print(f"Tidak ada id {id}")
