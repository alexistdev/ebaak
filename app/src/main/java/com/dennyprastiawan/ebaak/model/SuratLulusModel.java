package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratLulusModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("tempat_lahir")
    private final String tempat_lahir;
    @SerializedName("tanggal_lahir")
    private final String tanggal_lahir;
    @SerializedName("kode_surat")
    private final String kode_surat;

    public SuratLulusModel(String id_user, String tempat_lahir, String tanggal_lahir, String kode_surat) {
        this.id_user = id_user;
        this.tempat_lahir = tempat_lahir;
        this.tanggal_lahir = tanggal_lahir;
        this.kode_surat = kode_surat;
    }

    public String getId_user() {
        return id_user;
    }

    public String getTempat_lahir() {
        return tempat_lahir;
    }

    public String getTanggal_lahir() {
        return tanggal_lahir;
    }

    public String getKode_surat() {
        return kode_surat;
    }
}
