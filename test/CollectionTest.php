<?php 

namespace Test ;

use App\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    // php vendor/bin/phpunit test/CollectionTest.php

    private function jeuDonnee1()
    {
        $c = new Collection();
        $c->add([ "age" => 22 , "ville" => "Paris" ]);
        $c->add([ "age" => 26 , "ville" => "Lyon" ]);
        $c->add([ "age" => 24 , "ville" => "Lille" ]);
        return $c ;
    }

    private function jeuDonnee2()
    {
        $c = new Collection();
        $c["Pierre"] = [ "age" => 24 , "ville" => "Paris" ];
        $c["Charly"] = [ "age" => 22 , "ville" => "Lille" ];
        $c->set("Zorro" , [ "age" => 2 , "ville" => "Lyon" ]);
        return $c ;
    }


    public function testVerifGetSyntaxeDonnee1()
    {
        $c = $this->jeuDonnee1();
        // syntaxe 1
        $result = $c->get("0")->get("ville");
        $this->assertEquals($result , "Paris");
        // syntaxe 2
        $result = $c->get("0.ville");
        $this->assertEquals($result , "Paris");
    }

    public function testVerifGetSyntaxeDonnee2()
    {
        $c = $this->jeuDonnee2();
        
        $this->assertIsArray($c->get("Pierre")->all());
        $this->assertEquals($c->get("Pierre.age"), 24);
        $this->assertEquals($c->get("Zorro.ville"), "Lyon");

    }



    public function testMaxSyntaxe1()
    {
        $c = $this->jeuDonnee1();
        $result = $c->extract("age")->max();
        $this->assertEquals($result , 26);
    }

    public function testMaxSyntaxe2()
    {
        $c = $this->jeuDonnee1();
        $result = $c->max("age");
        $this->assertEquals($result , 26);
    }

    public function testJoin()
    {
        $c = $this->jeuDonnee1();
        $result = $c->extract("age")->join(" ,");
        $this->assertEquals($result , "22 ,26 ,24");
    }

}