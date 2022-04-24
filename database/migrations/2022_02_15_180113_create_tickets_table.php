<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('seen')->default(0)->comment('0 => unseen');
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reference_id')->constrained('ticket_admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('ticket_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('priority_id')->constrained('ticket_priorities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('tickets');
    }
}
