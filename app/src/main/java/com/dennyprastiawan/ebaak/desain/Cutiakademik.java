package com.dennyprastiawan.ebaak.desain;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
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

public class Cutiakademik extends AppCompatActivity {
    private EditText mTahun,mAlasan;
    private Button mRegister;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cutiakademik);
        Cutiakademik.this.setTitle("Cuti Akademik");
        tampil_syarat();
        init();

        mRegister.setOnClickListener(v -> simpanData());
    }

    public void simpanData(){

        SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        String tahunAkademik =  mTahun.getText().toString();
        String alasanCuti =  mAlasan.getText().toString();
        if(idUser.length() == 0){
            displayExceptionMessage("User tidak ditemukan , silahkan login ulang");
        } else if(tahunAkademik.length() == 0 || alasanCuti.length() == 0){
            displayExceptionMessage("Semua kolom harus diisi!");
        } else {
            try{
                Call<SuratCutiModel> call = APIService.Factory.create(getApplicationContext()).daftarCuti(idUser,tahunAkademik,alasanCuti);
                call.enqueue(new Callback<SuratCutiModel>() {
                    @EverythingIsNonNull
                    @Override
                    public void onResponse(Call<SuratCutiModel> call, Response<SuratCutiModel> response) {
                        if(response.isSuccessful()){
                            Intent intent = new Intent(Cutiakademik.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                            displayExceptionMessage("Berhasil disimpan");
                        }
                    }

                    @EverythingIsNonNull
                    @Override
                    public void onFailure(Call<SuratCutiModel> call, Throwable t) {

                        if(t instanceof NoConnectivityException) {
                            displayExceptionMessage("Internet Offline!");
                        }
                    }
                });

            }catch (Exception e){

                e.printStackTrace();
                displayExceptionMessage(e.getMessage());
            }
        }
    }

    public void init(){
        mTahun = findViewById(R.id.txtTahun);
        mAlasan = findViewById(R.id.txtAlasan);
        mRegister = findViewById(R.id.btnRegistrasi);
        pDialog = new ProgressDialog(getApplicationContext());
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public void onProfilAction(MenuItem mi) {
        displayExceptionMessage("Selamat Datang!");
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
                Cutiakademik.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Membayar Biaya Cuti AKademik.",
                "2. Aktif Semester Sebelumnya."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}