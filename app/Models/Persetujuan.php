<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    protected $table = ' Persetujuan';
    protected $primaryKey = 'id_persetujuan';
    protected $fillable = ['status_persetujuan', 'tanggal_persetujuan', 'surat_id_surat', 'surat_user_id_user'];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id_surat', 'id_surat');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'surat_user_id_user', 'id_user');
    }
}