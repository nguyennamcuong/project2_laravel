<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category){
        $this->category = $category;
    }

    public function create(){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive();
        return view('category.add',compact('htmlOption'));
    }


    public  function  index(){
        $categories = $this->category->latest()->paginate(5);
        return view('category.index',compact('categories'));
    }

    public function store(Request $request){
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)

        ]);
        return redirect()->route('categories.index');
    }
    public function edit($id){

    }

    public function delete($id){

    }
}
