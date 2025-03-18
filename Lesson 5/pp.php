<?php

$dogs=array(
array("Chihuaua", "Mexico",20),
array("Husky","Siberi",15),
array("Anes","Kosove",70));

    /*echo $dogs [0][0]."Origjina". $dogs[0][1]. "Life Span". $dogs[0][2]."<br>";
    echo $dogs [1][0]."Origjina". $dogs[1][1]. "Life Span". $dogs[1][2]."<br>";
    echo $dogs [2][0]."Origjina". $dogs[2][1]. "Life Span". $dogs[2][2]."<br>";*/

for($row = 0; $row<3; $row++){

    echo "<p>Row number $row </p>";
    echo"<ul>";

    for($col=0; $col<3; $col++){
        echo "<li>" .$dogs[$row][$col]."</li>";
    };

    echo "</ul>";
}

for($i = 0;$i<3; $i++){
    echo $i ."<br>";
    for($j = 0;$j<3; $j++){
        echo $j. "numru brenda elementit <br>";
    }
}




?>