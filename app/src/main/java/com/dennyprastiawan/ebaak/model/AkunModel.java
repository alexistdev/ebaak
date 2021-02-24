package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class AkunModel {
    @SerializedName("id_user")
    private final String id_user;

    @SerializedName("npm")
    private final String npm;

    @SerializedName("token")
    private final String token;

    @SerializedName("nama_jurusan")
    private final String nama_jurusan;

    @SerializedName("nama")
    private final String nama;

    @SerializedName("email")
    private final String email;

    public AkunModel(String id_user, String npm, String token, String nama_jurusan, String nama, String email) {
        this.id_user = id_user;
        this.npm = npm;
        this.token = token;
        this.nama_jurusan = nama_jurusan;
        this.nama = nama;
        this.email = email;
    }

    public String getId_user() {
        return id_user;
    }

    public String getNpm() {
        return npm;
    }

    public String getToken() {
        return token;
    }

    public String getNama_jurusan() {
        return nama_jurusan;
    }

    public String getNama() {
        return nama;
    }

    public String getEmail() {
        return email;
    }
}
