<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSurat extends Model
{
    protected $table = 'detail_surat';
    protected $primaryKey = 'id_detail_surat';
    public $timestamps = true;

    protected $fillable = [
        'surat_id_surat',
        'surat_user_id_user',
        'alasan_pengajuan',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id_surat', 'id_surat');
    }
}