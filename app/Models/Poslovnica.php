<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/13/2018
 * Time: 7:40 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Poslovnica
{
    public $naslov;
    public $adresa;
    public $tel;
    public $mob;
    public $fax;
    public $email;
    private $tabela='poslovnice';

    public function getAll(){
        return DB::table($this->tabela)
            ->get();
    }
    public function getOne($id){
        return DB::table($this->tabela)
            ->first();
    }
    public function insert(){
        return DB::table($this->tabela)
            ->insert([
                'naslov'=>$this->naslov,
                'adresa'=>$this->adresa,
                'tel'=>$this->tel,
                'fax'=>$this->fax,
                'mob'=>$this->mob,
                'email'=>$this->email
            ]);

    }
    public function edit($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'naslov'=>$this->naslov,
                'adresa'=>$this->adresa,
                'tel'=>$this->tel,
                'fax'=>$this->fax,
                'mob'=>$this->mob,
                'email'=>$this->email
            ]);

    }
    public function delete($id){
        return DB::table($this->tabela)
            ->where('id', $id)
            ->delete();
    }
}