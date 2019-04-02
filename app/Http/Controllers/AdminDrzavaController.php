<?php

namespace App\Http\Controllers;

use App\Models\Drzava;
use App\Models\Kontinenti;
use Illuminate\Http\Request;

class AdminDrzavaController extends Controller
{
    private $data=[];
    public function show($id=null){
        $drzave=new Drzava();
        $kontinenti=new Kontinenti();
        $this->data['kontinenti']=$kontinenti->getAll();
        $this->data['zemlje']=$drzave->getAll();
        if($id!=null){
            $drzave->id=$id;
            $this->data['zemlja']=$drzave->getOne();
        }
        return view('admin.drzave',$this->data);
    }
    public function add(Request $request){
        $request->validate([
            'naziv'=>'required',
            'kontinent'=>'not_in:0|required'
        ]);
        $drzava=new Drzava();
        $drzava->naziv=$request->get('naziv');
        $drzava->kontinent=$request->get('kontinent');
        try{
            $drzava->add();
            return redirect()->back()->with('success','Uspesno uneto u bazu');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }
    public function delete($id){
        $drzave=new Drzava();
        $drzave->id=$id;
        try{
            $drzave->delete();
            return redirect()->back()->with('success','Uspesno izbrisano iz baze');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
    public function edit(Request $request,$id){
        $drazve=new Drzava();
        $drazve->id=$id;
        $drazve->naziv=$request->get('naziv');
        $drazve->kontinent=$request->get('kontinent');
        try{
            $drazve->edit();
            return redirect()->back()->with('success','Uspesno izmenjeno');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
}
