package com.dennyprastiawan.ebaak;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.fragment.akun_fragment;
import com.dennyprastiawan.ebaak.fragment.bantuan_fragment;
import com.dennyprastiawan.ebaak.fragment.history_fragment;
import com.dennyprastiawan.ebaak.fragment.home;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity {
    private Toolbar toolbar;
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
                    fragment = new history_fragment();
                    break;
                case R.id.bantuan_menu:
                    fragment = new bantuan_fragment();
                    break;
                default:
                    fragment = new akun_fragment();
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


//    private void showDialog(){
//        if(!pDialog.isShowing()){
//            pDialog.show();
//        }
//    }
//
//    private void hideDialog(){
//        if(pDialog.isShowing()){
//            pDialog.dismiss();
//        }
//    }

    public void displayExceptionMessage(String msg)
    {
        Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
    }

}