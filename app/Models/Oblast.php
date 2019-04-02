<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Oblast
{
    public $id;
    public $naziv;
    public $grad;
    public $slika;
    public $nazivDrzave;
    private $tabela='oblast';
    public function getAll(){
        return DB::table($this->tabela)
            ->select('*','oblast.id as oblastId','oblast.naziv as nazivOblasti','drzave.naziv as nazivDrzave')
            ->join('drzave','drzave.id','=','oblast.drzava_id')
            ->get();
    }
    public function getOne(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->first();
    }
    public function insert(){
        return DB::table($this->tabela)
            ->insert([
                'naziv'=>$this->naziv,
                'drzava_id'=>$this->grad,
                'slika'=>$this->slika
            ]);
    }
    public function update(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'naziv'=>$this->naziv,
                'drzava_id'=>$this->grad
            ]);
    }
    public function updateSaSlikom(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'naziv'=>$this->naziv,
                'drzava_id'=>$this->grad,
                'slika'=>$this->slika
            ]);
    }
    public function delete(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->delete();
    }
    public function getByName(){
        return DB::table($this->tabela)
            ->select('*','oblast.id as oblastId','oblast.naziv as nazivOblasti','drzave.naziv as nazivDrzave','kontinenti.naziv as nazivKontinenta')
            ->join('drzave','drzave.id','=','oblast.drzava_id')
            ->join('kontinenti','kontinenti.id','=','drzave.kontinent_id')
            ->where('drzave.naziv',$this->nazivDrzave)
            ->get();
    }
}
