<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'program_studi_id_prodi',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id_prodi', 'id_prodi');
    }

    public function surats()
    {
        return $this->hasMany(Surat::class, 'user_id_user', 'id_user');
    }
}