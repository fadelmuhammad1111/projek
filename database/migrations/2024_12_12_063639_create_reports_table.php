<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('description');
            $table->enum('type', ['KEJAHATAN', 'PEMBANGUNAN', 'SOSIAL']);
            $table->string('province', 255);
            $table->string('regency', 255);
            $table->string('subdistrict', 255);
            $table->string('village', 255);
            $table->json('voting')->nullable();
            $table->integer('viewers')->default();
            $table->string('image', 255)->nullable();
            $table->boolean('statement')->default(false);
            $table->boolean('checkbox')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
