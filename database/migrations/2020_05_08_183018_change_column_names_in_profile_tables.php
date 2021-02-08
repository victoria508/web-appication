<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnNamesInProfileTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_profile_relation', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'profile_id');
            $table->renameColumn('entity_relation_id', 'profile_relation_id');
        });

        Schema::table('profile_tag', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'profile_id');
        });

        Schema::table('profile_relation_tag', function (Blueprint $table) {
            $table->renameColumn('entity_relation_id', 'profile_relation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_profile_relation', function (Blueprint $table) {
            $table->renameColumn('profile_id', 'entity_id');
            $table->renameColumn('profile_relation_id', 'entity_relation_id');
        });

        Schema::table('profile_tag', function (Blueprint $table) {
            $table->renameColumn('profile_id', 'entity_id');
        });

        Schema::table('profile_relation_tag', function (Blueprint $table) {
            $table->renameColumn('profile_relation_id', 'entity_relation_id');
        });
    }
}
