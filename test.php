<?php
$key = "AIzaSyAFHz-7hKCyzYx2kWfY-S_kSi6Hm8pZ8jk";
$address = "الدهشوري، قسم بني سويف، قسم بنى سويف، محافظة بني سويف";
// Formatted address 
$formatted_address = str_replace(' ', '+', $address);

$geocodeFromAddr = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$formatted_address}&key={$key}");
// Decode JSON data returned by API 
$apiResponse = json_decode($geocodeFromAddr);
// Retrieve latitude and longitude from API data 
$latitude  = $apiResponse->results[0]->geometry->location->lat;
$longitude = $apiResponse->results[0]->geometry->location->lng;
// Render the latitude and longitude of the given address 
echo (float)$latitude . "|" . (float)$longitude;
