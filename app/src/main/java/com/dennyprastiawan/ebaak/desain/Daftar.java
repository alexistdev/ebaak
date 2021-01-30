package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AppCompatActivity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;
import com.dennyprastiawan.ebaak.API.APIService;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.model.APIError;
import com.dennyprastiawan.ebaak.model.MahasiswaModel;
import com.dennyprastiawan.ebaak.model.SemuaJurusanItem;
import com.dennyprastiawan.ebaak.response.ResponseJurusan;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.Pattern;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Daftar extends AppCompatActivity {
    private EditText tvNpm,tvNama,tvEmail,tvPassword,tvJurusan;
    private TextView btnLogin;
    private ProgressDialog pDialog;
    private ImageView btnDaftar;
    private Spinner mSpinJurusan;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_daftar);

        init();
        populateSpinner(getApplicationContext());
        mSpinJurusan.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                String jurusanTerpilih = parent.getItemAtPosition(position).toString();
                tvJurusan.setText(jurusanTerpilih);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                tvJurusan.setText("");
            }
        });
        btnDaftar.setOnClickListener(v -> simpanData());
        btnLogin.setOnClickListener(v -> {
            Intent intent = new Intent(Daftar.this, Login.class);
            startActivity(intent);
            finish();
        });
    }

    /* Ini adalah private method untuk menyimpan data ke dalam database melalui Rest API*/
    private void simpanData(){
        String jurusan = tvJurusan.getText().toString();
        String npm = tvNpm.getText().toString();
        String nama = tvNama.getText().toString();
        String password = tvPassword.getText().toString();
        String email = tvEmail.getText().toString().trim();
        if(jurusan.length() == 0 || npm.length() == 0 || nama.length() == 0 || email.length() == 0){
            hideDialog();
            displayExceptionMessage("Semua kolom harus diisi!");
        } else {
            if(cekEmail(email)){
                try{
                    Call<MahasiswaModel> call= APIService.Factory.create(getApplicationContext()).tambahMahasiswa(jurusan,npm,nama,email,password);
                    call.enqueue(new Callback<MahasiswaModel>() {
                        @EverythingIsNonNull
                        @Override
                        public void onResponse(Call<MahasiswaModel> call, Response<MahasiswaModel> response) {
                            if(response.isSuccessful()){
                                hideDialog();
                                Intent intent = new Intent(Daftar.this, Login.class);
                                startActivity(intent);
                                finish();
                                displayExceptionMessage("data berhasil ditambahkan!");
                            }else{
                                hideDialog();
                                APIError error = ErrorUtils.parseError(response);
                                displayExceptionMessage(error.message());
                            }
                        }
                        @EverythingIsNonNull
                        @Override
                        public void onFailure(Call<MahasiswaModel> call, Throwable t) {
                            hideDialog();
                            displayExceptionMessage(t.getMessage());
                        }
                    });
                } catch(Exception e){
                    e.printStackTrace();
                    displayExceptionMessage(e.getMessage());
                }
            }else{
                hideDialog();
                displayExceptionMessage("Masukkan email yang valid!");
            }

        }
    }

    /* Validasi Email */
    private boolean cekEmail(String email){
        return Pattern.compile("^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
                + "((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                + "[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
                + "([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                + "[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
                + "([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$").matcher(email).matches();
    }

    /* ini untuk mengisi spinner melalui database */
    private void populateSpinner(final Context mContext) {
        showDialog();
        Call<ResponseJurusan> callJurusan = APIService.Factory.create(mContext).spinnerJurusan();
        callJurusan.enqueue(new Callback<ResponseJurusan>() {
            @EverythingIsNonNull
            @Override
            public void onResponse(Call<ResponseJurusan> call, Response<ResponseJurusan> response) {
                hideDialog();
                if(response.body() != null){
                    List<SemuaJurusanItem> semuaJurusanItems = response.body().getSemuaJurusanItems();
                    List<String> listSpinner = new ArrayList<>();
                    for (int i = 0; i < semuaJurusanItems.size(); i++){

                        listSpinner.add(semuaJurusanItems.get(i).getNama_jurusan());
                    }

                    /* Memasukkan data ke dalam spinner */
                    ArrayAdapter<String> adapter = new ArrayAdapter<>(mContext,
                            android.R.layout.simple_spinner_item, listSpinner);
                    adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
                    mSpinJurusan.setAdapter(adapter);
                }
            }
            @EverythingIsNonNull
            @Override
            public void onFailure(Call<ResponseJurusan> call, Throwable t) {
                hideDialog();
                displayExceptionMessage("Gagal mengambil data!");
            }
        });
    }

    /* Menginisiasi class */
    public void init()
    {
        mSpinJurusan =  findViewById(R.id.spinnerJurusan);
        btnLogin = findViewById(R.id.tombol_login);
        tvNpm = findViewById(R.id.txt_npm);
        tvNama = findViewById(R.id.txt_namalengkap);
        tvPassword = findViewById(R.id.txt_password);
        tvEmail = findViewById(R.id.txt_email);
        tvJurusan = findViewById(R.id.txt_Jurusan);
        btnDaftar = findViewById(R.id.btn_daftar);
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
        tvJurusan.setEnabled(false);
        tvJurusan.setVisibility(View.INVISIBLE);
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

}