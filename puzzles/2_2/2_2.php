<?php

$handle = fopen('input.txt', 'r');

$ids = array();
while (($line = fgets($handle, 4096)) !== false) {
  $line = str_replace("\n", "", $line); // remove newlines
  $lineArray = str_split($line);

  $ids[] = $lineArray;
}

/**
 * This function returns false if no match, or the string of shared characters if they are similar
 *
 * This is totally bad practice but php does it in their functions so I'll just also do it here
 */
function areSimilarIds($id1, $id2) {
  $numDiffChars = abs(count($id1) - count($id2));
  $sharedChars = array();
  for ($i = 0; $i < count($id1); $i++) {
    if($id1[$i] !== $id2[$i]) {
      $numDiffChars++;
      if ($numDiffChars > 1) {
        return false;
      }
    } else {
      $sharedChars[] = $id1[$i];
    }
  }
  // THIS AINT DRY NOOOOOO
  if ($numDiffChars > 1) {
    return false;
  }

  return $sharedChars;
}

// There might be a better big o complexity answer to this but ehhh this is what we're doin
for ($i = 0; $i < count($ids); $i++) {
  for ($j = $i + 1; $j < count($ids); $j++) {
    $result = areSimilarIds($ids[$i], $ids[$j]);
    if($result !== false) {
      echo "similar ids are \n$i, " . json_encode($ids[$i]) . " and \n$j, " . json_encode($ids[$j]) . "\n";
      echo "shared chars are " . implode($result) . "\n";
    }
  }
}
