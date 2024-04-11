<?php
date_default_timezone_set("Africa/Cairo");
include "connect.php";
session_start();
# Routes
define("APPURL", "http://localhost/Alwasit/");
$templates = 'includes/template/';
$css = 'ar/css/';
$js = 'ar/js/';
$images = 'ar/images/';
$function = 'includes/functions/';
$libs = '../libs/';
$prop_details_page = "../property_details.php";
$logout = "../auth/logout.php";
$upload_dir = "upload/";
$owner_dir = "owner/";

$notification_type = [
  "New Property Listing" => "تم إرسال العقار بنجاح , سيتم مراحعته و الموافقه عليه في اقرب وقت",
  "Change" => "تم التعديل العقار بنجاح , سيتم مراحعته و الموافقه عليه في اقرب وقت",
  "Delete" => "تم حذف العقار بنجاح "
];
