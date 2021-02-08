<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCollectionRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign('entities_collection_id_foreign');
            $table->dropColumn('collection_id');
        });

        Schema::table('profile_relations', function (Blueprint $table) {
            $table->dropForeign('entity_relations_collection_id_foreign');
            $table->dropColumn('collection_id');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign('tags_collection_id_foreign');
            $table->dropUnique('tags_collection_id_name_unique');
            $table->dropColumn('collection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');
        });

        Schema::table('profile_relations', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');

            $table->unique(['collection_id', 'name']);
        });
    }
}
