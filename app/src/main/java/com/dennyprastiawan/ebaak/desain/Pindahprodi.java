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
import com.dennyprastiawan.ebaak.model.APIError;
import com.dennyprastiawan.ebaak.model.SuratPindahProdiModel;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;

import okhttp3.MediaType;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Pindahprodi extends AppCompatActivity {
    private ProgressDialog pDialog;
    private EditText mProdi,mAlasan;
    private Button mRegistrasi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pindahprodi);
        Pindahprodi.this.setTitle("Surat Pindah Program Studi");
        tampil_syarat();
        init();
        mRegistrasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                simpan();
            }
        });
    }

    private void simpan(){
        SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        String prodi =  mProdi.getText().toString();
        String alasan =  mAlasan.getText().toString();
        if(prodi.length() == 0 || alasan.length() == 0){
            displayExceptionMessage("Silahkan lengkapi form !");
        } else {
            showDialog();
            RequestBody id = RequestBody.create(MediaType.parse("multipart/form-data"), idUser);
            RequestBody xprodi = RequestBody.create(MediaType.parse("multipart/form-data"), prodi);
            RequestBody xalasan = RequestBody.create(MediaType.parse("multipart/form-data"), alasan);
            try{
                Call<SuratPindahProdiModel> call = APIService.Factory.create(Pindahprodi.this).daftarPindahProdi(id,xprodi,xalasan);
                call.enqueue(new Callback<SuratPindahProdiModel>() {
                    @EverythingIsNonNull
                    @Override
                    public void onResponse(Call<SuratPindahProdiModel> call, Response<SuratPindahProdiModel> response) {
                        if(response.isSuccessful()){
                            hideDialog();
                            Intent intent = new Intent(Pindahprodi.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                            displayExceptionMessage("Berhasil disimpan");
                        }else {
                            hideDialog();
                            APIError error = ErrorUtils.parseError(response);
                            displayExceptionMessage(error.message());
                        }
                    }

                    @EverythingIsNonNull
                    @Override
                    public void onFailure(Call<SuratPindahProdiModel> call, Throwable t) {
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
        mProdi= findViewById(R.id.txtProdi);
        mAlasan= findViewById(R.id.txtAlasan);
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
                Pindahprodi.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Surat permohonan mahasiswa yang ditandatangani Orang Tua/Wali.",
                "2. Pengumpulan DNS & KRS Asli Pertama s.d Terakhir.",
                "3. Surat Keterangan Bebas Perpustakaan.",
                "4. Scan KTM.",
                "5. File dijadikan satu dalam folder zip/rar."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}