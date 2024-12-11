<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityColumnToItemsTable extends Migration
{

    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
	        $table->unsignedMediumInteger('quantity')->default(1)->after('have');
		});
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
	        $table->dropColumn('quantity');
        });
    }
}
