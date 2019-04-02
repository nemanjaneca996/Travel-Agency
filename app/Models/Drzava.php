<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Drzava{
    public $id;
    public $naziv;
    public $kontinent;
    public $nazivKontinenta;
    private $tabela='drzave';
    public function getAll(){
        return DB::table($this->tabela)
            ->select('*','drzave.id as drzavaId','drzave.naziv as nazivDrzave','kontinenti.naziv as nazivKontinent')
            ->join('kontinenti','kontinenti.id','=','drzave.kontinent_id')
            ->get();
    }
    public function add(){
        return DB::table($this->tabela)
            ->insert([
                'naziv'=>$this->naziv,
                'kontinent_id'=>$this->kontinent
            ]);
    }
    public function getOne(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->first();
    }
    public function getByName(){
        return DB::table($this->tabela)
            ->select('*','drzave.id as drzavaId','drzave.naziv as nazivDrzave','kontinenti.naziv as nazivKontinent')
            ->join('kontinenti','kontinenti.id','=','drzave.kontinent_id')
            ->where('kontinenti.naziv',$this->nazivKontinenta)
            ->get();
    }
    public function edit(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'naziv'=>$this->naziv,
                'kontinent_id'=>$this->kontinent
            ]);
    }
    public function delete(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->delete();
    }
}
