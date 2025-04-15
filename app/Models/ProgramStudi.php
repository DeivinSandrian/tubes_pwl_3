<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';
    protected $primaryKey = 'id_prodi';
    public $timestamps = false;

    protected $fillable = [
        'nama_prodi',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'program_studi_id_prodi', 'id_prodi');
    }
}