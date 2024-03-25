<?php
// function to set the title for each page contain pageTitle variable
function PageTitle()
{
    global $pageTitel;
    echo (isset($pageTitel))  ? $pageTitel : "Defult";
}
/*
	** Check Items Function v1.0
	** Function to Check Item In Database [ Function Accept Parameters ]
	** $select = The Item To Select [ Example: user, item, category ]
	** $from = The Table To Select From [ Example: users, items, categories ]
	** $value = The Value Of Select [ Example: Osama, Box, Electronics ]
	*/

function checkItem($select, $from, $value)
{

    global $conn;

    $statement = $conn->prepare("SELECT $select FROM $from WHERE $select = ?");

    $statement->execute(array($value));

    $count = $statement->rowCount();

    return $count;
}

/*
	** Count Number Of Items Function v1.0
	** Function To Count Number Of Items Rows
	** $item = The Item To Count
	** $table = The Table To Choose From
	*/

function countItems($item, $table)
{
    global $conn;
    $stmt2 = $conn->prepare("SELECT COUNT($item) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}

/*
	** Get Latest Records Function v1.0
	** Function To Get Latest Items From Database [ Users, Items, Comments ]
	** $select = Field To Select
	** $table = The Table To Choose From
	** $order = The Desc Ordering
	** $limit = Number Of Records To Get
	*/

function getLatest($select, $table, $order, $limit = 5)
{

    global $conn;

    $getStmt = $conn->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

    $getStmt->execute();

    $rows = $getStmt->fetchAll(PDO::FETCH_OBJ);

    return $rows;
}
