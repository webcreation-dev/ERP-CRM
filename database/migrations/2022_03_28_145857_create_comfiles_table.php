<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comfiles', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->datetime('com_date');
            $table->string('category');

            $table->string('ref');
            $table->string('enterprise');
            $table->string('ifu')->unique();
            $table->string('phones');
            $table->string('address');
            $table->string('email');

            $table->string('rpt_fullname');
            $table->string('rpt_phone')->nullable();

            $table->string('result')->nullable();
            $table->string('next')->nullable();
            $table->double('date_rdv')->nullable();

            $table->text('discussion');
            $table->text('activity');

            $table->string('user');
            $table->integer('wid');

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
        Schema::dropIfExists('comfiles');
    }
}
