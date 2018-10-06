<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class Countries extends Model
{

    protected $table = 'countries';

    public function getCountryIdByName($name)
    {
        return parent::where('name', $name)->first()->country_id;
    }

    public function getCountry($country_id)
    {
        return DB::table('countries')->where('country_id', '=', $country_id)->first();
    }

    public function getCountries()
    {
        return DB::table('countries')->orderBy('name', 'ASC')->get();
    }

    public function getStatesByCountry($country_id = null)
    {
        $country_id = ($country_id) ? $country_id : $this->getCountryIdByName('Malaysia');

        return DB::table('states')->where('country_id', '=', $country_id)->orderBy('name', 'ASC')->get();
    }

    public function getStatesByCountryName($countryName = null)
    {
        $country_id = $this->getCountryIdByName($countryName ? $countryName : 'Malaysia');
        return DB::table('states')->where('country_id', '=', $country_id)->orderBy('name', 'ASC')->get();
    }

    public function getStates()
    {
        return DB::table('states')->orderBy('name', 'ASC')->get();
    }
}