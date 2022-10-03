<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
// use App\Models\User;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Landlord;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Database;



class SSOController extends Controller
{
    public function getLogin(Request $request)
    {

        $request->session()->put("state", $state =  Str::random(40));
        $query = http_build_query([
            "client_id" => config("auth.client_id"),
            "redirect_uri" => config("auth.callback") ,
            "response_type" => "code",
            "scope" => config("auth.scopes"),
            "state" => $state
        ]);
        return redirect(config("auth.sso_host") .  "/oauth/authorize?" . $query);
    }

    public function getCallback(Request $request)
    {
        $state = $request->session()->pull("state");

        throw_unless(strlen($state) > 0 && $state == $request->state, InvalidArgumentException::class);

        $response = Http::asForm()->post(
            config("auth.sso_host") .  "/oauth/token",
            [
                "grant_type" => "authorization_code",
                "client_id" => config("auth.client_id"),
                "client_secret" => config("auth.client_secret"),
                "redirect_uri" => config("auth.callback") ,
                "code" => $request->code
            ]
        );
        $request->session()->put($response->json());
        return redirect(route("sso.connect"));
    }
    

    public function connectUser(Request $request)
    {

        $access_token = $request->session()->get("access_token");
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $access_token
        ])->get(config("auth.sso_host") .  "/api/user");
        $userArray = $response->json();


// dd($userArray);
        try {
            $email = $userArray['email'];
        } catch (\Throwable $th) {
            return redirect("/")->withError("Failed to get login information! Try again.");
        }


        if($userArray['database'] === null) {

            $currentAdmin = Landlord::where('email', '=', $userArray['email'])->first();
            // dd($currentAdmin);
            if($currentAdmin === null) {

                $database = Database::where('status', '=', 'free')->first();


                Config::set("database.connections.tenant.database", $database->database_name);
                // dd(User::all());
                $admin = User::create([
                    'name' => $userArray['name'],
                    'login' => $userArray['name'],
                    'email' =>  $userArray['email'],
                    'profil' =>  "admin",
                    'name_society' =>  $userArray['name_society'],
                    'database' =>  $database->database_name,
                ]);

                Landlord::create([
                    'name' => $userArray['name'],
                    'email' =>  $userArray['email'],
                    'name_society' =>  $userArray['name_society'],
                    'database' =>  $database->database_name,  // Database who has choiced
                ]);
                

                Auth::login($admin);
                
                session(['database' => $database->database_name]);

                $busyDatabase = Database::where("database_name", $database->database_name)->first();
                $busyDatabase->status = 'busy';
                $busyDatabase->save();

            }else {

                Config::set("database.connections.tenant.database", $currentAdmin['database']);  
                $checkAdmin = User::where("email", $currentAdmin['email'])->first();
                Auth::login($checkAdmin);
                session(['database' => $currentAdmin['database']]);
                    
            }

            return redirect(route('home'));

        }else {

            $database = Landlord::where('name_society', '=', $userArray['name_society'])->first();

            if($database === null) {

                return redirect('http://127.0.0.1:8000/home')->with('notCreateNow',"Vous ne pouviez pas encore créer de compte. Veuillez conatcter votre administrateur pour plus d'information");

            }else {

                $database = Landlord::where('name_society', '=', $userArray['name_society'])->first();
                Config::set("database.connections.tenant.database", $database->database);
                
                // dd($database->database);

                $currentClient = User::where('email', '=', $userArray['email'])->first();


                if($currentClient === null) {
                    
                    $client = User::create([
                        'name' => $userArray['name'],
                        'login' => $userArray['name'],
                        'email' =>  $userArray['email'],
                        'profil' =>  "user",
                        'name_society' =>  $userArray['name_society'],
                        'database' =>  $database->database,
                    ]);
                    // dd(1);

                    Auth::login($client);
                    session(['database' => $database->database]);
                }else {
                    Auth::login($currentClient);
                    session(['database' => $database->database]);
                }
            }

            return redirect(route('home'));
        }

    }
}

 
