<?php
echo "hora: ";
$h=trim(fgets(STDIN));
$h=date('H:i');
echo "hora 2:";
$h2=trim(fgets(STDIN));

$nuevaH = strtotime('+ 30 minute',strtotime($h));
$nuevaH= date('H:i');
echo $nuevaH ."\n";
echo $h2 ."\n";

if ($h> $h2 ) {
    echo "seeeeee";
} 




// $hora->format('g:i');
// print_r($hora) ;

?>