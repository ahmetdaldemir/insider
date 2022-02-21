<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homeowner_team_id');
            $table->foreign('homeowner_team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->unsignedBigInteger('guestowner_team_id');
            $table->foreign('guestowner_team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->unsignedBigInteger('week_id');
            $table->foreign('week_id')->references('id')->on('weeks')->onDelete('cascade');

            $table->integer('homeowner_team_goals')->default(0);
            $table->integer('guestowner_team_goals')->default(0);
            $table->boolean('match_status')->default(0);

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
        Schema::dropIfExists('matches');
    }
}
