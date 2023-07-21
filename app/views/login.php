<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <main class="form-signin">
  <div class="container">
 <?php if(isset($error)):?>
<div class="m-4" id="myAlert">
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Info!</h4>
  <?php echo $error;?>
 </div>
 <?php endif;?>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Please sign in</h5>
            <form action="/user/login" method="POST">
              <div class="form-group">
                <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-primary">Sign in</button>
            </form>            
          </div>
        </div>
      </div>
    </div>
    <p class="mt-2 mb-3 text-center">&copy; <?=date('Y')?> <a class="text-reset fw-bold" href="https://www.linkedin.com/in/angelomorais/" target="_blank">- Ângelo Morais</a></p>
  </div>
</main>
  <script>
  setTimeout(function() {
    document.getElementById('myAlert').style.display = 'none';
  }, 2000);
</script>
</body>

</html>
