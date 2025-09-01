<?php require_once('Connections/cn_db.php'); ?>
<?php require_once('Connections/cn_db.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_GET['id'])) && ($_GET['id'] != "") && (isset($_POST['delete']))) {
  $deleteSQL = sprintf("DELETE FROM db1 WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_cn_db, $cn_db);
  $Result1 = mysql_query($deleteSQL, $cn_db) or die(mysql_error());

  $deleteGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_cn_db, $cn_db);
$query_Recordset1 = sprintf("SELECT * FROM db1 WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $cn_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script type="text/javascript">
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<p>&nbsp;</p>
<table width="500" border="1" cellpadding="0">
  <tr>
    <td>ID</td>
    <td><?php echo $row_Recordset1['id']; ?></td>
  </tr>
  <tr>
    <td>姓名</td>
    <td><?php echo $row_Recordset1['name']; ?></td>
  </tr>
  <tr>
    <td>年齡</td>
    <td><?php echo $row_Recordset1['Old']; ?></td>
  </tr>
  <tr>
    <td>居住</td>
    <td><?php echo $row_Recordset1['Addr']; ?></td>
  </tr>
  <tr>
    <td><input name="delete" type="submit" id="submit" onclick="return deleteconfirm()" value="刪除" /></td>
    <td><input name="回上一頁" type="button" onclick="confirmBack()" id="回上一頁" value="回上一頁" /></td>
  </tr>
</table>

</form>
<p>&nbsp;</p>
</body>
<script>
const deleteconfirm=()=>{
	 return confirm('are you sure');
}
function confirmBack() {
  const confirmed = confirm("確定要返回上一頁嗎？");
  if (confirmed) {
    history.back(); // Go back one page in history
  }
}
</script>
</html>
<?php
mysql_free_result($Recordset1);
?>
