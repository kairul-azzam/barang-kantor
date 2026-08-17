<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('code')->unique()->comment('Kode inventaris');
            $table->string('name');
            $table->unsignedInteger('stock')->default(1)->comment('Total unit dimiliki');
            $table->enum('condition', ['baik', 'perlu_perbaikan', 'rusak'])->default('baik');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
