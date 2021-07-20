package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratPindahKelasModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("kelas_sebelum")
    private final String kelas_sebelum;
    @SerializedName("alasan_pindah")
    private final String alasan_pindah;
    @SerializedName("tanggal_pengajuan")
    private final String tanggal_pengajuan;
    @SerializedName("kode_surat")
    private final String kode_surat;

    public SuratPindahKelasModel(String id_user, String kelas_sebelum, String alasan_pindah, String tanggal_pengajuan, String kode_surat) {
        this.id_user = id_user;
        this.kelas_sebelum = kelas_sebelum;
        this.alasan_pindah = alasan_pindah;
        this.tanggal_pengajuan = tanggal_pengajuan;
        this.kode_surat = kode_surat;
    }

    public String getId_user() {
        return id_user;
    }

    public String getKelas_sebelum() {
        return kelas_sebelum;
    }

    public String getAlasan_pindah() {
        return alasan_pindah;
    }

    public String getTanggal_pengajuan() {
        return tanggal_pengajuan;
    }

    public String getKode_surat() {
        return kode_surat;
    }
}
