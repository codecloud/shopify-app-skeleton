<?php
namespace App\ShopifyFramework\Http\Request;

use App\ShopifyFramework\Entity\SupportTicket;

class AddNewSupportMessage extends Request
{
    public function rules()
    {
        return [
            'support_ticket_id' => 'integer',
            'message' => 'required'
        ];
    }

//    public function authorize()
//    {
//        $ticket = SupportTicket::get($this->get('support_ticket_id'));
//        return $ticket->user_id == \Auth::getUser()->id;
//    }
}