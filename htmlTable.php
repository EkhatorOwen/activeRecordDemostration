<?php
class htmlTable
{
function makeTable($data)
{
echo '<table>';

    foreach ($data as $data)
    {
    echo "<tr>";

        foreach ($data as $column) {

        echo "<td>$column</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
}
?>