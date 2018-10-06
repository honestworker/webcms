<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    /**
     * Generated
     */

    protected $table = 'countries';
    protected $fillable = ['country_id', 'name', 'iso_code_2', 'iso_code_3', 'address_format', 'postcode_required', 'status'];



}
