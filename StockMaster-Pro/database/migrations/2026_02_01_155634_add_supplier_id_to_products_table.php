<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Zid l-column mn b3d category_id masalan bach y-bqa l-tartib mzyan
            $table->foreignId('supplier_id')
                  ->after('category_id') 
                  ->nullable()
                  ->constrained('suppliers')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Darori t-dropi l-foreign key hiya l-lowla 3ad l-column
            $table->dropForeign(['supplier_id']);
            $table->dropColumn('supplier_id');
        });
    }
};