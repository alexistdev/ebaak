package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class MahasiswaModel {
    @SerializedName("id_user")
    private String id_user;
    @SerializedName("npm")
    private String npm;
    @SerializedName("id_jurusan")
    private String id_jurusan;
    @SerializedName("nama")
    private String nama;
    @SerializedName("email")
    private String email;

    public MahasiswaModel(String id_user, String npm, String id_jurusan, String nama, String email) {
        this.id_user = id_user;
        this.npm = npm;
        this.id_jurusan = id_jurusan;
        this.nama = nama;
        this.email = email;
    }

    public String getId_user() {
        return id_user;
    }

    public String getNpm() {
        return npm;
    }

    public String getId_jurusan() {
        return id_jurusan;
    }

    public String getNama() {
        return nama;
    }

    public String getEmail() {
        return email;
    }
}
