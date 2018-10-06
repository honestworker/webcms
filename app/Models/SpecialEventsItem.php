<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialEventsItem extends Model {

    /**
     * Generated
     */

    protected $table = 'special_events_items';
    protected $fillable = ['id', 'product_id', 'color_id', 'event_id', 'would_love', 'still_need', 'priority', 'last_modified'];



}
