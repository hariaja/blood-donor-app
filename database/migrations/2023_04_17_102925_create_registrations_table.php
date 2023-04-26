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
    Schema::create('registrations', function (Blueprint $table) {
      $table->id();
      $table->string('uuid')->unique();
      $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
      $table->string('number');
      $table->date('last_donor')->nullable();
      $table->date('return_donor')->nullable();
      $table->enum('urgency', [Constant::YES, Constant::NO]);
      $table->enum('ramadan', [Constant::YES, Constant::NO]);
      $table->enum('status', [Constant::PENDING, Constant::REJECTED, Constant::APPROVED])->default(Constant::PENDING);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('registrations');
  }
};
