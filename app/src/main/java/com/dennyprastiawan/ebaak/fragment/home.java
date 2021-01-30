package com.dennyprastiawan.ebaak.fragment;

import android.app.ActionBar;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.dennyprastiawan.ebaak.MainActivity;
import com.dennyprastiawan.ebaak.R;

import java.util.Objects;

public class home extends Fragment {


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
        return inflater.inflate(R.layout.fragment_home, container, false);
    }
}