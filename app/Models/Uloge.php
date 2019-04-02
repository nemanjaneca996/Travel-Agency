<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 2/28/2018
 * Time: 3:20 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Uloge
{
    public function getAll(){
        return DB::table('uloga')
            ->select('*')
            ->get();
    }
}