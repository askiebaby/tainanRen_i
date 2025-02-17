<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Counter;

class IndexController extends Controller
{
    public function show()
    {
        $sumup = DB::select('select SUM(book1) as b1, SUM(book2) as b2, SUM(book3) as b3, SUM(veg) as veg  from counters')[0];
        return view('welcome', ['book1' => $sumup->b1,'book2'=>$sumup->b2,'book3'=>$sumup->b3,'veg'=>$sumup->veg]);
    }

    public function store(Request $request)
    {
        DB::insert('insert into counters (name,tan,book1,book2,book3,veg,created_at) 
                values (?,?,?,?,?,?,DATE_ADD(NOW(), INTERVAL 8 HOUR))',[$request['name'],$request['tan'],(int)$request['b1'],(int)$request['b2'],(int)$request['b3'],(int)$request['veg']]);
        return ['success' => 'successfully done'];//redirect('/');
    } 
    
    
}
