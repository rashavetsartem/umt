<?php include_once("includes/header.php");?>
<?php include_once("includes/functions.php");?>

<?php
    if (isset($_POST['REPAIR_ID'])) {
        require("includes/connection.php");
        $stmt = $db->query("UPDATE repairs SET REPAIRS_STATUS_ID = '3' WHERE ID = '".$_POST['REPAIR_ID']."'");

        header('location: repairs.php');
    }
?>

<?php
    if (isset($_POST['submit'])) {
        require("includes/connection.php");
        $stmt = $db->query("CALL epr_repairs_insert('".$_POST['StartDate']."','".$_POST['ts']."','".$_POST['sto']."','".$_POST['EndDate']."','".$_SESSION['userid']."')");
        header('location: repairs.php');
    }
?>

<?php include_once("includes/navbar.php");?>
<div class="tabcontent">
  <table class="table table-bordered table-sm table-hover">
      <thead class="thead">
      </thead>
      <tbody>
      <tr class="unselectable">
        <th style="width:68px;">№</th>
        <th hidden>Тип ТС</th>
        <th style="width:185px;">ТС</th>
        <th style="width:120px;">Начало ремонта</th>
        <th>Тип ремонта</th>
        <th>Работы по ремонту</th>
        <th style="width:120px;">Плановый конец ремонта</th>
        <th style="width:200px;">Ответственный механик</th>
        <th style="width:200px;">Автосервис</th>
        <th style="width:120px;" class="noprint"></th>
      </tr>
      <tbody>
        <tr>
          <td colspan="9" style="font-weight: bold; position: sticky; top: 110px; background-color: #d6d6d6">Тягачи</td>
        </tr>  
      </tbody>
      <?php
      $repairs = get_repairs_filter('1');
      foreach($repairs as $repairs): ?>
        <tr class="task" data-id=<?=$repairs['REPAIR_ID']?> data-name="repairs">
          <td style="width:68px;"><?=$repairs['REPAIR_ID']?></td>
          <td hidden><?=$repairs['CAR_TYPE_ID']?></td>
          <td style="width:185px;"><?=$repairs['CARS_NAME']?></td>
          <td style="width:120px;"><?=$repairs['START_DATE']?></td>
          <td style="width:150px;">
                <select class="form-control" data-id="<?=$repairs['REPAIR_ID']?>" data-name="repairs_type">
                  <option><?=$repairs['repairs_type']?></option>
                    <?php $repairsType = get_repairs_type();
                    foreach($repairsType as $repairsType):?> 
                  <option value="<?=$repairsType['id']?>"><?=$repairsType['name']?></option>;
                    <?php endforeach;?>
                </select>
          </td>
          <td class= "edit" contenteditable= "true" data-id= "<?=$repairs['REPAIR_ID']?>" data-name= "work_performed"><?=$repairs['work_performed']?></td>
          <td style="width:120px;">
            <input type="date" name="bday" max="3000-12-31" min="1000-01-01" class="form-control" value="<?=$repairs['END_DATE']?>" data-id="<?=$repairs['REPAIR_ID']?>" data-name= "end_date">
          </td>
          <td style="width:200px;">
                <select class="form-control" data-id="<?=$repairs['REPAIR_ID']?>" data-name="responsible_person">
                  <option><?=$repairs['responsible_person']?></option>
                    <?php $workers = get_workers();
                    foreach($workers as $workers):?> 
                  <option value="<?=$workers['id']?>"><?=$workers['name']?></option>;
                    <?php endforeach;?>
                </select>
          </td>
          <td><?=$repairs['SERVICES']?></td>
          <td class="noprint" style="width:180px;">
            <div class= buttonHide>
              <button hidden class="btn btn-info btn-sm" href=#my_modal data-toggle= "modal" data-name="repairs-det" data-service= '<?=$repairs['SERVICES']?>'  data-cartypeid= <?=$repairs['CAR_TYPE_ID']?> data-carname= '<?=$repairs['CARS_NAME']?>' data-startdate=<?=$repairs['START_DATE']?>  data-id=<?=$repairs['REPAIR_ID']?>>Детали</button>                                           
              <form method="post">
                <input type='hidden' name='REPAIR_ID' value=<?=$repairs['REPAIR_ID']?>>
                <button class="btn btn-secondary btn-sm" onclick="clicked(event)" data-id=<?=$repairs['REPAIR_ID']?>>Закрыть</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach;?>
      </tbody>  
      <tbody>
        <tr>
          <td colspan="9" style="font-weight: bold; position: sticky; top: 148px; background-color: #d6d6d6;">Полуприцепы Зерновозы</td>
        </tr>  
      </tbody>
      <tbody>
      <?php
      $repairs = get_repairs_filter('2');
      foreach($repairs as $repairs): ?>
        <tr class="task" data-id=<?=$repairs['REPAIR_ID']?> data-name="repairs">
          <td style="width:68px;"><?=$repairs['REPAIR_ID']?></td>
          <td hidden><?=$repairs['CAR_TYPE_ID']?></td>
          <td style="width:185px;"><?=$repairs['CARS_NAME']?></td>
          <td style="width:120px;"><?=$repairs['START_DATE']?></td>
          <td style="width:150px;">
                <select class="form-control" data-id="<?=$repairs['REPAIR_ID']?>" data-name="repairs_type">
                  <option><?=$repairs['repairs_type']?></option>
                    <?php $repairsType = get_repairs_type();
                    foreach($repairsType as $repairsType):?> 
                  <option value="<?=$repairsType['id']?>"><?=$repairsType['name']?></option>;
                    <?php endforeach;?>
                </select>
          <td class= "edit" contenteditable= "true" data-id= "<?=$repairs['REPAIR_ID']?>" data-name= "work_performed"><?=$repairs['work_performed']?></td>
          <td style="width:120px;">
            <input type="date" name="bday" max="3000-12-31" min="1000-01-01" class="form-control" value="<?=$repairs['END_DATE']?>">
          </td>
          <td style="width:200px;">
                <select class="form-control" data-id="<?=$repairs['REPAIR_ID']?>" data-name="responsible_person">
                  <option><?=$repairs['responsible_person']?></option>
                    <?php $workers = get_workers();
                    foreach($workers as $workers):?> 
                  <option value="<?=$workers['id']?>"><?=$workers['name']?></option>;
                    <?php endforeach;?>
                </select>
          </td>
          <td><?=$repairs['SERVICES']?></td>
          <td class="noprint" style="width:180px; ">
            <div class= buttonHide>
              <button hidden class="btn btn-info btn-sm" href=#my_modal data-toggle= "modal" data-name="repairs-det" data-service= '<?=$repairs['SERVICES']?>'  data-cartypeid= <?=$repairs['CAR_TYPE_ID']?> data-carname= '<?=$repairs['CARS_NAME']?>' data-startdate=<?=$repairs['START_DATE']?>  data-id=<?=$repairs['REPAIR_ID']?>>Детали</button>                                           
              <form method="post">
                <input type='hidden' name='REPAIR_ID' value=<?=$repairs['REPAIR_ID']?>>
                <button class="btn btn-secondary btn-sm" onclick="clicked(event)" data-id=<?=$repairs['REPAIR_ID']?>>Закрыть</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach;?>
      </tbody> 
      <tbody>
        <tr>
          <td colspan="9" style="font-weight: bold; position: sticky; top: 186px; background-color: #d6d6d6">Полуприцепы Цистерны</td>
        </tr>  
      </tbody> 
      <tbody>
      <?php
      $repairs = get_repairs_filter('3');
      foreach($repairs as $repairs): ?>
        <tr class="task" data-id=<?=$repairs['REPAIR_ID']?> data-name="repairs">
          <td style="width:68px;"><?=$repairs['REPAIR_ID']?></td>
          <td hidden><?=$repairs['CAR_TYPE_ID']?></td>
          <td style="width:185px;"><?=$repairs['CARS_NAME']?></td>
          <td style="width:120px;"><?=$repairs['START_DATE']?></td>
          <td style="width:150px;">
                <select class="form-control" data-id="<?=$repairs['REPAIR_ID']?>" data-name="repairs_type">
                  <option><?=$repairs['repairs_type']?></option>
                    <?php $repairsType = get_repairs_type();
                    foreach($repairsType as $repairsType):?> 
                  <option value="<?=$repairsType['id']?>"><?=$repairsType['name']?></option>;
                    <?php endforeach;?>
                </select>
          </td>
          <td class= "edit" contenteditable= "true" data-id= "<?=$repairs['REPAIR_ID']?>" data-name= "work_performed"><?=$repairs['work_performed']?></td>
          <td style="width:120px;">
            <input type="date" name="bday" max="3000-12-31" min="1000-01-01" class="form-control" value="<?=$repairs['END_DATE']?>">
          </td>
          <td style="width:200px;">
                <select class="form-control" data-id="<?=$repairs['REPAIR_ID']?>" data-name="responsible_person">
                  <option><?=$repairs['responsible_person']?></option>
                    <?php $workers = get_workers();
                    foreach($workers as $workers):?> 
                  <option value="<?=$workers['id']?>"><?=$workers['name']?></option>;
                    <?php endforeach;?>
                </select>
          </td>
          <td><?=$repairs['SERVICES']?></td>
          <td class="noprint" style="width:180px; ">
            <div class= buttonHide>
              <button hidden class="btn btn-info btn-sm" href=#my_modal data-toggle= "modal" data-name="repairs-det" data-service= '<?=$repairs['SERVICES']?>'  data-cartypeid= <?=$repairs['CAR_TYPE_ID']?> data-carname= '<?=$repairs['CARS_NAME']?>' data-startdate=<?=$repairs['START_DATE']?>  data-id=<?=$repairs['REPAIR_ID']?>>Детали</button>                                           
              <form method="post">
                <input type='hidden' name='REPAIR_ID' value=<?=$repairs['REPAIR_ID']?>>
                <button class="btn btn-secondary btn-sm" onclick="clicked(event)" data-id=<?=$repairs['REPAIR_ID']?>>Закрыть</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach;?>
    </tbody>  
  </table>
</div>

<div class="form-group float-right" style="padding:10px; position: fixed; z-index:1;top: 60px;right: 2%;">
    <div class="noprint">
      <button href=#repairAdd data-toggle= "modal" class="btn btn-info">Новый ремонт</button>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="repairAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id= "repairAdd_modal-hrader">
        <h2>Создание нового ремонта<h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body" style=" border: 1px solid #e8e8e8; padding-top:35px; padding-left:125px;">

              <div class="form-group row">
                <label class="col-sm-5 col-form-label-lg" for="get_ts">ТС:</label>
                <div class="col-sm-6">
                  
                  <select data-live-search="true" class="custom-select custom-select-lg" id="get_ts" name="ts" required>
                    <option value="">выберите ТС</option>
                      <?php $carName = get_carName();
                      foreach($carName as $carName):?>
                    <option value=<?=$carName['id']?>><?=$carName['name']?></option>
                      <?php endforeach?>
                  </select>
                  
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-sm-5 col-form-label-lg" for="StartDate" >Начало ремонта:</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control form-control-lg" placeholder="col-form-label" name="StartDate" value="">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-5 col-form-label-lg" for="get_repair_type">Тип ремонта:</label>
                <div class="col-sm-6">
                  <select class="custom-select custom-select-lg" id="get_repair_type" name="repairType" required>
                    <option value="">выберите Тип ремонта</option>
                      <?php $repairsType = get_repairsType();?>
                      <?php foreach($repairsType as $repairsType):?>
                    <option value=<?=$repairsType['ID']?>><?=$repairsType['NAME']?></option>
                      <?php endforeach;?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-5 col-form-label-lg" for="repairWorking" >Работы по ремонту:</label>
                <div class="col-sm-6">
                  <textarea type="text" class="form-control form-control-lg" placeholder="" name="repairWorking" value=""></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-5 col-form-label-lg" for="EndDate">Плановый конец ремонта:</label>
                <div class="col-sm-6">
                  <input class="form-control form-control-lg" type="date" name="EndDate" value="">
                </div>
              </div> 
              
              <div class="form-group row">
                <label class="col-sm-5 col-form-label-lg" for="get_service">Автосервис:</label>
                <div class="col-sm-6">
                <select class="custom-select custom-select-lg" id="get_service" name="sto" required>
                  <option value="">выберите Автосервис</option>
                    <?php $serviceName = get_serviceName();
                    foreach($serviceName as $serviceName):?>
                  <option value=<?=$serviceName['ID']?>><?=$serviceName['NAME']?></option>
                    <?php endforeach?>
                </select>
                </div>
              </div> 
      </div>
      <div id= "repairAdd_modal-footer" class="modal-footer">
          <button name="submit" type="submit" class="btn btn-success">Сохранить</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
      </form>
    </div>
</div>
</div>

<?php include_once("deteils-modal.php");?>


<!--- Модальное окно добавления точек---------------------------------------------------------------------------->


<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="addPoints_modal" >
<div class="modal-dialog modal-dialog-centered modal-xl">
<div class="modal-content" style="width: 100%;">
    <div class="modal-header">
        <h5 class="modal-title">Выберите точки для добавления в ремонт.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
        <div class="container">
            <div class="form-group inline">
                <button id="btn_add_points" type="button" class="btn btn-success" data-dismiss="modal">Добавить выбранные в ремонт</button>
                <input hidden type="text" id="addPoints_modal_repair_id">
                <input type="text" class="form-control float-right" style="width:40%;" id="searchAddPoints" placeholder="Поиск по точкам">
            </div>
            <div class="modalAddDetails_content" style="height: 370px ; overflow: auto; border: 1px solid rgb(199, 194, 194); ">
            <table class="table table-bordered table-sm table-hover" id="mytable" cellspacing="0" style="width: 100%;">
                <thead class="thead-dark">
                    <tr role="row">
                        <th>Блок систем</th>
                        <th>Система</th>
                        <th>Точка</th>
                        <th>Размещение</th>
                        <th>Выбрать</th>
                    </tr>
                </thead> 
            </table>
            </div>
        </div>
        </div>
    </div>
    <div class="modal-footer" style="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
    </div>
</div>
</div>
</div>





<nav class="context-menu" id="context-menu">
  <ul class="context-menu__items">
    <li class="context-menu__item">
      <a href=#repairAdd data-toggle= "modal" class="context-menu__link">
        <i class="fa fa-eye"></i> Новый ремонт
      </a>
    </li>
    <li class="context-menu__item">
      <a href=#my_modal data-toggle= "modal" class="context-menu__link">
        <i class="fa fa-eye"></i> Открыть ремонт
      </a>
    </li>
    <li class="context-menu__item">
      <a href="#" class="context-menu__link">
        <i class="fa fa-times"></i> Закрыть ремонт
      </a>
    </li>
  </ul>
</nav>





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






<script>

(function() {
  
  "use strict";

  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////
  //
  // H E L P E R    F U N C T I O N S
  //
  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////

  /**
   * Function to check if we clicked inside an element with a particular class
   * name.
   * 
   * @param {Object} e The event
   * @param {String} className The class name to check against
   * @return {Boolean}
   */
  function clickInsideElement( e, className ) {
    var el = e.srcElement || e.target;
    
    if ( el.classList.contains(className) ) {
      return el;
    } else {
      while ( el = el.parentNode ) {
        if ( el.classList && el.classList.contains(className) ) {
          return el;
        }
      }
    }

    return false;
  }

  /**
   * Get's exact position of event.
   * 
   * @param {Object} e The event passed in
   * @return {Object} Returns the x and y position
   */
  function getPosition(e) {
    var posx = 0;
    var posy = 0;

    if (!e) var e = window.event;
    
    if (e.pageX || e.pageY) {
      posx = e.pageX;
      posy = e.pageY;
    } else if (e.clientX || e.clientY) {
      posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
      posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
    }

    return {
      x: posx,
      y: posy
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////
  //
  // C O R E    F U N C T I O N S
  //
  //////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////
  
  /**
   * Variables.
   */
  var contextMenuClassName = "context-menu";
  var contextMenuItemClassName = "context-menu__item";
  var contextMenuLinkClassName = "context-menu__link";
  var contextMenuActive = "context-menu--active";

  var taskItemClassName = "task";
  var taskItemInContext;

  var clickCoords;
  var clickCoordsX;
  var clickCoordsY;

  var menu = document.querySelector("#context-menu");
  var menuItems = menu.querySelectorAll(".context-menu__item");
  var menuState = 0;
  var menuWidth;
  var menuHeight;
  var menuPosition;
  var menuPositionX;
  var menuPositionY;

  var windowWidth;
  var windowHeight;

  /**
   * Initialise our application's code.
   */
  function init() {
    contextListener();
    clickListener();
    keyupListener();
    resizeListener();
  }

  /**
   * Listens for contextmenu events.
   */
  function contextListener() {
    document.addEventListener( "contextmenu", function(e) {
      taskItemInContext = clickInsideElement( e, taskItemClassName );

      if ( taskItemInContext ) {
        e.preventDefault();
        toggleMenuOn();
        positionMenu(e);
      } else {
        taskItemInContext = null;
        toggleMenuOff();
      }
    });
  }

  /**
   * Listens for click events.
   */
  function clickListener() {
    document.addEventListener( "click", function(e) {
      var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );

      if ( clickeElIsLink ) {
        e.preventDefault();
        menuItemListener( clickeElIsLink );
      } else {
        var button = e.which || e.button;
        if ( button === 1 ) {
          toggleMenuOff();
        }
      }
    });
  }

  /**
   * Listens for keyup events.
   */
  function keyupListener() {
    window.onkeyup = function(e) {
      if ( e.keyCode === 27 ) {
        toggleMenuOff();
      }
    }
  }

  /**
   * Window resize event listener
   */
  function resizeListener() {
    window.onresize = function(e) {
      toggleMenuOff();
    };
  }

  /**
   * Turns the custom context menu on.
   */
  function toggleMenuOn() {
    if ( menuState !== 1 ) {
      menuState = 1;
      menu.classList.add( contextMenuActive );
    }
  }

  /**
   * Turns the custom context menu off.
   */
  function toggleMenuOff() {
    if ( menuState !== 0 ) {
      menuState = 0;
      menu.classList.remove( contextMenuActive );
    }
  }

  /**
   * Positions the menu properly.
   * 
   * @param {Object} e The event
   */
  function positionMenu(e) {
    clickCoords = getPosition(e);
    clickCoordsX = clickCoords.x;
    clickCoordsY = clickCoords.y;

    menuWidth = menu.offsetWidth + 4;
    menuHeight = menu.offsetHeight + 4;

    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;

    if ( (windowWidth - clickCoordsX) < menuWidth ) {
      menu.style.left = windowWidth - menuWidth + "px";
    } else {
      menu.style.left = clickCoordsX + "px";
    }

    if ( (windowHeight - clickCoordsY) < menuHeight ) {
      menu.style.top = windowHeight - menuHeight + "px";
    } else {
      menu.style.top = clickCoordsY + "px";
    }
  }

  /**
   * Dummy action function that logs an action when a menu item link is clicked
   * 
   * @param {HTMLElement} link The link that was clicked
   */
  function menuItemListener( link ) {
    console.log( "Task ID - " + taskItemInContext.getAttribute("data-id") + ", Task action - " + link.getAttribute("data-action"));
    toggleMenuOff();
  }

  /**
   * Run the app.
   */
  init();

})();

</script>