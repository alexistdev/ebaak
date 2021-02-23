package com.dennyprastiawan.ebaak.desain;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.R;

public class Kerjapraktek extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_kerjapraktek);
        Kerjapraktek.this.setTitle("Surat Kerja Praktek");
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
                Kerjapraktek.this);
        alert.setTitle("Syarat :");
        String[] items={
                "1. Fotocopy KRS Semester Berjalan.",
                "2. Rangkuman Nilai Akademik (Asli).",
                "3. Fotocopy Slip Pembayaran BPP.",
                "4. Fotocopy Slip Pembayaran SKS.",
                "5. Fotocopy Slip Pembayaran Biaya Kerja Praktek.",
                "6. File dijadikan satu dalam folder zip/rar."
        };
        alert.setItems(items, (dialogInterface, i) -> {});
        alert.setCancelable(false)
                .setNegativeButton("Siap",
                        (dialog, id) -> dialog.cancel());
        final AlertDialog dialog = alert.create();
        dialog.show();
    }
}