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
    Schema::table('schedules', function (Blueprint $table) {
      $table->string('status')->default(Constant::NOT_YET_COME)->after('address');
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
