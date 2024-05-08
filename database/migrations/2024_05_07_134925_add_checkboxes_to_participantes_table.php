<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckboxesToParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participantes', function (Blueprint $table) {
            $table->boolean('firstCheckboxChecked')->default(false);
            $table->boolean('lastCheckboxChecked')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participantes', function (Blueprint $table) {
            $table->dropColumn('firstCheckboxChecked');
            $table->dropColumn('lastCheckboxChecked');
        });
    }
}
