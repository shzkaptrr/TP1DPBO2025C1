from Petshop import Petshop

petshop_jakarta = Petshop() # membuat objek dari class Petshop

print("======== MENU PETSHOP =======")
print("|    1. Tampilkan produk    |")
print("|    2. Cari Produk         |")
print("|    3. Tambah produk       |") 
print("|    4. Update produk       |")
print("|    5. Hapus produk        |")
print("|    6. Keluar              |")
print("=============================")
while True: # looping infinit selaman masukan bukan 6(keluar)
    req = int(input("Request: ")) # input request
    
    if req == 1: # tampikan produk
        petshop_jakarta.tampilkanProduk() # memanggil fungsi tampilkanProduk
    
    elif req == 2: # cari produk
        id = input("id produk yang dicari: ") # input id produk yang dicari
        petshop_jakarta.cariProduk(id) # memanggil fungsi cariProduk
    
    elif req == 3: # tambah produk
        print("id, nama produk, kategori produk, dan harga produk:")
        data = input().split() # input data produk, di split agar bisa menginput 1 baris dengan format 4 masukan tersebut
        id, namaProduk, kategoriProduk, hargaProduk = data # masing-masing inputan akan disimpan ke dalam variabel yang sesuai
        hargaProduk = int(hargaProduk) # mengubah harga produk ke integer
        petshop_jakarta.tambahProduk(id, namaProduk, kategoriProduk, hargaProduk) # memanggil fungsi tambahProduk
        
    elif req == 4: # update produk
        id = input("id produk yang ingin diupdate: ") # input id produk yang ingin diupdate
        print("nama produk baru, kategori produk baru, dan harga produk baru:")
        data = input().split() # input data produk baru, di split agar bisa menginput 1 baris dengan format 3 masukan tersebut
        namaProduk, kategoriProduk, hargaProduk = data  # masing-masing inputan akan disimpan ke dalam variabel yang sesuai
        hargaProduk = int(hargaProduk) # mengubah harga produk ke integer
        petshop_jakarta.updateProduk(id, namaProduk, kategoriProduk, hargaProduk) # memanggil fungsi updateProduk

    elif req == 5: # hapus produk
        id = input("id produk yang ingin dihapus: ") # input id produk yang ingin dihapus
        petshop_jakarta.hapusProduk(id) # memanggil fungsi hapusProduk
    
    elif req == 6: # keluar
        break

    else:
        print("Request tidak ada")
