<?php include_once("includes/header.php");?>
<?php require_once("includes/functions.php");?>

<?php
    if (isset($_POST['deleteId'])) {
        require("includes/connection.php");
        $deteils_delete_ID= $_POST['deleteId'];
        $stmt = $db->query("DELETE FROM repairs_det WHERE ID= $deteils_delete_ID ");
    
        echo "<script type= text/javascript> window.location = 'repairs-det.php?repair_id='".$_GET['repair_id']."'' </script>";
    }
?>


<table class="table table-bordered table-sm table-hover">
<thead class="thead">
    <tr>
      <th hidden>№</th>
      <th hidden>Система</th>
      <th>Точка</th>
      <th>Место установки</th>
      <th>Дата</th>
      <th>Автосервис</th>
      <th>Поставщик</th>
      <th>Деталь</th>
      <th>Производитель</th>
      <th>Гарантия мес.</th>
      <th>Статус</th>
      <th style="width: 40px;"></th>
    </tr>
</thead>

  <?php $repairs_det = get_repairsdet($_GET['repair_id']);?>
  <?php foreach($repairs_det as $repairs_det): ?>
  <?php if($repairs_det['REPAIRS_DET_STATUS_NAME']=='Рекламация'){$bg='#ff3333';$hidden_delit='hidden';} else{$bg='';$hidden_delit='image';} ?>
<tbody>  
   <tr>
     <td hidden><?=$repairs_det['ID']?></td>
     <td hidden><?=$repairs_det['CAR_SYSTEM_NAME']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['CAR_POINT_NAME']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['POINT_LOCATION_NAME']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['LAST_INSTALL_DATE']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['LAST_SERVICE_NAME']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['CLIENT_SELL']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['LAST_DETAIL_NAME']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['LAST_MANUFACTURER_NAME']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['RECLAMATION_MONTH']?></td>
     <td bgcolor=<?=$bg?> ><?=$repairs_det['REPAIRS_DET_STATUS_NAME']?></td>
     <td $hidden_delit bgcolor=<?=$bg?> >
     <form action="" method="post">
      <input type="hidden" name="deleteId" value="<?=$repairs_det['ID']?>">
      <input class="delit" type="<?=$hidden_delit?>" src="images/b_drop.png">
     </form>
     </td>
   </tr>
  <?php endforeach;?>
</tbody>
</table>       


<?php include_once("includes/footer.php");?>
<?php include_once("includes/scripts.php");?>

<script>
  $(".delit").click(function(){
  var res = confirm("Вы действительно хотите удалить эту точку?"); 
  if(!res) return false;
  });
</script>