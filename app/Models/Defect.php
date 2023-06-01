<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Defect extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'kode',
        'nama',
        'penyebab',
        'solusi'
    ];

    public $timestamps = false;

    protected static $logAttributes = ['nama', 'kode'];

    protected static $igonoreChangedAttributes = ['updated_at'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'defect';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} defect";
    }

    public function ciriciris()
    {
        return $this->belongsToMany(Ciriciri::class)->withPivot('value_cf');
    }
}
