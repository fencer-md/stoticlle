<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAnnouncementsExpire extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('announcement_expires')->nullable();
        });

        DB::update(DB::raw("UPDATE users SET announcement_expires = DATE_ADD(announcement_start, INTERVAL 7 DAY) WHERE announcement_start IS NOT NULL"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('announcement_expires');
        });
    }

}
