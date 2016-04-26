<?php
namespace App\ShopifyFramework\Entity;

class SupportMessage extends EntityModel
{
    /**
     * @var string
     */
    protected $table = 'support_message';

    /**
     * @var array
     */
    protected $fillable = ['subject', 'user_id', 'author'];
}