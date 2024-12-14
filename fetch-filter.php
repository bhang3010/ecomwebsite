<?php
require_once('./db/conn.php');

$filter = $_GET['filter'];

if ($filter == 'brand') {
  $sql_str = "SELECT id, name FROM brands ORDER BY name";
} elseif ($filter == 'category') {
  $sql_str = "SELECT id, name FROM categories ORDER BY name";
}

$result = mysqli_query($conn, $sql_str);

// Thêm lựa chọn "Tất cả"
echo "<option value='0'>Tất cả</option>"; 

while ($row = mysqli_fetch_assoc($result)) {
  echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}
?>