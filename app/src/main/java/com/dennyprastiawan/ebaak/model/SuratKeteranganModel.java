package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratKeteranganModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("nik_ortu")
    private final String nik_ortu;
    @SerializedName("nama_ortu")
    private final String nama_ortu;
    @SerializedName("pekerjaan_ortu")
    private final String pekerjaan_ortu;
    @SerializedName("alamat")
    private final String alamat;
    @SerializedName("keperluan")
    private final String keperluan;
    @SerializedName("message")
    private final String message;

    public SuratKeteranganModel(String id_user, String nik_ortu, String nama_ortu, String pekerjaan_ortu, String alamat, String keperluan, String message) {
        this.id_user = id_user;
        this.nik_ortu = nik_ortu;
        this.nama_ortu = nama_ortu;
        this.pekerjaan_ortu = pekerjaan_ortu;
        this.alamat = alamat;
        this.keperluan = keperluan;
        this.message = message;
    }

    public String getId_user() {
        return id_user;
    }

    public String getNik_ortu() {
        return nik_ortu;
    }

    public String getNama_ortu() {
        return nama_ortu;
    }

    public String getPekerjaan_ortu() {
        return pekerjaan_ortu;
    }

    public String getAlamat() {
        return alamat;
    }

    public String getKeperluan() {
        return keperluan;
    }

    public String getMessage() {
        return message;
    }
}
