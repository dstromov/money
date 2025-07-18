<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyFactory> */
    // TOD писать всегда их. В частности тут писать в явном виде, почему код закомментирован
    //use HasFactory;
    use SoftDeletes;

    protected $fillable = ['full_name', 'label', 'country', 'rate'];

    public function denominations(): HasMany
    {
        return $this->hasMany(Denomination::class);
        //->chaperone();
    }

}
