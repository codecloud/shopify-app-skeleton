<?php
namespace App\ShopifyFramework\Entity;

class RecurringPurchase extends EntityModel
{
    /**
     * @var string
     */
    protected $table = 'recurring_purchase';

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function charges()
    {
        return $this->hasMany(RecurringCharge::class);
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 'ACTIVE' && strtotime($this->expires_at . ' 23:59:59') > time();
    }
}