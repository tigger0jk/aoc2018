<?php

// $handle = fopen('sampleInput.txt', 'r');
$handle = fopen('input.txt', 'r');

$twosCount = 0;
$threesCount = 0;
while (($line = fgets($handle, 4096)) !== false) {
  // TODO remove newline? don't need to, only one per line, won't be dupes of it
  // echo "raw line: $line";
  $lineArray = str_split($line);
  sort($lineArray);
  // echo "sorted line: " . json_encode($lineArray) . "\n";

  unset($currentChar);
  $lineArray[] = "end"; // this is cheesy but it ensures our last character doesn't match any previous (because it's 3 chars), gives us an end step
  $currentCount = 0;
  $hasTwo = false;
  $hasThree = false;
  foreach ($lineArray as $char) {
    if(!isset($currentChar)) {
      $currentChar = $char;
    }
    if ($currentChar === $char) {
      $currentCount++;
    } else {
      if($currentCount === 2) {
        $hasTwo = true;
      } else if($currentCount === 3) {
        $hasThree = true;
      }
      $currentChar = $char;
      $currentCount = 1;
    }
  }
  if ($hasTwo === true) {
    $twosCount++;
  }
  if ($hasThree === true) {
    $threesCount++;
  }
  // echo "Processed " . json_encode($lineArray) . " new twosCount is $twosCount and threes is $threesCount\n";
}
$checksum = $twosCount * $threesCount;

echo "checksum: $checksum\n";
