package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.R;

public class Cutiakademik extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cutiakademik);
        Cutiakademik.this.setTitle("Cuti Akademik");
        tampil_syarat();
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public void onProfilAction(MenuItem mi) {
        displayExceptionMessage("ini profil");
    }

    public void displayExceptionMessage(String msg)
    {
        Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
    }

    public void tampil_syarat()
    {
        final AlertDialog.Builder alert = new AlertDialog.Builder(
                Cutiakademik.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Membayar Biaya Cuti AKademik.",
                "2. Aktif Semester Sebelumnya."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}