<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminSliderController extends Controller
{
    private $data = [];

    public function show()
    {
        $slider = new Slider();
        $this->data['slike'] = $slider->getAll();
        return view('admin.slider', $this->data);
    }

    public function store(Request $request)
    {
        $rules = [
            'alt' => 'required',
            'slika' => 'required|mimes:jpg,jpeg'
        ];
        $request->validate($rules);
        $slika = $request->file('slika');
        $ekstenzija = $slika->getClientOriginalExtension();
        $tmp = $slika->getPathname();
        $folder = 'slider/';
        $imeSlike = time() . '.' . $ekstenzija;
        $odrediste = public_path($folder) . $imeSlike;

        $slider = new Slider();
        $slider->alt = $request->get('alt');
        $slider->made_id = session()->get('user')[0]->userId;
        $slider->made_date=time();
        try {
            File::move($tmp, $odrediste);
            $slider->url = 'slider/' . $imeSlike;
            $slider->add();
            return redirect()->back()->with('success', 'Uspesno ste dodali sliku!');
        } catch (\Illuminate\Database\QueryException $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', 'Greska prilikom unosa u bazu');
        } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', 'Greska prilikom dodavanja slike');
        }
    }

    public function delete($id)
    {
        $slider = new Slider();
        $slider->id = $id;

        $brisanje = $slider->getOne();
        File::delete($brisanje->url);
        try{
            $slider->delete();
            return redirect()->back()->with('success', 'Uspesno ste obrisali sliku!');
        }catch (\Illuminate\Database\QueryException $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', 'Greska prilikom birsanja iz baze');
        } catch (\Symfony\Component\HttpFoundation\File\Exception\FileException $greska) {
            \Log::error($greska);
            return redirect()->back()->with('error', 'Greska prilikom brisanja slike');
        }

    }
}
