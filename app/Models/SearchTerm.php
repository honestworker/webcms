<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchTerm extends Model {

    /**
     * Generated
     */

    protected $table = 'search_terms';
    protected $fillable = ['id', 'keyword', 'results', 'number_uses', 'last_searched'];



}
