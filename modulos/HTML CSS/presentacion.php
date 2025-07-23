<?php
function mostrarTeatro($teatro) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th></th>";
    for ($i = 1; $i <= count($teatro[0]); $i++) {
        echo "<th>$i</th>";
    }
    echo "</tr>";

    for ($i = 0; $i < count($teatro); $i++) {
        echo "<tr><th>" . ($i + 1) . "</th>";
        for ($j = 0; $j < count($teatro[$i]); $j++) {
            $color = "";
            if ($teatro[$i][$j] == "X") $color = "red";
            elseif ($teatro[$i][$j] == "R") $color = "orange";
            else $color = "green";

            echo "<td style='background-color:$color;text-align:center;'>" . $teatro[$i][$j] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table><br>";
}
