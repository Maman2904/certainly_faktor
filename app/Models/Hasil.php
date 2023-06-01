<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'hasil_penentuan',
        'cf_max',
        'ciriciri_terpilih',
        'file_pdf',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function defect()
    {
        return $this->belongsTo(Defect::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
