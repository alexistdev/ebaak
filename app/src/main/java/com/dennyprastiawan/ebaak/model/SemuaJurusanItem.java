package com.dennyprastiawan.ebaak.model;

import com.google.gson.annotations.SerializedName;

public class SemuaJurusanItem {
    @SerializedName("nama_jurusan")
    final private String nama_jurusan;
    @SerializedName("id_jurusan")
    final private String id_jurusan;

    public SemuaJurusanItem(String nama_jurusan, String id_jurusan) {
        this.nama_jurusan = nama_jurusan;
        this.id_jurusan = id_jurusan;
    }

    public String getNama_jurusan() {
        return nama_jurusan;
    }

    public String getId_jurusan() {
        return id_jurusan;
    }
}
