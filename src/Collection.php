<?php 

namespace App ;

use ArrayAccess;
use ArrayIterator;
use Traversable;
use IteratorAggregate;

class Collection implements ArrayAccess , IteratorAggregate{

    public array $tableau = [];

    public function __construct( array|bool $tableau = false)
    {
        if($tableau){
            $this->tableau = $tableau ;
        }
    }

    public function all():array
    {
        return $this->tableau ;
    }

    public function get(string|int $key):mixed
    {
        $index = explode("." , $key);
        return $this->getValue($index , $this->tableau);
        
    }

    private function getValue(array $indexes , $values):mixed
    {
        $key = array_shift($indexes);

        if(!array_key_exists( $key, $values )){
            return null ;
        }

        if(empty($indexes)){
            if(is_array($values[$key])){
                return new self($values[$key]);
            }else {
                return $values[$key];
            }
        }else {
            return $this->getValue($indexes , $values[$key]);
        }
    }

    public function add ($value):void
    {
        $this->tableau[] = $value; 
    }

    public function set($key, $valeur):void
    {
        $this->tableau[$key] = $valeur ;
        //return new self($this->tableau);
    }

    public function has(string|int $key) :bool
    {
        return array_key_exists( $key, $this->tableau) ;
    }

    /**
     * savoir si une clé existe dans le tableau
     *
     * @param [type] $offset
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }
    
    /**
     * récupérer la valeur
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }
    
    public function offsetSet(mixed $offset , mixed $value): void
    {
        $this->set($offset , $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        if($this->has($offset)){
            unset($this->tableau[$offset]);
        }
    }

    /**
     * faire un foreach sur un objet
     *
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->tableau);
    }

    public function liste($key, $valeur):self
    {
        $result = [];
        foreach($this->tableau as $item){
            $result[$item[$key]] = $item[$valeur];
        }
        return  new self($result) ;
    }

    public function extract($key):self
    {
        $result = [];
        foreach($this->tableau as $item){
            $result[] = $item[$key];
        }
        return  new self($result) ;
    }

    public function join(string $glue): string
    {
        return implode($glue, $this->tableau);
    }

    public function max($key = false)
    {
        if($key){
            return $this->extract($key)->max();
        }
        return max($this->tableau);
    }

}