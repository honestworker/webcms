<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class Gstrate extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gst_rates';

    public function getGstrate($gstrate_id) {
        return DB::table($this->table)->where('id', '=', $gstrate_id)->first();
    }

    public function getGstrates($limit, $page, $data) {
        $gstrates = DB::table($this->table);

        if (isset($data['name']) && trim($data['name']) != '') {
            $gstrates->where('name', 'LIKE', '%' . $data['name'] . '%');
        }

        //Sorting Start
        $sort = 'ASC';
        $sort_by = 'created_at';

        if (isset($data['sort']) && $data['sort'] == 'DESC') {
            $sort = $data['sort'];
        }

        if (isset($data['sort_by']) && in_array($data['sort_by'], array('id', 'name', 'rate','status', 'created_at', 'updated_at'))) {
            $sort_by = $data['sort_by'];
        }


        $gstrates->orderBy($sort_by, $sort);

        //Sorting End

        return $gstrates->paginate($limit);
    }

    public function getLastUpdated() {
        $updated_at = DB::table($this->table)->select('updated_at')->orderBy('updated_at', 'DESC')->take(1)->first();
        if ($updated_at) {
            return date('d M, Y @ h:i A', strtotime($updated_at->updated_at));
        } else {
            return false;
        }
    }

    public function get_paginate_msg($limit, $page, $data) {
        $page = ($page ? ($page - 1) * $limit : 0);

        //First query
        $gstrates = DB::table($this->table)->select('id');
        if (isset($data['name']) && trim($data['name']) != '') {
            $gstrates->where('name', 'LIKE', '%' . $data['name'] . '%');
        }

        $results = $gstrates->skip($page)->take($limit)->get();

        //Second query
        $gstrates = DB::table($this->table);
        if (isset($data['name']) && trim($data['name']) != '') {
            $gstrates->where('name', 'LIKE', '%' . $data['name'] . '%');
        }

        $count = $gstrates->count();

        if ($results) {
            $message = 'Showing ' . ($page + 1) . ' to ' . ($page + count($results)) . ' of ' . $count . ' entries';
        } else {
            $message = 'Showing 0 to 0 of ' . $count . ' entries';
        }

        return $message;
    }

    public function deleteGstrate($gstrate_id) {
        DB::table($this->table)->where('id', '=', $gstrate_id)->delete();
    }

    public function addGstrate($data) {
        $insert = [
            'name' => $data['name'],
            'rate' => $data['rate'],
            'status' => (isset($data['status']) ? '1' : '0'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        DB::table($this->table)->insert($insert);
    }

    public function editGstrate($gstrate_id, $data) {
        $update = [
            'name' => $data['name'],
            'rate' => $data['rate'],
            'status' => (isset($data['status']) ? '1' : '0'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        DB::table($this->table)->where('id', $gstrate_id)->update($update);
    }

}
