<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryTables extends Migration
{
    public function up()
    {
        // Tabel tbl_rak
        Schema::create('tbl_rak', function (Blueprint $table) {
            $table->id('id_rak');
            $table->string('kode_rak', 10)->unique();
            $table->string('rak', 25)->unique();
            $table->string('keterangan', 50);
            $table->primary('id_rak');
        });

        // Tabel tbl_ddc
        Schema::create('tbl_ddc', function (Blueprint $table) {
            $table->id('id_ddc');
            $table->unsignedBigInteger('id_rak');
            $table->string('kode_ddc', 10)->unique();
            $table->string('ddc', 100);
            $table->string('keterangan', 100);
            $table->foreign('id_rak')->references('id_rak')->on('tbl_rak');
            $table->primary('id_ddc');
        });

        // Tabel tbl_format
        Schema::create('tbl_format', function (Blueprint $table) {
            $table->id('id_format');
            $table->string('kode_format', 10)->unique();
            $table->string('format', 25);
            $table->string('keterangan', 50);
            $table->primary('id_format');
        });

        // Tabel tbl_jenis_anggota
        Schema::create('tbl_jenis_anggota', function (Blueprint $table) {
            $table->id('id_jenis_anggota');
            $table->string('kode_jenis_anggota', 2)->unique();
            $table->string('jenis_anggota', 15);
            $table->string('max_pinjam', 5);
            $table->string('keterangan', 200);
            $table->primary('id_jenis_anggota');
        });

        // Tabel tbl_penerbit
        Schema::create('tbl_penerbit', function (Blueprint $table) {
            $table->id('id_penerbit');
            $table->string('kode_penerbit', 10)->unique();
            $table->string('nama_penerbit', 50)->unique();
            $table->string('alamat_penerbit', 150);
            $table->string('no_telp', 15);
            $table->string('email', 30);
            $table->string('fax', 15);
            $table->string('website', 50);
            $table->string('kontak', 50);
            $table->primary('id_penerbit');
        });
        
        // Tabel tbl_pengarang
        Schema::create('tbl_pengarang', function (Blueprint $table) {
            $table->id('id_pengarang');
            $table->string('kode_pengarang', 10)->unique();
            $table->string('gelar_depan', 10)->nullable();
            $table->string('nama_pengarang', 50)->unique();
            $table->string('gelar_belakang', 10)->nullable();
            $table->string('no_telp', 20);
            $table->string('email', 50);
            $table->string('website', 200);
            $table->longText('biografi');
            $table->string('keterangan', 50);
            $table->primary('id_pengarang');
        });

        // Tabel tbl_perpustakaan
        Schema::create('tbl_perpustakaan', function (Blueprint $table) {
            $table->id('id_perpustakaan');
            $table->string('nama_perpustakaan', 100)->unique();
            $table->string('nama_pustakawan', 50);
            $table->string('alamat', 150);
            $table->string('email', 50)->unique();
            $table->string('website', 50);
            $table->string('no_telp', 20);
            $table->string('keterangan', 50);
            $table->primary('id_perpustakaan');
        });

        // Tabel tbl_pustaka
        Schema::create('tbl_pustaka', function (Blueprint $table) {
            $table->id('id_pustaka');
            $table->unsignedBigInteger('kode_pustaka')->unique();
            $table->unsignedBigInteger('id_ddc');
            $table->unsignedBigInteger('id_format');
            $table->unsignedBigInteger('id_penerbit');
            $table->unsignedBigInteger('id_pengarang');
            $table->string('isbn', 20)->unique();
            $table->string('judul_pustaka', 100);
            $table->string('tahun_terbit', 5);
            $table->string('keyword', 50);
            $table->string('keterangan_fisik', 100);
            $table->string('keterangan_tambahan', 100);
            $table->longText('abstraksi');
            $table->longText('gambar');
            $table->integer('harga_buku');
            $table->string('kondisi_buku', 15);
            $table->enum('fp', ['0', '1']);
            $table->tinyInteger('jml_pinjam')->default(0);
            $table->tinyInteger('stok')->default(0);
            $table->tinyInteger('sisa')->default(0); // Kolom sisa akan dihitung berdasarkan stok dan jml_pinjam
            $table->integer('denda_terlambat');
            $table->integer('denda_hilang');
            $table->foreign('id_ddc')->references('id_ddc')->on('tbl_ddc');
            $table->foreign('id_format')->references('id_format')->on('tbl_format');
            $table->foreign('id_penerbit')->references('id_penerbit')->on('tbl_penerbit');
            $table->foreign('id_pengarang')->references('id_pengarang')->on('tbl_pengarang');
            $table->primary('id_pustaka');
        });

        // Tabel tbl_anggota
        Schema::create('tbl_anggota', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->unsignedBigInteger('id_jenis_anggota');
            $table->string('kode_anggota', 20)->unique();
            $table->string('nama_anggota', 100)->unique();
            $table->string('tempat', 20);
            $table->date('tgl_lahir');
            $table->string('alamat', 50);
            $table->string('no_telp', 15);
            $table->string('email', 30);
            $table->date('tgl_daftar');
            $table->date('masa_aktif');
            $table->enum('fa', ['Y', 'T']);
            $table->string('keterangan', 45);
            $table->longText('foto');
            $table->string('username', 50)->unique();
            $table->string('password', 200);
            
            $table->foreign('id_jenis_anggota')->references('id_jenis_anggota')->on('tbl_jenis_anggota');
            $table->primary('id_anggota');
        });

        // Tabel tgl_transaksi
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_pustaka');
            $table->unsignedBigInteger('id_anggota');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->date('tgl_pengembalian')->nullable();
            $table->enum('fp', ['0', '1']);
            $table->string('keterangan', 50);
            $table->foreign('id_pustaka')->references('id_pustaka')->on('tbl_pustaka');
            $table->foreign('id_anggota')->references('id_anggota')->on('tbl_anggota');
            $table->primary('id_transaksi');
        });
    }

    public function down()
    {
        // Drop tables in reverse order
        Schema::dropIfExists('tbl_transaksi');
        Schema::dropIfExists('tbl_anggota');
        Schema::dropIfExists('tbl_pustaka');
        Schema::dropIfExists('tbl_perpustakaan');
        Schema::dropIfExists('tbl_pengarang');
        Schema::dropIfExists('tbl_penerbit');
        Schema::dropIfExists('tbl_jenis_anggota');
        Schema::dropIfExists('tbl_format');
        Schema::dropIfExists('tbl_ddc');
        Schema::dropIfExists('tbl_rak');
    }
}
