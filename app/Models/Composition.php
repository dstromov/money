<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Composition extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    public function denomination(): BelongsTo
    {
        return $this->belongsTo(Denomination::class);
    }

}
