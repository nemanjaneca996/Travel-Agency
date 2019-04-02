<?php

namespace App\Http\Controllers;

use App\Models\Poslovnica;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminPoslovniceController extends Controller
{
    private $data=[];
    public function show($id=null){
        $poslovnice=new Poslovnica();
        $this->data['poslovnice']=$poslovnice->getAll();
        if($id!=null)
            $this->data['poslovnica']=$poslovnice->getOne($id);
        return view('admin.poslovnice',$this->data);
    }
    public function add(Request $request){
        $request->validate([
            'naslov'=>'required',
            'adresa'=>'required',
            'tel'=>'required',
            'fax'=>'required',
            'mob'=>'required',
            'email'=>'required|email'
        ]);
        $poslovnica=new Poslovnica();
        $poslovnica->naslov=$request->get('naslov');
        $poslovnica->adresa=$request->get('adresa');
        $poslovnica->tel=$request->get('tel');
        $poslovnica->fax=$request->get('fax');
        $poslovnica->mob=$request->get('mob');
        $poslovnica->email=$request->get('email');
        try{
            $poslovnica->insert();
            return redirect()->back()->with('success','Uspesno uneto u bazu!');
        }catch (QueryException $exception){
            \Log::error($exception);
            return redirect()->back()->with('error','Greska'.$exception);
        }
    }
    public function edit(Request $request,$id){
        $request->validate([
            'naslov'=>'required',
            'adresa'=>'required',
            'tel'=>'required',
            'fax'=>'required',
            'mob'=>'required',
            'email'=>'required|email'
        ]);
        $poslovnica=new Poslovnica();
        $poslovnica->naslov=$request->get('naslov');
        $poslovnica->adresa=$request->get('adresa');
        $poslovnica->tel=$request->get('tel');
        $poslovnica->fax=$request->get('fax');
        $poslovnica->mob=$request->get('mob');
        $poslovnica->email=$request->get('email');
        try{
            $poslovnica->edit($id);
            return redirect()->back()->with('success','Uspesno uneto u bazu!');
        }catch (QueryException $exception){
            \Log::error($exception);
            return redirect()->back()->with('error','Greska'.$exception);
        }
    }
    public function delete($id=null){
        $poslovnice=new Poslovnica();
        try{
            $poslovnice->delete($id);
            return redirect()->back()->with('success','Uspesno obrisano!');
        }catch (QueryException $exception){
            \Log::error($exception);
            return redirect()->back()->with('error','Greska'.$exception);
        }
    }
}
