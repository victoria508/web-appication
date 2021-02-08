<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Tag table
         */
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();

            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');

            $table->unique(['collection_id', 'name']);
        });

        /**
         * Profile Tag pivot table
         */
        Schema::create('entity_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')
                  ->references('id')
                  ->on('entities')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')
                  ->references('id')
                  ->on('tags')
                  ->onDelete('cascade');

            $table->primary(['tag_id', 'entity_id']);
        });

        /**
         * ProfileRelation Tag pivot table
         */
        Schema::create('entity_relation_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_relation_id');
            $table->foreign('entity_relation_id')
                  ->references('id')
                  ->on('entity_relations')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')
                  ->references('id')
                  ->on('tags')
                  ->onDelete('cascade');

            $table->primary(['tag_id', 'entity_relation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_relation_tag');
        Schema::dropIfExists('entity_tag');
        Schema::dropIfExists('tags');
    }
}
