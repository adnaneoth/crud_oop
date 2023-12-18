<?php
require_once("src\crud.php");



$database = new crud();
// $dataToInsert = ['name' => 'saad'];
// $tableName = 'user';
// $result = $database->insertRecord($tableName, $dataToInsert);

// if ($result) {
//     echo "inserted successfully!";
// } else {
//     echo "Failed to insert .";
// }



// $result = $database->deleteRecord('user', 1);

//  if ($result) {
//      echo "delete successfully!";
//  } else {
//      echo "Failed to delete .";
//  }

 $dataToInsert = ['name' => 'amine'];
 $result = $database->updateRecord('user',$dataToInsert, 13);



?>