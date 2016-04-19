<?php
namespace App\ShopifyFramework\Entity;

class User extends EntityModel
{
    /**
     * @var string
     */
    protected $table = 'user';

    /**
     * @var array
     */
    protected $fillable = ['name', 'email_address', 'shop_url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function singlePurchases()
    {
        return $this->hasMany(SinglePurchase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function singleCharges()
    {
        return $this->hasMany(SingleCharge::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recurringPurchases()
    {
        return $this->hasMany(RecurringPurchase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recurringCharges()
    {
        return $this->hasMany(RecurringCharge::class);
    }
}
