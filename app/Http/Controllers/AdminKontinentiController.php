<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontinenti;

class AdminKontinentiController extends Controller
{
    private $data=[];
    public function show($id=null){
        $kontinenti=new Kontinenti();
        $this->data['kontinenti']=$kontinenti->getAll();
        if($id!=null){
            $kontinenti->id=$id;
            $this->data['kontinent']=$kontinenti->getOne();
        }
        return view('admin.kontinenti',$this->data);
    }
    public function add(Request $request){
        $request->validate([
            'naziv'=>'required'
        ]);
        $kontinenti=new Kontinenti();
        $kontinenti->naziv=$request->get('naziv');
        $kontinenti->made_id = session()->get('user')[0]->userId;
        $kontinenti->made_date=time();
        try{
            $kontinenti->add();
            return redirect()->back()->with('success','Uspesno uneto u bazu');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }
    public function delete($id){
        $kontinenti=new Kontinenti();
        $kontinenti->id=$id;
        try{
            $kontinenti->delete();
            return redirect()->back()->with('success','Uspesno izbrisano iz baze');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
    public function edit(Request $request,$id){
        $kontinenti=new Kontinenti();
        $kontinenti->id=$id;
        $kontinenti->naziv=$request->get('naziv');
        $kontinenti->edit_id=session()->get('user')[0]->userId;
        $kontinenti->edit_date=time();
        try{
            $kontinenti->edit();
            return redirect()->back()->with('success','Uspesno izmenjeno');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }

}
