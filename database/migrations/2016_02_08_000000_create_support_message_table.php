<?php
use Illuminate\Database\Migrations\Migration;

class CreateSupportMessageTable extends Migration
{
    public function up()
    {
        Schema::create('support_message', function($table) {
            $table->increments('id')->unsigned();
            $table->integer('support_ticket_id')->unsigned()->index();
            $table->enum('author', [
                \App\ShopifyFramework\Entity\SupportTicket::AUTHOR_CUSTOMER,
                \App\ShopifyFramework\Entity\SupportTicket::AUTHOR_IMAGINE_APPS
            ]);
            $table->text('message');
            $table->timestamps();
        });
    }
}