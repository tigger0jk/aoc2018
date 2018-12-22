<?php

$handle = fopen('input.txt', 'r');

$claimCounts = array();

const DIM = 1000;

class Claim {
  public $id;
  public $startX;
  public $startY;
  public $endX;
  public $endY;
  public $width;
  public $height;

  public function Claim($id, $startX, $startY, $width, $height) {
    $this->id = $id;
    $this->startX = $startX;
    $this->startY = $startY;
    $this->width = $width;
    $this->height = $height;

    $this->endX = $startX + $width;
    $this->endY = $startY + $height;
  }
}

for ($i = 0; $i < DIM; $i++) {
  $claimCounts[] = array_fill(0, DIM, 0);
}
$claims = array();

while (($line = fgets($handle, 4096)) !== false) {
  $line = str_replace("\n", "", $line); // remove newlines
  $lineArray = explode(" ", $line);
  // #1 @ 45,64: 22x22
  // pos 0 is "#1"
  // pos 1 is "@"
  // pos 2 is "45,64:"
  // pos 3 is "22x22"

  $id = $lineArray[0];

  list($startX, $startY) = explode(",", str_replace(":", "", $lineArray[2]));
  // echo "X: $startX Y: $startY\n";
  list($width, $height) = explode("x", $lineArray[3]);
  // echo "width: $width height: $height\n";

  $claim = new Claim($id, $startX, $startY, $width, $height);
  $claims[] = $claim;

  for ($x = $claim->startX; $x < $claim->endX; $x++) {
    for ($y = $claim->startY; $y < $claim->endY; $y++) {
      $claimCounts[$x][$y]++;
    }
  }
}

// Yeah this is a real slow way to do this but at least we're saving christmas
foreach ($claims as $claim) {
  for ($x = $claim->startX; $x < $claim->endX; $x++) {
    for ($y = $claim->startY; $y < $claim->endY; $y++) {
      if ($claimCounts[$x][$y] > 1) {
        continue 3; // oof, continue the foreach
      }
    }
  }
  echo "Claim has no collisions, id $claim->id\n";
}
