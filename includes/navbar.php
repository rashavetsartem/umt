<nav class="navbar navbar-light fixed-top navbar-expand-lg" style="background-color: #ffffff; border-bottom: 1px solid #d6d6d6;">
  <img src="/images/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
  <a class="navbar-brand" href="#">Cartochka</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ремонты
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="repairs.php" >Открытые</a>
            <a class="dropdown-item" href="repairs-all.php">Все ремонты</a>
          </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Заказы
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Текущий месяц</a>
            <a class="dropdown-item" href="orders.php">Все заказы</a>
          </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Рекламации
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="reclamations.php">В работе</a>
            <a class="dropdown-item" href="reclamations-all.php" id="defaultOpen">Все рекламации</a>
          </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Служебные
        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="cars-status.php">Статус авто</a>
            <a class="dropdown-item" href="repair-schedule.php" id="defaultOpen">График ремонтов</a>
            <a class="dropdown-item" href="admin-panel.php" id="defaultOpen">Администрирование</a>
          </div>
      </li>
    </ul>
  </div>
  <input type="text" class="form-control float-right" style="width:25%; margin: 5px; margin-right: 19px;" id="search" placeholder="Поиск...">
    <div style="margin-right: 10px;">
      <?php echo $_SESSION['user_name'];?>
    </div>
    <button class="btn btn-outline-dark" onclick="window.location.href='logout.php'">Выход</button>
</nav>
<hr>