<?php

$handle = fopen('input.txt', 'r');

$claimCounts = array();

const DIM = 1000;

for ($i = 0; $i < DIM; $i++) {
  $claimCounts[] = array_fill(0, DIM, 0);
}

while (($line = fgets($handle, 4096)) !== false) {
  $line = str_replace("\n", "", $line); // remove newlines
  $lineArray = explode(" ", $line);
  // #1 @ 45,64: 22x22
  // pos 0 is "#1"
  // pos 1 is "@"
  // pos 2 is "45,64:"
  // pos 3 is "22x22"

  list($startX, $startY) = explode(",", str_replace(":", "", $lineArray[2]));
  // echo "X: $startX Y: $startY\n";
  list($width, $height) = explode("x", $lineArray[3]);
  // echo "width: $width height: $height\n";

  $endX = $startX + $width;
  $endY = $startY + $height;

  for ($x = $startX; $x < $endX; $x++) {
    for ($y = $startY; $y < $endY; $y++) {
      $claimCounts[$x][$y]++;
    }
  }
}
$overLaps = 0;
for ($x = 0; $x < DIM; $x++) {
  for ($y = 0; $y < DIM; $y++) {
    if ($claimCounts[$x][$y] > 1) {
      $overLaps++;
    }
  }
}
echo "There are $overLaps overlaps\n";
