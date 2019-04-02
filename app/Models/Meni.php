<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Meni
{
    public $id;
    public $naziv;
    public $adresa;
    public $roditelj;
    private $tabela='meni';

    public function getAll(){
        return DB::table($this->tabela)
            ->get();
    }
    public function insert(){
        return DB::table($this->tabela)
            ->insert([
                'naziv'=>$this->naziv,
                'adresa'=>$this->adresa,
                'parent'=>$this->roditelj
            ]);
    }
    public function getOne(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->first();
    }
    public function update(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'naziv'=>$this->naziv,
                'adresa'=>$this->adresa,
                'parent'=>$this->roditelj
            ]);
    }
    public function delete(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->delete();
    }
    public function meni(){
        $menus=DB::table($this->tabela)->get();
        foreach ($menus as $meni){
            $meni->submenus=DB::table($this->tabela)
                                ->where('parent',$meni->id)
                                ->orderBy('naziv')
                                ->get();
        }
        return $menus;

    }
}