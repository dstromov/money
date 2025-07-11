<?php

use App\Models\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('denominations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Currency::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', length: 255)->comment('Наименование');
            $table->enum('type', ['Купюра', 'Монета'])->comment('Формат - купюра или монета');
            $table->decimal('ratio', 25, 8)->comment('Отношение к базовой денежной единице; параметр актуален для таких сущностей как копейки, центы и т.д.'); //TODO переписать на список допустимых соотношений с лейблами (1/100, 1/400 и т.д.)
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denominations');
    }
};
