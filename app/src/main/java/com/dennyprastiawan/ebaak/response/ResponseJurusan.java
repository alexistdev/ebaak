package com.dennyprastiawan.ebaak.response;

import com.dennyprastiawan.ebaak.model.SemuaJurusanItem;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseJurusan {
    @SerializedName("result")
    final private List<SemuaJurusanItem> semuaJurusanItems;

    public ResponseJurusan(List<SemuaJurusanItem> semuaJurusanItems) {
        this.semuaJurusanItems = semuaJurusanItems;
    }


    public List<SemuaJurusanItem> getSemuaJurusanItems() {
        return semuaJurusanItems;
    }
}
