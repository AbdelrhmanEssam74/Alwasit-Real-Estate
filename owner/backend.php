<?php
include 'init.php';

$owner_id = $_SESSION['owner_id'];
$property_id = uniqid();
// Change the name of each img
// New name = owner_id + "_" + property_id + "_" + count;
$count = 0;
$new_imgs = array();
foreach ($_FILES['imgs']['name'] as $img) {
  $img_extension = pathinfo($img, PATHINFO_EXTENSION);
  $new_imgs[] = $owner_id . '_' . $property_id . '_' . $count . '.' . $img_extension;
  $count++;
}
// Storing the images in a specific directory
// The directory name = owner_id
// The property name = property_id
$new_upload_dir_owner = $upload_dir . $owner_id;
$new_upload_dir_property = $new_upload_dir_owner . '/' . $property_id;

if (!is_dir($new_upload_dir_owner)) {
  mkdir($new_upload_dir_owner, 0777, true);
}

if (!is_dir($new_upload_dir_property)) {
  mkdir($new_upload_dir_property, 0777, true);
} else {
  // Clear the existing files in the property directory
  $files = glob($new_upload_dir_property . '/*');
  foreach ($files as $file) {
    if (is_file($file)) {
      unlink($file);
    }
  }
}
foreach ($_FILES['imgs']['tmp_name'] as $index => $tmp_name) {
  // Move the uploaded image to the specific directory
  $new_img = $new_imgs[$index];
  $destination = $new_upload_dir_property . '/' . $new_img;
  move_uploaded_file($tmp_name, $destination);
}
//  function to extract the latitude and longitude from the URL 
function extractLatLngFromUrl($url)
{
  $pattern = '/@(-?\d+\.\d+),(-?\d+\.\d+)/';
  preg_match($pattern, $url, $matches);

  if (!empty($matches)) {
    $latitude = floatval($matches[1]);
    $longitude = floatval($matches[2]);
    return ['latitude' => $latitude, 'longitude' => $longitude];
  } else {
    return null;
  }
}
$result = extractLatLngFromUrl($_POST['locationURL']);

$latitude = " ";
$longitude = "";
if ($result !== null) {
  $latitude = $result['latitude'];
  $longitude = $result['longitude'];
}
$data = array(
  'owner_id'              => $owner_id,
  'propertyTitle'         => $_POST['propertyTitle'],
  'propertyDescription'   => $_POST['propertyDescription'],
  'propertyType'          => $_POST['propertyType'],
  'propertyStatus'        => $_POST['propertyStatus'],
  'propertyPrice'         => $_POST['propertyPrice'],
  'propertyArea'          => $_POST['propertyArea'],
  'propertyRooms'         => $_POST['propertyRooms'],
  'propertyBaths'         => $_POST['propertyBaths'],
  'propertyAddress'       => $_POST['propertyAddress'],
  'propertyNeighborhood'  => $_POST['propertyNeighborhood'],
  'propertyCity'          => $_POST['propertyCity'],
  'latitude'              => $latitude,
  'longitude'              => $longitude,
  'buildingYear'          => $_POST['buildingYear'],
  'imgs'                  => implode(',', $new_imgs),
  'property_id'           => $property_id
);

//NOTE - insert the data into the database here.
$insert_stmt = $conn->prepare(
  "INSERT INTO properties (
    `property_id`,
    `owner_id`,
    `address`, 
    `title`,
    `city`,
    `rooms`, 
    `bath`, 
    `area`, 
    `price`,
    `status`,
    `type`,
    `neighborhood`,
    `building_in`, 
    `description`,
    `img`,
    `latitude`, 
    `longitude`
    )
    VALUES (
    :property_id,
    :owner_id,
    :propertyAddress,
    :propertyTitle,
    :propertyCity,
    :propertyRooms,
    :propertyBaths,
    :propertyArea,
    :propertyPrice,
    :propertyStatus,
    :propertyType,
    :propertyNeighborhood,
    :buildingYear,
    :propertyDescription,
    :imgs,
    :latitude,
    :longitude
    )"
);
$r = $insert_stmt->execute($data);
// get the value of property_num from owners table in database and increate it by 1
$get_stmt = $conn->prepare("SELECT property_num FROM owners WHERE owner_id = :owner_id");
$get_stmt->execute(['owner_id' => $owner_id]);
$property_num = $get_stmt->fetchColumn();
$property_num++;
// update the property_num in owners table in database
$update_stmt = $conn->prepare("UPDATE owners SET property_num = :property_num WHERE owner_id = :owner_id");
$update_stmt->execute(['property_num' => $property_num, 'owner_id' => $owner_id]);
if ($r) {
  $_SESSION['uploaded_success'] = true;
  header('Location:' . $_SERVER['HTTP_REFERER']);
  exit;
}
