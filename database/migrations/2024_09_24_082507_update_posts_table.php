<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //creo la colonna per la foregin key
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //Creo la FK sulla colonna creata
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                //quando cancello una categoria metterà null nella foregin key
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //NON posso eliminare la colonna senza prima eliminare la foregin key
            //sintassi con nome della fk: tabella_colonna_foregin
            //$table->dropForeign('post_category_id_foreign');

            //sintassi inserendo il nome della colonna con la Fk
            $table->dropForeign(['category_id']);


            $table->dropColumn('category_id');
        });
    }
};
