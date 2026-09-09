<?php

function returnWithError(string $message, int $exitCode) {
  http_response_code($exitCode);
  die($message);
}
function returnServerError(string $message) {
  returnWithError($message, 500);
}

function returnBadRequestError(string $message) {
  returnWithError($message, 400);
}

function getInputArgs()
{
  $args = json_decode(file_get_contents("php://input"), true);
  if (isset($args['x']) && isset($args['y']) && isset($args['color'])) {
    $x = $args['x'];
    $y = $args['y'];
    $color = $args['color'];

    if (
      !is_numeric($x) || !is_numeric($y) || !is_numeric($color) ||
      intval($x) != $x || intval($y) != $y || intval($color) != $color
    ) {
      returnBadRequestError("Invalid input: x, y, and color must all be integers");
    }

    return [$x, $y, $color];
  }
  else {
    returnBadRequestError("Missing required argument 'x', 'y' or 'color'.");
  }
}

function writeToLog($x, $y, $color) {
  if (($handle = fopen("logs/" . date("W-Y") . ".log", "a")) !== false) {
    if (flock($handle, LOCK_EX)) {
      fwrite($handle, $x . " " . $y . " " . $color . "\n");
    }
    else {
      fclose($handle);
      returnServerError("Failed to lock log file.");
    }
    fclose($handle);
  }
  else {
    returnServerError("Failed to write beads to the log file.");
  }
}

function readBeadsFile($beadsFileName) {
  if (($handle = fopen($beadsFileName, "r")) !== false) {
    $data = [];
    if (flock($handle, LOCK_EX)) {
      while (($row = fgetcsv($handle, escape: "\\")) !== false) {
        $data[] = $row;
      }
    }
    else {
      fclose($handle);
      returnServerError("Failed to lock beads file when reading.");
    }

    fclose($handle);
    return $data;
  }
  else {
    returnServerError("Failed to open beads file when reading.");
  }
}

function paintPixel($data, $x, $y, $color) {
  if (isset($data[$y][$x])) {
    $data[$y][$x] = $color;
  }
  return $data;
}

function writeToBeadsFile($beadsFileName, $data) {
  if (($handle = fopen($beadsFileName, "c+")) !== false) {
    if (flock($handle, LOCK_EX)) {
      ftruncate($handle, 0);
      foreach ($data as $row) {
        fputcsv($handle, $row, escape: "\\");
      }
    }
    else {
      fclose($handle);
      returnServerError("Failed to lock beads file on write.");
    }
    fclose($handle);
  }
  else {
    returnServerError("Failed to open beads file on write.");
  }
}

function clearFile($snapshotFileName) {
  if (($handle = fopen($snapshotFileName, "c+")) !== false) {
    if (flock($handle, LOCK_EX)) {
      ftruncate($handle, 0);
      for ($y = 1; $y <= 30; $y++) {
        $row = [];
        for ($x = 1; $x <= 30; $x++) {
          $row[$x] = 0;
        }
        fputcsv($handle, $row);
      }
    }
    else {
      fclose($handle);
      returnServerError("Failed to lock file" + $snapshotFileName + " when clearing.");
    }
    fclose($handle);
  }
  else {
    returnServerError("Failed to open file" + $snapshotFileName + " when clearing.");
  }
}

// Call every new week when beads file should be cleared.
// Will create a new snapshot file and clear the current beads file.
function createNewSnapshotFile($snapshotFileName, $beadsFileName) {
  clearFile($snapshotFileName);
  clearFile($beadsFileName);
}

function saveToSnapshotFile($beadsFileName) {
  $snapshotFolder = "snapshots/";
  $snapshotFileName = $snapshotFolder . date("W-Y") . ".csv";
  if (file_exists($snapshotFileName)) {
    copy($beadsFileName, $snapshotFileName);
  } else {
    createNewSnapshotFile($snapshotFileName, $beadsFileName);
  }
}

function main() {
  [$x, $y, $color] = getInputArgs();
  writeToLog($x, $y, $color);

  $beadsFileName = "beads.csv";
  $data = readBeadsFile($beadsFileName);
  $data = paintPixel($data, $x, $y, $color);
  writeToBeadsFile($beadsFileName, $data);
  saveToSnapshotFile($beadsFileName);
}

main();
?>