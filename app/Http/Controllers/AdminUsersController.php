<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 2/26/2018
 * Time: 9:24 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Uloge;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller{
    private $data=[];
    public function index(){
        return view('pages.admin');
    }
    public function Users($id=null){
        $users=new User();
        $this->data['users']=$users->getAll();
        $uloge=new Uloge();
        $this->data['uloge']=$uloge->getAll();
        if($id!=null){
            $user=new User();
            $user->id=$id;
            $this->data['user']=$user->getOne();
            return view('admin.korisnici',$this->data);
        }
        return view('admin.korisnici',$this->data);
    }
    public function deleteUsers($id){
        $user=new User();
        $user->id=$id;

        $korisnik=$user->getOne();
        try{
            File::delete($korisnik->slika);
            $user->delete();
            return redirect()->back()->with('success','Uspesno ste izbrisali korisnika!');
        }catch (\Exception $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', "Greska".$greska);
        }


    }
    public function storeUsers(Request $request){
        $rules=[
            'ime'=>'required|regex:/^[A-Z][a-z]{2,15}$/',
            'prezime'=>'required|regex:/^[A-Z][a-z]{3,15}$/',
            'email'=>'email|unique:user',
            'password'=>'required',
            'slika'=>'required|mimes:jpg,jpeg,png',
            'uloga'=>'required|not_in:0'
        ];
        $poruke=[
            'required'=>'Polje :attribute je obavezno',
            'email'=>'Polje :attribute nije u pravilnom formatu',
            'regex'=>'Polje :attribute nije u pravilnom formatu',
            'mimes'=>'Dozvoljeni formati su: :values',
            'unique'=>':attribute je zauzet',
            'not_in'=>'Izaberite ulogu!'
        ];
        $request->validate($rules,$poruke);
        $slika=$request->file('slika');
        $ekstenzija=$slika->getClientOriginalExtension();
        $tmp=$slika->getPathname();
        $folder='users/';
        $imeSlike=time().'.'.$ekstenzija;
        $odrediste=public_path($folder).$imeSlike;

        $user=new User();
        $user->ime=$request->get('ime');
        $user->prezime=$request->get('prezime');
        $user->email=$request->get('email');
        $user->lozinka=$request->get('password');
        $user->uloga=$request->get('uloga');

            try{
                File::move($tmp,$odrediste);
                $user->slika='users/'.$imeSlike;
                $user->registerByAdmin();
                return redirect()->back()->with('success', 'Uspesno ste registrovani, mozete se ulogovati!');
            } catch (\Illuminate\Database\QueryException $greska) {
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom unosa u bazu');
            } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $greska){
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom dodavanja slike');
            }


    }
    public function updateUsers(Request $request, $id){
        $rules=[
            'ime'=>'regex:/^[A-Z][a-z]{2,15}$/',
            'prezime'=>'regex:/^[A-Z][a-z]{3,15}$/',
            'email'=>'email',
            'password'=>'required',
            'slika'=>'mimes:jpg,jpeg,png',
            'uloga'=>'required|not_in:0'
        ];
        $poruke=[
            'required'=>'Polje :attribute je obavezno',
            'email'=>'Polje :attribute nije u pravilnom formatu',
            'regex'=>'Polje :attribute nije u pravilnom formatu',
            'mimes'=>'Dozvoljeni formati su: :values',
            'unique'=>':attribute je zauzet',
            'not_in'=>'Izaberite ulogu!'
        ];
        $request->validate($rules,$poruke);
        $user=new User();
        $user->id=$id;
        $user->ime=$request->get('ime');
        $user->prezime=$request->get('prezime');
        $user->email=$request->get('email');
        $user->lozinka=$request->get('password');
        $user->uloga=$request->get('uloga');
        if(empty($request->file('slika'))){
            $user->updateBezSlike();
            return redirect()->back()->with('success','Uspesno ste izmenili nalog!');
        }
        else{
            $korisnik=$user->getOne();
            File::delete($korisnik->slika);
            $slika=$request->file('slika');
            $ekstenzija=$slika->getClientOriginalExtension();
            $tmp=$slika->getPathname();
            $folder='users/';
            $imeSlike=time().'.'.$ekstenzija;
            $odrediste=public_path($folder).$imeSlike;
            try{
                File::move($tmp,$odrediste);
                $user->slika='users/'.$imeSlike;
                $user->updateSaSlikom();
                return redirect()->back()->with('success', 'Uspesno ste napravili nalog!');
            } catch (\Illuminate\Database\QueryException $greska) {
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom unosa u bazu');
            } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $greska){
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom dodavanja slike');
            }
        }
    }
}