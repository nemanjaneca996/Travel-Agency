<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/13/2018
 * Time: 10:24 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Odgovori
{
    public $odgovor;
    public $pitanje;
    private $tabela='odgovori';

    public function getAll(){
        return DB::table($this->tabela)
            ->select('*','odgovori.id as odgovorId','pitanja.id as pitanjeId')
            ->join('pitanja','pitanja.id','=','odgovori.pitanje_id')
            ->get();
    }
    public function getAnketa(){
        return DB::table($this->tabela)
            ->select('*','odgovori.id as odgovorId','pitanja.id as pitanjeId')
            ->join('pitanja','pitanja.id','=','odgovori.pitanje_id')
            ->where('aktivno',1)
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
                'odgovor'=>$this->odgovor,
                'pitanje_id'=>$this->pitanje
            ]);
    }
    public function update($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'odgovor'=>$this->odgovor,
                'pitanje_id'=>$this->pitanje
            ]);
    }
    public function glasanje($id,$vrednost){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'vrednost'=>$vrednost
            ]);
    }
    public function delete($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->delete();
    }
}