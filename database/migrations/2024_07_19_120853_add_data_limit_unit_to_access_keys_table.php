<?php

use App\Enums\DataLimitUnit;
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
        Schema::table('access_keys', function (Blueprint $table) {
            $table->string('data_limit_unit', 5)->default(DataLimitUnit::Bytes)->after('port');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('access_keys', function (Blueprint $table) {
            $table->dropColumn('data_limit_unit');
        });
    }
};
