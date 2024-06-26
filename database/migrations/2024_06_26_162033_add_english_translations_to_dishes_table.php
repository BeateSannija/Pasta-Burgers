<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnglishTranslationsToDishesTable extends Migration
{
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->string('dish_name_en')->nullable();
            $table->text('dish_description_en')->nullable();
        });
    }

    public function down()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->dropColumn('dish_name_en');
            $table->dropColumn('dish_description_en');
        });
    }
}
