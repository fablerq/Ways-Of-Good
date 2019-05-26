<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Tag extends Model
{
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }
    
    protected $fillable = [
        'title',
    ];

    public $timestamps = false;
}
