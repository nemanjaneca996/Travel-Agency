<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/10/2018
 * Time: 1:50 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class TipSmestaja
{
    public function getAll(){
        return DB::table('tipsmestaja')
            ->get();
    }
}