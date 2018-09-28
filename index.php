<?php 
include('src/db/database.php');
include('src/models/todo.php');
include('src/models/user.php');

if(!isset($_SESSION)){
  session_start();
};

if (!$_SESSION["token"]) {
  header('Location:/php-auth/signup.php');
}

$user=new User;
$you = $user->fetchByToken($_SESSION["token"])->fetch_assoc();

if (!$you) {
  header('Location:/php-auth/signup.php');
}
if(isset($_POST['id']) && !empty($_POST['id'])){
  $todo = new todo;
  $id = $_POST['id'];
  $todo->delete($id);
  header('Location:/php-auth/index.php');
}
if(isset($_POST['logout']) ){
  session_destroy();
  header('Location:/php-auth/login.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>PHP-Project</title>
  </head>
  <body>

    
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search">
              <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
    </div>


    <div class="container">
         <div class="row">
           <div class="col-8 text-center offset-2 mt-5">
            

            <h1>Todos</h1>


            <ul class="list-group">
              <?php
              $todo = new Todo;
              $results = $todo->index($you['id']);

              while ($row = $results->fetch_assoc()) {
                
              ?>
              
              <li class="list-group-item d-flex justify-content-between align-items-center">

                <a href="http://localhost/php-auth/show.php?id=<?php echo $row['id'] ?>
                ">
                  <p class="text-left mr-5"> <?php echo $row['body']; ?> </p>   
                </a>

                <div class="d-flex justify-content-between align-items-center"> 
                <a href="http://localhost/php-native/edit.php?id=<?php echo $row['id'] ?>">
                  <button name="submit" class="btn btn-success mr-3">Edit</button>
                </a>

                <form action='#' method="post">
                  <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                  <button name="submit" class="btn btn-danger">Delete</button>
                </form>

                </div>
              </li> 
              <?php
              };
              ?>
            </ul>


            <a href="http://localhost/php-auth/create.php"><button class="btn btn-dark mt-3">Add Todo</button></a>


          </div>
         </div>
         <form method="post" action="index.php" >
          <input type="hidden" name="logout">
           <button class="btn btn-primary" value="submit">Logout</button>
         </form>
    </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>