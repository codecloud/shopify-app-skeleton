<?php
namespace App\ShopifyFramework\Entity;

class RecurringProduct extends EntityModel
{
    /**
     * @var string
     */
    protected $table = 'recurring_product';

    public function getFrequencyAsTimeModifierString()
    {
        switch ($this->frequency) {
            case 'monthly':
                return '+ 1 month';
            default:
                throw new \Exception('Invalid frequency "' . $this->frequency . '"');
        }
    }

    /**
     * @return \stdClass[]
     */
    public function features()
    {
        return $this->features ? json_decode($this->features) : [];
    }
}