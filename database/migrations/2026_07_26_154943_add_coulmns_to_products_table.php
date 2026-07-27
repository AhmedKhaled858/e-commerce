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
        Schema::table('products', function (Blueprint $table) {
            //
            $table->foreignId('store_id')->after('category_id')->constrained('stores')->cascadeOnDelete();
            $table->string('slug')->unique()->after('title');
            $table->decimal('compare_price',8,2)->after('price')->nullable();
            $table->enum('status',['active','draft','archived'])->default('active')->after('compare_price');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignId('store_id');
            $table->dropColumn('slug');
            $table->dropColumn('compare_price');
            $table->dropColumn('status');
            $table->dropSoftDeletes();
        });
    }
};
