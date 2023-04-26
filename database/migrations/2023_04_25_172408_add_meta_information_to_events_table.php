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
        Schema::table('events', function (Blueprint $table) {
            $table->string('street_address')->nullable()->after('ubication');
            $table->string('address_locality')->nullable()->after('street_address');
            $table->string('postal_code')->nullable()->after('address_locality');
            $table->string('address_region')->nullable()->after('postal_code');
            $table->string('address_country')->nullable()->after('address_region');
            $table->text('about')->nullable()->after('created_by');
            $table->string('meta_title')->nullable()->after('about');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('street_address');
            $table->dropColumn('address_locality');
            $table->dropColumn('postal_code');
            $table->dropColumn('address_region');
            $table->dropColumn('address_country');
            $table->dropColumn('about');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
        });
    }
};
