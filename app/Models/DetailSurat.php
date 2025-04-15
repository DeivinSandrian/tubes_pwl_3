<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSurat extends Model
{
    use HasFactory;

    protected $table = 'detail_surat';
    protected $primaryKey = 'id_detail_surat';

    protected $fillable = [
        'pengajuan_id_pengajuan',
        'file_path',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id_pengajuan', 'id_pengajuan');
    }
}