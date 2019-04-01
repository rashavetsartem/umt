<?php
session_start();
//Страница открывается только если слать запрос
if (!$_POST)  exit();
//Проверим логин и пароль
if (empty($_POST["inputLogin"]) || empty($_POST["inputPassword"]))
{
  die("Поля логин и пароль обязательные!");
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$link = new mysqli('localhost', 'root', '', 'artem_umt'); // Соединяемся с базой

  // Ругаемся, если соединение установить не удалось
  if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
  }

  // Проверка кодировки
  if (!mysqli_set_charset($link, "utf8")) {
      printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($link));
          exit();
      } else {
          ;
  }
if ($link)
{     
    //Ищем в базе нашего пользователя
    $SQL = "SELECT * FROM `users` WHERE `login` =  '".$_POST["inputLogin"]."' AND `password` = '".$_POST["inputPassword"]."'";
    $result = mysqli_query($link, $SQL);
    if (!$result || mysqli_num_rows($result) == 0)
    {
      mysqli_close($link);
      die("Неправильный пароль!");
    };
    while($row=mysqli_fetch_array($result))
    {
      setcookie('user_role_id', $row['USERS_ROLE_ID']);
      setcookie('user_name', $row['NAME']);
      setcookie('user_id',$row['ID']);
      
      $_SESSION['userid'] = $row['ID'];
      $_SESSION['user_name'] = $row['NAME'];
      $_SESSION['user_role_id'] = $row['USERS_ROLE_ID'];
    }
    
}
else
{
  die("Не могу присоедениться к серверу!");
}
?>
<script>
window.location.href = 'http://1.2.3.20/Cartochka-prj1/repairs.php';
</script>