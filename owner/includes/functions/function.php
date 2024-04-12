<?php
date_default_timezone_set("Africa/Cairo");
// function to set the title for each page contain pageTitle variable
function PageTitle()
{
  global $pageTitel;
  echo (isset($pageTitel))  ? $pageTitel : "Defult";
}

/*
	** Count Number Of Items Function v1.0
	** Function To Count Number Of Items Rows
	** $item = The Item To Count
	** $table = The Table To Choose From
	*/

function countItems($item, $table, $value = null)
{
  $result = "";
  global $conn;
  if ($value == null) {
    $stmt2 = $conn->prepare("SELECT COUNT($item) FROM $table");
    $stmt2->execute();
    $result = $stmt2->fetchColumn();
  } else {
    $stmt2 = $conn->prepare("SELECT COUNT($item) FROM $table WHERE $item = '$value'");
    $stmt2->execute();
    $result = $stmt2->fetchColumn();
  }
  return $result;
}

/*
	** Get value Of Specific Field Function v1.0
	** Function To get value Of Specific Field
	** $item  = The Specific Field
	** $table = The Table To Choose From
	** $id    = The ID of owner
*/
function getValue($item, $table, $column, $value)
{
  global $conn;
  $stmt2 = $conn->prepare("SELECT $item FROM $table WHERE $column = '$value'");
  $stmt2->execute();
  return $stmt2->fetch();
}

/*
	** Set Notifications Function v1.0
	** Function To Count Number Of Items Rows
	** 
	** 
	** 
  */
function setNotifications($receive_id, $notification_type, $notification_content)
{
  $current_date = date("Y-m-d h:i:s");
  global $conn;
  $insert_stmt = $conn->prepare("INSERT INTO notifications (`receive_id` ,`notification_type`,`notification_content` ,`Timestamp` ) VALUES (?,?,?,?)");
  $r = $insert_stmt->execute(array($receive_id, $notification_type, $notification_content, $current_date));
  return $r;
}

/*
	** Get Latest Records Function v1.0
	** Function To Get Latest Items From Database [ Users, Items, Comments ]
	** $select = Field To Select
	** $table = The Table To Choose From
	** $order = The Desc Ordering
	** $limit = Number Of Records To Get
	*/

function getLatest($select, $table, $order,  $limit = 3, $condition = null)
{
  global $conn;
  $rows = array();
  if ($condition == null) {
    $getStmt = $conn->prepare("SELECT $select FROM $table ORDER BY $order  DESC LIMIT $limit");
    $getStmt->execute();
    $rows = $getStmt->fetchAll(PDO::FETCH_OBJ);
  } else {
    $getStmt = $conn->prepare("SELECT $select FROM $table WHERE $condition ORDER BY $order  DESC LIMIT $limit ");
    $getStmt->execute();
    $rows = $getStmt->fetchAll(PDO::FETCH_OBJ);
  }
  return $rows;
}
