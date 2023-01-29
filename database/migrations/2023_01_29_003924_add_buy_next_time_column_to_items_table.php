<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuyNextTimeColumnToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
	        $table->foreignId('buy_next_at_id')->nullable()->after('have');
			$table->boolean('buy_later')->default(false)->after('have');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
	        $table->dropColumn('buy_next_at_id');
	        $table->dropColumn('buy_later');
        });
    }
}
