<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementsBetsRemoveAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements_bets', function (Blueprint $table) {
            $table->dropColumn('amount');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements_bets', function (Blueprint $table) {
            $table->float('amount');
        });
    }
}
