<?php

$handle = fopen('input.txt', 'r');

$total = 0;
$count = 0;
while (($line = fgets($handle, 4096)) !== false) {
  $number = intval($line);
  $total += $number;
  $count++;
  echo $number . "\n";
}

echo "count: " . $count . "\n"; // used this to check that I had the expected 1036 lines of input
echo "total: " . $total . "\n";
