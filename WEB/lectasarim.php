echo "
<div class=\"ui grid\">
<div class=\"ui two column grid\">
<div class=\"four column row\">
<div class=\"column\">&nbsp;&nbsp;User Lecturer</div>
<div class=\"column\"> </div>
<div class=\"column\"> </div>
<div class=\"column\"><div align='right'> <button class=\"ui grey basic button\" id='signout'>Log Out</button></div> </div>
</div> ";
echo "
<div class=\"three wide column\" >
<div class=\"ui vertical menu\">
<div class=\"item\">
    <div class=\"header\">Class</div>
    <div class=\"menu\">
        <a class=\"item\" href='addclass.php'>Add Class</a>
        <a class=\"item\">Edit Class</a>
    </div>
</div>
<div class=\"item\">
    <div class=\"header\">Grades</div>
    <div class=\"menu\">
        <a class=\"item\">Add/Edit Grade</a>

    </div>
</div>
<div class=\"item\">
    <div class=\"header\">Backup</div>
    <div class=\"menu\">
        <a class=\"item\">Old Grades</a>
    </div>
</div>

</div></div>
<div class=\"column\">
    <table class=\"ui celled table\">
    <thead>
    <tr>
        <th>Name Surname</th>
        <th>Student No</th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>5</th>
        <th>6</th>
        <th>7</th>
        <th>8</th>
        <th>9</th>
        <th>10</th>
        <th>11</th>
        <th>12</th>
        <th>13</th>
        <th>14</th>
        <th>15</th>
        <th>16</th>
        <th>17</th>
        <th>18</th>
        <th>19</th>
        <th>20</th>

    </tr>
    </thead>
    <tbody>
    ";
    for($i=0;$i<10;$i++){
    echo "<tr>";
        for($j=0;$j<22;$j++){
        echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        }
        echo "</tr>";
    }
    echo "
    </tbody>
    </table></body></div>

</div>
</div>

";