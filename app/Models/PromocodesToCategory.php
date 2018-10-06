<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocodesToCategory extends Model {

    /**
     * Generated
     */

    protected $table = 'promocodes_to_category';
    protected $fillable = ['id', 'promocode_id', 'category_id'];



}
