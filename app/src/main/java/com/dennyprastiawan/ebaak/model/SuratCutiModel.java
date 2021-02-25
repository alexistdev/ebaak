package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratCutiModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("tahun_akademik")
    private final String tahun_akademik;
    @SerializedName("alasan_cuti")
    private final String alasan_cuti;


    public SuratCutiModel(String id_user, String tahun_akademik, String alasan_cuti) {
        this.id_user = id_user;
        this.tahun_akademik = tahun_akademik;
        this.alasan_cuti = alasan_cuti;

    }

    public String getId_user() {
        return id_user;
    }

    public String getTahun_akademik() {
        return tahun_akademik;
    }

    public String getAlasan_cuti() {
        return alasan_cuti;
    }


}
