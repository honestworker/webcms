<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialEvent extends Model {

    /**
     * Generated
     */

    protected $table = 'special_events';
    protected $fillable = ['id', 'user_id', 'event_type', 'event_date', 'event_location', 'guests', 'registrant_first_name', 'registrant_last_name', 'registrant_telephone', 'registrant_birth_date', 'registrant_address', 'registrant_city', 'registrant_post_code', 'registrant_state', 'registrant_country', 'co_registrant_first_name', 'co_registrant_last_name', 'co_registrant_telephone', 'co_registrant_address', 'co_registrant_city', 'co_registrant_post_code', 'co_registrant_state', 'co_registrant_country', 'send_gift_to', 'recipient_name', 'recipient_address', 'recipient_city', 'recipient_post_code', 'recipient_state', 'recipient_country', 'use_future_shipping_address', 'future_shipping_date', 'future_shipping_address', 'future_shipping_recipient_name', 'future_shipping_recipient_address', 'future_shipping_recipient_city', 'future_shipping_recipient_post_code', 'future_shipping_recipient_state', 'future_shipping_recipient_country', 'preference', 'preferred_state', 'preferred_store', 'token', 'last_modified', 'created'];



}
