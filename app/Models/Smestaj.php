<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/7/2018
 * Time: 11:08 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Smestaj
{
    public $naziv;
    public $brojZvezdica;
    public $oblast;
    public $tip;
    public $opis;
    public $cenovnik;
    public $made_id;
    public $made_date;
    public $edit_id;
    public $edit_date;
    private $tabela='smestaj';
    public function getAll(){
        return DB::table($this->tabela)
            ->select('*','smestaj.naziv as nazivSmestaja','oblast.naziv as nazivOblasti','tipsmestaja.naziv as nazivTipa','smestaj.id as smestajId','user1.ime as madeIme','user2.ime as editIme','user1.prezime as madePrezime','user2.prezime as editPrezime')
            ->join('oblast','oblast.id','=','smestaj.oblast_id')
            ->join('tipsmestaja','tipsmestaja.id','=','smestaj.tip_id')
            ->join('slikesmestaja','slikesmestaja.smestaj_id','=','smestaj.id')
            ->join('user as user1','user1.id','=','smestaj.made_id')
            ->leftJoin('user as user2','user2.id','=','smestaj.edit_id')
            ->where([
                'glavna'=>1
            ])
            ->paginate(8);
    }
    public function insert(){
        return DB::table($this->tabela)
            ->insert([
                'naziv'=>$this->naziv,
                'brojZvezdica'=>$this->brojZvezdica,
                'opis'=>$this->opis,
                'cenovnik'=>$this->cenovnik,
                'oblast_id'=>$this->oblast,
                'tip_id'=>$this->tip,
                'made_id'=>$this->made_id,
                'made_date'=>$this->made_date
            ]);
    }
    public function getOne($id){
        return DB::table($this->tabela)
            ->select('*','smestaj.naziv as nazivSmestaja','oblast.naziv as nazivOblasti','tipsmestaja.naziv as nazivTipa','smestaj.id as smestajId','oblast.id as oblastId','tipsmestaja.id as tipId')
            ->join('oblast','oblast.id','=','smestaj.oblast_id')
            ->join('tipsmestaja','tipsmestaja.id','=','smestaj.tip_id')
            ->join('slikesmestaja','slikesmestaja.smestaj_id','=','smestaj.id')
            ->where([
                'glavna'=>1,
                'smestaj.id'=>$id
            ])
            ->first();
    }
    public function edit($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'naziv'=>$this->naziv,
                'brojZvezdica'=>$this->brojZvezdica,
                'opis'=>$this->opis,
                'cenovnik'=>$this->cenovnik,
                'oblast_id'=>$this->oblast,
                'tip_id'=>$this->tip,
                'edit_id'=>$this->edit_id,
                'edit_date'=>$this->edit_date
            ]);
    }
    public function editBez($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'naziv'=>$this->naziv,
                'brojZvezdica'=>$this->brojZvezdica,
                'opis'=>$this->opis,
                'oblast_id'=>$this->oblast,
                'tip_id'=>$this->tip,
                'edit_id'=>$this->edit_id,
                'edit_date'=>$this->edit_date
            ]);
    }
    public function delete($id){
        return DB::table($this->tabela)
            ->where('id',$id)
            ->delete();
    }
    public function getSmestaji($oblast){
        return DB::table($this->tabela)
            ->select('*','smestaj.naziv as nazivSmestaja','oblast.naziv as nazivOblasti','tipsmestaja.naziv as nazivTipa','smestaj.id as smestajId','drzave.naziv as nazivDrzave','kontinenti.naziv as nazivKontinenta')
            ->join('oblast','oblast.id','=','smestaj.oblast_id')
            ->join('tipsmestaja','tipsmestaja.id','=','smestaj.tip_id')
            ->join('slikesmestaja','slikesmestaja.smestaj_id','=','smestaj.id')
            ->join('drzave','drzave.id','=','oblast.drzava_id')
            ->join('kontinenti','kontinenti.id','=','drzave.kontinent_id')
            ->where([
                'glavna'=>1,
                'oblast.id'=>$oblast
            ])
            ->paginate(5);
    }
    public function getOneWithPhotos($id){
        return DB::table($this->tabela)
            ->select('*','smestaj.naziv as nazivSmestaja','oblast.naziv as nazivOblasti','oblast.id as oblastId','tipsmestaja.naziv as nazivTipa','smestaj.id as smestajId','drzave.naziv as nazivDrzave','kontinenti.naziv as nazivKontinenta')
            ->join('oblast','oblast.id','=','smestaj.oblast_id')
            ->join('tipsmestaja','tipsmestaja.id','=','smestaj.tip_id')
            ->join('slikesmestaja','slikesmestaja.smestaj_id','=','smestaj.id')
            ->join('drzave','drzave.id','=','oblast.drzava_id')
            ->join('kontinenti','kontinenti.id','=','drzave.kontinent_id')
            ->where('smestaj.id',$id)
            ->first();
    }
    public function setTop($id){

        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'top'=>1
            ]);
    }
    public function unsetTop($id){

        return DB::table($this->tabela)
            ->where('id',$id)
            ->update([
                'top'=>0
            ]);
    }
    public function getHome(){
        return DB::table($this->tabela)
            ->select('*', 'smestaj.naziv as nazivSmestaja', 'oblast.naziv as nazivOblasti', 'tipsmestaja.naziv as nazivTipa', 'smestaj.id as smestajId')
            ->join('oblast', 'oblast.id', '=', 'smestaj.oblast_id')
            ->join('tipsmestaja', 'tipsmestaja.id', '=', 'smestaj.tip_id')
            ->join('slikesmestaja', 'slikesmestaja.smestaj_id', '=', 'smestaj.id')
            ->join('drzave', 'drzave.id', '=', 'oblast.drzava_id')
            ->join('kontinenti', 'kontinenti.id', '=', 'drzave.kontinent_id')
            ->where('slikesmestaja.glavna', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

}