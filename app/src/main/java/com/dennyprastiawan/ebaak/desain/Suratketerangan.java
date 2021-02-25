package com.dennyprastiawan.ebaak.desain;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Environment;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import com.dennyprastiawan.ebaak.API.APIService;
import com.dennyprastiawan.ebaak.API.NoConnectivityException;
import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.config.Constants;
import com.dennyprastiawan.ebaak.model.APIError;
import com.dennyprastiawan.ebaak.model.SuratKeteranganModel;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;
import java.io.File;
import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Suratketerangan extends AppCompatActivity {
    private static final int PICKFILE_RESULT_CODE = 21;
    private ProgressDialog pDialog;
    private Button mUpload,mRegistrasi;
    private TextView namaFile;
    private EditText mNik,mNama,mkerja,mAlamat,mPerlu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_suratketerangan);
        Suratketerangan.this.setTitle("Surat Keterangan");
        init();
        tampil_syarat();
        mUpload.setOnClickListener(v -> {
            Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
            intent.setType("file/*");
            intent = Intent.createChooser(intent, "Pilih file");
            startActivityForResult(intent,PICKFILE_RESULT_CODE);
        });
        mRegistrasi.setOnClickListener(v -> displayExceptionMessage("Silahkan lengkapi Form terlebih dahulu !"));

    }


    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == PICKFILE_RESULT_CODE) {
            if (resultCode == RESULT_OK) {
                String URLFILE = data.getData().getPath();
                File files = new File(Environment.getExternalStorageDirectory().getAbsolutePath(), URLFILE);
                namaFile.setText(URLFILE);
                SharedPreferences sharedPreferences = this.getSharedPreferences(
                        Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);

                mRegistrasi.setOnClickListener(v -> {
                    try {
                                String idUser = sharedPreferences.getString("idUser", "");
                                String nik =  mNik.getText().toString();
                                String nama =  mNama.getText().toString();
                                String pekerjaan =  mkerja.getText().toString();
                                String alamat =  mAlamat.getText().toString();
                                String keperluan =  mPerlu.getText().toString();
                                if(nik.length() == 0 || nama.length() == 0 || pekerjaan.length() == 0 || alamat.length() == 0 || keperluan.length() == 0 ){
                                    displayExceptionMessage("Silahkan lengkapi form terlebih dahulu");
                                } else {
                                    showDialog();
                                    RequestBody id = RequestBody.create(MediaType.parse("multipart/form-data"), idUser);
                                    RequestBody nikk = RequestBody.create(MediaType.parse("multipart/form-data"), nik);
                                    RequestBody namak = RequestBody.create(MediaType.parse("multipart/form-data"), nama);
                                    RequestBody pekerjaank = RequestBody.create(MediaType.parse("multipart/form-data"), pekerjaan);
                                    RequestBody alamatx = RequestBody.create(MediaType.parse("multipart/form-data"), alamat);
                                    RequestBody keperluanx = RequestBody.create(MediaType.parse("multipart/form-data"), keperluan);
                                    // creates RequestBody instance from file
                                    //RequestBody requestFile = RequestBody.create(MediaType.parse("multipart/form-data"), URLFILE);
                                    RequestBody requestFile = RequestBody.create(MediaType.parse("multipart/form-file"), files);
                                    // MultipartBody.Part is used to send also the actual filename
                                    MultipartBody.Part fileToUpload = MultipartBody.Part.createFormData("lampiran", "testing", requestFile);
                                    // adds another part within the multipart request
                                    Call<SuratKeteranganModel> call = APIService.Factory.create(getApplicationContext()).daftarSk(id,nikk,namak,pekerjaank,alamatx,keperluanx,fileToUpload);
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
                                            } else {
                                                APIError error = ErrorUtils.parseError(response);
                                                displayExceptionMessage(error.message());
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
                        e.printStackTrace();
                        displayExceptionMessage(e.getMessage());
                    }
                });
            }
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public void init(){
        mUpload = findViewById(R.id.btnUpload);
        mRegistrasi = findViewById(R.id.btnRegistrasi);
        mNik = findViewById(R.id.etNikOrtu);
        mNama = findViewById(R.id.etNamaOrtu);
        mkerja = findViewById(R.id.etPekerjaan);
        mAlamat = findViewById(R.id.etAlamat);
        mPerlu= findViewById(R.id.etKeperluan);
        pDialog = new ProgressDialog(getApplicationContext());
        namaFile = findViewById(R.id.NamaFile);
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");

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
                Suratketerangan.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Melampirkan Fotocopy KRS (Semester Berjalan).",
                "2. Melampirkan Fotocopy DNS (Semester Terakhir/Semester Aktif).",
                "3. Melampirkan Fotocopy Slip BPP (Semester Berjalan).",
                "4. File dijadikan satu dalam folder zip/rar."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }


}