<?php

  $id = $_GET['id'];
  $conn =  mysqli_connect('us-cdbr-iron-east-05.cleardb.net:3306', 'b52e20d0f5da46', 'fc4f25b0', 'heroku_0188da0de4a5cfa');

  if(!$conn){
    die ("Connection failed:  " .mysqli_connect_error());
  }

    $sql = "UPDATE prerequest SET prerequest.Status = 'Approved' where prerequest.ID=$id";

    if (mysqli_query($conn, $sql)) {
      $sql = "DELETE FROM final_shifts USING final_shifts, prerequest
      WHERE final_shifts.idshift = prerequest.Shift_ID AND final_shifts.username = prerequest.userName";
      if (mysqli_query($conn, $sql)) {

        mysqli_close($conn);
        header('Location:manager_homepage.html.php');
        exit;
      } else {
         header('Location:manager_approval.html.php');
        echo "Error removing record...";
      }
      exit;
    } else {
      header('Location:manager_approval.html.php');
      echo "Error updating record";
    }


?>
