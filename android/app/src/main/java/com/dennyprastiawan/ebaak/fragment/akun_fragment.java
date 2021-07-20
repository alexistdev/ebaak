package com.dennyprastiawan.ebaak.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.dennyprastiawan.ebaak.API.APIService;
import com.dennyprastiawan.ebaak.API.NoConnectivityException;
import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.config.Constants;
import com.dennyprastiawan.ebaak.desain.Login;
import com.dennyprastiawan.ebaak.model.APIError;
import com.dennyprastiawan.ebaak.model.AkunModel;
import com.dennyprastiawan.ebaak.utils.ErrorUtils;
import com.dennyprastiawan.ebaak.utils.SessionUtils;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class akun_fragment extends Fragment {
    private ProgressDialog pDialog;
    private EditText mNpm,mEmail,mNamaLengkap,mJurusan,mPassword;
    private Button mEdit,mLogout;


    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        if(getActivity() != null){
            getActivity().setTitle("Setting");
        }

        SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
                Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
        String idUser = sharedPreferences.getString("idUser", "");
        View myview = inflater.inflate(R.layout.fragment_akun, container, false);
        init(myview);

        loadData(idUser);
        /* Menangani logout */
        mLogout.setOnClickListener(v -> {
            SessionUtils.logout(requireContext());
            Intent intent = new Intent(getActivity(), Login.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
            if(getActivity()!= null){
                getActivity().finish();
            }
        });
        /*Tombol menangani edit akun*/
        mEdit.setOnClickListener(v -> updateUser(idUser));

        return myview;
    }

    private void updateUser(String idUser){
        String email = mEmail.getText().toString();
        String nama = mNamaLengkap.getText().toString();
        String password = mPassword.getText().toString();
        if(email.length() == 0 || nama.length() == 0 ){
            displayExceptionMessage("Form tidak lengkap !");
        }else{
            try{
                Call<AkunModel> call = APIService.Factory.create(getContext()).updateAkun(idUser,email,nama,password);
                call.enqueue(new Callback<AkunModel>() {
                    @EverythingIsNonNull
                    @Override
                    public void onResponse(Call<AkunModel> call, Response<AkunModel> response) {
                        if(response.isSuccessful()) {
                            if(response.body() != null) {
                                loadData(idUser);
                                displayExceptionMessage("Akun berhasil di update!");
                            }
                        }else{
                            APIError error = ErrorUtils.parseError(response);
                            displayExceptionMessage(error.message());
                        }
                    }
                    @EverythingIsNonNull
                    @Override
                    public void onFailure(Call<AkunModel> call, @NonNull Throwable t) {
                        if(t instanceof NoConnectivityException) {
                            displayExceptionMessage("Internet Offline!");
                        }
                    }
                });
            }catch (Exception e){
                e.printStackTrace();
                displayExceptionMessage(e.getMessage());
            }
        }
    }

    public void init(View view){
        mNpm = view.findViewById(R.id.txtNPM);
        mNpm.setEnabled(false);
        mEmail = view.findViewById(R.id.txtEMail);
        mNamaLengkap = view.findViewById(R.id.txtNama);
        mJurusan = view.findViewById(R.id.txtJurusan);
        mJurusan.setEnabled(false);
        mPassword = view.findViewById(R.id.txtPassword);
        mEdit = view.findViewById(R.id.btnEdit);
        mLogout = view.findViewById(R.id.btnLogout);
        pDialog = new ProgressDialog(getContext());
        pDialog.setCancelable(false);
        pDialog.setMessage("Loading.....");
    }

    public void loadData(String idUser)
    {
        showDialog();
        try{
            Call<AkunModel> callAkun = APIService.Factory.create(getContext()).infoAkun(idUser);
            callAkun.enqueue(new Callback<AkunModel>() {
                @EverythingIsNonNull
                @Override
                public void onResponse(Call<AkunModel> call, Response<AkunModel> response) {
                    if(response.isSuccessful()) {
                        hideDialog();
                        if (response.body() != null) {
                            mNpm.setText(response.body().getNpm());
                            mEmail.setText(response.body().getEmail());
                            mNamaLengkap.setText(response.body().getNama());
                            mJurusan.setText(response.body().getNama_jurusan());
                        }
                    } else {
                        hideDialog();
                        APIError error = ErrorUtils.parseError(response);
                        displayExceptionMessage(error.message());
                    }
                }
                @EverythingIsNonNull
                @Override
                public void onFailure(Call<AkunModel> call, Throwable t) {
                    if(t instanceof NoConnectivityException) {
                        hideDialog();
                        displayExceptionMessage("Internet Offline!");
                    }
                }
            });
        }catch(Exception e){
            hideDialog();
            e.printStackTrace();
            displayExceptionMessage(e.getMessage());
        }
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