<?php
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketTable extends Migration
{
    public function up()
    {
        Schema::create('support_ticket', function($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->string('subject', 100);
            $table->enum('status', [
                \App\ShopifyFramework\Entity\SupportTicket::STATUS_OPEN,
                \App\ShopifyFramework\Entity\SupportTicket::STATUS_AWAITING_CUSTOMER,
                \App\ShopifyFramework\Entity\SupportTicket::STATUS_AWAITING_IMAGINE_APPS_REPLY,
                \App\ShopifyFramework\Entity\SupportTicket::STATUS_CLOSED
            ]);
            $table->timestamps();
        });
    }
}