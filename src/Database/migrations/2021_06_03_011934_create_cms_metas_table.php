<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cms_page_id')->index();
            $table->enum('type', config('durba-cms.meta-types'))
                ->default('string');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('group')->nullable();
            $table->json('content')->nullable();
            $table->timestamps();

            $table->foreign('cms_page_id')
            ->references('id')
            ->on('cms_pages')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unique(['cms_page_id', 'slug']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_metas');
    }
}
