<?php 

namespace App ;

use Doctrine\Common\Collections\ArrayCollection;

class DeriveCollection extends ArrayCollection{

    public function unique($key): array{
        $result = [];
        $elements = $this->getValues();
        foreach($elements as $e){
            $result[] = $e[$key];  
        }
        return array_unique($result);
    }

}