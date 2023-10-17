<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('guest_books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('no_barcode')->nullable()->unique();

            $table->text('photo')->nullable();
            $table->string('disk')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('type')->nullable();

            $table->string('description')->nullable();
            $table->dateTime('scan_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_books');
    }
}
