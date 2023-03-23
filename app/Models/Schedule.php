<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'day', 'set', 'start', 'end', 'room'
    ];
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
