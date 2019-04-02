<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 2/26/2018
 * Time: 8:47 PM
 */

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RegistracijaController extends Controller {
    private $data=[];
    public function login(Request $request){
        $user=new User();
        $email=addslashes($request->get('email'));
        $lozinka=addslashes($request->get('password'));
        $user->email=$email;
        $user->lozinka=$lozinka;
        $logovanje=$user->login();
        $this->data['user']=$logovanje;
        if(!empty($logovanje)) {
            $request->session()->push('user',$logovanje);
            if($request->session()->get('user')[0]->naziv=='admin')
                return redirect('/admin');
            else
                return redirect('/');
        }
        else
            return redirect()->back()->with('error','Pogresno uneti parametri');
    }
    public function registracija(Request $request){
        $rules=[
            'ime'=>'regex:/^[A-Z][a-z]{2,15}$/',
            'prezime'=>'regex:/^[A-Z][a-z]{3,15}$/',
            'email'=>'email',
            'password'=>'required',
            'slika'=>'required|mimes:jpg,jpeg,png'
        ];
        $poruke=[
            'required'=>'Polje :attribute je obavezno',
            'email'=>'Polje :attribute nije u pravilnom formatu',
            'regex'=>'Polje :attribute nije u pravilnom formatu',
            'mimes'=>'Dozvoljeni formati su: :values'
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
        $user->provera();
        $this->data['user']=$user->provera();
        if(!empty($this->data['user']))
        {
            return redirect()->back()->with('error','Korisnik sa tom email adresom vec postoji!');
        }
        else {
            try{
                File::move($tmp,$odrediste);
                $user->slika='users/'.$imeSlike;
                $user->register();
                return redirect()->back()->with('success', 'Uspesno ste registrovani, mozete se ulogovati!');
            } catch (\Illuminate\Database\QueryException $greska) {
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom unosa u bazu');
            } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $greska){
                \Log::error($greska);
                return redirect()->back()->with('error', 'Greska prilikom dodavanja slike');
            }
        }
    }
    public function logout(){
        session()->forget('user');
        session()->flush();
        return redirect('/');
    }
}