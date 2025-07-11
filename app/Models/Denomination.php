<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denomination extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function compositions(): HasMany
    {
        return $this->hasMany(Composition::class);
        //->chaperone();
    }

}
 