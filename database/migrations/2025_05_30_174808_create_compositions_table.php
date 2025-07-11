<?php

use App\Models\Denomination;
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
        Schema::create('compositions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Denomination::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('value', 25, 8)->comment('Номинал');
            $table->unsignedInteger('count')->nullable($value = true)->comment('Кол-во в коллекции');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};
