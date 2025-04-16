<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    public $timestamps = true;

    protected $fillable = [
        'jenis_surat',
        'status_pengajuan',
        'semester',
        'alamat_lengkap_bandung',
        'keperluan_pengajuan',
        'surat_ditujukan_kepada',
        'nama_mata_kuliah',
        'kode_mata_kuliah',
        'topik',
        'data_mahasiswa',
        'tanggal_kelulusan',
        'user_id_user',
        'program_studi_id_prodi',
        'file_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_user', 'id_user');
    }

    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id_prodi', 'id_prodi');
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'surat_id_surat', 'id_surat');
    }
}