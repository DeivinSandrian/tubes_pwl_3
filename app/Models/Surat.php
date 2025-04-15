<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        'nama_surat',
        'deskripsi',
    ];

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'surat_id_surat', 'id_surat');
    }
}