<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpportunitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->string('status')->default('In Catalog');
            $table->string('title');
            $table->string('country');
            $table->string('discipline');
            $table->string('duration');
            $table->string('num_positions');
            $table->text('work_environment');
            $table->text('project_description');
            $table->text('benefits');
            $table->text('expected_outcomes');
            $table->text('project_summary');
            $table->integer('is_filled')->nullable();
            $table->timestamp('submitted_at');
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
        Schema::drop('opportunities');
    }
}
