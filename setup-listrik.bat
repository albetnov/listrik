@echo off
echo Starting Migration...
echo Listrik by Albet Novendo.
php asmvc run:migration Level
php asmvc run:migration Admin
php asmvc run:migration Tarif
php asmvc run:migration Pelanggan
php asmvc run:migration Penggunaan
php asmvc run:migration Tagihan
php asmvc run:migration Pembayaran
echo Migration finished.
echo Seeding database...
php asmvc run:seeder LevelSeeder
php asmvc run:seeder UserSeeder
echo Setup Completed.
