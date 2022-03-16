<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')
                ->nullable()
                ->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('content');
            $table->string('seo_title')->nullable();
            $table->string('seo_meta')->nullable();
            $table->string('social_title')->nullable();
            $table->string('social_meta')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('created_by')
            ->references('id')
            ->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_pages');
    }
}
