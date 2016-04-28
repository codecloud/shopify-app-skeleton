<?php
use Illuminate\Database\Migrations\Migration;

class CreateRecurringProductTable extends Migration
{
    public function up()
    {
        Schema::create('recurring_product', function($table) {
            $table->increments('id')->unsigned();
            $table->string('display_name');
            $table->string('slug');
            $table->string('description');
            $table->string('features', 1000);
            $table->decimal('amount', 5, 2)->unsigned();
            $table->enum('frequency', ['monthly']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('recurring_product');
    }
}