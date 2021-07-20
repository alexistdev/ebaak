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
import com.dennyprastiawan.ebaak.model.SuratKeteranganModel;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Suratketerangan extends AppCompatActivity {
    private ProgressDialog pDialog;
    private Button mRegistrasi;
    private EditText mNik,mNama,mkerja,mAlamat,mPerlu,mLampiran;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_suratketerangan);
        Suratketerangan.this.setTitle("Surat Keterangan");
        init();
        tampil_syarat();
        mRegistrasi.setOnClickListener(v -> displayExceptionMessage("Silahkan lengkapi Form terlebih dahulu !"));
        SharedPreferences sharedPreferences = this.getSharedPreferences(Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        mRegistrasi.setOnClickListener(v -> {
            try {
                String idUser = sharedPreferences.getString("idUser", "");
                String nik =  mNik.getText().toString();
                String nama =  mNama.getText().toString();
                String pekerjaan =  mkerja.getText().toString();
                String alamat =  mAlamat.getText().toString();
                String keperluan =  mPerlu.getText().toString();
                String lampiran = mLampiran.getText().toString();
                if(nik.length() == 0 || nama.length() == 0 || pekerjaan.length() == 0 || alamat.length() == 0 || keperluan.length() == 0 || lampiran.length() == 0 ){
                    displayExceptionMessage("Silahkan lengkapi form terlebih dahulu");
                } else {
                    showDialog();
                    Call<SuratKeteranganModel> call =  APIService.Factory.create(Suratketerangan.this).daftarSk(idUser,nik,nama,pekerjaan,alamat,keperluan,lampiran);
                    call.enqueue(new Callback<SuratKeteranganModel>() {
                        @EverythingIsNonNull
                        @Override
                        public void onResponse(Call<SuratKeteranganModel> call, Response<SuratKeteranganModel> response) {
                            hideDialog();
                            if(response.isSuccessful()){
                                Intent intent = new Intent(Suratketerangan.this, MainActivity.class);
                                startActivity(intent);
                                finish();
                                displayExceptionMessage("Berhasil disimpan");
                            }
                        }
                        @EverythingIsNonNull
                        @Override
                        public void onFailure(Call<SuratKeteranganModel> call, Throwable t) {
                            if(t instanceof NoConnectivityException) {
                                hideDialog();
                                displayExceptionMessage("Internet Offline!");
                            }
                        }
                    });
                }
            } catch (Exception e) {
                hideDialog();
                e.printStackTrace();
                displayExceptionMessage(e.getMessage());
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public void init(){
        mRegistrasi = findViewById(R.id.btnRegistrasi);
        mNik = findViewById(R.id.etNikOrtu);
        mNama = findViewById(R.id.etNamaOrtu);
        mkerja = findViewById(R.id.etPekerjaan);
        mAlamat = findViewById(R.id.etAlamat);
        mPerlu= findViewById(R.id.etKeperluan);
        mLampiran = findViewById(R.id.etLinkUpload);
        pDialog = new ProgressDialog(Suratketerangan.this);
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");

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
        Toast.makeText(Suratketerangan.this, msg, Toast.LENGTH_LONG).show();
    }

    public void tampil_syarat()
    {
        final AlertDialog.Builder alert = new AlertDialog.Builder(
                Suratketerangan.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Melampirkan Fotocopy KRS (Semester Berjalan).",
                "2. Melampirkan Fotocopy DNS (Semester Terakhir/Semester Aktif).",
                "3. Melampirkan Fotocopy Slip BPP (Semester Berjalan).",
                "4. File dijadikan satu dalam folder zip/rar kemudian diupload ke google drive, dan sertakan linknya pada form!."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}