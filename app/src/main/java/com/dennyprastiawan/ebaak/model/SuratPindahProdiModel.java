package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratPindahProdiModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("nama_prodi")
    private final String nama_prodi;
    @SerializedName("alasan_pindah")
    private final String alasan_pindah;
    @SerializedName("kode_surat")
    private final String kode_surat;

    public SuratPindahProdiModel(String id_user, String nama_prodi, String alasan_pindah, String kode_surat) {
        this.id_user = id_user;
        this.nama_prodi = nama_prodi;
        this.alasan_pindah = alasan_pindah;
        this.kode_surat = kode_surat;
    }

    public String getId_user() {
        return id_user;
    }

    public String getNama_prodi() {
        return nama_prodi;
    }

    public String getAlasan_pindah() {
        return alasan_pindah;
    }

    public String getKode_surat() {
        return kode_surat;
    }
}
