<?php
namespace App\ShopifyFramework\Entity;

/**
 * @property $messages SupportMessage[]
 */
class SupportTicket extends EntityModel
{
    const STATUS_OPEN = 'Open';
    const STATUS_CLOSED = 'Closed';
    const STATUS_AWAITING_CUSTOMER = 'Awaiting customer reply';
    const STATUS_AWAITING_IMAGINE_APPS_REPLY = 'Awaiting reply from Imagine Apps';

    const AUTHOR_CUSTOMER = 'Customer';
    const AUTHOR_IMAGINE_APPS = 'David';

    /**
     * @var string
     */
    protected $table = 'support_ticket';

    /**
     * @var array
     */
    protected $fillable = ['subject', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(SupportMessage::class);
    }

    /**
     * @param User $user
     * @return SupportTicket[]
     */
    public static function findOpenForUser(User $user)
    {
        return self::findForUser($user, [
            self::STATUS_OPEN,
            self::STATUS_AWAITING_CUSTOMER,
            self::STATUS_AWAITING_IMAGINE_APPS_REPLY
        ]);
    }

    /**
     * @param User $user
     * @return SupportTicket[]
     */
    public static function findClosedForUser(User $user)
    {
        return self::findForUser($user, [
            self::STATUS_CLOSED
        ]);
    }

    /**
     * @param User  $user
     * @param array $statuses
     * @return SupportTicket[]
     */
    public static function findForUser(User $user, array $statuses = [])
    {
        $stmt = self::where('user_id', '=', $user->id)
                    ->orderBy('updated_at', 'desc')
                    ->orderBy('id', 'desc');

        if ($statuses) {
            $stmt->whereIn('status', $statuses);
        }

        $results = $stmt->get();

        return $results->count() ? $results : [];
    }
}