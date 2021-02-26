package com.dennyprastiawan.ebaak.desain;

import android.app.DatePickerDialog;
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
import com.dennyprastiawan.ebaak.model.APIError;
import com.dennyprastiawan.ebaak.model.SuratLulusModel;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

import okhttp3.MediaType;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Tandalulus extends AppCompatActivity {
    private ProgressDialog pDialog;
    private EditText mTempat,mTanggal;
    private Button mRegistrasi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tandalulus);
        Tandalulus.this.setTitle("Surat Tanda Lulus");
        tampil_syarat();
        init();
        mRegistrasi.setOnClickListener(v -> simpan());
        final Calendar myCalendar1 = Calendar.getInstance();
        DatePickerDialog.OnDateSetListener date = (view, year, month, dayOfMonth) -> {
            myCalendar1.set(Calendar.YEAR, year);
            myCalendar1.set(Calendar.MONTH, month);
            myCalendar1.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            String myFormat = "dd-MM-yyyy"; //In which you need put here
            SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.ITALY);
            mTanggal.setText(sdf.format(myCalendar1.getTime()));
        };
        mTanggal.setOnClickListener(v -> new DatePickerDialog(Tandalulus.this, date, myCalendar1
                .get(Calendar.YEAR), myCalendar1.get(Calendar.MONTH),
                myCalendar1.get(Calendar.DAY_OF_MONTH)).show());
    }

    private void simpan() {
        showDialog();
        SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        String tempat =  mTempat.getText().toString();
        String tanggal =  mTanggal.getText().toString();
        if(tempat.length() == 0 || tanggal.length() == 0){
            hideDialog();
            displayExceptionMessage("Silahkan lengkapi form !");
        } else {
            try{
                RequestBody id = RequestBody.create(MediaType.parse("multipart/form-data"), idUser);
                RequestBody xtempat = RequestBody.create(MediaType.parse("multipart/form-data"), tempat);
                RequestBody xtanggal = RequestBody.create(MediaType.parse("multipart/form-data"), tanggal);
                Call<SuratLulusModel> call = APIService.Factory.create(Tandalulus.this).daftarLulus(id,xtempat,xtanggal);
                call.enqueue(new Callback<SuratLulusModel>() {
                    @EverythingIsNonNull
                    @Override
                    public void onResponse(Call<SuratLulusModel> call, Response<SuratLulusModel> response) {
                        hideDialog();
                        if(response.isSuccessful()){
                            hideDialog();
                            Intent intent = new Intent(Tandalulus.this, MainActivity.class);
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
                    public void onFailure(Call<SuratLulusModel> call, Throwable t) {
                        hideDialog();
                        if(t instanceof NoConnectivityException) {
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
        mTempat= findViewById(R.id.txtTempatLahir);
        mTanggal= findViewById(R.id.txtAlasan);
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
                Tandalulus.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Form STLS yang sudah diisi.",
                "2. File dijadikan satu dalam folder zip/rar."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}