<?php

require "php/php_conn.php";
require "php/php_general_functions.php";

function print_wi(){
  global $conn;

  $sql = mysqli_query($conn, "SELECT category, CASE WHEN category = 'Drugs and Medicines' THEN 1 WHEN category = 'Medical Supplies' THEN 2 ELSE 3 END AS category_order FROM ref_category ORDER BY category_order ASC");
  $tbody = "";
  while($row = mysqli_fetch_assoc($sql)){
    $category = $row["category"];
    echo $category;
    $sub_total = 0.00;
    $sql2 = mysqli_query($conn, "SELECT p.end_user, p.po_number, s.supplier, p.date_delivered, p.description, p.quantity, p.sn_ln, p.exp_date, p.unit_cost, SUBSTRING(p.quantity, 1, 1) AS quan FROM tbl_po AS p, ref_supplier AS s WHERE p.supplier_id = s.supplier_id AND p.category = '$category' AND p.procurement_mode <> 'Central-Office' AND p.procurement_mode <> 'Bidding' AND p.procurement_mode <> 'PTR'");
    while($row2 = mysqli_fetch_assoc($sql2)){
      $quantity_unit = explode(" ", $row2["quantity"]);
      $total_amount = (float)$quantity_unit[0] * (float)$row2["unit_cost"];
      $sub_total+=$total_amount;
      $sn_ln = ($category != "Drugs and Medicines" && $category != "Medical Supplies") ? "" : explode("|", $row2["sn_ln"])[0];
      $exp_date = ($category != "Drugs and Medicines" && $category != "Medical Supplies") ? "" : $row2["exp_date"];
      $tbody.="<tr>
            <td style=\"width: 61.2px; height: 12px; text-align: center; font-size: 9px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\">".$row2["end_user"]."</td>
            <td style=\"width: 56.4px; height: 12px; text-align: left; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row2["po_number"]."</td>
            <td style=\"width: 73.8px; height: 12px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row2["supplier"]."</td>
            <td style=\"width: 56.4px; height: 12px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row2["date_delivered"]."</td>
            <td style=\"width: 204.6px; height: 12px; text-align: left; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$row2["description"]."</td>
            <td style=\"width: 59.4px; height: 12px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 53.4px; height: 12px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 54px; height: 12px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$quantity_unit[0]."</td>
            <td style=\"width: 41.4px; height: 12px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".$quantity_unit[1]."</td>
            <td style=\"width: 48.6px; height: 12px; text-align: center; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format((float)$row2["unit_cost"], 2)."</td>
            <td style=\"width: 73.8px; height: 12px; text-align: right; font-size: 8px; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\">".number_format($total_amount, 2)."</td>
            <td style=\"width: 51.6px; height: 12px; text-align: center; font-size: 9px; font-weight: bold; vertical-align: center; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
          </tr>";
    }
    $tbody.="<tr>
            <td style=\"width: 61.2px; height: 12px; text-align: center; font-size: 9px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-left-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid;\"></td>
            <td style=\"width: 56.4px; height: 0px; text-align: left; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 73.8px; height: 0px; text-align: center; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 56.4px; height: 0px; text-align: center; font-size: 8px; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 204.6px; height: 0px; text-align: left; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 59.4px; height: 0px; text-align: center; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 53.4px; height: 0px; text-align: center; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 54px; height: 0px; text-align: center; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 41.4px; height: 0px; text-align: center; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 48.6px; height: 0px; text-align: center; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 73.8px; height: 0px; text-align: right; font-size: 8px; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
            <td style=\"width: 51.6px; height: 0px; text-align: center; font-size: 9px; font-weight: bold; vertical-align: bottom; border-right-color: rgb(0, 0, 0); border-bottom-color: rgb(0, 0, 0); border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid;\"></td>
          </tr>";
  }
  echo $tbody;
}

print_wi();

?>