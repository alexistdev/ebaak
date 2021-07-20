package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.API.APIService;
import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.model.APIError;
import com.dennyprastiawan.ebaak.model.LoginModel;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;
import com.dennyprastiawan.ebaak.utils.SessionUtils;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Login extends AppCompatActivity {
    private TextView mTbDaftar;
    private ProgressDialog pDialog;
    private ImageView btnLogin;
    private EditText edNpm,edPass;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        init();
        //cek login
        if(SessionUtils.isLoggedIn(this)){
            Intent intent = new Intent(Login.this, MainActivity.class);
            startActivity(intent);
            finish();
        }
        mTbDaftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Login.this, Daftar.class);
                startActivity(intent);
                finish();
            }
        });
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String npm = edNpm.getText().toString();
                String password = edPass.getText().toString();
                if(npm.trim().length()> 0 && password.trim().length() >0){
                    checkLogin(npm,password);
                } else {
                    Toast.makeText(getApplicationContext(), "Semua kolom harus diisi!", Toast.LENGTH_SHORT).show();
                }
            }
        });

    }
    /* Mengecek login */
    private void checkLogin(final String npm, final String password)
    {
        showDialog();
        try{
            Call<LoginModel> call = APIService.Factory.create(getApplicationContext()).postLogin(npm,
                    password);
            call.enqueue(new Callback<LoginModel>() {
                @EverythingIsNonNull
                @Override
                public void onResponse(Call<LoginModel> call, Response<LoginModel> response) {
                    hideDialog();
                    if(response.isSuccessful()){
                        if(response.body() != null){
                            if (SessionUtils.login(Login.this, response.body().getIdUser(), response.body().getToken())){
                                Intent intent = new Intent(Login.this, MainActivity.class);
                                startActivity(intent);
                                finish();
                            }
                        }
                    } else {
                        hideDialog();
                        APIError error = ErrorUtils.parseError(response);
                        displayExceptionMessage(error.message());
                    }
                }
                @EverythingIsNonNull
                @Override
                public void onFailure(Call<LoginModel> call, Throwable t) {
                    hideDialog();
                    displayExceptionMessage(t.getMessage());
                }
            });
        }catch (Exception e){
            hideDialog();
            e.printStackTrace();
            displayExceptionMessage(e.getMessage());
        }
    }
    /* Menginisiasi class */
    public void init()
    {
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
        mTbDaftar = findViewById(R.id.btn_daftar);
        btnLogin =findViewById(R.id.tombol_login);
        edNpm = findViewById(R.id.txt_npm);
        edPass = findViewById(R.id.txt_pass);
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