<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animal = ['ular', 'naga', 'dino'];



    public function index(){

        $no = 1;
    foreach ($this->animal as $hewan) {echo $no++.".$hewan <br>";}
    }

    public function store(Request $request){
        array_push($this->animal, $request->nama);
        return $this->index();
    }

    public function update(Request $request, $id){
        $this->animal[$id] = $request->nama;
        return $this->index();
    }

    public function destroy($id){
        array_splice($this->animal,$id, 1);
        return $this->index();
    }
}

