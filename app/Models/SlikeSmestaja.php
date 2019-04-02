<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/10/2018
 * Time: 2:32 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class SlikeSmestaja
{
    private $table='slikesmestaja';
    public $url;
    public $alt;
    public $glavna;
    public $id;
    public $smestaj;

    public function insert(){
            return DB::table($this->table)
                ->insert([
                    'url'=>$this->url,
                    'alt'=>$this->alt,
                    'glavna'=>$this->glavna,
                    'smestaj_id'=>$this->smestaj
                ]);

    }
    public function edit($id){
        return DB::table($this->table)
            ->where('smestaj_id',$id)
            ->update([
                'url'=>$this->url,
                'alt'=>$this->alt,
                'glavna'=>$this->glavna
            ]);
    }
    public function getOne($id){
        return DB::table($this->table)
            ->where('smestaj_id',$id)
            ->first();
    }
    public function getById($id){
        return DB::table($this->table)
            ->where([
                'smestaj_id'=>$id,
                'glavna'=>0
            ])
            ->get();
    }
    public function getAllById($id){
        return DB::table($this->table)
            ->where([
                'smestaj_id'=>$id
            ])
            ->get();
    }
    public function delete($id){
        return DB::table($this->table)
            ->where('smestaj_id',$id)
            ->delete();
    }
    public function deleteMultiple($cekirano){
        return DB::table($this->table)
            ->whereIn('url',$cekirano)
            ->delete();
    }

}