<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Slider
{
    public $id;
    public $alt;
    public $url;
    public $made_id;
    public $made_date;
    private $tabela='slider';

    public function getAll(){
        return DB::table($this->tabela)
            ->select('*','slider.id as sliderId')
            ->join('user','user.id','=','slider.made_id')
            ->get();
    }
    public function add(){
        return DB::table($this->tabela)
            ->insert([
                'alt'=>$this->alt,
                'url'=>$this->url,
                'made_id'=>$this->made_id,
                'made_date'=>$this->made_date
            ]);
    }
    public function getOne(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->first();
    }
    public function delete(){
        return DB::table($this->tabela)
            ->where('id',$this->id)
            ->delete();
    }

}
