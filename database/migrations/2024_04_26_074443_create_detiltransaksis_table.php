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
        Schema::create('detiltransaksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksis_id')->unsigned();
            $table->bigInteger('barangs_id')->unsigned();
            $table->integer('qty');
            $table->double('price');
            $table->timestamps();
        });
        Schema::table('detiltransaksis', function(Blueprint $table) {
	
            $table->foreign('transaksis_id')->references('id')->on('transaksis')
                   ->onUpdate('cascade') ->onDelete('cascade');
                  
                  
        $table->foreign('barangs_id')->references('id')->on('barangs')
                   ->onUpdate('cascade') ->onDelete('cascade');
           });
       }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropForeign('detiltransaksis_transaksis_id_foreign');
        });
   
        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropIndex('detiltransaksis_transaksis_id_foreign');
        });

        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropForeign('detiltransaksis_barangs_id_foreign');
        });
   
        Schema::table('detiltransaksis', function(Blueprint $table) {
            $table->dropIndex('detiltransaksis_barangs_id_foreign');
        });
       
        Schema::dropIfExists('detiltransaksis');

    }

};
