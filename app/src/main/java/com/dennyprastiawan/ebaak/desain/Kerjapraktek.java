package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

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
import com.dennyprastiawan.ebaak.API.APIService;
import com.dennyprastiawan.ebaak.API.NoConnectivityException;
import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.config.Constants;
import com.dennyprastiawan.ebaak.model.APIError;
import com.dennyprastiawan.ebaak.model.SuratKPModel;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Kerjapraktek extends AppCompatActivity {
    private ProgressDialog pDialog;
    private EditText mNama,mDituju,mAlamat,mTglMUlai,mTglAkhir,mKeterangan,mUpload;
    private Button mRegister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_kerjapraktek);
        Kerjapraktek.this.setTitle("Surat Kerja Praktek");
        tampil_syarat();
        init();
        mRegister.setOnClickListener(v -> simpan());
        /* Menampilkan calendar picker */
        final Calendar myCalendar1 = Calendar.getInstance();
        final Calendar myCalendar2 = Calendar.getInstance();
        DatePickerDialog.OnDateSetListener date = (view, year, month, dayOfMonth) -> {
            myCalendar1.set(Calendar.YEAR, year);
            myCalendar1.set(Calendar.MONTH, month);
            myCalendar1.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            String myFormat = "dd-MM-yyyy"; //In which you need put here
            SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.ITALY);
            mTglMUlai.setText(sdf.format(myCalendar1.getTime()));
        };
        mTglMUlai.setOnClickListener(v -> new DatePickerDialog(Kerjapraktek.this, date, myCalendar1
                .get(Calendar.YEAR), myCalendar1.get(Calendar.MONTH),
                myCalendar1.get(Calendar.DAY_OF_MONTH)).show());

        DatePickerDialog.OnDateSetListener date2 = (view, year, month, dayOfMonth) -> {
            myCalendar2.set(Calendar.YEAR, year);
            myCalendar2.set(Calendar.MONTH, month);
            myCalendar2.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            String myFormat2 = "dd-MM-yyyy"; //In which you need put here
            SimpleDateFormat sdf2 = new SimpleDateFormat(myFormat2, Locale.ITALY);
            mTglAkhir.setText(sdf2.format(myCalendar2.getTime()));
        };
        mTglAkhir.setOnClickListener(v -> new DatePickerDialog(Kerjapraktek.this, date2, myCalendar2
                .get(Calendar.YEAR), myCalendar2.get(Calendar.MONTH),
                myCalendar2.get(Calendar.DAY_OF_MONTH)).show());
    }

    private void simpan() {
        SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        String namaInstansi = mNama.getText().toString();
        String Dituju = mDituju.getText().toString();
        String alamatInstansi = mAlamat.getText().toString();
        String tanggalMulai = mTglMUlai.getText().toString();
        String tanggalAkhir = mTglAkhir.getText().toString();
        String keterangan = mKeterangan.getText().toString();
        String lampiran = mUpload.getText().toString();
        if(namaInstansi.length() == 0 || Dituju.length() == 0 || alamatInstansi.length() == 0 || tanggalMulai.length() == 0 || tanggalAkhir.length() == 0 || keterangan.length() == 0){
            displayExceptionMessage("Silahkan lengkapi formnya !");
        } else {
            try{
                showDialog();
                Call<SuratKPModel> call = APIService.Factory.create(Kerjapraktek.this).daftarKP(idUser,namaInstansi,Dituju,alamatInstansi,tanggalMulai,tanggalAkhir,keterangan,lampiran);
                call.enqueue(new Callback<SuratKPModel>() {
                    @EverythingIsNonNull
                    @Override
                    public void onResponse(Call<SuratKPModel> call, Response<SuratKPModel> response) {
                        if(response.isSuccessful()){
                            hideDialog();
                            Intent intent = new Intent(Kerjapraktek.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                            displayExceptionMessage("Berhasil disimpan");
                        } else {
                            hideDialog();
                            APIError error = ErrorUtils.parseError(response);
                            displayExceptionMessage(error.message());
                        }
                    }
                    @EverythingIsNonNull
                    @Override
                    public void onFailure(Call<SuratKPModel> call, Throwable t) {
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
        mNama = findViewById(R.id.txtNamaInstansi);
        mDituju = findViewById(R.id.txtDitujukan);
        mAlamat = findViewById(R.id.txtAlamat);
        mTglMUlai = findViewById(R.id.txtTglMulai);
        mTglAkhir = findViewById(R.id.txtTglBerakhir);
        mKeterangan = findViewById(R.id.txtKeterangan);
        mRegister = findViewById(R.id.btnRegistrasi);
        mUpload = findViewById(R.id.etLinkUpload);
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
                Kerjapraktek.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Fotocopy KRS Semester Berjalan.",
                "2. Rangkuman Nilai Akademik (Asli).",
                "3. Fotocopy Slip Pembayaran BPP.",
                "4. Fotocopy Slip Pembayaran SKS.",
                "5. Fotocopy Slip Pembayaran Biaya Kerja Praktek.",
                "6. File dijadikan satu dalam folder zip/rar kemudian diupload ke google drive, dan sertakan linknya pada form!."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}