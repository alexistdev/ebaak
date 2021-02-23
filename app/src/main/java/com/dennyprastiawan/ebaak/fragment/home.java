package com.dennyprastiawan.ebaak.fragment;

import android.app.ActionBar;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.desain.Cutiakademik;
import com.dennyprastiawan.ebaak.desain.Daftar;
import com.dennyprastiawan.ebaak.desain.Login;
import com.dennyprastiawan.ebaak.desain.SuratSidang;
import com.dennyprastiawan.ebaak.desain.Suratketerangan;

import java.util.Objects;

public class home extends Fragment {
    private CardView mSuratKeterangan,mSidang,mCuti;
    private ProgressDialog pDialog;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        if(getActivity() != null){
            getActivity().setTitle("Aplikasi E-BAAK");
        }
        View myview = inflater.inflate(R.layout.fragment_home, container, false);
        init(myview);

        /*Ini menu surat pendaftaran sidang*/
        mSidang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), SuratSidang.class);
                startActivity(intent);
            }
        });

        /* Ini menu surat Keterangan */
        mSuratKeterangan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), Suratketerangan.class);
                startActivity(intent);
            }
        });

        /* Ini menu surat cuti akademik */
        mCuti.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), Cutiakademik.class);
                startActivity(intent);
            }
        });





        return myview;
    }

    public void init(View view){
        mSuratKeterangan = view.findViewById(R.id.cardSuratKeterangan);
        mSidang = view.findViewById(R.id.cdSidang);
        mCuti = view.findViewById(R.id.cdCuti);
        pDialog = new ProgressDialog(getContext());
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
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
        Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
    }
}