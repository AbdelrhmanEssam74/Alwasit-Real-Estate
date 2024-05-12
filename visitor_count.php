<?php
// File path to store the visitor count
$visitorCountFile = 'visitor_count.txt';

// Check if the visitor count file exists, if not, create it with an initial count of 0
if (!file_exists($visitorCountFile)) {
  file_put_contents($visitorCountFile, '0');
}

// Increment the visitor count
$visitorCount = (int)file_get_contents($visitorCountFile); // Read the current count
$visitorCount++; // Increment the count
file_put_contents($visitorCountFile, $visitorCount); // Update the count in the file

// Display the visitor count
echo  $visitorCount;
