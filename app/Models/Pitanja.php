<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/13/2018
 * Time: 10:24 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Pitanja
{
    public $pitanje;
    public $aktivno;
    private $tabela='pitanja';

    public function getAll(){
        return DB::table($this->tabela)
            ->get();
    }
    public function getOne($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->first();
    }
    public function insert(){
        return DB::table($this->tabela)
            ->insert([
                'naziv'=>$this->pitanje,
                'aktivno'=>$this->aktivno
            ]);
    }
    public function update($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'naziv'=>$this->pitanje,
                'aktivno'=>$this->aktivno
            ]);
    }
    public function delete($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->delete();
    }
}