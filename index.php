<?php

use App\Collection;

require_once __DIR__ . "/vendor/autoload.php";

$c = new Collection([]);
$c->add([ "age" => 22 , "ville" => "Paris" ]);
$c->add([ "age" => 24 , "ville" => "Lyon" ]);
$c->add([ "age" => 24 , "ville" => "Lille" ]);

/* $c["Pierre"] = [ "age" => 24 , "ville" => "Lille" ];
$c["Charly"] = [ "age" => 24 , "ville" => "Lille" ]; */


/* $c->set("Julien" , [ "age" => 24 , "ville" => "Lille" ]); */

dump($c->liste("ville", "age")->all());
dump($c->extract("ville")->max());
dump($c->all());
dump($c->get("0.ville"));
dump($c->get("0")->get("ville"));


$c2 = new Collection();
$c2["Pierre"] = [ "age" => 24 , "ville" => "Lille" ];
$c2["Charly"] = [ "age" => 24 , "ville" => "Lille" ];
$c2->set("Zorro" , [ "age" => 24 , "ville" => "Lyon" ]);

dump($c2->get("Pierre"));
dump($c2->get("Pierre.age"));
dump($c2->get("Zorro.ville"));