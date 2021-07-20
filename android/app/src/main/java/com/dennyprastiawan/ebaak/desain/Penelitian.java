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
import com.dennyprastiawan.ebaak.model.SuratPenelitianModel;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Penelitian extends AppCompatActivity {
    private ProgressDialog pDialog;
    private EditText mDitujukan,mNamaInstansi,mAlamat,mJudul,mTanggalMulai,mTanggalAkhir,mPenelitian;
    private Button mRegistrasi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_penelitian);
        Penelitian.this.setTitle("Surat Izin Penelitian");
        tampil_syarat();
        init();
        mRegistrasi.setOnClickListener(v -> simpan());
        /* Menampilkan calendar picker */
        final Calendar myCalendar1 = Calendar.getInstance();
        final Calendar myCalendar2 = Calendar.getInstance();
        DatePickerDialog.OnDateSetListener date = (view, year, month, dayOfMonth) -> {
            myCalendar1.set(Calendar.YEAR, year);
            myCalendar1.set(Calendar.MONTH, month);
            myCalendar1.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            String myFormat = "dd-MM-yyyy"; //In which you need put here
            SimpleDateFormat sdf = new SimpleDateFormat(myFormat, Locale.ITALY);
            mTanggalMulai.setText(sdf.format(myCalendar1.getTime()));
        };
        mTanggalMulai.setOnClickListener(v -> new DatePickerDialog(Penelitian.this, date, myCalendar1
                .get(Calendar.YEAR), myCalendar1.get(Calendar.MONTH),
                myCalendar1.get(Calendar.DAY_OF_MONTH)).show());

        DatePickerDialog.OnDateSetListener date2 = (view, year, month, dayOfMonth) -> {
            myCalendar2.set(Calendar.YEAR, year);
            myCalendar2.set(Calendar.MONTH, month);
            myCalendar2.set(Calendar.DAY_OF_MONTH, dayOfMonth);
            String myFormat2 = "dd-MM-yyyy"; //In which you need put here
            SimpleDateFormat sdf2 = new SimpleDateFormat(myFormat2, Locale.ITALY);
            mTanggalAkhir.setText(sdf2.format(myCalendar2.getTime()));
        };
        mTanggalAkhir.setOnClickListener(v -> new DatePickerDialog(Penelitian.this, date2, myCalendar2
                .get(Calendar.YEAR), myCalendar2.get(Calendar.MONTH),
                myCalendar2.get(Calendar.DAY_OF_MONTH)).show());
    }

    private void simpan(){
        SharedPreferences sharedPreferences = this.getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        String dituju =  mDitujukan.getText().toString();
        String namaInstansi =  mNamaInstansi.getText().toString();
        String alamatInstansi =  mAlamat.getText().toString();
        String judulPenelitian =  mJudul.getText().toString();
        String tanggalMulai =  mTanggalMulai.getText().toString();
        String tanggalAkhir =  mTanggalAkhir.getText().toString();
        String lampiran = mPenelitian.getText().toString();

        if(dituju.length() == 0 || namaInstansi.length() == 0 || alamatInstansi.length() == 0 || judulPenelitian.length() == 0 || tanggalMulai.length() == 0 || tanggalAkhir.length() == 0 || lampiran.length() == 0){
            displayExceptionMessage("Silahkan lengkapi form !");
        } else{
            showDialog();
            try{
                Call<SuratPenelitianModel> call = APIService.Factory.create(Penelitian.this).daftarPenelitian(idUser,dituju,namaInstansi,alamatInstansi,judulPenelitian,tanggalMulai,tanggalAkhir,lampiran);
                call.enqueue(new Callback<SuratPenelitianModel>() {
                    @EverythingIsNonNull
                    @Override
                    public void onResponse(Call<SuratPenelitianModel> call, Response<SuratPenelitianModel> response) {
                        hideDialog();
                        if(response.isSuccessful()){
                            Intent intent = new Intent(Penelitian.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                            displayExceptionMessage("Berhasil disimpan");
                        } else {
                            APIError error = ErrorUtils.parseError(response);
                            displayExceptionMessage(error.message());
                        }
                    }
                    @EverythingIsNonNull
                    @Override
                    public void onFailure(Call<SuratPenelitianModel> call, Throwable t) {
                        hideDialog();
                        if(t instanceof NoConnectivityException) {
                            displayExceptionMessage("Internet Offline!");
                        }
                    }
                });
//                Call<SuratPenelitianModel> call = APIService.Factory.create(Penelitian.this).daftarPenelitian(id,ditujukan,nama_instansi,alamat_instansi,judul_penelitian,tanggal_mulai,tanggal_akhir);
//                call.enqueue(new Callback<SuratPenelitianModel>() {
//                    @Override
//                    public void onResponse(Call<SuratPenelitianModel> call, Response<SuratPenelitianModel> response) {
//                        hideDialog();
//                        if(response.isSuccessful()){
//                            Intent intent = new Intent(Penelitian.this, MainActivity.class);
//                            startActivity(intent);
//                            finish();
//                            displayExceptionMessage("Berhasil disimpan");
//                        } else {
//                            APIError error = ErrorUtils.parseError(response);
//                            displayExceptionMessage(error.message());
//                        }
//                    }
//
//                    @Override
//                    public void onFailure(Call<SuratPenelitianModel> call, Throwable t) {
//                        hideDialog();
//                        if(t instanceof NoConnectivityException) {
//                            //hideDialog();
//                            displayExceptionMessage("Internet Offline!");
//                        }
//                    }
//                });
            }catch (Exception e){
                hideDialog();
                e.printStackTrace();
                displayExceptionMessage(e.getMessage());
            }
        }



    }

    public void init(){
        mDitujukan = findViewById(R.id.txtDitujukan);
        mNamaInstansi = findViewById(R.id.txtInstansi);
        mAlamat = findViewById(R.id.txtAlamat);
        mJudul = findViewById(R.id.txtJudul);
        mTanggalMulai = findViewById(R.id.txtTanggalMulai);
        mTanggalAkhir = findViewById(R.id.txtTanggalAkhir);
        mPenelitian = findViewById(R.id.etLinkUpload);
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
                Penelitian.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Fotocopy Slip BPP.",
                "2. Fotocopy KRS Semester Berjalan.",
                "3. Fotocopy Slip Skripsi/TA.",
                "4. Fotocopy Slip SKS Semester Berjalan.",
                "5. File dijadikan satu dalam folder zip/rar kemudian diupload ke google drive, dan sertakan linknya pada form!."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}