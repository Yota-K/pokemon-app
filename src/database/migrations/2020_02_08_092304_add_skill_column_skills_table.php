<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkillColumnSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->renameColumn('skill_name', 'skill_name_1');
            $table->string('skill_name_2', 10);
            $table->string('skill_name_3', 10);
            $table->string('skill_name_4', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->renameColumn('skill_name_1', 'skill_name');
            $table->dropColumn('skill_name_2');
            $table->dropColumn('skill_name_3');
            $table->dropColumn('skill_name_4');
        });
    }
}
