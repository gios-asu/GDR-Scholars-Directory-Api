<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('response_id')->comment('GDR Restrict Access');
            $table->integer('response_number')->comment('GDR Restrict Access');
            $table->string('respondent_name')->comment('GDR Restrict Access');
            $table->string('respondent_email')->comment('GDR Restrict Access');
            $table->string('host_name');
            $table->string('host_org_type');
            $table->string('host_support');
            $table->string('host_website');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hosts');
    }
}
