<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNamesOfEntityTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('entities', 'profiles');
        Schema::rename('entity_relations', 'profile_relations');
        Schema::rename('entity_entity_relation', 'profile_profile_relation');
        Schema::rename('entity_tag', 'profile_tag');
        Schema::rename('entity_relation_tag', 'profile_relation_tag');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('profiles', 'entities');
        Schema::rename('profile_relations', 'entity_relations');
        Schema::rename('profile_profile_relation', 'entity_entity_relation');
        Schema::rename('profile_tag', 'entity_tag');
        Schema::rename('profile_relation_tag', 'entity_relation_tag');

    }
}
