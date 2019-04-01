<?php

function get_repairs_filter($carType){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_repairs_filter("'.$carType.'")');
    $repairs = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $repairs;
  };
  
function get_tree_cartype1(){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_tree("1")');
    $tree_cartype1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $tree_cartype1;
};
   
function get_tree_cartype2(){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_tree("2")');
    $tree_cartype2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $tree_cartype2;
};

function get_reclamation(){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_reclamation()');
    $reclamation = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $reclamation;
};

function get_repairs(){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_repairs()');
    $repairs = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $repairs;
};

function get_orders(){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_orders()');
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $orders;
};

function get_reclamation_result(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT id, name FROM reclamation_result ORDER BY id');
    $reclamation_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $reclamation_result;
};

function get_carName(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT C.ID id, CONCAT(CT.NAME, C.NAME) name FROM CARS C, CARS_TYPE CT WHERE C.CARS_TYPE_ID = CT.ID ORDER BY CT.ID, C.NAME');
    $carName = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $carName;
};

function get_serviceName(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT ID, NAME FROM SERVICES ORDER BY NAME');
    $reclamation_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $reclamation_result;
};

function get_repairsType(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT ID, NAME FROM repairs_type WHERE ID <> 0 ORDER BY ID');
    $reclamation_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $reclamation_result;
};


function get_repairsdet($repair_id){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_repairsdet("'.$repair_id.'")');
    $repairsdet = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $repairsdet;
};

function get_ordersdet($order_id){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_ordersdet("'.$order_id.'")');
    $ordersdet = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $ordersdet;
};

function get_clients(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT * FROM CLIENTS  ORDER BY ID');
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $clients;
};

function get_workers(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT W.ID id, W.NAME name FROM workers W ORDER BY W.NAME');
    $workers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $workers;
};

function get_repairs_type(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT RT.ID id, RT.NAME name FROM repairs_type RT ORDER BY RT.NAME');
    $repairsType = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $repairsType;
};

function get_cars(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT * FROM cars ORDER BY NAME');
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cars;
};

function get_carsModels(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT * FROM cars_model ORDER BY NAME');
    $carsModels = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $carsModels;
};

function get_carsType(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT * FROM cars_type WHERE ID <> 0 ORDER BY NAME');
    $carsType = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $carsType;
};

function get_drivers(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT ID,  NAME FROM workers ORDER BY NAME');
    $drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $drivers;
};

function get_services(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT * FROM SERVICES ORDER BY NAME');
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $services;
};

function get_workersAll(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT * FROM workers ORDER BY NAME');
    $workersAll = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $workersAll;
};

function get_users(){
    require("includes/connection.php");
    $stmt = $db->query('SELECT * FROM users ORDER BY NAME');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
};
?>
