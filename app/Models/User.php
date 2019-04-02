<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class User
{
    public $id;
    public $ime;
    public $prezime;
    public $email;
    public $lozinka;
    public $uloga;
    public $slika;
    private $tabela='user';

    public function getAll(){
        return DB::table($this->tabela)
                ->select('*','user.id as userId')
                ->join('uloga','uloga.id','=','user.uloga_id')
                ->get();
    }
    public function login(){
        return DB::table($this->tabela)
            ->select('*','user.id as userId')
            ->join('uloga','uloga.id','=','user.uloga_id')
            ->where([
                'email'=>$this->email,
                'password'=>md5($this->lozinka)])
            ->first();
    }
    public function provera(){
        return DB::table($this->tabela)
            ->select('*')
            ->where('email','=',$this->email)
            ->first();
    }
    public function getOne(){
        return DB::table($this->tabela)
            ->select('*','user.id as userId')
            ->join('uloga','uloga.id','=','user.uloga_id')
            ->where('user.id',$this->id)
            ->first();
    }
    public function register(){
        return DB::table($this->tabela)
            ->insert([
                'ime'=>$this->ime,
                'prezime'=>$this->prezime,
                'email'=>$this->email,
                'password'=>md5($this->lozinka),
                'uloga_id'=>2,
                'slika'=>$this->slika

            ]);
    }
    public function registerByAdmin(){
        return DB::table($this->tabela)
            ->insert([
                'ime'=>$this->ime,
                'prezime'=>$this->prezime,
                'email'=>$this->email,
                'password'=>md5($this->lozinka),
                'uloga_id'=>$this->uloga,
                'slika'=>$this->slika

            ]);
    }
    public function updateBezSlike(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'ime'=>$this->ime,
                'prezime'=>$this->prezime,
                'email'=>$this->email,
                'password'=>md5($this->lozinka),
                'uloga_id'=>$this->uloga
            ]);
    }
    public function updateSaSlikom(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'ime'=>$this->ime,
                'prezime'=>$this->prezime,
                'email'=>$this->email,
                'password'=>md5($this->lozinka),
                'uloga_id'=>$this->uloga,
                'slika'=>$this->slika
            ]);
    }
    public function delete(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->delete();
    }
    public function anketa($tip){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'glasanje'=>$tip
            ]);
    }

}