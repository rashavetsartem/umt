<?php include_once("includes/header.php");?>
<?php include_once("includes/navbar.php");?>
<style>
.row{
    margin:10px;
}

.container-fluid{
    margin-top:50px;
}
</style>

<?php
function get_cars_status(){
    require("includes/connection.php");
    $stmt = $db->query('CALL spr_cars_status()');
    $cars_status = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $cars_status;
};
?>


<div class="container-fluid">
  <div class="row">
    <div class="col">
        <table class="table table-bordered table-sm table-hover" id="tableOrders">
            <thead class="thead">
                <tr class="unselectable">
                    <th>№</th>
                    <th>ТС</th>
                    <th>Статус</th>
                    <th>Прицеп</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php $cars_status = get_cars_status();
                foreach($cars_status as $cars_status): ?>
                    <tr class="unselectable" data-id=<?=$cars_status['ID']?> data-name="cars_status">
                        <td><?=$cars_status['ID']?></td>
                        <td><?=$cars_status['CAR_NAME']?></td>
                        <td><?=$cars_status['TS_STATUS']?></td>
                        <td><?=$cars_status['TRAILER_NAME']?></td>
                        <td></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="col">
        <table class="table table-bordered table-sm table-hover" id="tableOrders">
            <thead class="thead">
                <tr class="unselectable">
                    <th>№</th>
                    <th>ТС</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
  </div>
</div>

<?php include_once("includes/footer.php");?>
<?php include_once("includes/scripts.php");?> 