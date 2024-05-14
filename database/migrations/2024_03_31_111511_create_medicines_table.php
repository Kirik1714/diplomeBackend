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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('dosage');
            $table->string('packaging');
            $table->string('atx');
            $table->text('structure');
            $table->text('indications');
            $table->text('contraindications');
            $table->text('methods');
            $table->text('release');
            $table->integer('status_id')->default(1);
            $table->integer('form_id');
            $table->integer('classification_id'); 
            $table->integer('supplier_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
