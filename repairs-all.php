<?php include_once("includes/header.php");?>
<?php include_once("includes/functions.php");?>
<?php include_once("includes/navbar.php");?>

<div class= "tabcontent">
<table class="table table-bordered table-sm table-hover table-fixed">

    <thead class="thead" >

    </thead>

    <tbody>
    <tr class="unselectable">
      <th style="width:68px; vertical-align:middle;">№</th>
      <th hidden>Тип ТС</th>
      <th style="width:185px; vertical-align:middle;">ТС</th>
      <th style="width:120px; vertical-align:middle;">Начало ремонта</th>
      <th style="vertical-align:middle;">Тип ремонта</th>
      <th style="vertical-align:middle;">Работы по ремонту</th>
      <th style="width:120px; vertical-align:middle;">Плановый конец ремонта</th>
      <th style="width:200px; vertical-align:middle;">Ответственный механик</th>
      <th style="width:200px; vertical-align:middle;">Автосервис</th>
      <th>Статус ремонта</th>
      <th hidden class="noprint"></th>
    </tr>

    <?php
    $repairs = get_repairs();
    foreach($repairs as $repairs): ?>
      <tr class="unselectable" data-id=<?=$repairs['REPAIR_ID']?> data-name="repairs">
        <td style="width:68px;"><?=$repairs['REPAIR_ID']?></td>
        <td hidden><?=$repairs['CAR_TYPE_ID']?></td>
        <td style="width:185px;"><?=$repairs['CARS_NAME']?></td>
        <td style="width:120px;"><?=$repairs['START_DATE']?></td>
        <td style="width:150px;"><?=$repairs['repairs_type']?></td>
        <td><?=$repairs['work_performed']?></td>
        <td style="width:120px;"><?=$repairs['END_DATE']?></td>
        <td style="width:200px;"><?=$repairs['responsible_person']?></td>
        <td><?=$repairs['SERVICES']?></td>
        <td hidden class="noprint" style="width:180px; ">
          <div class= buttonHide>
          <button hidden class="btn btn-info btn-sm" href=#my_modal data-toggle= "modal" data-name="repairs-det" data-service= '<?=$repairs['SERVICES']?>'  data-cartypeid= <?=$repairs['CAR_TYPE_ID']?> data-carname= '<?=$repairs['CARS_NAME']?>' data-startdate=<?=$repairs['START_DATE']?>  data-id=<?=$repairs['REPAIR_ID']?>>Детали</button>                                           
            <form method="post">
              <input type='hidden' name='REPAIR_ID' value=<?=$repairs['REPAIR_ID']?>>
            </form>
          </div>
        </td>
        <td><?=$repairs['repairs_status']?></td>
      </tr>
    <?php endforeach;?>
  </tbody>  
</table>
</div>


<?php include_once("deteils-modal.php");?>
<?php include_once("includes/footer.php");?>
<?php include_once("includes/scripts.php");?>


<script>
    function addOrder(){
    var txt;
    var r = confirm("Создать заказ?");
    if (r == true) {
      var Id = $('#addOrder').data('id');
        $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: {addOrder: Id}
        });
    }
  }
</script>


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


    /* элементы для таблицы добавление точек */
    var a = "trchangecolor(this,\'tcolor\',\'ycolor\');";
    var modalTableBody_cartype1 = $("<tbody class='modalBody'/>")
        .append("<?php $tree = get_tree_cartype1();?>")
        .append("<?php foreach($tree as $tree): ?>")
        .append("<tr class='tcolor'><td><?=$tree['systems_type_name']?></td><td><?=$tree['system_name']?></td><td><?=$tree['points_name']?></td><td><?=$tree['points_location_name']?></td><td><input id='chk' type='checkbox' data-id='<?=$tree['ID']?>' data-name='' onchange= "+a+"></td></tr>")
        .append("<?php endforeach;?>");

    var modalTableBody_cartype2 = $("<tbody class='modalBody'/>")
        .append("<?php $tree = get_tree_cartype2();?>")
        .append("<?php foreach($tree as $tree): ?>")
        .append("<tr class='tcolor'><td><?=$tree['systems_type_name']?></td><td><?=$tree['system_name']?></td><td><?=$tree['points_name']?></td><td><?=$tree['points_location_name']?></td><td><input id='chk' type='checkbox' data-id='<?=$tree['ID']?>' data-name='' onchange= "+a+"></td></tr>")
        .append("<?php endforeach;?>");             
    
    var orders_det_button = $("<div class='modal_button'/>")
        .append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Закрыть</button>");

    /* елементы для сборки модального окна */
    var modalHeaderRepair= $("<div class='modal_header_test'/>")
        .append("<h5 class='modal-title'><ul><li>"+carName+"</li><li>"+repairDate+"</li></ul></h5>");     
    var repairs_det_button = $("<div class='modal_button'/>")    
        .append("<input id='addOrder' data-id="+Id+" onclick='addOrder()' type='button' value='Создать заказ' class='btn btn-warning'>")
        .append("<button id='addPoints' type='button' class='btn btn-info' data-toggle='modal' data-target='.bd-example-modal-xl' data-cartypeid="+carTypeId+" data-id="+Id+">Добавить точки</button>")
        .append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Закрыть</button>");

    /* Собираем модальное окно детали */
    if(Type=="orders-det") { /* Детали заказа */
      myFrame.attr('src', 'orders-det.php?order_id='+Id);
          $("div.modal_button").remove()
          $("div.modal_header_test").remove()
          $('#modal-footer').prepend(orders_det_button);
          $('#modal-header').prepend(modalHeaderOrder);
    }else if(Type=="repairs-det"){ /* Детали ремонта */
      myFrame.attr('src', 'repairs-det.php?repair_id='+Id);
          $("div.modal_button").remove()
          $("div.modal_header_test").remove()        
          $('#modal-footer').append(repairs_det_button);
          $('#modal-header').prepend(modalHeaderRepair);

    /*Собираем модальное окно добавления точек*/
    if (carTypeId==1) {   /* Таблица добавления точек типТС 1*/
            $("tbody.modalBody").remove()
            $('#mytable').append(modalTableBody_cartype1); 
          } else {    /* Таблица добавления точек типТС не 1*/
            $("tbody.modalBody").remove()
            $('#mytable').append(modalTableBody_cartype2); 
          }
    };
  });

  /* Перед открытием модала с добавлением точек*/
  $('#addPoints_modal').on('show.bs.modal', function(e) {
 
    var Id = $(e.relatedTarget).data('id');
    var repair_id = $('#addPoints_modal_repair_id');
    repair_id.val(Id);
    /* убираем чекбоксы */
    $('input:checked').prop('checked', false);
    /* убираем цвет */
    $('tr').removeClass('ycolor').addClass('tcolor');
  });
</script>

<script>
/* Изменение класса строк в модальном окне добавления точек, для подсвечивания выбраных строк */

function trchangecolor(checkbox, uncheckedcolor, checkedcolor) {
   if (checkbox.checked == true)
   checkbox.parentNode.parentNode.className = checkedcolor;
   else
   checkbox.parentNode.parentNode.className = uncheckedcolor;
}
</script>


<script>
  /*обработка нажатия кнопки добавить точки*/
$('#btn_add_points').click(function(){
    var txt;
    var repairs_id = $('#addPoints_modal_repair_id').val();
    var r = confirm("Добавить выбранные точки в ремонт?");
    if (r == true) {
      $('input:checkbox:checked').each(function() {
        $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: {tree_id: $(this).data('id'), repairs_id: repairs_id}
        });
      });
        /* закрытие модала детали и открытие еге еще раз с добавленными точками */
        $('*[class="close"]').click();
        setTimeout(function () {
          $('*[data-name="repairs-det"][data-id="'+repairs_id+'"]').click();
        }, 500);
    }
  });
  
  $(document).ready(function(){
        $("#searchAddPoints").keyup(function(){
            _this = this;
            $.each($("#mytable tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();                
                });
            });
        });

</script>


<script>


function clicked(e)
{
    if(!confirm('Закрыть ремонт?'))e.preventDefault();
}
</script>

<script>
    $(function(){
    var oldVal, newVal, repairId, fieldName;
    $('.edit').focus(function(){
      oldVal = $(this).text();
      repairId = $(this).data('id');
      fieldName = $(this).data('name');
    }).blur(function(){
      newVal = $(this).text();
      if(newVal != oldVal){
        $.ajax({
          url: 'includes/ajax.php',
          type: 'POST',
          data: {fieldName: fieldName, newVal: newVal, repairId: repairId}
        })
      };
    });
  });

  $(function(){
    var oldVal, newVal, id, name;
    $('.form-control').focus(function(){
      oldVal = $(this).val();
      repairId = $(this).data('id');
      name = $(this).data('name');
      console.log(repairId,name,oldVal);
    }).change(function(){
      newVal = $(this).val();

      if(newVal != oldVal){/*проверка на изменение значения*/
        if(name=='repairs_type'){ /*проверка по data-name*/
          $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: {repairs_type: newVal, repairId: repairId}
          });
          console.log(repairId,name,newVal);
        }else if(name=='end_date'){ /* проверка по data-name*/
          $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: {end_date: newVal, repairId: repairId}
          });
          console.log(repairId,name,newVal);
        }else if(name=='responsible_person'){ /* проверка по data-name*/
          $.ajax({
            url: 'includes/ajax.php',
            type: 'POST',
            data: {responsible_person: newVal, repairId: repairId}
          });
        };
      };
  /* конец проверки изменения значения */      
    });
  });


</script>