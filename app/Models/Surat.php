<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    public $timestamps = true;

    protected $fillable = [
        'jens_surat',
        'status_pengajuan',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'user_id_user',
    ];

    protected $dates = [
        'tanggal_pengajuan',
        'tanggal_persetujuan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_user', 'id_user');
    }

    public function detail()
    {
        return $this->hasOne(DetailSurat::class, 'surat_id_surat', 'id_surat');
    }

    public function upload()
    {
        return $this->hasOne(UploadSurat::class, 'surat_id_surat', 'id_surat');
    }
}