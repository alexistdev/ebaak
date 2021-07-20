package com.dennyprastiawan.ebaak.response;

import com.dennyprastiawan.ebaak.model.RiwayatModel;
import com.dennyprastiawan.ebaak.model.SemuaJurusanItem;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseRiwayat {
    @SerializedName("result")
    final private List<RiwayatModel> semuaRiwayatItem;

    public ResponseRiwayat(List<RiwayatModel> semuaRiwayatItem) {
        this.semuaRiwayatItem = semuaRiwayatItem;
    }

    public List<RiwayatModel> getSemuaRiwayatItem() {
        return semuaRiwayatItem;
    }
}
