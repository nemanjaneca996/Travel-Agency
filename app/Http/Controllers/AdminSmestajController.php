<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 3/7/2018
 * Time: 10:49 PM
 */

namespace App\Http\Controllers;


use App\Models\Oblast;
use App\Models\SlikeSmestaja;
use App\Models\Smestaj;
use App\Models\TipSmestaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class AdminSmestajController extends Controller
{
    private $data = [];

    public function show($id=null)
    {
        $smestaj = new Smestaj();
        $tip = new TipSmestaja();
        $oblast = new Oblast();
        $this->data['oblasti'] = $oblast->getAll();
        $this->data['tipovi'] = $tip->getAll();
        $this->data['smestaji'] = $smestaj->getAll();
        if($id!=null){
            $this->data['Smestaj']=$smestaj->getOne($id);
        }
        return view('admin.smestaj', $this->data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'naziv' => 'required',
            'brojzvezdica' => 'required',
            'opis' => 'required',
            'oblast' => 'required|not_in:0',
            'tip' => 'required|not_in:0',
            'slika' => 'required|mimes:jpg,jpeg,png',
            'cenovnik' => 'required|mimes:pdf'
        ]);
        $smestaj = new Smestaj();
        $smestaj->naziv = $request->get('naziv');
        $smestaj->tip = $request->get('tip');
        $smestaj->brojZvezdica = $request->get('brojzvezdica');
        $smestaj->opis = $request->get('opis');
        $smestaj->oblast = $request->get('oblast');
        $smestaj->made_id = session()->get('user')[0]->userId;
        $smestaj->made_date=time();
        $cenovnik = $request->file('cenovnik');
        $ekstenzija = $cenovnik->getClientOriginalExtension();
        $tmp = $cenovnik->getPathname();
        $folder = 'cenovnik/';
        $imeCenovnika = time() . '.' . $ekstenzija;
        $odrediste = public_path($folder) . $imeCenovnika;

        $slika = $request->file('slika');
        $ekstenzijaSlike = $slika->getClientOriginalExtension();
        $tmpSlike = $slika->getPathname();
        $folderSlike = 'smestaj/';
        $imeSlike=time().'.'.$ekstenzijaSlike;
        $odredisteSlike = public_path($folderSlike) . $imeSlike;
        try{
            File::move($tmp, $odrediste);
            File::move($tmpSlike, $odredisteSlike);
            $smestaj->cenovnik = 'cenovnik/' . $imeCenovnika;
            $slikaUnos=new SlikeSmestaja();
            $slikaUnos->url='smestaj/'.$imeSlike;
            $slikaUnos->alt=$imeSlike;
            $slikaUnos->glavna=1;
            $statement = DB::select("SHOW TABLE STATUS LIKE 'smestaj'");
            $nextId = $statement[0]->Auto_increment;
            $slikaUnos->smestaj=$nextId;
            $smestaj->insert();
            $slikaUnos->insert();
            return redirect()->back()->with('success','Uspesan unos');

        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
    public function edit(Request $request, $id){
        $request->validate([
            'naziv' => 'required',
            'brojzvezdica' => 'required',
            'opis' => 'required',
            'oblast' => 'required|not_in:0',
            'tip' => 'required|not_in:0',
            'slika' => 'mimes:jpg,jpeg,png',
            'cenovnik' => 'mimes:pdf'
        ]);
            $smestaj = new Smestaj();
            $smestaj->naziv = $request->get('naziv');
            $smestaj->tip = $request->get('tip');
            $smestaj->brojZvezdica = $request->get('brojzvezdica');
            $smestaj->opis = $request->get('opis');
            $smestaj->oblast = $request->get('oblast');
            $smestaj->edit_id = session()->get('user')[0]->userId;
            $smestaj->edit_date=time();
        if(!empty($request->file('slika'))){
            $slikaUnos=new SlikeSmestaja();
            $slikaBrisanje=$slikaUnos->getOne($id);
            File::delete($slikaBrisanje->url);

            $slika = $request->file('slika');
            $ekstenzijaSlike = $slika->getClientOriginalExtension();
            $tmpSlike = $slika->getPathname();
            $folderSlike = 'smestaj/';
            $imeSlike=time().'.'.$ekstenzijaSlike;
            $odredisteSlike = public_path($folderSlike) . $imeSlike;
            $premestanjeSlike = File::move($tmpSlike, $odredisteSlike);
                if($premestanjeSlike){
                    $slikaUnos->url='smestaj/'.$imeSlike;
                    $slikaUnos->alt=$imeSlike;
                    $slikaUnos->glavna=1;
                    $rez1=$slikaUnos->edit($id);
                    if(empty($request->file('cenovnik'))){
                        $rez2=$smestaj->editBez($id);
                    }
                    else{
                        $cenovnikBrisanje=$smestaj->getOne($id);
                        File::delete($cenovnikBrisanje->cenovnik);

                        $cenovnik = $request->file('cenovnik');
                        $ekstenzija = $cenovnik->getClientOriginalExtension();
                        $tmp = $cenovnik->getPathname();
                        $folder = 'cenovnik/';
                        $imeCenovnika = time() . '.' . $ekstenzija;
                        $odrediste = public_path($folder) . $imeCenovnika;
                        $premestanje = File::move($tmp, $odrediste);
                        if($premestanje){
                            $smestaj->cenovnik = 'cenovnik/' . $imeCenovnika;
                            $rez2=$smestaj->edit($id);
                        }
                        else{
                            \Log::error("GRESKA!!");
                            return redirect()->back()->with('error', "Greska");
                        }
                    }
                }
        }else{
            $rez1=1;
                if(empty($request->file('cenovnik'))){
                    $rez2=$smestaj->editBez($id);
                }
                else{
                    $cenovnikBrisanje=$smestaj->getOne($id);
                    File::delete($cenovnikBrisanje->cenovnik);

                    $cenovnik = $request->file('cenovnik');
                    $ekstenzija = $cenovnik->getClientOriginalExtension();
                    $tmp = $cenovnik->getPathname();
                    $folder = 'cenovnik/';
                    $imeCenovnika = time() . '.' . $ekstenzija;
                    $odrediste = public_path($folder) . $imeCenovnika;
                    $premestanje = File::move($tmp, $odrediste);
                    if($premestanje){
                        $smestaj->cenovnik = 'cenovnik/' . $imeCenovnika;
                        $rez2=$smestaj->edit($id);
                    }

                }

        }
        if($rez1 && $rez2){
            return redirect()->back()->with('success','Uspesan unos');
        }
         else {
             \Log::error("GRESKA!!");
            return redirect()->back()->with('error', 'Greska prilikom premestanja');
        }

    }
    public function delete($id){
        $smestaj=new Smestaj();
        $slika=new SlikeSmestaja();
        $cenDel=$smestaj->getOne($id);
        $slikaDel=$slika->getOne($id);
        try{
            File::delete($cenDel->cenovnik,$slikaDel->url);
            $smestaj->delete($id);
            $slika->delete($id);
            return redirect()->back()->with('success','Uspesno izbrisano iz baze!');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }

    }
    public function showSlike($id=null){
        $smestaj=new Smestaj();
        $slika=new SlikeSmestaja();
        $this->data['smestaji']=$smestaj->getAll();
        if($smestaj!=null){
            $this->data['slike']=$slika->getById($id);
            $this->data['smestaj']=$smestaj->getOne($id);
        }
        return view('admin.slike',$this->data);
    }
    public function addSlike(Request $request,$id){
        $request->validate([
            'slika'=>'required|mimes:jpg,jpeg,png'
        ]);

        $slika = $request->file('slika');
        $ekstenzijaSlike = $slika->getClientOriginalExtension();
        $tmpSlike = $slika->getPathname();
        $folderSlike = 'smestaj/';
        $imeSlike=time().'.'.$ekstenzijaSlike;
        $odredisteSlike = public_path($folderSlike) . $imeSlike;
        $premestanjeSlike = File::move($tmpSlike, $odredisteSlike);
        if($premestanjeSlike){
            $unos=new SlikeSmestaja();
            $unos->url='smestaj/'.$imeSlike;
            $unos->alt=$imeSlike;
            $unos->glavna=0;
            $unos->smestaj=$id;
            $rez=$unos->insert();
            if($rez){
                return redirect()->back()->with('success','Uspesno dodate slike!');
            }
            else{
                \Log::error("GRESKA!!");
                return redirect()->back()->with('error','Greska!');
            }
        }
    }
    public function deleteSlike(Request $request,$id){
        $cekirano=Input::get('slike');
        foreach ($cekirano as $c){
            File::delete($c);
        }
        $slika=new SlikeSmestaja();
        try{
            $slika->deleteMultiple($cekirano);
            return redirect()->back()->with('success','Uspesno bisanje!');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }
    }
    public function showTop(){
        $smestaj = new Smestaj();
        $this->data['smestaji']=$smestaj->getAll();
        return view('admin.top',$this->data);
    }

    public function addTop($id){
        $smestaj=new Smestaj();
        try{
            $smestaj->setTop($id);
            return redirect()->back()->with('success','Uspesno izbrisano');
        }catch (QueryException $exception){
            \Log::error($exception);
             return redirect()->back()->with('error','Greska'.$exception);
        }
    }
    public function deleteTop($id){
        $smestaj=new Smestaj();
        try{
            $smestaj->unsetTop($id);
            return redirect()->back()->with('success','Uspesno izbrisano');
        }catch (QueryException $exception){
            \Log::error($exception);
            return redirect()->back()->with('error','Greska'.$exception);
        }
    }
}
