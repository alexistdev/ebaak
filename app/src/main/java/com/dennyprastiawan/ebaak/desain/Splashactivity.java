package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;

import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.utils.SessionUtils;

import java.util.Timer;
import java.util.TimerTask;

public class Splashactivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splashactivity);

        if(SessionUtils.isLoggedIn(this)){
            Intent intent = new Intent(Splashactivity.this, MainActivity.class);
            startActivity(intent);
            finish();
        }
        int timeout = 3000; // make the activity visible for 4 seconds

        Timer timer = new Timer();
        timer.schedule(new TimerTask() {

            @Override
            public void run() {
                finish();
                Intent homepage = new Intent(Splashactivity.this, Login.class);
                startActivity(homepage);
            }
        }, timeout);
    }
}