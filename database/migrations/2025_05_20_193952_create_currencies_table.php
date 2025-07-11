<?php

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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', length: 255)->comment('Полное наименование');
            $table->string('label', length: 255)->comment('Обозначение страны');
            $table->string('country', length: 255)->comment('Страна');
            $table->decimal('rate', 25, 8)->nullable($value = true)->comment('Курс, ед/руб.');
            $table->decimal('full_summ', 25, 8)->nullable($value = true)->comment('Сумма для страны, руб.');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    //TODO уйти от null в пользу нулей и пустых строк


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
