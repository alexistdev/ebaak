package com.dennyprastiawan.ebaak.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.API.APIService;
import com.dennyprastiawan.ebaak.API.NoConnectivityException;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.config.Constants;
import com.dennyprastiawan.ebaak.fragment.surat.RiwayatAdapter;
import com.dennyprastiawan.ebaak.model.RiwayatModel;
import com.dennyprastiawan.ebaak.response.ResponseRiwayat;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class history_fragment extends Fragment {
    private RecyclerView HistoryView;
    private RiwayatAdapter riwayatAdapter;
    private List<RiwayatModel> daftarRiwayat;
    private ProgressDialog pDialog;
    private Context mContext;

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_history, container, false);
        HistoryView = view.findViewById(R.id.rcRiwayat);
        if(getActivity() != null){
            getActivity().setTitle("Riwayat Pengajuan");
        }
        init(view);
        setupRecyclerView();
        setData(getContext());

        return view;
    }

    public void setData(Context mContext) {
        try{
            SharedPreferences sharedPreferences = this.getActivity().getSharedPreferences(
                    Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
            String idUser = sharedPreferences.getString("idUser", "");
            Call<ResponseRiwayat> call = APIService.Factory.create(mContext).tampilRiwayat(idUser);
            call.enqueue(new Callback<ResponseRiwayat>() {
                @EverythingIsNonNull
                @Override
                public void onResponse(Call<ResponseRiwayat> call, Response<ResponseRiwayat> response) {
                    hideDialog();
                    if(response.isSuccessful()){
                        if(response.body() != null){
                            daftarRiwayat = response.body().getSemuaRiwayatItem();
                            riwayatAdapter.replaceData(daftarRiwayat);
                        }
                    }
                }
                @EverythingIsNonNull
                @Override
                public void onFailure(Call<ResponseRiwayat> call, Throwable t) {
                    hideDialog();
                    if(t instanceof NoConnectivityException) {
                        displayExceptionMessage("Internet Offline!");
                    }
                }
            });
        }catch(Exception e){
            hideDialog();
            e.printStackTrace();
            displayExceptionMessage(e.getMessage());
        }
    }

    private void setupRecyclerView() {
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getContext()){
            @Override
            public RecyclerView.LayoutParams generateDefaultLayoutParams() {
                return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
            }
        };
        riwayatAdapter = new RiwayatAdapter(getContext(),new ArrayList<>());
        HistoryView.setLayoutManager(linearLayoutManager);
        HistoryView.setAdapter(riwayatAdapter);
    }

    public void init(View view){

        pDialog = new ProgressDialog(view.getContext());
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
        showDialog();
    }

    private void showDialog(){
        if(!pDialog.isShowing()){
            pDialog.show();
        }
    }

    private void hideDialog(){
        if(pDialog.isShowing()){
            pDialog.dismiss();
        }
    }

    public void displayExceptionMessage(String msg)
    {
        Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
    }
}