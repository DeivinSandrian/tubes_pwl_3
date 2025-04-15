<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadSurat extends Model
{
    protected $table = 'upload_surat';
    protected $primaryKey = 'id_upload';
    public $timestamps = true;

    protected $fillable = [
        'file_surat',
        'tanggal_upload',
        'status_upload',
        'surat_id_surat',
        'surat_user_id_user',
    ];

    protected $dates = [
        'tanggal_upload',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id_surat', 'id_surat');
    }
}