<!doctype html>
<html lang="en">
  <head>
    <meta name="robots" content="none"/>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Cartochka Login</title>
  </head>
<style>

.text-center {
text-align: center!important;
}
html,

body {
  width:100%;
  height: 100%;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #e8e8e8;
}

.form-signin {
  width: 100%;
  max-width: 430px;
  padding: 15px;
  margin: auto;
  border: 1px solid grey;
  background: white;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>



<body class="text-center">
    <form class="form-signin" action="intropage.php" method="post">
        <p style="font-size:40px;"><img class="mb-4" src="/images/logo.jpg" alt="" width="72" height="72">Cartochka</p>

        <label for="inputLogin" class="sr-only">Имя пользователя</label>
        <input type="text" id="inputLogin" name="inputLogin" class="form-control" placeholder="Имя пользователя" required="" >
        <label></label>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Пароль" required="">
        <div class="checkbox mb-3">
            <label>
            
            </label>
        </div>
        <button class="btn btn-outline-dark btn-block" type="submit">Вход</button>
        <p class="mt-5 mb-3 text-muted">© 2018-2019</p>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>