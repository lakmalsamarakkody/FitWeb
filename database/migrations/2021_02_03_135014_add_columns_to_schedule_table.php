<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_schedules', function (Blueprint $table) {
            $table->string('schedule_approval')->nullable()->after('result_released');
            $table->boolean('schedule_release')->default(false)->after('schedule_approval');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_schedules', function (Blueprint $table) {
            //
        });
    }
}
