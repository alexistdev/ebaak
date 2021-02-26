package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.API.APIService;
import com.dennyprastiawan.ebaak.API.NoConnectivityException;
import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.config.Constants;
import com.dennyprastiawan.ebaak.model.SuratCutiModel;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Aktifakademik extends AppCompatActivity {
    private ProgressDialog pDialog;
    private EditText mAlasan;
    private Button mRegistrasi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_aktifakademik);
        Aktifakademik.this.setTitle("Aktif Kembali");
        tampil_syarat();
        init();
        mRegistrasi.setOnClickListener(v -> simpan());
    }

    public void simpan(){
        showDialog();
        SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        String alasan =  mAlasan.getText().toString();
        if(idUser.length() == 0) {
            hideDialog();
            displayExceptionMessage("User tidak ditemukan , silahkan login ulang");
        } else if(alasan.length() == 0){
            hideDialog();
            displayExceptionMessage("Semua kolom harus diisi!");
        } else {
            try{
                Call<SuratCutiModel> call= APIService.Factory.create(getApplicationContext()).daftarAktif(idUser,alasan);
                call.enqueue(new Callback<SuratCutiModel>() {
                    @EverythingIsNonNull
                    @Override
                    public void onResponse(Call<SuratCutiModel> call, Response<SuratCutiModel> response) {
                        if(response.isSuccessful()){
                            hideDialog();
                            Intent intent = new Intent(Aktifakademik.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                            displayExceptionMessage("Berhasil disimpan");
                        }
                    }

                    @EverythingIsNonNull
                    @Override
                    public void onFailure(Call<SuratCutiModel> call, Throwable t) {
                        if(t instanceof NoConnectivityException) {
                            hideDialog();
                            displayExceptionMessage("Internet Offline!");
                        }
                    }
                });
            }catch (Exception e){
                hideDialog();
                e.printStackTrace();
                displayExceptionMessage(e.getMessage());
            }
        }
    }

    public void init(){
        mAlasan = findViewById(R.id.txtAlasan);
        mRegistrasi = findViewById(R.id.btnRegistrasi);
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public void onProfilAction(MenuItem mi) {
        displayExceptionMessage("ini profil");
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
        Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
    }

    public void tampil_syarat()
    {
        final AlertDialog.Builder alert = new AlertDialog.Builder(
                Aktifakademik.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Dinyatakan Cuti Semester Sebelumnya di Sistem."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}