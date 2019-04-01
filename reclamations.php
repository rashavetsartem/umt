<?php include_once("includes/header.php");?>
<?php include_once("includes/navbar.php");?>


<?php
/* Сохранение коммента к рекламации */
require("includes/connection.php");
if(isset($_POST['rec_comment'])){
    $stmt = $db->query("UPDATE repairs_det SET reclamation_comment ='".$_POST['rec_comment']."' WHERE ID = '".$_POST['id']."'");
    header('location: reclamations.php');
}
?>

<?php       
function get_reclamation_inwork(){
  require("includes/connection.php");
  $stmt = $db->query('CALL spr_reclamation_inwork()');
  $reclamation = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $reclamation;
};

function get_reclamation_result(){
  require("includes/connection.php");
  $stmt = $db->query('SELECT id, name FROM reclamation_result ORDER BY id');
  $reclamation_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $reclamation_result;
};

function get_reclamations_sum(){
          require("includes/connection.php");
          $stmt = $db->query('SELECT SUM(buy_price) reclamation_total FROM `vw_reclamations` WHERE 1 LIMIT 1');
          $reclamations_sum = $stmt->fetch();
          return $reclamations_sum;
}
?>

<div class= "tabcontent">


  <table class="table table-bordered table-sm table-hover">
    <thead class="thead">

      </thead>
      <tbody>
      <tr class="unselectable">
          <th>№</th>
          <th style="width: 100px;">Гос. Номер</th>
          <th style="width: 120px;">Дата прошлого ремонта</th>
          <th style="width: 120px;">Дата рекламации</th>
          <th style="width: 150px;">Точка</th>
          <th style="width: 100px;">Место установки</th>
          <th>Поставщик</th>
          <th>Номера счетов</th>
          <th>Автосервис</th>
          <th style="width: 100px;">Стоимость (грн.)</th>
          <th>Причина рекламации</th>
          <th hidden>Комментарий</th>
        </tr>
      <?php $reclamations = get_reclamation_inwork();

            foreach($reclamations as $reclamation): ?>
            <tr class="unselectable" data-id=<?=$reclamation['id']?> data-name="reclamations">
              <td><?=$reclamation['id']?></td>
              <td><?=$reclamation['car_name']?></td>
              <td><?=$reclamation['last_install_date']?></td>
              <td><?=$reclamation['repair_date']?></td>
              <td style="width: 150px;"><?=$reclamation['point_name']?></td>
              <td><?=$reclamation['point_location_name']?></td>
              <td><?=$reclamation['seller_name']?></td>
              <td><?=$reclamation['reclamation_orders_numbers']?></td>
              <td><?=$reclamation['service_name']?></td>
              <td><?=$reclamation['buy_price']?></td>
              <td>
                <select class="form-control" data-id="<?=$reclamation['id']?>" data-name="reclamation_result">
                  <option><?=$reclamation['reclamation_result']?></option>
                    <?php $reclamation_result = get_reclamation_result();
                    foreach($reclamation_result as $reclamation_result):?> 
                  <option value="<?=$reclamation_result['id']?>"><?=$reclamation_result['name']?></option>;
                    <?php endforeach;?>
                </select>
              </td>
              <td hidden>
                <button class="btn btn-info btn-sm" href=#my_modal data-toggle= "modal" data-name="reclamation-comment" data-service= '<?=$reclamation['service_name']?>' data-carname= '<?=$reclamation['car_name']?>' data-startdate= '<?=$reclamation['repair_date']?>'  data-id= '<?=$reclamation['id']?>' data-comment='<?=$reclamation['reclamation_comment']?>'> test</button>
                <textarea class="form-control" row="4" data-id="<?=$reclamation['id']?>" data-name="reclamation_comment"><?=$reclamation['reclamation_comment']?></textarea>
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
  var Id = $(e.relatedTarget).data('id');
  var Comment = $(e.relatedTarget).data('comment');
  var modal_class = $('#modal_dialog');
  var buttons = $("<div class='modal_button'/>")
    .append("<button type='submit' form='rec_comment' class='btn btn-success'>Сохранить</button>")
    .append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Закрыть</button>");
  var reclamation_comment = $("<div class='modalcomment' id='modal_comment'/>")
    .append("<form id='rec_comment' method='post' action='reclamations.php'><textarea id='rec_comment' name='rec_comment' style='height:200px;' data-id= "+Id+" data-name='reclamation_comment' class='form-control' row='8'>"+Comment+"</textarea><input hidden type='text' name='id' value="+Id+"></form>");
  var header = $("<div class='modalheader' id='comment_header'/>")
    .append("<h5 class='modal-title'>Комментарий к рекламации.</h5>");
    /* Собираем модальное окно */
  modal_class.removeClass('modal-xl')
  $("div.modal_button").remove()
  $("div.modal_header_test").remove()
  $("#myframe").remove()
  $("#comment_header").remove()
  $("#modal_comment").remove()
  $("#modal-footer").prepend(buttons)
  $("#modal-body").prepend(reclamation_comment)
  $("#modal-header").prepend(header)
});

</script>

<script>
  /* редактирование ячеек на табе рекламация */
  $(function(){
    var oldVal, newVal, id, name;
    $('.form-control').focus(function(){
      oldVal = $(this).val();
      id = $(this).data('id');
      name = $(this).data('name');
      console.log(id,name);
    }).change(function(){
      newVal = $(this).val();

      if(newVal != oldVal){/*проверка на изменение значения*/
        if(name=='reclamation_comment'){ /*проверка по data-name*/
          $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: {reclamation_comment: newVal, id: id}
          });
        }else if(name=='reclamation_result'){ /* проверка по data-name*/
          $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: {reclamation_result: newVal, id: id}
          });
        };
      };
  /* конец проверки изменения значения */      
    });
  });
</script>
