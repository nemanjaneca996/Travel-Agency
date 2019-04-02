<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kontinenti
{
    public $id;
    public $naziv;
    public $made_id;
    public $made_date;
    public $edit_id;
    public $edit_date;
    private $tabela='kontinenti';
    public function getAll(){
        return DB::table($this->tabela)
            ->select('*','kontinenti.id as kontinentId','user1.ime as madeIme','user2.ime as editIme','user1.prezime as madePrezime','user2.prezime as editPrezime')
            ->join('user as user1','user1.id','=','kontinenti.made_id')
            ->leftJoin('user as user2','user2.id','=','kontinenti.edit_id')
            ->get();
    }
    public function add(){
        return DB::table($this->tabela)
            ->insert([
                'naziv'=>$this->naziv,
                'made_id'=>$this->made_id,
                'made_date'=>$this->made_date
            ]);
    }
    public function getOne(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->first();
    }
    public function edit(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->update([
                'naziv'=>$this->naziv,
                'edit_id'=>$this->edit_id,
                'edit_date'=>$this->edit_date
            ]);
    }
    public function delete(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->delete();
    }
}
