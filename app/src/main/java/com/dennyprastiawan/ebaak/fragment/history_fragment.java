package com.dennyprastiawan.ebaak.fragment;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.dennyprastiawan.ebaak.R;

public class history_fragment extends Fragment {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        if(getActivity() != null){
            getActivity().setTitle("Riwayat Pengajuan");
        }
        return inflater.inflate(R.layout.fragment_history, container, false);
    }
}