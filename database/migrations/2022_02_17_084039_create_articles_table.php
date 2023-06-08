<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Subcategory::class)->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('title_ar')->nullable();
            $table->text('article');
            $table->integer('views')->default(0);
            $table->string('status')->default('pending');
            $table->text('article_ar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
