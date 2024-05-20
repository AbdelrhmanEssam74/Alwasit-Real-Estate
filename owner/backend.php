<?php
include 'init.php';
include $function . 'function.php';
include $libs . 'emails/index.php';

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
$arr = array(
  "status1" => "للإيجار",
  "status2" => "للبيع",
);
$arr2 = array(
  "type1" => "شقة",
  "type2" => "فيلا",
);
echo $_POST['propertyType'];
$data = array(
  'owner_id'              => $owner_id,
  'propertyTitle'         => $_POST['propertyTitle'],
  'propertyDescription'   => $_POST['propertyDescription'],
  'propertyType'          => $_POST['propertyType'],
  'propertyStatus'        => $arr[$_POST['propertyStatus']],
  'propertyPrice'         => $_POST['propertyPrice'],
  'propertyArea'          => $_POST['propertyArea'],
  'propertyRooms'         => $_POST['propertyRooms'],
  'propertyBaths'         => $_POST['propertyBaths'],
  'propertyAddress'       => $_POST['propertyAddress'],
  'propertyNeighborhood'  => trim($_POST['propertyNeighborhood']),
  'propertyCity'          => $_POST['propertyCity'],
  'locationURL'          => $_POST['locationURL'],
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
    `location_url`, 
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
    :locationURL,
    :latitude,
    :longitude
    )"
);
$r = $insert_stmt->execute($data);
//NOTE - Insert type of property in categories table in database
// get number of properties in categories table in database
$n = trim($_POST['propertyNeighborhood']);
$neighborhoods = $conn->prepare("SELECT * FROM `neighborhoods` WHERE neighborhood_name = :n");
$neighborhoods->execute(['n' => $n]);
$neighborhoods = $neighborhoods->fetch(PDO::FETCH_OBJ);
if (($neighborhoods)) {
  $num = $neighborhoods->nums_of_properties;
  $num++;
  $update_nums_of_properties = "UPDATE neighborhoods set nums_of_properties = ? WHERE neighborhood_name = ?";
  $stmt = $conn->prepare($update_nums_of_properties);
  $stmt->execute(array($num, $n));
} else {
  $insert_neighborhoods = "INSERT INTO `neighborhoods` (`neighborhood_name` , `city`) VALUES(?,?)";
  $stmt = $conn->prepare($insert_neighborhoods);
  $r = $stmt->execute(array($data['propertyNeighborhood'], $data['propertyCity']));
}
//NOTE - Insert neighborhood in neighborhood table in database
// get number of properteis in neighborhood table in database
$t = trim($_POST['propertyType']);
$categories = $conn->prepare("SELECT * FROM `categories` WHERE category_name = :t");
$categories->execute(['t' => $t]);
$categories = $categories->fetch(PDO::FETCH_OBJ);
if (($categories)) {
  $num = $categories->nums_of_properties;
  $num++;
  $update_nums_of_properties = "UPDATE categories set nums_of_properties = ? WHERE category_name = ?";
  $stmt = $conn->prepare($update_nums_of_properties);
  $stmt->execute(array($num, $t));
} else {
  $insert_categories = "INSERT INTO `categories` (`category_name`) VALUES(?)";
  $stmt = $conn->prepare($insert_categories);
  $r = $stmt->execute(array($data['propertyType']));
}
// get the value of property_num from owners table in database and increase it by 1
$get_stmt = $conn->prepare("SELECT property_num FROM owners WHERE owner_id = :owner_id");
$get_stmt->execute(['owner_id' => $owner_id]);
$property_num = $get_stmt->fetchColumn();
$property_num++;
// update the property_num in owners table in database
$update_stmt = $conn->prepare("UPDATE owners SET property_num = :property_num WHERE owner_id = :owner_id");
$update_stmt->execute(['property_num' => $property_num, 'owner_id' => $owner_id]);
// send notifications
setNotifications($owner_id, array_keys($notification_type, $notification_type['New Property Listing'])[0], $notification_type['New Property Listing']);
// send email to user to notify him the property uploded successfully 
date_default_timezone_set('Europe/Sofia');
$full_name = $_SESSION['fullname'];
$current_date = date('Y-m-d h:i');
$propertyTitle = $_POST['propertyTitle'];
$mailBody = "
<!DOCTYPE html>
<html dir='rtl'>
<head>
  <meta charset='UTF-8'>
</head>
<body>
  <div style='font-family: Arial, sans-serif; text-align: right; padding:15px'>
مرحبًا  <h3>$full_name,</h3>
<p>
$propertyTitle   :   لقد قمت بارسال عقار بعنوان     
  <br>
  $current_date     بتاريخ  
  <br> 
  سيتم مراجعته  والموافقه عليه في اقرب وقت
</p>
<p>فريق الوسيط</p>
<a href='http://localhost/Alwasit' target='_blank'>Alwasit</a>
  </div>
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
