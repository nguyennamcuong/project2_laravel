<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Menu;
use Illuminate\Http\Request;
class MenuController extends Controller
{
    private $menuRecusive;
    private $menu;
    public function __construct(MenuRecusive $menuRecusive, Menu $menu ){
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }
    public function index(){
        $menus = $this->menu->paginate(5);
        return view('menus.index',compact('menus'));
    }
    public function create(){
        $optionSelect = $this->menuRecusive->menuRecusiveAdd();
        return view('menus.add',compact('optionSelect'));
    }
    public function store(Request $request){
        $this->menu->create([
            'name' => $request->name,
            'parent_id'=>$request->parent_id
        ]);
        return redirect()->route('menus.index');
    }
}
