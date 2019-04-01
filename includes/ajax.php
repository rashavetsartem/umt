<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "";
$db_base = "artem_umt";

$link = mysqli_connect($db_host, $db_user, $db_password, $db_base); // Соединяемся с базой

// Ругаемся, если соединение установить не удалось
if (!$link) {
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}

// Проверка кодировки
if (!mysqli_set_charset($link, "utf8")) {
    printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($link));
        exit();
    } else {
        ;
}

  if (isset($_POST['addOrder'])) {
    $sql = mysqli_query($link, "CALL epr_orders_insert('".$_POST['addOrder']."','2')");  
}

  if(isset($_POST['rec_comment'])){
    $sql = mysqli_query($link, "UPDATE repairs_det SET reclamation_comment ='".$_POST['rec_comment']."' WHERE ID = '".$_POST['id']."'");
}

  if(isset($_POST['reclamation_result'])){
    $sql = mysqli_query($link, "UPDATE repairs_det SET reclamation_result_id ='".$_POST['reclamation_result']."' WHERE ID = '".$_POST['id']."'");
}

  if(isset($_POST['tree_id'])){
    $sql = mysqli_query($link, "CALL epr_repairsdet_insert_new('".$_POST['tree_id']."','".$_POST['repairs_id']."')");
}

  if(isset($_POST['field_name'])){
    $sql = mysqli_query($link, "CALL erp_ordersdet_update_new('".$_POST['id']."','".$_POST['field_name']."','".$_POST['newVal']."')");
  }

  
  if(isset($_POST['checked'])){
    $sql = mysqli_query($link, "UPDATE orders_det SET ORDERS_CHECK ='".$_POST['checked']."' WHERE ID = '".$_POST['id']."'");
  }

  if(isset($_POST['fieldName'])){
    $sql = mysqli_query($link, "UPDATE repairs SET WORK_PERFORMED ='".$_POST['newVal']."' WHERE ID = '".$_POST['repairId']."'");
  }

  if(isset($_POST['repairs_type'])){
    $sql = mysqli_query($link, "UPDATE repairs SET REPAIRS_TYPE_ID ='".$_POST['repairs_type']."' WHERE ID = '".$_POST['repairId']."'");
  }

  if(isset($_POST['end_date'])){
    $sql = mysqli_query($link, "UPDATE repairs SET END_DATE ='".$_POST['end_date']."' WHERE ID = '".$_POST['repairId']."'");
  }

  if(isset($_POST['responsible_person'])){
    $sql = mysqli_query($link, "UPDATE repairs SET WORKERS_ID ='".$_POST['responsible_person']."' WHERE ID = '".$_POST['repairId']."'");
  }

?>
