<?php

use App\Helpers\Global\Constant;
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
    Schema::create('schedules', function (Blueprint $table) {
      $table->id();
      $table->string('uuid')->unique();
      $table->foreignId('registration_id')->constrained('registrations', 'id')->onDelete('cascade');
      $table->date('date');
      $table->string('location')->default(Constant::LOCATION);
      $table->string('address')->default(Constant::ADDRESS);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('schedules');
  }
};
