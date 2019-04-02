<?php

namespace App\Http\Controllers;

use App\Models\Drzava;
use App\Models\Oblast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminOblastController extends Controller
{
    private $data=[];

    public function show($id=null){
        $drzave=new Drzava();
        $this->data['drzave']=$drzave->getAll();
        $oblasti=new Oblast();
        $this->data['oblasti']=$oblasti->getAll();
        if($id!=null){
            $oblasti->id=$id;
            $this->data['oblast']=$oblasti->getOne();
        }
        return view('admin.oblast',$this->data);
    }
    public function add(Request $request)
    {
        $request->validate([
            'naziv' => 'required',
            'drzava' => 'required|not_in:0',
            'slika' => 'required|mimes:jpg,jpeg,png'
        ]);
        $oblast = new Oblast();
        $oblast->naziv = $request->get('naziv');
        $oblast->grad = $request->get('drzava');
        $slika = $request->file('slika');
        $ekstenzija = $slika->getClientOriginalExtension();
        $tmp = $slika->getPathname();
        $folder = 'oblasti/';
        $imeSlike = time() . '.' . $ekstenzija;
        $odrediste = public_path($folder) . $imeSlike;
        try{
            File::move($tmp, $odrediste);
            $oblast->slika = 'oblasti/' . $imeSlike;
            $oblast->insert();
            return redirect()->back()->with('success', 'Uspesno ste dodali oblast!');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
    public function edit(Request $request,$id)
    {
        $request->validate([
            'naziv' => 'required',
            'drzava' => 'required|not_in:0',
            'slika' => 'mimes:jpg,jpeg,png'
        ]);
        $oblast = new Oblast();
        $oblast->naziv = $request->get('naziv');
        $oblast->grad = $request->get('drzava');
        $oblast->id=$id;
        if(empty($request->file('slika')))
        {
            try{
                $oblast->update();
                return redirect()->back()->with('success','Uspesno ste izmenili oblast!');
            }catch (\Exception $greska) {
                \Log::error($greska);
                return redirect()->back()->with('error', "Greska".$greska);
            }
        }
        else{
            $zaBrisanje=$oblast->getOne();
            File::delete($zaBrisanje->slika);
            $slika=$request->file('slika');
            $ekstenzija=$slika->getClientOriginalExtension();
            $tmp=$slika->getPathname();
            $folder='oblasti/';
            $imeSlike=time().'.'.$ekstenzija;
            $odrediste=public_path($folder).$imeSlike;
            try{
                File::move($tmp,$odrediste);
                $oblast->slika='oblasti/'.$imeSlike;
                $oblast->updateSaSlikom();
                return redirect()->back()->with('success', 'Uspesno ste izmenili oblast!');
            } catch (\Illuminate\Database\QueryException $greska) {
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom unosa u bazu');
            } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $greska){
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom dodavanja slike');
            }
        }
    }
    public function delete($id){
        $oblast=new Oblast();
        $oblast->id=$id;
        $slika=$oblast->getOne();
        try{
            File::delete($slika->slika);
            $oblast->delete();
            return redirect()->back()->with('success','Uspesno izbrisano iz baze');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
}
