<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


//выписывать поля в явном виде, аннотация, как проперти, выше класса, прямо тут.
// может вернуться коллекция, нужно использовать "<>"



class Composition extends Model
{

    // в явном виде прописывать с чем ассоциируется таблица.


    use SoftDeletes;


    // лучше не разрешать обновление вообще всех полей, т.к. так можно id обновить.
    // лучше использовать fillable и перечислить в явном виде поля.

    protected $fillable = ['denomination_id', 'value', 'count'];

    public function denomination(): BelongsTo
    {
        // правильно, но нужно добавить ключи - в явном виде ключи.
        return $this->belongsTo(Denomination::class);
    }

}
