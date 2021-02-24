package com.dennyprastiawan.ebaak.desain;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.dennyprastiawan.ebaak.R;

public class Suratketerangan extends AppCompatActivity {
    private static final int PICKFILE_RESULT_CODE = 1;
    private ProgressDialog pDialog;
    private Button mUpload,mRegistrasi;
    private TextView namaFile;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_suratketerangan);
        Suratketerangan.this.setTitle("Surat Keterangan");
        init();
        tampil_syarat();
        mUpload.setOnClickListener(v -> {
            Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
            intent.setType("file/*");
            startActivityForResult(intent,PICKFILE_RESULT_CODE);
        });
        mRegistrasi.setOnClickListener(v -> displayExceptionMessage("Silahkan lengkapi Form terlebih dahulu !"));

    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == PICKFILE_RESULT_CODE) {
            if (resultCode == RESULT_OK) {
                String FilePath = data.getData().getPath();
                namaFile.setText(FilePath);
                mRegistrasi.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        displayExceptionMessage("ini sesudah");
                    }
                });
            }
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    public void init(){
        mUpload = findViewById(R.id.btnUpload);
        mRegistrasi = findViewById(R.id.btnRegistrasi);
        pDialog = new ProgressDialog(getApplicationContext());
        namaFile = findViewById(R.id.NamaFile);
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
    }

    public void onProfilAction(MenuItem mi) {
        displayExceptionMessage("ini profil");
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