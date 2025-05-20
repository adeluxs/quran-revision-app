<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartTimeAndEndTimeToRevisionSessionsTable extends Migration
{
    public function up()
    {
        Schema::table('revision_sessions', function (Blueprint $table) {
            $table->time('start_time')->after('date');
            $table->time('end_time')->after('start_time');
        });
    }

    public function down()
    {
        Schema::table('revision_sessions', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time']);
        });
    }
}
