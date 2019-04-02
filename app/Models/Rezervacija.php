<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/12/2018
 * Time: 9:19 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Rezervacija
{
    public $smestaj;
    public $user;
    public $datum;
    public $tip;
    public $napomena;
    public $datumPolaska;
    private $tabela='rezervacija';

    public function insert(){
        return DB::table($this->tabela)
            ->insert([
                'user_id'=>$this->user,
                'smestaj_id'=>$this->smestaj,
                'vreme'=>$this->datum,
                'tipSobe'=>$this->tip,
                'napomena'=>$this->napomena,
                'datumPolaska'=>$this->datumPolaska
            ]);
    }
    public function getAll(){
        return DB::table($this->tabela)
            ->select('*','user.id as userId')
            ->join('smestaj','smestaj.id','=','rezervacija.smestaj_id')
            ->join('user','user.id','=','rezervacija.user_id')
            ->get();
    }
    public function delete($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->delete();
    }
    public function getAllForUser($id){
        return DB::table($this->tabela)
            ->select('*','rezervacija.id as rezId')
            ->join('smestaj','smestaj.id','=','rezervacija.smestaj_id')
            ->where('rezervacija.user_id',$id)
            ->get();
    }
}