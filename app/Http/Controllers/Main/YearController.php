<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Year;
use ProtoneMedia\Splade\SpladeTable;

class YearController extends Controller
{
    public function index()
    {
        return view('main.years.index', [
             'years' => SpladeTable::for(Year::class)
            ->withGlobalSearch(columns:['name'])
            ->column('name', canBeHidden:false, sortable:true)
            ->paginate(15),
        ]);

        
    }
}
