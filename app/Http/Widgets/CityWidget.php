<?php

namespace App\Http\Widgets;

use Orchid\Platform\Widget\Widget;

class CityWidget extends Widget {

    /**
     * @var null
     */
    public $query = null;

    /**
     * @var null
     */
    public $key = null;

    /**
     * @return mixed
     */
    public function handler(){
        $data = config('city.list');

        if(!is_null($this->query) || !is_null($this->key)){
            return collect($data)->filter(function ($item) {

                if($item['id'] == $this->key){
                    return true;
                }

                return false !== stristr($item['text'], $this->query);
            })->toArray();
        }

        return $data;
    }

}
