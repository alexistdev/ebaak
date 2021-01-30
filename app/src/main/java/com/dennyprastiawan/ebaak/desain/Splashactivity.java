package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;

import com.dennyprastiawan.ebaak.R;

public class Splashactivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splashactivity);
        ImageView btnMulai = findViewById(R.id.btn_mulai);
        btnMulai.setOnClickListener(v -> {
            Intent intent = new Intent(Splashactivity.this, Daftar.class);
            startActivity(intent);
            finish();
        });
    }
}