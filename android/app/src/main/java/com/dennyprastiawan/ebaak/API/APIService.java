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
import com.dennyprastiawan.ebaak.model.SuratLulusModel;
import com.dennyprastiawan.ebaak.model.SuratPenelitianModel;
import com.dennyprastiawan.ebaak.model.SuratPindahKelasModel;
import com.dennyprastiawan.ebaak.model.SuratPindahProdiModel;
import com.dennyprastiawan.ebaak.model.SuratSidangModel;
import com.dennyprastiawan.ebaak.response.ResponseJurusan;
import com.dennyprastiawan.ebaak.response.ResponseRiwayat;
import java.util.concurrent.TimeUnit;
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

    @GET("api/Riwayat/tampil")
    Call<ResponseRiwayat> tampilRiwayat(@Query("id_user") String id_user);



    /* API Untuk Surat Tanda Lulus*/
    @FormUrlEncoded
    @POST("api/Surat/tandalulus")
    Call<SuratLulusModel> daftarLulus(@Field("id_user") String id_user,
                                      @Field("tempat_lahir") String tempat_lahir,
                                      @Field("tanggal_lahir") String tanggal_lahir,
                                      @Field("lampiran") String lampiran);

    /* API Untuk Surat Pindah Prodi*/
    @FormUrlEncoded
    @POST("api/Surat/pindahprodi")
    Call<SuratPindahProdiModel> daftarPindahProdi(@Field("id_user") String id_user,
                                                  @Field("nama_prodi") String nama_prodi,
                                                  @Field("alasan_pindah") String alasan_pindah,
                                                  @Field("lampiran") String lampiran);

    /* API Untuk Surat Pindah Kelas*/
    @FormUrlEncoded
    @POST("api/Surat/pindahkelas")
    Call<SuratPindahKelasModel> daftarPindahKelas(@Field("id_user") String id_user,
                                                  @Field("kelas_sebelum") String kelas_sebelum,
                                                  @Field("alasan_pindah") String alasan_pindah,
                                                  @Field("tanggal_pengajuan") String tanggal_pengajuan,
                                                  @Field("lampiran") String lampiran);

    /* API Untuk Surat Kerja Praktek*/
    @FormUrlEncoded
    @POST("api/Surat/kerjapraktek")
    Call<SuratKPModel> daftarKP(@Field("id_user") String id_user,
                                @Field("nama_instansi") String nama_instansi,
                                @Field("ditujukan") String ditujukan,
                                @Field("alamat_instansi") String alamat_instansi,
                                @Field("tanggal_mulai") String tanggal_mulai,
                                @Field("tanggal_berakhir") String tanggal_berakhir,
                                @Field("keterangan") String keterangan,
                                @Field("lampiran") String lampiran);

    /* API Untuk Surat Penelitian*/
    @FormUrlEncoded
    @POST("api/Surat/penelitian")
    Call<SuratPenelitianModel> daftarPenelitian(@Field("id_user") String id_user,
                                                @Field("ditujukan") String ditujukan,
                                                @Field("nama_instansi") String nama_instansi,
                                                @Field("alamat_instansi") String alamat_instansi,
                                                @Field("judul_penelitian") String judul_penelitian,
                                                @Field("tanggal_mulai") String tanggal_mulai,
                                                @Field("tanggal_akhir") String tanggal_akhir,
                                                @Field("lampiran") String lampiran);


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

    @FormUrlEncoded
    @POST("api/Surat/keterangan")
    Call<SuratKeteranganModel> daftarSk(@Field("id_user") String id_user,
                                        @Field("nik_ortu") String nik_ortu,
                                        @Field("nama_ortu") String nama_ortu,
                                        @Field("pekerjaan_ortu") String pekerjaan_ortu,
                                        @Field("alamat") String alamat,
                                        @Field("keperluan") String keperluan,
                                        @Field("lampiran")  String lampiran);


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
