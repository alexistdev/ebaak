package com.dennyprastiawan.ebaak.API;

import android.content.Context;

import com.dennyprastiawan.ebaak.BuildConfig;
import com.dennyprastiawan.ebaak.config.Constants;
import com.dennyprastiawan.ebaak.model.AkunModel;
import com.dennyprastiawan.ebaak.model.LoginModel;
import com.dennyprastiawan.ebaak.model.MahasiswaModel;
import com.dennyprastiawan.ebaak.model.SuratCutiModel;
import com.dennyprastiawan.ebaak.model.SuratKPModel;
import com.dennyprastiawan.ebaak.model.SuratKeteranganModel;
import com.dennyprastiawan.ebaak.model.SuratPenelitianModel;
import com.dennyprastiawan.ebaak.model.SuratPindahKelasModel;
import com.dennyprastiawan.ebaak.model.SuratSidangModel;
import com.dennyprastiawan.ebaak.response.ResponseJurusan;

import java.util.concurrent.TimeUnit;

import okhttp3.MultipartBody;
import okhttp3.OkHttpClient;
import okhttp3.RequestBody;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Part;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface APIService {

    /* API Untuk Surat Pindah Kelas*/
    @Multipart
    @POST("api/Surat/pindahkelas")
    Call<SuratPindahKelasModel> daftarPindahKelas(@Part("id_user") RequestBody id_user,
                                                  @Part("kelas_sebelum") RequestBody kelas_sebelum,
                                                  @Part("alasan_pindah") RequestBody alasan_pindah,
                                                  @Part("tanggal_pengajuan") RequestBody tanggal_pengajuan);

    /* API Untuk Surat Kerja Praktek*/
    @Multipart
    @POST("api/Surat/kerjapraktek")
    Call<SuratKPModel> daftarKP(@Part("id_user") RequestBody id_user,
                                @Part("nama_instansi") RequestBody nama_instansi,
                                @Part("ditujukan") RequestBody ditujukan,
                                @Part("alamat_instansi") RequestBody alamat_instansi,
                                @Part("tanggal_mulai") RequestBody tanggal_mulai,
                                @Part("tanggal_berakhir") RequestBody tanggal_berakhir,
                                @Part("keterangan") RequestBody keterangan);

    /* API Untuk Surat Penelitian*/
    @Multipart
    @POST("api/Surat/penelitian")
    Call<SuratPenelitianModel> daftarPenelitian(@Part("id_user") RequestBody id_user,
                                                @Part("ditujukan") RequestBody ditujukan,
                                                @Part("nama_instansi") RequestBody nama_instansi,
                                                @Part("alamat_instansi") RequestBody alamat_instansi,
                                                @Part("judul_penelitian") RequestBody judul_penelitian,
                                                @Part("tanggal_mulai") RequestBody tanggal_mulai,
                                                @Part("tanggal_akhir") RequestBody tanggal_akhir);


    /* API Untuk Surat Aktif Akademik*/
    @FormUrlEncoded
    @POST("api/Surat/aktif")
    Call<SuratCutiModel> daftarAktif(@Field("id_user") String id_user,
                                     @Field("alasan_aktif") String alasan_aktif);

    /* API Untuk Surat Cuti Akademik*/
    @FormUrlEncoded
    @POST("api/Surat/cuti")
    Call<SuratCutiModel> daftarCuti(@Field("id_user") String id_user,
                                    @Field("tahun_akademik") String tahun_akademik,
                                    @Field("alasan_cuti") String alasan_cuti);

    /* API Untuk Surat Pendaftaran Sidang*/
    @FormUrlEncoded
    @POST("api/Surat/sidang")
    Call<SuratSidangModel> daftarSidang(@Field("id_user") String id_user,
                                        @Field("judul") String judul,
                                        @Field("pembimbing") String pembimbing,
                                        @Field("penguji1") String penguji1,
                                        @Field("penguji2") String penguji2,
                                        @Field("nidn_pembimbing") String nidn_pembimbing,
                                        @Field("nomor_sk") String nomor_sk,
                                        @Field("tanggal_sk") String tanggal_sk,
                                        @Field("tanggal_acc") String tanggal_acc,
                                        @Field("jumlah_bimbingan") String jumlah_bimbingan);

    @Multipart
    @POST("api/Surat/keterangan")
    Call<SuratKeteranganModel> daftarSk(@Part("id_user") RequestBody id_user,
                                        @Part("nik_ortu") RequestBody nik_ortu,
                                        @Part("nama_ortu") RequestBody nama_ortu,
                                        @Part("pekerjaan_ortu") RequestBody pekerjaan_ortu,
                                        @Part("alamat") RequestBody alamat,
                                        @Part("keperluan") RequestBody keperluan,
                                        @Part MultipartBody.Part lampiran);


    @FormUrlEncoded
    @PUT("api/Auth/akun/{id_user}")
    Call<AkunModel> updateAkun(@Path("id_user") String id_user,
                                 @Field("email") String email,
                                 @Field("nama") String nama,
                                 @Field("password") String password);

    @GET("api/Auth/akun/{id_user}")
    Call<AkunModel> infoAkun(@Path("id_user") String id_user);

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
            HttpLoggingInterceptor logging = new HttpLoggingInterceptor();
            if(BuildConfig.DEBUG){
                logging.setLevel(HttpLoggingInterceptor.Level.BODY);
            }else {
                logging.setLevel(HttpLoggingInterceptor.Level.NONE);
            }

            //OkHttpClient client = builder.build();
            OkHttpClient client = builder.addInterceptor(logging).build();

            Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(Constants.URL)
                    .client(client)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();

            return retrofit.create(APIService.class);
        }
    }
}
