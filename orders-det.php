<?php include_once("includes/header.php");?>
<?php require_once("includes/functions.php");?>


<?php
  if(isset($_POST['field_name'])){
    require_once("includes/connection.php");
    $sql = mysqli_query($link, "CALL erp_ordersdet_update_new('".$_POST['id']."','".$_POST['field_name']."','".$_POST['newVal']."')");
  }

  if(isset($_POST['checked'])){
    require_once("includes/connection.php");
    $sql = mysqli_query($link, "UPDATE orders_det SET ORDERS_CHECK ='".$_POST['checked']."' WHERE ID = '".$_POST['id']."'");
  }
?>

<div>
<table class="table table-bordered table-sm table-hover">
  <thead class="thead">
    <tr>
      <th hidden>№</th>
      <th style= "width: 70px">Точка</th>
      <th style= "width: 40px">Кол-во шт.</th>
      <th>Производитель</th>
      <th>Поставщик</th>
      <th style= "width: 70px">Кол-во</th>
      <th style= "width: 70px">Цена</th>
      <th style= "width: 70px">Сумма</th>
      <th style= "width: 70px">Гарантия (мес.)</th>
      <th>Комментарий</th>

      <?php if ($_COOKIE['user_role_id'] !== "3"){
      echo '<th>Номера счетов</th>' .
           '<th>Счёт</th>';
      }
      ?>

    </tr>
  </thead>
  <tbody> 
  <?php $orders_det = get_ordersdet($_GET['order_id']);?>
  <?php foreach($orders_det as $orders_det): ?>
 
      <tr>
        <td hidden><?=$orders_det['id']?></td>
        <td><?=$orders_det['name']?></td>
        <td><?=$orders_det['requirement_itemcount']?></td>
        <td class= "edit" contenteditable= "true" data-id="<?=$orders_det['id']?>" data-name= "DETAILS_MANUFACTURER"><?=$orders_det['details_manufacturer']?></td>
        <td>
          <select class="custom-select" data-id=<?=$orders_det['id']?> data-name= "CLIENT_ID">
            <option><?=$orders_det['client_name']?></option>
            <option value=""></option>
              <?php $clients = get_clients();
                    foreach($clients as $clients):?> 
            <option value="<?=$clients['ID']?>"><?=$clients['NAME']?></option>
              <?php endforeach;?>
          </select>
        </td>
        <td class= "edit" contenteditable= "true" data-id="<?=$orders_det['id']?>" data-name= "ITEMCOUNT"><?=$orders_det['itemcount']?></td>
        <td class= "edit" contenteditable= "true" data-id="<?=$orders_det['id']?>" data-name= "BUY_PRICE"><?=$orders_det['buy_price']?></td>
        <td><?=$orders_det['buy_summ']?></td>
        <td class= "edit" contenteditable= "true" data-id="<?=$orders_det['id']?>" data-name= "WARRANTY_MONTH"><?=$orders_det['warranty_month']?></td>
        <td class= "edit" contenteditable= "true" data-id="<?=$orders_det['id']?>" data-name= "COMMENT"><?=$orders_det['orders_comment']?></td>

        
        <td class= "edit" contenteditable= "true" data-id="<?=$orders_det['id']?>" data-name= "ORDERS_NUMBERS"><?=$orders_det['orders_numbers']?></td>
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="checkbox_<?=$orders_det['id']?>" data-id=<?=$orders_det['id']?> <?php 
              if ($orders_det['orders_check'] == '0'){
                echo  'checked= checked';
              }?>>
            <label class="custom-control-label" for="checkbox_<?=$orders_det['id']?>"></label>
          </div>
        </td>


      </tr>
  <?php endforeach;?>
      </tbody>

    <!---?php
        require_once("includes/connection.php");
      $sql = mysqli_query($db, "CALL spr_ordersdet({$_GET['order_id']})");
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tbody>' .
                '<tr>' .
                  '<td hidden>' . $result['id'] . '</td>' .
                  '<td>' . $result['name'] . '</td>' .
                  '<td>' . $result['requirement_itemcount'] . '</td>' .
                  '<td class= edit contenteditable= true data-id=' . $result['id'] . ' data-name=  "DETAILS_MANUFACTURER">' . $result['details_manufacturer'] . '</td>' .
                  '<td>
                  <select class= edit_select data-id= ' . $result['id'] . ' data-name= "CLIENT_ID">
                  <option value=' . $result['client_name'] . '>' . $result['client_name'] . '</option>';
                  
                  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                  $db_host = "127.0.0.1";
                  $db_user = "root";
                  $db_password = "";
                  $db_base = "artem_umt";
                  $link = mysqli_connect($db_host, $db_user, $db_password, $db_base);
                  if (!$link) {
                    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                    exit;
                  }
                  if (!mysqli_set_charset($link, "utf8")) {
                      printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($link));
                          exit();
                      } else {
                          ;
                  }
                  $sql1 = mysqli_query($link,"SELECT C.ID, C.NAME NAME FROM CLIENTS C ORDER BY C.ID");
                  while ($row1 = mysqli_fetch_array($sql1))
                  {
                    echo '<option value='.$row1['ID'].'>'.$row1['NAME'].'</option>';
                  };
                  echo '</select>
                  </td>' .
                  '<td class= edit contenteditable= true data-id=' . $result['id'] . ' data-name=  "ITEMCOUNT">' . $result['itemcount'] . '</td>' .
                  '<td class= edit contenteditable= true data-id=' . $result['id'] . ' data-name=  "BUY_PRICE">' . $result['buy_price'] . '</td>' .
                  '<td>' . $result['buy_summ'] . '</td>' .
                  '<td class= edit contenteditable= true data-id=' . $result['id'] . ' data-name=  "WARRANTY_MONTH">' . $result['warranty_month'] . '</td>' .
                  '<td class= edit contenteditable= true data-id=' . $result['id'] . ' data-name=  "COMMENT">' . $result['orders_comment'] . '</td>';

                  if ($_COOKIE['user_role_id'] !== "3"){
                    echo '<td class= edit contenteditable= true data-id=' . $result['id'] . ' data-name=  "ORDERS_NUMBERS">' . $result['orders_numbers'] . '</td>' .
                  '<td><input type= checkbox class= edit_checkbox data-id=' . $result['id'] . ' data-name = "ORDERS_CHECK" id= checkbox ';  
                  if ($result['orders_check'] == '0'){
                     echo  'checked= checked>';
                    } echo '</td>';};
                   echo '<td hidden><a href="?del_id=' . $result['id'] . '">Удалить</a></td>' .
                '</tr> ' .
              '</tbody>';
      }
      mysqli_close($link);
    ?--->

</table>    
</div>


<?php include_once("includes/footer.php");?>
<?php include_once("includes/scripts.php");?>


<script type="text/javascript">
  $(function(){
    var oldVal, newVal, id, name;
    $('.edit').keypress(function(e){
      if(e.which == 13){
        return false;
      }
    });
    $('.edit').focus(function(){
      oldVal = $(this).text();
      id = $(this).data('id');
      field_name = $(this).data('name')
    }).blur(function(){
      newVal = $(this).text();
      if(newVal != oldVal){
        $.ajax({
          url: 'includes/ajax.php',
          type: 'POST',
          data: {field_name: field_name, newVal: newVal, id: id}
        })
      }
    });
  });

  $(function(){
    var oldVal, newVal, id, name;
    $('.custom-select').focus(function(){
      oldVal = $(this).val();
      id = $(this).data('id');
      field_name = $(this).data('name')
    }).change(function(){
      newVal = $(this).val();
      if(newVal != oldVal){
        $.ajax({
          url: 'includes/ajax.php',
          type: 'POST',
          data: {field_name: field_name, newVal: newVal, id: id}
        })
      };
    });
  });

$('.custom-control-input').click(function(){
  id = $(this).data('id');
  if ($(this).is(':checked')){
      $.ajax({
          url: 'includes/ajax.php', 
          method: 'post',
          data: {checked: 0, id: id}
          });
          console.log(id);
      } else {
        $.ajax({
          url: 'includes/ajax.php', 
          method: 'post',
          data: {checked: 1, id: id}
          });
      };
  });
</script>