<?php


namespace App\Http\Controllers;


use App\Models\Drzava;
use App\Models\Meni;
use App\Models\Oblast;
use App\Models\Odgovori;
use App\Models\Poslovnica;
use App\Models\Slider;
use App\Models\SlikeSmestaja;
use App\Models\Smestaj;
use App\Models\Top;
use App\Models\User;


class FrontController extends Controller
{
    private $data=[];

    public function __construct()
    {
        $menus=new Meni();
        $this->data['menus']=$menus->meni();
    }
    public function index(){
        $top=new Smestaj();
        $this->data['tops']=$top->getHome();
        $slider=new Slider();
        $this->data['sliders']=$slider->getAll();
        return view('pages.home',$this->data);
    }
    public function registracija(){
        return view('pages.registracija',$this->data);
    }
    public function drzave($kontinent){
        $drzave=new Drzava();
        $drzave->nazivKontinenta=$kontinent;
        $this->data['drzave']=$drzave->getByName();
        if(empty($this->data['drzave'][0]))
            return view('pages.izrada');
        else
            return view('pages.drzave',$this->data);
    }
    public function oblasti($kontinent,$drzava){
        $this->data['kontinent']=$kontinent;
        $oblasti=new Oblast();
        $oblasti->nazivDrzave=$drzava;
        $this->data['oblasti']=$oblasti->getByName();
        if(empty($this->data['oblasti'][0]))
            return view('pages.izrada');
        else
            return view('pages.oblasti',$this->data);
    }
    public function smestaji($oblast){
        $smestaji=new Smestaj();
        $this->data['smestaji']=$smestaji->getSmestaji($oblast);
        if(empty($this->data['smestaji'][0]))
            return view('pages.izrada');
        else
            return view('pages.smestaji',$this->data);
    }
    public function stranicenje($oblast){
        $smestaji=new Smestaj();
        $this->data['smestaji']=$smestaji->getSmestaji($oblast);
        if(empty($this->data['smestaji'][0]))
            return view('pages.smestajiAjax');
        else
            return view('pages.smestajiAjax',$this->data)->render();
    }
    public function smestaj($id){
        $smestaj = new Smestaj();
        $this->data['smestaj']=$smestaj->getOneWithPhotos($id);
        $slike=new SlikeSmestaja();
        $this->data['slike']=$slike->getAllById($id);
        return view('pages.smestaj',$this->data);
    }
    public function autor(){
        $anketa=new Odgovori();
        $this->data['anketa']=$anketa->getAnketa();
        if(session()->has('user')){
            $user=new User();
            $user->id=session()->get('user')[0]->userId;
            $this->data['user']=$user->getOne();
        }
        return view('pages.autor',$this->data);
    }
    public function kontakt(){
        $poslovnice=new Poslovnica();
        $this->data['poslovnice']=$poslovnice->getAll();
        return view('pages.kontakt',$this->data);
    }
    public function cenovnik($id){
        $headers = array(
            'Content-Type: application/pdf',
        );
        $smestaji=new Smestaj();
        $smestaj=$smestaji->getOne($id);
        return response()->download(public_path($smestaj->cenovnik), $smestaj->nazivSmestaja.'.pdf', $headers);
    }
    public function dokumentacija(){
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download(public_path('dokumentacija.pdf'), 'dokumentacija.pdf', $headers);
    }
    public function anketa($id){
        $odgovri=new Odgovori();
        $glasao=$odgovri->getOne($id);
        $vrednost=$glasao->vrednost+1;
        $odgovri->glasanje($id,$vrednost);
        $idAnkete=$glasao->pitanje_id;
        $user=new User();
        $user->id=session()->get('user')[0]->userId;
        $user->anketa($idAnkete);
        $odgovri->pitanje=$idAnkete;
        $this->data['odgovori']=$odgovri->getAnketa();
        return view('pages.glasanje',$this->data);
    }

}