#LIST SERVICES
1. Login & Register User
2. Login & Add Admin
3. Pemesanan User dan Admin
4. Admin bisa cancel pemesanan
5. User bisa cancel pemesanan tapi maks hanya 30 menit sejak dibuat
6. Admin bisa melakukan restock (satu restock hanya untuk 1 barang)
7. Admin bisa melihat laporan pendapatan (pendapatan dilihat dari total harga di pemesanan, bukan di barang)
8. Admin bisa melihat banyak pengeluaran
9. Admin bisa mengupdate status pemesanan
10. Admin bisa menglola barang
11. List barang untuk user

#Konvensi
1. Tidak pakai eloquent, tapi pakai repository, namun repository tidak butuh dependency injection karena skala kecil
2. Pakai arsitektur onion
3. Pakai blade
4. Logging untuk aktivitas admin (bisa dilihat superadmin)

### Format Commit
1. Feat : nambah baru yang berhubuangn dengan backend
2. Fix : benerin bug, atau juga testing sambil fix
3. Refactor : Linting, fungsionalitas hampir sama tapi ganti logic 
4. Docs : Menambahkan dokumentasi
5. Style : UI
6. DB : melakukan perubahan pada migration/seeder
