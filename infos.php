<?php

use App\DeriveCollection;

require_once __DIR__ . "/vendor/autoload.php";

$a = [
    ["nom" => "Alain" , "age" => 22 ,"ville" => "Paris"  ],
    ["nom" => "Céline" , "age" => 24 ,"ville" => "Lyon"  ],
    ["nom" => "Zorro" , "age" => 22 ,"ville" => "Paris"  ],
    ["nom" => "pierre" , "age" => 21 ,"ville" => "Lille"  ],
];

$collection = new DeriveCollection($a);

$collection->add(["nom" => "Alain" , "age" => 22 ,"ville" => "Marseille"  ]);
$collection->add(["nom" => "Alain" , "age" => 22 ,"ville" => "Marseille"  ]);
$collection->add(["nom" => "Alain" , "age" => 22 ,"ville" => "Marseille"  ]);
$collection->add(["nom" => "Alain" , "age" => 22 ,"ville" => "Marseille"  ]);

$villes = $collection->unique("ville");

dd($villes);