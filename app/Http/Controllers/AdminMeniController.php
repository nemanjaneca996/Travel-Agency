<?php

namespace App\Http\Controllers;

use App\Models\Meni;
use Illuminate\Http\Request;

class AdminMeniController extends Controller
{
    private $data=[];

    public function show($id=null){
        $meni=new Meni();
        if($id!=null){
            $meni->id=$id;
            $this->data['Meni']=$meni->getOne();
        }
        $this->data['meni']=$meni->getAll();
        return view('admin.meni',$this->data);
    }
    public function add(Request $request){
        $rules=([
            'naziv'=>'required',
            'adresa'=>'required'
        ]);
        $request->validate($rules);
        $meni=new Meni();
        $meni->naziv=$request->get('naziv');
        $meni->adresa=$request->get('adresa');
        $meni->roditelj=$request->get('roditelj');
        try{
            $meni->insert();
            return redirect()->back()->with('success','Uspesno uneto u bazu!');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }
    public function update(Request $request,$id){
        $rules=([
            'naziv'=>'required',
            'adresa'=>'required'
        ]);
        $request->validate($rules);
        $meni=new Meni();
        $meni->id=$id;
        $meni->naziv=$request->get('naziv');
        $meni->adresa=$request->get('adresa');
        $meni->roditelj=$request->get('roditelj');
        try{
            $meni->update();
            return redirect()->back()->with('success','Uspesno uneto u bazu!');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }
    public function delete($id){
        $meni=new Meni();
        $meni->id=$id;
        try{
            $meni->delete();
            return redirect()->back()->with('success','Uspesno obrisano iz baze!');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }
}
