<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pasien', 'nomor_hp', 'alamat', 'statusPatient_id', 'tanggal_masuk', 'tanggal_keluar'];


    public function status() {
        return $this->belongsTo(statusPatient::class, 'status_id');
    }
}

