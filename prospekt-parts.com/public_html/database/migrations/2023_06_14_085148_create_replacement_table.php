<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplacementTable extends Migration
{
    /**
     * Run the migrations.
     * @param string analog | новый артикул замена
     * @param string part | старый артикул
     * @return void
     */
    public function up()
    {
        Schema::create('replacement', function (Blueprint $table) {
            $table->increments('id');
            $table->string('analog');
            $table->string('part')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replacement');
    }
}
