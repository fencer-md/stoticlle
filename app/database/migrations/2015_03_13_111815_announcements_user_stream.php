<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnouncementsUserStream extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('announcements');

            $table->integer('announcement_stream')->nullable();
            $table->dateTime('announcement_start')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('announcement_stream');
            $table->dropColumn('announcement_start');

            $table->boolean('announcements')->default(false);
        });
    }

}
