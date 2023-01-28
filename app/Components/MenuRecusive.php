<?php
namespace App\Components;
use App\Menu;
class MenuRecusive{
    private $html;
    public function __construct(){
        $this->html ='';
    }
    public function menuRecusiveAdd($parntId =0, $subMark = ''){
        $data = Menu::where('parent_id',$parntId)->get();
        foreach ($data as $dataItem){
            $this->html .='<option value= ' .$dataItem->id .'>' . $subMark . $dataItem->name .'</option>';
            $this->menuRecusiveAdd($dataItem -> id , $subMark .  '--');
        }
        return $this->html;
    }
}
