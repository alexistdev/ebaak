package com.dennyprastiawan.ebaak.API;

import android.content.Context;

import com.dennyprastiawan.ebaak.config.Constants;
import com.dennyprastiawan.ebaak.model.LoginModel;
import com.dennyprastiawan.ebaak.model.MahasiswaModel;
import com.dennyprastiawan.ebaak.response.ResponseJurusan;

import java.util.concurrent.TimeUnit;

import okhttp3.OkHttpClient;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;

public interface APIService {

    @FormUrlEncoded
    @POST("api/Auth/login")
    Call<LoginModel> postLogin(@Field("npm") String npm,
                               @Field("password") String password);

    //API untuk menampilkan jurusan di spinner
    @GET("api/Daftar/tampil")
    Call<ResponseJurusan> spinnerJurusan();

    //API untuk menambah data mahasiswa
    @FormUrlEncoded
    @POST("api/Daftar/tambah")
    Call<MahasiswaModel> tambahMahasiswa(@Field("jurusan") String nama_jurusan,
                                         @Field("npm") String npm,
                                         @Field("nama") String nama_lengkap,
                                         @Field("email") String email,
                                         @Field("password") String password);

    class Factory{
        public static APIService create(Context mContext){
            OkHttpClient.Builder builder = new OkHttpClient.Builder();
            builder.readTimeout(20, TimeUnit.SECONDS);
            builder.connectTimeout(20, TimeUnit.SECONDS);
            builder.writeTimeout(20, TimeUnit.SECONDS);
            builder.addInterceptor(new NetworkConnectionInterceptor(mContext));

            OkHttpClient client = builder.build();

            Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(Constants.URL)
                    .client(client)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();

            return retrofit.create(APIService.class);
        }
    }
}
