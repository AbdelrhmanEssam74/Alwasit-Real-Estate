<?php
include 'init.php';
include $function . 'function.php';
include $libs . 'emails/index.php';


//NOTE - if isset new images
// Change the name of each img
// New name = owner_id + "_" + property_id + "_" + count;
$owner_id = $_SESSION['owner_id'];
$property_id = $_POST['property_id'];
$imgs = "";
if ($_FILES['new-imgs']['name'][0]) {
  $count = 0;
  $new_imgs = array();
  foreach ($_FILES['new-imgs']['name'] as $img) {
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
  foreach ($_FILES['new-imgs']['tmp_name'] as $index => $tmp_name) {
    // Move the uploaded image to the specific directory
    $new_img = $new_imgs[$index];
    $destination = $new_upload_dir_property . '/' . $new_img;
    move_uploaded_file($tmp_name, $destination);
    $imgs  = implode(',', $new_imgs);
  }
}
//NOTE -  old images
$old_imgs = $_POST['old-imgs']; //array with all old imgs from db
$imgs = (empty($imgs)) ? $old_imgs : $imgs;

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
$arr = array(
  "type1" => "شقة",
  "type2" => "فيلا",
  "status1" => "لللإيجار",
  "status2" => "للبيع",
);
$data = array(
  'owner_id'              => $owner_id,
  'propertyTitle'         => $_POST['propertyTitle'],
  'propertyDescription'   => $_POST['propertyDescription'],
  'propertyType'          => $arr[$_POST['propertyType']],
  'propertyStatus'        => $arr[$_POST['propertyStatus']],
  'propertyPrice'         => $_POST['propertyPrice'],
  'propertyArea'          => $_POST['propertyArea'],
  'propertyRooms'         => $_POST['propertyRooms'],
  'propertyBaths'         => $_POST['propertyBaths'],
  'propertyAddress'       => $_POST['propertyAddress'],
  'propertyNeighborhood'  => $_POST['propertyNeighborhood'],
  'propertyCity'          => $_POST['propertyCity'],
  'locationURL'          => $_POST['locationURL'],
  'latitude'              => $latitude,
  'longitude'              => $longitude,
  'buildingYear'          => $_POST['buildingYear'],
  'imgs'                  => $imgs,
  'property_id'           => $property_id
);

//NOTE - insert the data into the database here.
$update_stmt = $conn->prepare(
  "UPDATE properties SET
    `owner_id` = :owner_id,
    `address` = :propertyAddress,
    `title` = :propertyTitle,
    `city` = :propertyCity,
    `rooms` = :propertyRooms,
    `bath` = :propertyBaths,
    `area` = :propertyArea,
    `price` = :propertyPrice,
    `status` = :propertyStatus,
    `type` = :propertyType,
    `neighborhood` = :propertyNeighborhood,
    `building_in` = :buildingYear,
    `description` = :propertyDescription,
    `img` = :imgs,
    `location_url` = :locationURL,
    `latitude` = :latitude,
    `longitude` = :longitude
  WHERE `property_id` = :property_id"
);
$r = $update_stmt->execute($data);
// update the active property in properties table in database
$update_stmt = $conn->prepare("UPDATE properties SET active = 0 WHERE owner_id = :owner_id AND property_id = :property_id");
$update_stmt->execute(['owner_id' => $owner_id, "property_id" => $property_id]);
// send notifications
setNotifications($owner_id, array_keys($notification_type, $notification_type['Change'])[0], $notification_type['Change']);
// send email to user to notify him the property uploded successfully 
$full_name = $_SESSION['fullname'];
$current_date = date('Y-m-d h:i');
$propertyTitle = $_POST['propertyTitle'];
$mailBody = "
<!DOCTYPE html>
<html>
<head>
</head>
<body style='text-align:right;'>
مرحبًا  <h3>$full_name,</h3>
<p>
$propertyTitle   :   لقد قمت بتعديل عقار بعنوان     
  <br>
  $current_date     بتاريخ  
  <br> 
  سيتم مراجعته  والموافقه عليه في اقرب وقت
</p>
<p>فريق الوسيط</p>
<a href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
</body>
</html>
";
$email_subject  = 'Alwasit | الوسيط';
$send_email_obj = new EmailSender($_SESSION['email'], $email_subject, $mailBody);
$send_email_obj->sendEmail();
if ($r) {
  $_SESSION['uploaded_success'] = true;
  header('Location:' . $_SERVER['HTTP_REFERER']);
  exit;
}
