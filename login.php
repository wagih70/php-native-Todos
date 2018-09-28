<?php
include('src/db/database.php');
include('src/models/user.php');



if(isset($_POST['inputEmail']) && !empty($_POST['inputEmail']) && isset($_POST['inputPassword']) && !empty($_POST['inputPassword'])) {
  
  $user = new User;
  $email = $_POST['inputEmail'];
  $password = crypt($_POST['inputPassword'],'123'); 
  $you=$user->login($email,$password)->fetch_assoc();
  if($you){
      $token = bin2hex(random_bytes(64));
      $user->generateToken($email,$password,$token);
      $_SESSION["token"] = $token;
      header('Location:/php-auth/index.php');
    }else{
      header('Location:/php-auth/signup.php');
    }
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

   <!--  =================================== main content =================================== -->
   <div class="text-center container">
       <div class="row">
         <form class="form-signin col-md-4 mt-5 pt-5 offset-md-4" action="login.php" method="post">
           <h1 class="h3 mb-3 font-weight-normal">Please login</h1>
           <label for="inputEmail" class="sr-only">Email address</label>
           <input type="email" name="inputEmail" class="form-control mt-2" placeholder="Email address" required autofocus>
           <label for="inputPassword" class="sr-only">Password</label>
           <input type="password" name="inputPassword" class="form-control mt-2 mb-3" placeholder="Password" required>
           <div class="checkbox mb-3">
             <label>
               <input type="checkbox" value="remember-me"> Remember me
             </label>
           </div>
           <button id="login-btn" class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Login </button>
           <p class="mt-5 mb-3 text-muted">Copy Rights &copy;</p>
         </form>
       </div>
     </div>


     <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>