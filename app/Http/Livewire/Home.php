<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Comfile;
use App\User;


class Home extends Component
{
    public $search = "";
    public $filtreUser = "";
    public $filtreType = "";
    
    public function render()
    {

        $comfileQuery = Comfile::query();
        
        if($this->search != "") {
            $comfileQuery->where("enterprise", "LIKE", "%". $this->search ."%");
        }

        if($this->filtreUser != "") {
            $comfileQuery->where("user", $this->filtreUser);
        }
        if($this->filtreUser == "all") {
            $comfileQuery = Comfile::query();
        }

        if($this->filtreType != "") {
            $comfileQuery->where("status", $this->filtreType);
        }
        if($this->filtreType == "all") {
            $comfileQuery = Comfile::query();
        }

        if(Auth::user()->profil == "user") {
            $comfileQuery->where("user", Auth::user()->name);
        }
        
        $comfiles = [
            "comfiles" => $comfileQuery->latest()->paginate(25),
            "users" => User::all(),
        ];
        return view('livewire.home', $comfiles)
                ->extends("layouts.app")
                ->section("content");
    }
}
