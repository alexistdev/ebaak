package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.AppCompatButton;

import android.app.DatePickerDialog;
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
import com.dennyprastiawan.ebaak.model.SuratSidangModel;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class SuratSidang extends AppCompatActivity {
    EditText mJudul,mPembimbing,mPenguji1,mPenguji2,mNIDN,mSKbimbingan,mTglSK,mTglACC,mJumlah;
    private ProgressDialog pDialog;
    private Button mRegistrasi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_surat_sidang);
        SuratSidang.this.setTitle("Surat Pendaftaran Sidang");
        init();
        mRegistrasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                simpanData();
            }
        });
        /* Menampilkan calendar picker */
        final Calendar myCalendar1 = Calendar.getInstance();
        final Calendar myCalendar2 = Calendar.getInstance();
        DatePickerDialog.OnDateSetListener date = (view, year, month, dayOfMonth) -> {
            myCalendar1.set(Calendar.YEAR, year);
            myCalendar1.set(Calendar.MONTH, month);
            myCalendar1.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            String myFormat = "dd-MM-yyyy"; //In which you need put here
            SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.ITALY);
            mTglSK.setText(sdf.format(myCalendar1.getTime()));
        };
        mTglSK.setOnClickListener(v -> new DatePickerDialog(SuratSidang.this, date, myCalendar1
                .get(Calendar.YEAR), myCalendar1.get(Calendar.MONTH),
                myCalendar1.get(Calendar.DAY_OF_MONTH)).show());

        DatePickerDialog.OnDateSetListener date2 = (view, year, month, dayOfMonth) -> {
            myCalendar2.set(Calendar.YEAR, year);
            myCalendar2.set(Calendar.MONTH, month);
            myCalendar2.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            String myFormat2 = "dd-MM-yyyy"; //In which you need put here
            SimpleDateFormat sdf2 = new SimpleDateFormat(myFormat2, Locale.ITALY);
            mTglACC.setText(sdf2.format(myCalendar2.getTime()));
        };
        mTglACC.setOnClickListener(v -> new DatePickerDialog(SuratSidang.this, date2, myCalendar2
                .get(Calendar.YEAR), myCalendar2.get(Calendar.MONTH),
                myCalendar2.get(Calendar.DAY_OF_MONTH)).show());

    }

    public void simpanData(){
        SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        String judul =  mJudul.getText().toString();
        String pembimbing =  mPembimbing.getText().toString();
        String penguji1 =  mPenguji1.getText().toString();
        String penguji2 =  mPenguji1.getText().toString();
        String NIDN =  mNIDN.getText().toString();
        String SKbimbingan =  mSKbimbingan.getText().toString();
        String TglSK =  mTglSK.getText().toString();
        String TglACC =  mTglACC.getText().toString();
        String Jumlah =  mJumlah.getText().toString();
        if(idUser.length() == 0){
            displayExceptionMessage("User tidak ditemukan , silahkan login ulang");
        } else if(judul.length() == 0 || pembimbing.length() == 0 || penguji1.length() == 0 || penguji2.length() == 0 || NIDN.length() == 0 || SKbimbingan.length() == 0 || TglSK.length() == 0 || TglACC.length() == 0 || Jumlah.length() == 0){
            displayExceptionMessage("Semua kolom harus diisi!");
        } else {
            try{
                Call<SuratSidangModel> call = APIService.Factory.create(getApplicationContext()).daftarSidang(idUser,judul,pembimbing,penguji1,penguji2,NIDN,SKbimbingan,TglSK,TglACC,Jumlah);
                call.enqueue(new Callback<SuratSidangModel>() {
                    @Override
                    public void onResponse(Call<SuratSidangModel> call, Response<SuratSidangModel> response) {
                        if(response.isSuccessful()){
                            Intent intent = new Intent(SuratSidang.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                            displayExceptionMessage("Berhasil disimpan");
                        }
                    }

                    @Override
                    public void onFailure(Call<SuratSidangModel> call, Throwable t) {
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
        mJudul = findViewById(R.id.txtJudul);
        mPembimbing = findViewById(R.id.txtPembimbing);
        mPenguji1 = findViewById(R.id.txtPenguji1);
        mPenguji2 = findViewById(R.id.txtPenguji2);
        mNIDN = findViewById(R.id.txtNIDN);
        mSKbimbingan = findViewById(R.id.txtNomorSK);
        mTglSK = findViewById(R.id.txtTanggalSK);
        mTglACC = findViewById(R.id.txtTanggalAcc);
        mJumlah = findViewById(R.id.txtJumlahBimbingan);
        mRegistrasi = findViewById(R.id.btnRegistrasi);
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
        displayExceptionMessage("ini profil");
    }

    public void displayExceptionMessage(String msg)
    {
        Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
    }

}