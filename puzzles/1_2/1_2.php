<?php

$total = 0;
$loops = 0;
$histo = array($total => 1);
while(true) { // this seems safe
  // $handle = fopen('sampleInput2.txt', 'r');
  $handle = fopen('input.txt', 'r');
  $count = 0;

  while (($line = fgets($handle, 4096)) !== false) {
    $number = intval($line);
    $total += $number;
    // both count and loops are 1 indexed, human readable formats
    $count++;
    $loops++;
    // echo "delta $number gives us total $total \n";
    if (isset($histo[$total])) {
      echo "we have reached $total for the 2nd time at input $count on loop $loops\n";
      exit;
    }
    $histo[$total] = 1;
  }
}
