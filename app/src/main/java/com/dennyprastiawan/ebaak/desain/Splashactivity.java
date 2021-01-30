package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;

import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.utils.SessionUtils;

public class Splashactivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splashactivity);
        ImageView btnMulai = findViewById(R.id.btn_mulai);
        if(SessionUtils.isLoggedIn(this)){
            Intent intent = new Intent(Splashactivity.this, MainActivity.class);
            startActivity(intent);
            finish();
        }
        btnMulai.setOnClickListener(v -> {
            Intent intent = new Intent(Splashactivity.this, Daftar.class);
            startActivity(intent);
            finish();
        });
    }
}