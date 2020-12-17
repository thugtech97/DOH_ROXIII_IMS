<?php

require "php/php_conn.php";

function get_item(){
  global $conn;

  $po_number = "2020-07-343";
  $sql = mysqli_query($conn, "SELECT po_id, po_number, item_name, quantity FROM tbl_po WHERE inspection_status = '1' AND po_number LIKE '$po_number' ORDER BY po_id DESC");
  if(mysqli_num_rows($sql) != 0){
    while($row = mysqli_fetch_assoc($sql)){
      if((int)explode(" ", $row["quantity"])[0] != 0){
        echo "<option data-po=\"".$row["po_number"]."\" value=\"".$row["po_id"]."\">".$row["item_name"]."</option>";
      }
    }
  }
}

get_item();

?>