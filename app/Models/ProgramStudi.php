<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'nama_prodi',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'program_studi_id_prodi', 'id_prodi');
    }
}