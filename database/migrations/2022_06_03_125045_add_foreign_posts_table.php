<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('posts', function (Blueprint $table){
            // per chiavi univoche riferite ad altra tabella
            // genero la colonna
            $table->unsignedBigInteger('category_id');
            // definisco relazione
            $table->foreign('category_id')->references('id')->on('categories')->setDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // definiamo il down
        $Schema::table('posts', function (Blueprint $table){

            $table->dropForeign('posts_categoriy_id_foreign');
            $table->dropColumn('category_id');

        });
    }
}
