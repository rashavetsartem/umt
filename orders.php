<?php include_once("includes/header.php");?>
<?php include_once("includes/navbar.php");?>
<?php require_once("includes/functions.php");?>

<div class= "tabcontent">
  <table class="table table-bordered table-sm table-hover" id="tableOrders">
    <thead class="thead">

    </thead>
    <tbody>
    <tr class="unselectable">
        <th hidden>№</th>
        <th></th>
        <th>Дата заказа</th>
        <th>ТС</th>
        <th>СТО</th>      
        <th>Дата ремонта</th>
        <th>Пользователь</th>      
        <th></th>
      </tr>
    <?php $orders = get_orders();?>
    <?php foreach($orders as $orders):?>
    <?php if($orders['order_check']==1){$bg="#fc4343";} else{$bg="";}?>
      <tr class="unselectable" data-id=<?=$orders['ORDER_ID']?> data-name="orders">
        <td hidden><?=$orders['ORDER_ID']?></td>
        <td style= "width: 20px; color: transparent; background-color: <?=$bg?>"><?=$orders['order_check']?></td>
        <td style= "width: 150px"><?=$orders['ORDERS_DATE']?></td>
        <td style= "width: 350px"><?=$orders['REPAIR_CAR']?></td>                 
        <td><?=$orders['SERVICE_NAME']?></td>
        <td style= "width: 150px"><?=$orders['REPAIR_DATE']?></td>
        <td><?=$orders['USER_NAME']?></td>
        <td style= 'width: 100px'>
          <div class= buttonHide>
            <button class='btn btn-info btn-sm' href="#my_modal" data-repairid = '<?=$orders['repair_id']?>' data-toggle= "modal" data-service= '<?=$orders['SERVICE_NAME']?>' data-name="orders-det" data-carname= '<?=$orders['REPAIR_CAR']?>' data-startdate=<?=$orders['ORDERS_DATE']?> data-id=<?=$orders['ORDER_ID']?>>Детали</button>
          </div>
        </td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>
</div>

<?php include_once("deteils-modal.php");?>
<?php include_once("includes/footer.php");?>
<?php include_once("includes/scripts.php");?>
<script>
    $('#my_modal').on('show.bs.modal', function(e) {
      
    var myFrame = $('#myframe');
    var Id = $(e.relatedTarget).data('id');
    var Type= $(e.relatedTarget).data('name');
    var carTypeId= $(e.relatedTarget).data('cartypeid');
    var carName= $(e.relatedTarget).data('carname');
    var repairDate= $(e.relatedTarget).data('startdate');
    var serviceName= $(e.relatedTarget).data('service');
    var orderRepairId= $(e.relatedTarget).data('repairid');


    var orders_det_button = $("<div class='modal_button'/>")
        .append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Закрыть</button>");

        var modalHeaderOrder= $("<div class='modal_header_test'/>")
        .append("<h5 class='modal-title'><ul><li>"+carName+"</li><li>"+repairDate+"</li><li>"+"Автосервис: "+serviceName+"</li><li>"+"Ремонт №: "+orderRepairId+"</li></ul></h5>");

    /* Собираем модальное окно детали */

      myFrame.attr('src', 'orders-det.php?order_id='+Id);
          $("div.modal_button").remove()
          $("div.modal_header_test").remove()
          $('#modal-footer').prepend(orders_det_button);
          $('#modal-header').prepend(modalHeaderOrder);

  });
</script>