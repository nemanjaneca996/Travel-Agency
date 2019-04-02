<?php

namespace App\Http\Controllers;

use App\Models\Odgovori;
use App\Models\Pitanja;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Psy\Exception\Exception;

class AdminAnketaController extends Controller
{
    private $data=[];
    public function showPitanja($id=null){
        $pitanja=new Pitanja();
        $this->data['pitanja']=$pitanja->getAll();
        if($id!=null){
            $this->data['pitanje']=$pitanja->getOne($id);
        }
        return view('admin.pitanja',$this->data);
    }
    public function addPitanja(Request $request){
        $request->validate([
            'naziv'=>'required'
        ]);
        $pitanja=new Pitanja();
        $pitanja->pitanje=$request->get('naziv');
        if(empty($request->get('aktivnost'))){
            $pitanja->aktivno=0;
        }
        else
            $pitanja->aktivno=1;
        try{
            $pitanja->insert();
            return redirect()->back()->with('success','Uspesno uneto u bazu');
        }catch (QueryException $exception){
            return redirect()->back()->with('error','Greska'.$exception);
        }

    }
    public function editPitanja(Request $request,$id){
        $request->validate([
            'naziv'=>'required'
        ]);
        $pitanja=new Pitanja();
        $pitanja->pitanje=$request->get('naziv');
        if(empty($request->get('aktivnost'))){
            $pitanja->aktivno=0;
        }
        else
            $pitanja->aktivno=1;
        try{
            $pitanja->update($id);
            return redirect()->back()->with('success','Uspesno uneto u bazu');
        }catch (QueryException $exception){
            return redirect()->back()->with('error','Greska'.$exception);
        }

    }
    public function deletePitanja($id){
        $pitanje=new Pitanja();
        try{
            $pitanje->delete($id);
            return redirect()->back()->with('success','Uspesno izbrisano');
        }catch (QueryException $exception){
            return redirect()->back()->with('error','Greska'.$exception);
        }
    }
    public function showOdgovori($id=null){
        $odgovori=new Odgovori();
        $this->data['odgovori']=$odgovori->getAll();
        $pitanja=new Pitanja();
        $this->data['pitanja']=$pitanja->getAll();
        if($id!=null){
            $this->data['odgovor']=$odgovori->getOne($id);
        }
        return view('admin.odgovori',$this->data);
    }
    public function addOdgovor(Request $request){
        $request->validate([
            'naziv'=>'required',
            'pitanje'=>'required|not_in:0'
        ]);
        $odgovor=new Odgovori();
        $odgovor->odgovor=$request->get('naziv');
        $odgovor->pitanje=$request->get('pitanje');
        try{
            $odgovor->insert();
            return redirect()->back()->with('success','Uspesno uneto u bazu');
        }catch (QueryException $exception){
            return redirect()->back()->with('error','Greska'.$exception);
        }

    }
    public function editOdgovor(Request $request,$id){
        $request->validate([
            'naziv'=>'required',
            'pitanje'=>'required|not_in:0'
        ]);
        $odgovor=new Odgovori();
        $odgovor->odgovor=$request->get('naziv');
        $odgovor->pitanje=$request->get('pitanje');
        try{
            $odgovor->update($id);
            return redirect()->back()->with('success','Uspesno uneto u bazu');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
    public function deleteOdgovor($id){
        $odgovor=new Odgovori();
        try{
            $odgovor->delete($id);
            return redirect()->back()->with('success','Uspesno izbrisano');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }

}
