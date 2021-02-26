package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratKPModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("nama_instansi")
    private final String nama_instansi;
    @SerializedName("ditujukan")
    private final String ditujukan;
    @SerializedName("alamat_instansi")
    private final String alamat_instansi;
    @SerializedName("tanggal_mulai")
    private final String tanggal_mulai;
    @SerializedName("tanggal_berakhir")
    private final String tanggal_berakhir;
    @SerializedName("keterangan")
    private final String keterangan;
    @SerializedName("kode_surat")
    private final String kode_surat;

    public SuratKPModel(String id_user, String nama_instansi, String ditujukan, String alamat_instansi, String tanggal_mulai, String tanggal_berakhir, String keterangan, String kode_surat) {
        this.id_user = id_user;
        this.nama_instansi = nama_instansi;
        this.ditujukan = ditujukan;
        this.alamat_instansi = alamat_instansi;
        this.tanggal_mulai = tanggal_mulai;
        this.tanggal_berakhir = tanggal_berakhir;
        this.keterangan = keterangan;
        this.kode_surat = kode_surat;
    }

    public String getId_user() {
        return id_user;
    }

    public String getNama_instansi() {
        return nama_instansi;
    }

    public String getDitujukan() {
        return ditujukan;
    }

    public String getAlamat_instansi() {
        return alamat_instansi;
    }

    public String getTanggal_mulai() {
        return tanggal_mulai;
    }

    public String getTanggal_berakhir() {
        return tanggal_berakhir;
    }

    public String getKeterangan() {
        return keterangan;
    }

    public String getKode_surat() {
        return kode_surat;
    }
}
