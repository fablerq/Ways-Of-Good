<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Ticket extends Model
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    protected $fillable = [
        'user_id', 'organization_id', 'place_id', 'icon_id',
        'status_id', 'type_id','title', 'description', 'availableVisitors', 'time'
    ];

    public $timestamps = false;
}
