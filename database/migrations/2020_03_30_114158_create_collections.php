<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Collection table
         */
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
            $table->softDeletes()
                  ->index();

            $table->morphs('owner');
        });

        /**
         * Entity table
         */
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->json('data');
            $table->timestamps();

            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');
        });

        /**
         * EntityRelation table
         */
        Schema::create('entity_relations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)
                  ->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');
        });

        /**
         * EntityEntityRelation pivot table
         */
        Schema::create('entity_entity_relation', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id')
                  ->references('id')
                  ->on('entities')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('entity_relation_id');
            $table->foreign('entity_relation_id')
                  ->references('id')
                  ->on('entity_relations')
                  ->onDelete('cascade');

            $table->primary(['entity_relation_id', 'entity_id']);
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_entity_relation');
        Schema::dropIfExists('entity_relations');
        Schema::dropIfExists('entities');
        Schema::dropIfExists('collections');
    }
}
