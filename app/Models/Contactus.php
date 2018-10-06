<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model {

    /**
     * Generated
     */

    protected $table = 'contactus';
    protected $fillable = ['id', 'first_name', 'last_name', 'company_name', 'occupation', 'tel', 'fax', 'email', 'address', 'city', 'postcode', 'room', 'subject', 'comment_enquiry'];



}
