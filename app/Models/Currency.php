<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyFactory> */
    //use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function denominations(): HasMany
    {
        return $this->hasMany(Denomination::class);
        //->chaperone();
    }

}
