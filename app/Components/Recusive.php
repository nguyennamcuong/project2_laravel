<?php
namespace App\Components;


class Recusive {

    private $data;
    private $htmlSelect = '';
    public function construct($data){
        $this->data = $data;
    }

  public function categoryRecusive($id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                $this->htmlSelect .= "<option>" . $text . $value['name'] . "</option>";
                $this->categoryRecusive($value['id'], $text.'->');
            }
        }
        return $this->htmlSelect;
    }
}
