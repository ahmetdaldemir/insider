<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->char('played')->default(0)->comment("Toplam oynanan maç");
            $table->char('won')->default(0)->comment("Kazandığı Maç");
            $table->char('drawn')->default(0)->comment("Beraberlik");
            $table->char('lost')->default(0)->comment("Kaybettiği");
            $table->char('point')->default(0)->comment("Puan");
            $table->char('dg')->default(0)->comment("Attığı ile Yediği gol farkı");
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('points');
    }
}
