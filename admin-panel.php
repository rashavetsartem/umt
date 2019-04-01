<?php include_once("includes/header.php");?>
<?php include_once("includes/navbar.php");?>
<?php include_once("includes/functions.php");?>

<?php
    if (isset($_POST['carName'])) {
        require("includes/connection.php");
        $stmt = $db->query("UPDATE cars 
            SET 
                NAME = '".$_POST['carName']."', 
                REGNUMBER = '".$_POST['regnumber']."',
                INNERNUMBER = '".$_POST['innernumber']."',
                YEAR_MAKE = '".$_POST['yearMake']."'

            WHERE ID = '".$_POST['carId']."'");

        header('location: admin-panel.php');
    }
?>


<div class="container-fluid" style="margin-top:60px;">
    <ul class="nav nav-tabs" id="adminTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="ts-tab" data-toggle="tab" href="#ts" role="tab" aria-controls="ts" aria-selected="true">Транспортные средства</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="clients-tab" data-toggle="tab" href="#clients" role="tab" aria-controls="clients" aria-selected="false">Клиенты</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="services-tab" data-toggle="tab" href="#services" role="tab" aria-controls="services" aria-selected="false">Автосервисы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="workers-tab" data-toggle="tab" href="#workers" role="tab" aria-controls="workers" aria-selected="false">Сотрудники</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Пользователи</a>
        </li>
    </ul>
    <div class="tab-content" id="adminTabContent">
        <div class="tab-pane fade show active" id="ts" role="tabpanel" aria-labelledby="home-tab" style="border: 1px solid grey;">
            <table class="table table-bordered table-sm table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>CARS_MODEL_ID</th>
                        <th>CARS_TYPE_ID</th>
                        <th>REGNUMBER</th>
                        <th>INNERNUMBER</th>
                        <th>YEAR_MAKE</th>
                        <th>VIN_CODE</th>
                        <th>CAR_ID_GPS</th>
                        <th>WORKERS_ID</th>
                    </tr>

                    <?php
                        $cars = get_cars();
                        foreach($cars as $row): ?>
                    <tr 
                    data-id="<?=$row['ID']?>" 
                    data-trname="cars_tr" 
                    data-carname="<?=$row['NAME']?>" 
                    data-carsmodelid="<?=$row['CARS_MODEL_ID']?>" 
                    data-carstypeid="<?=$row['CARS_TYPE_ID']?>" 
                    data-regnumber="<?=$row['REGNUMBER']?>" 
                    data-innernumber="<?=$row['INNERNUMBER']?>" 
                    data-yearmake="<?=$row['YEAR_MAKE']?>" 
                    data-vincode="<?=$row['VIN_CODE']?>" 
                    data-caridgps="<?=$row['CAR_ID_GPS']?>" 
                    data-workersid="<?=$row['WORKERS_ID']?>"
                    >
                        <td><?=$row['ID']?></td>
                        <td><?=$row['NAME']?></td>
                        <td><?=$row['CARS_MODEL_ID']?></td>
                        <td><?=$row['CARS_TYPE_ID']?></td>
                        <td><?=$row['REGNUMBER']?></td>
                        <td><?=$row['INNERNUMBER']?></td>
                        <td><?=$row['YEAR_MAKE']?></td>
                        <td><?=$row['VIN_CODE']?></td>
                        <td><?=$row['CAR_ID_GPS']?></td>
                        <td><?=$row['WORKERS_ID']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>    
            </table>    
        </div>

        <div class="tab-pane fade" id="clients" role="tabpanel" aria-labelledby="profile-tab" >
            <table class="table table-bordered table-sm table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>ADRESS</th>
                        <th>PHONE</th>
                        <th>CONTACT</th>
                    </tr>

                    <?php
                        $clients = get_clients();
                        foreach($clients as $row): ?>
                    <tr 
                    data-id="<?=$row['ID']?>" 
                    data-trname="clients_tr" 
                    data-carname="<?=$row['NAME']?>" 
                    data-adress="<?=$row['ADRESS']?>" 
                    data-phone="<?=$row['PHONE']?>" 
                    data-contact="<?=$row['CONTACT']?>" 
                    >
                        <td><?=$row['ID']?></td>
                        <td><?=$row['NAME']?></td>
                        <td><?=$row['ADRESS']?></td>
                        <td><?=$row['PHONE']?></td>
                        <td><?=$row['CONTACT']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>    
            </table>
        </div>

        <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="contact-tab">
            <table class="table table-bordered table-sm table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>ADRESS</th>
                        <th>PHONE</th>
                        <th>CONTACT</th>
                    </tr>

                    <?php
                        $services = get_services();
                        foreach($services as $row): ?>
                    <tr 
                    data-id="<?=$row['ID']?>" 
                    data-trname="clients_tr" 
                    data-carname="<?=$row['NAME']?>" 
                    data-adress="<?=$row['ADRESS']?>" 
                    data-phone="<?=$row['PHONE']?>" 
                    data-contact="<?=$row['CONTACT']?>" 
                    >
                        <td><?=$row['ID']?></td>
                        <td><?=$row['NAME']?></td>
                        <td><?=$row['ADRESS']?></td>
                        <td><?=$row['PHONE']?></td>
                        <td><?=$row['CONTACT']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>    
            </table>
        </div>
        
        <div class="tab-pane fade" id="workers" role="tabpanel" aria-labelledby="contact-tab">
            <table class="table table-bordered table-sm table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>WORKERS_POSITION_ID</th>
                    </tr>

                    <?php
                        $workersAll = get_workersAll();
                        foreach($workersAll as $row): ?>
                    <tr 
                    data-id="<?=$row['ID']?>" 
                    data-trname="clients_tr" 
                    data-carname="<?=$row['NAME']?>" 
                    data-adress="<?=$row['WORKERS_POSITION_ID']?>" 
                    >
                        <td><?=$row['ID']?></td>
                        <td><?=$row['NAME']?></td>
                        <td><?=$row['WORKERS_POSITION_ID']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>    
            </table>
        </div>
        
        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="contact-tab">
            <table class="table table-bordered table-sm table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>login</th>
                        <th>hash</th>
                        <th>user_ip</th>
                        <th>NAME</th>
                        <th>USERNAME</th>
 
                        <th>USERS_ROLE_ID</th>
                        <th>user_start_page</th>
                    </tr>

                    <?php
                        $users = get_users();
                        foreach($users as $row): ?>
                    <tr 
                        data-id="<?=$row['ID']?>" 
                        data-trname="clients_tr" 
                        data-carname="<?=$row['login']?>" 
                        data-adress="<?=$row['hash']?>" 
                        data-carname="<?=$row['user_ip']?>" 
                        data-adress="<?=$row['NAME']?>" 
                        data-carname="<?=$row['USERNAME']?>" 

                        data-carname="<?=$row['USERS_ROLE_ID']?>" 
                        data-adress="<?=$row['user_start_page']?>" 
                    >
                        <td><?=$row['ID']?></td>
                        <td><?=$row['login']?></td>
                        <td><?=$row['hash']?></td>
                        <td><?=$row['user_ip']?></td>
                        <td><?=$row['NAME']?></td>
                        <td><?=$row['USERNAME']?></td>

                        <td><?=$row['USERS_ROLE_ID']?></td>
                        <td><?=$row['user_start_page']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>    
            </table>
        </div>
    </div>
</div>

<style>
.form-row{
    margin: 5px;
} 
</style>

<div class="carEdit" id="carEdit" hidden>
    <div class='form-row' id='form-row'>
        <div class= "col">
        <div class="form-group">
            <label for="carId">Код</label>
            <input id= "carId" name= "carId" class="form-control form-control-sm" type="text" value="">               
        </div>
        </div>

        <div class= "col">
        <div class="form-group">
            <label for="carName">Имя</label>
            <input id= "carName" name= "carName" class="form-control form-control-sm" type="text" value="">
        </div>
        </div>
    </div>

    <div class='form-row' id='form-row'>
        <div class= "col">
        <div class="form-group">
                <label for="carsModelId">Модель</label>
                <select class="form-control" data-id="" data-name="reclamation_result">
                  <option value="" name= "carsModelId" id= "carsModelId"></option>
                    <?php $cars_models = get_carsModels();
                    foreach($cars_models as $cars_models):?> 
                  <option value="<?=$cars_models['ID']?>"><?=$cars_models['NAME']?></option>;
                    <?php endforeach;?>
                </select>              
        </div>
        </div>
        <div class= "col">
        <div class="form-group">
                <label for="carsTypeId">Тип</label>
                <select class="form-control" data-id="" data-name="reclamation_result">
                  <option value="" name= "carsTypeId" id= "carsTypeId"></option>
                    <?php $cars_type = get_carsType();
                    foreach($cars_type as $cars_type):?> 
                  <option value="<?=$cars_type['ID']?>"><?=$cars_type['NAME']?></option>;
                    <?php endforeach;?>
                </select>  
        </div>
        </div>
    </div>

    <div class='form-row' id='form-row'>
        <div class= "col">
        <div class="form-group">
            <label for="regnumber">Регистрационный номер</label>
            <input id= "regnumber" name= "regnumber" class="form-control form-control-sm" type="text" value="">               
        </div>
        </div>
        <div class= "col">
        <div class="form-group">
            <label for="innernumber">Гаражный номер</label>
            <input id= "innernumber" name= "innernumber" class="form-control form-control-sm" type="text" value="">
        </div>
        </div>
    </div>

    <div class='form-row' id='form-row'>
        <div class= "col">
        <div class="form-group">
            <label for="yearMake">Год выпуска</label>
            <input id= "yearMake" name= "yearMake" class="form-control form-control-sm" type="text" value="">               
        </div>
        </div>
        <div class= "col">
        <div class="form-group">
            <label for="vinCode">Вин код</label>
            <input id= "vinCode" name= "vinCode" class="form-control form-control-sm" type="text" value="">
        </div>
        </div>
    </div>

    <div class='form-row' id='form-row'>
        <div class= "col">
        <div class="form-group">
            <label for="carIdGps">GPS номер</label>
            <input id= "carIdGps" name= "carIdGps" class="form-control form-control-sm" type="text" value="">               
        </div>
        </div>
        <div class= "col">
        <div class="form-group">
            <label for="workersId">Сотрудник</label>
             <select class="form-control" data-id="" data-name="reclamation_result">
               <option value="" name= "workersId" id= "workersId"></option>
                 <?php $drivers = get_drivers();
                 foreach($drivers as $drivers):?> 
               <option value="<?=$drivers['ID']?>"><?=$drivers['NAME']?></option>;
                 <?php endforeach;?>
             </select>  
        </div>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" id="my_modal">
<div class="modal-dialog modal-dialog-centered modal-lg" id="modal_dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id= "modal-header">
          <div class="form-row">
              <h4>Карточка транспортного средства<h4>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body" id="modal-body">
        <form method="post" class="form-edit" id="form-edit" action='admin-panel.php'>

        </form>
      </div>
      <div id= "modal-footer" class="modal-footer">
        <button type="submit" form="form-edit" class="btn btn-success">Сохранить</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
</div>
</div>


<?php include_once("includes/footer.php");?>
<?php include_once("includes/scripts.php");?> 

<script>



$("tr").dblclick(function(){

    var id = $(this).data('id');
    var trName = $(this).data('trname');
    var carName = $(this).data('carname');
    var carsModelId = $(this).data('carsmodelid');
    var carsTypeId = $(this).data('carstypeid');
    var regnumber = $(this).data('regnumber');
    var innernumber = $(this).data('innernumber');
    var yearMake = $(this).data('yearmake');
    var vinCode = $(this).data('vincode');
    var carIdGps = $(this).data('caridgps');
    var workersId = $(this).data('workersid');
    
    var carEdit = $('#carEdit');
     
    $('#my_modal').on('show.bs.modal', function(e) {
        $('#carId').val(id);
        $('#carName').val(carName);
        $('#carsModelId').text(carsModelId);
        $('#carsModelId').val(carsModelId);
        $('#carsTypeId').text(carsTypeId);
        $('#carsTypeId').val(carsTypeId);
        $('#regnumber').val(regnumber);
        $('#innernumber').val(innernumber);
        $('#yearMake').val(yearMake);
        $('#vinCode').val(vinCode);
        $('#carIdGps').val(carIdGps);
        $('#workersId').val(workersId);

        $('#carEdit').removeAttr("hidden");
        $('#carEdit').appendTo('#form-edit');

    });
    $('#my_modal').modal('show');
});


</script>