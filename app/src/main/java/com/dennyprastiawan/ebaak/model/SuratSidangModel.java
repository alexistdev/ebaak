package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SuratSidangModel {
    @SerializedName("id_user")
    private final String id_user;
    @SerializedName("judul")
    private final String judul;
    @SerializedName("pembimbing")
    private final String pembimbing;
    @SerializedName("penguji1")
    private final String penguji1;
    @SerializedName("penguji2")
    private final String penguji2;
    @SerializedName("nidn_pembimbing")
    private final String nidn_pembimbing;
    @SerializedName("nomor_sk")
    private final String nomor_sk;
    @SerializedName("tanggal_sk")
    private final String tanggal_sk;
    @SerializedName("tanggal_acc")
    private final String tanggal_acc;
    @SerializedName("jumlah_bimbingan")
    private final String jumlah_bimbingan;

    public SuratSidangModel(String id_user, String judul, String pembimbing, String penguji1, String penguji2, String nidn_pembimbing, String nomor_sk, String tanggal_sk, String tanggal_acc, String jumlah_bimbingan) {
        this.id_user = id_user;
        this.judul = judul;
        this.pembimbing = pembimbing;
        this.penguji1 = penguji1;
        this.penguji2 = penguji2;
        this.nidn_pembimbing = nidn_pembimbing;
        this.nomor_sk = nomor_sk;
        this.tanggal_sk = tanggal_sk;
        this.tanggal_acc = tanggal_acc;
        this.jumlah_bimbingan = jumlah_bimbingan;
    }

    public String getId_user() {
        return id_user;
    }

    public String getJudul() {
        return judul;
    }

    public String getPembimbing() {
        return pembimbing;
    }

    public String getPenguji1() {
        return penguji1;
    }

    public String getPenguji2() {
        return penguji2;
    }

    public String getNidn_pembimbing() {
        return nidn_pembimbing;
    }

    public String getNomor_sk() {
        return nomor_sk;
    }

    public String getTanggal_sk() {
        return tanggal_sk;
    }

    public String getTanggal_acc() {
        return tanggal_acc;
    }

    public String getJumlah_bimbingan() {
        return jumlah_bimbingan;
    }
}
