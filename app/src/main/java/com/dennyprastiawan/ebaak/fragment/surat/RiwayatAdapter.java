package com.dennyprastiawan.ebaak.fragment.surat;

import android.content.Context;
import android.graphics.drawable.Drawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.dennyprastiawan.ebaak.R;
import com.dennyprastiawan.ebaak.model.RiwayatModel;

import java.util.List;

public class RiwayatAdapter extends RecyclerView.Adapter<RiwayatAdapter.MyRiwayatHolder> {
    private final Context context;
    List<RiwayatModel> mRiwayatList;

    public RiwayatAdapter(Context context, List<RiwayatModel> mRiwayatList) {
        this.context = context;
        this.mRiwayatList = mRiwayatList;
    }

    @NonNull
    @Override
    public MyRiwayatHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_riwayat, parent, false);
        RiwayatAdapter.MyRiwayatHolder holder;
        holder = new MyRiwayatHolder(mView);
        return holder;
    }

    @Override
    public void onBindViewHolder (@NonNull MyRiwayatHolder holder,final int position){
        holder.mTanggal.setText(mRiwayatList.get(position).getTanggal_surat());
        String status = mRiwayatList.get(position).getStatus_riwayat();
        if(status.equals("2")){
            holder.mStatus.setText("PENDING");
            holder.mStatus.setTextColor(context.getResources().getColor(R.color.maroon));
        } else {
            holder.mStatus.setText("SELESAI");
            holder.mStatus.setTextColor(context.getResources().getColor(R.color.tombolSurat));
            holder.mNamaRiwayat.setCompoundDrawablesWithIntrinsicBounds(0, 0, R.drawable.complete, 0);
        }

        holder.mNamaRiwayat.setText(mRiwayatList.get(position).getNama_surat());
    }

    public static class MyRiwayatHolder extends RecyclerView.ViewHolder {
        private final TextView mTanggal,mStatus,mNamaRiwayat;
        MyRiwayatHolder(@NonNull View itemView) {
            super(itemView);
            mTanggal = itemView.findViewById(R.id.txtTanggal);
            mStatus = itemView.findViewById(R.id.txtStatus);
            mNamaRiwayat = itemView.findViewById(R.id.txtNama);

        }
    }
    @Override
    public int getItemCount () {
        return mRiwayatList.size();
    }

    public void replaceData(List<RiwayatModel> riwayatModels) {
        this.mRiwayatList = riwayatModels;
        notifyDataSetChanged();
    }
}
