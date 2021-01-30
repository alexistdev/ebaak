package com.dennyprastiawan.ebaak.fragment;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.dennyprastiawan.ebaak.R;

public class akun_fragment extends Fragment {


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        if(getActivity() != null){
            getActivity().setTitle("Setting");
        }
        return inflater.inflate(R.layout.fragment_akun, container, false);
    }
}