<?php

namespace App\Http\Controllers;

use App\Models\Meni;
use App\Models\Rezervacija;
use Illuminate\Http\Request;
use Mockery\Exception;

class RezervacijaController extends Controller
{
    private $data=[];

    public function insert(Request $request,$id){
        $request->validate([
            'soba'=>'required',
            'datum'=>'required'
        ]);
        $rezervacija=new Rezervacija();
        $rezervacija->smestaj=$id;
        $rezervacija->user=session()->get('user')[0]->userId;
        $rezervacija->datum=time();
        $rezervacija->datumPolaska=$request->get('datum');
        $rezervacija->tip=$request->get('soba');
        if(empty($request->get('napomena'))){
            $rezervacija->napomena='Bez napomene';
        }
        else
            $rezervacija->napomena=$request->get('napomena');
        try{
            $rezervacija->insert();
            return redirect()->back()->with('success','Uspesno rezervisano!');
        }catch (\Illuminate\Database\QueryException $exception){
            \Log::error($exception);
            return redirect()->back()->with('error','Greska prikikom unosa u bazu!'.$exception);
        }

    }
    public function showForUser(){
        if(!session()->has('user')){
            return redirect('/');
        }
        $menus=new Meni();
        $this->data['menus']=$menus->meni();
        $rezervacije=new Rezervacija();
        $this->data['rezervacije']=$rezervacije->getAllForUser(session()->get('user')[0]->userId);
        return view('pages.rezervacije',$this->data);
    }
    public function delete($id){
        $rezervacije=new Rezervacija();
        try{
            $rezervacije->delete($id);
            return redirect()->back();

        }catch (\Illuminate\Database\QueryException $exception){
            \Log::error($exception);
            return redirect()->back()->with('error','Greska sa bazom!'.$exception);
        }
    }
    public function showAdmin(){
        $rezervacije=new Rezervacija();
        $this->data['rezervacije']=$rezervacije->getAll();
        return view('admin.rezervacije',$this->data);
    }
}
