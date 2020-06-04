<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcmHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icm_headers', function (Blueprint $table) {
            $table->bigIncrements('creationHeaderID');
            $table->unsignedBigInteger("materialTypeID");
            $table->text("shortDescription");
            $table->text("longDescription");
            $table->string("mfrNumber");
            $table->float("buyPrice", 19, 6);
            $table->longText("refDoc");
            $table->integer("statusID");
            $table->integer("creatorID");
            $table->unsignedBigInteger("approverID");
            $table->dateTime("dateRequested");
            $table->dateTime("dateCreated");
            $table->dateTime("dateModified");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('icm_headers');
    }
}
