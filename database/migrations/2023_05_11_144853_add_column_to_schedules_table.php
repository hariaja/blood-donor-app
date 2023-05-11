<?php

use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('schedules', function (Blueprint $table) {
      $table->string('status')->default(Constant::NOT_YET_COME)->after('time');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('schedules', function (Blueprint $table) {
      $table->dropColumn('status');
    });
  }
};
