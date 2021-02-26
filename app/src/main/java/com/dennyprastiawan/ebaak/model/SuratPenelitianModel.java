package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratPenelitianModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("ditujukan")
    private final String ditujukan;
    @SerializedName("nama_instansi")
    private final String nama_instansi;
    @SerializedName("alamat_instansi")
    private final String alamat_instansi;
    @SerializedName("judul_penelitian")
    private final String judul_penelitian;
    @SerializedName("tanggal_mulai")
    private final String tanggal_mulai;
    @SerializedName("tanggal_akhir")
    private final String tanggal_akhir;
    @SerializedName("lampiran")
    private final String lampiran;
    @SerializedName("kode_surat")
    private final String kode_surat;

    public SuratPenelitianModel(String id_user, String ditujukan, String nama_instansi, String alamat_instansi, String judul_penelitian, String tanggal_mulai, String tanggal_akhir, String lampiran, String kode_surat) {
        this.id_user = id_user;
        this.ditujukan = ditujukan;
        this.nama_instansi = nama_instansi;
        this.alamat_instansi = alamat_instansi;
        this.judul_penelitian = judul_penelitian;
        this.tanggal_mulai = tanggal_mulai;
        this.tanggal_akhir = tanggal_akhir;
        this.lampiran = lampiran;
        this.kode_surat = kode_surat;
    }

    public String getId_user() {
        return id_user;
    }

    public String getDitujukan() {
        return ditujukan;
    }

    public String getNama_instansi() {
        return nama_instansi;
    }

    public String getAlamat_instansi() {
        return alamat_instansi;
    }

    public String getJudul_penelitian() {
        return judul_penelitian;
    }

    public String getTanggal_mulai() {
        return tanggal_mulai;
    }

    public String getTanggal_akhir() {
        return tanggal_akhir;
    }

    public String getLampiran() {
        return lampiran;
    }

    public String getKode_surat() {
        return kode_surat;
    }
}
