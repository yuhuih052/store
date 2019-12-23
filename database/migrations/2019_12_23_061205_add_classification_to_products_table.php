<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassificationToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('edible')->after('on_sale')->default(true);
            $table->boolean('daily_use')->after('on_sale')->default(true);
            $table->boolean('wash_rinse')->after('on_sale')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('edible');
            $table->dropColumn('daily_use');
            $table->dropColumn('wash_rinse');
        });
    }
}
