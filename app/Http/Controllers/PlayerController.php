<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PlayerController extends Controller
{
  
    public function index(){
        $players = Http::get('https://www.easports.com/fifa/ultimate-team/api/fut/item/page=4');
        foreach($players['items'] as $player){
            $crear = DB::table('players')->where('name', $player['name'])->exists();
            if($crear == false){ 
                Player::create([
                'name'=> $player['name'],
                'position'=> $player['position'],
                'nation'=> $player['nation']['name'],
                'team'=> $player['club']['name'],
                ]);
            }
    }
        return view('welcome');
    }
    
    public function list(Request $request){
        $player_query= Player::query();
        if($sort = $request->input('sort')){
            $player_query->orderBy('name', $sort);
        }
        return $player_query->get();
       
    }

    public function search($team = null){
        return $team?Player::where("team", "like", "%". $team ."%")->get():Player::all();
    }



}
