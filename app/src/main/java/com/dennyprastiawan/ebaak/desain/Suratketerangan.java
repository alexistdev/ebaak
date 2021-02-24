package com.dennyprastiawan.ebaak.desain;

import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.dennyprastiawan.ebaak.R;

public class Suratketerangan extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_suratketerangan);
        Suratketerangan.this.setTitle("Surat Keterangan");
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