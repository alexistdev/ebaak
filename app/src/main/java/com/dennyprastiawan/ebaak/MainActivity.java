package com.dennyprastiawan.ebaak;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;

import com.dennyprastiawan.ebaak.fragment.home;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        loadFragment(new home());
        BottomNavigationView bottomNavigationView = findViewById(R.id.bottomMenu);
        bottomNavigationView.setOnNavigationItemSelectedListener(item -> {
            Fragment fragment;
            switch (item.getItemId()){
                case R.id.home_menu:
                    fragment = new home();
                    break;
                case R.id.history_menu:
                    fragment = new home();
                    break;
                case R.id.bantuan_menu:
                    fragment = new home();
                    break;
                default:
                    fragment = new home();
                    break;
            }
            return loadFragment(fragment);
        });
    }

    /* Meload Fragment */
    private boolean loadFragment(Fragment fragment) {
        if (fragment != null) {
            getSupportFragmentManager().beginTransaction()
                    .replace(R.id.fl_container, fragment)
                    .commit();
            return true;
        }
        return false;
    }
}