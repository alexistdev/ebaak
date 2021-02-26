package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class RiwayatModel {
    @SerializedName("id_riwayat")
    private String id_riwayat;
    @SerializedName("nama_surat")
    private String nama_surat;
    @SerializedName("tanggal_surat")
    private String tanggal_surat;
    @SerializedName("kode_surat")
    private String kode_surat;
    @SerializedName("status_riwayat")
    private String status_riwayat;
    @SerializedName("type")
    private String type;

    public RiwayatModel(String id_riwayat, String nama_surat, String tanggal_surat, String kode_surat, String status_riwayat, String type) {
        this.id_riwayat = id_riwayat;
        this.nama_surat = nama_surat;
        this.tanggal_surat = tanggal_surat;
        this.kode_surat = kode_surat;
        this.status_riwayat = status_riwayat;
        this.type = type;
    }

    public String getId_riwayat() {
        return id_riwayat;
    }

    public String getNama_surat() {
        return nama_surat;
    }

    public String getTanggal_surat() {
        return tanggal_surat;
    }

    public String getKode_surat() {
        return kode_surat;
    }

    public String getStatus_riwayat() {
        return status_riwayat;
    }

    public String getType() {
        return type;
    }
}
