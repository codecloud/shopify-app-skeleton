<?php
namespace App\ShopifyFramework\Entity;

use Illuminate\Contracts\Auth\Authenticatable;

class User extends EntityModel implements Authenticatable
{
    /**
     * @var string
     */
    protected $table = 'user';

    /**
     * @var array
     */
    protected $fillable = ['owner_name', 'email_address', 'shop_url', 'last_logged_in_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
         return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->access_token;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return null;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        return null;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return null;
    }
}
