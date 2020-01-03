<?php
    // Start the session
    session_start();
    date_default_timezone_set('America/Los_Angeles');

    $characters       = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString     = '';

    for ($i = 0; $i < 32; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
  	//Genrate Random Key
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Encrypt And Decrypt Form Data Using PHP Ajax</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

  	<form class="form-material container" method="post" id="login_form" >
      <h1>Encrypt And Decrypt Form Data Using PHP Ajax</h1>
  		<input type="hidden" name="enckey" id="enckey" value="<?php echo $randomString; ?>">
      <div class="login row">
          <div class="col-md-6 form-group">
            <input class="form-control" type="text" placeholder="Username" id="username" name="username">
          </div>  
          <div class="col-md-6 form-group">  
            <input class="form-control" type="password" placeholder="password" id="password"  name="password">
          </div>  
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="forgot">forgot password?</a>
          <input type="submit" value="Sign In">
        </div>
      </div>
      <div class="shadow"></div>
  	</form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script src="js/cryptor.js"></script>
  	<script src="js/endecryption.js"></script>

  	<script type="text/javascript">

      $(document).ready(function() {
    		$("#login_form").submit(function(e) {
          e.preventDefault();
          let encryption = new Encryption();
          var nonceValue =	$('#enckey').val();

          var form_data  = $('#login_form').serializeArray().reduce(function(obj, item) {
              if (item.name != "enckey") {
                  obj[item.name] = encryption.encrypt(item.value,nonceValue);
              } else {
                obj[item.name] = item.value;
              }
              return obj;
            }, {}
          );

          $.ajax({
             type: "POST",
             url: 'post.php',
             data: form_data, // serializes the form's elements.
             success: function(data) {
                 alert(data); // show response from the php script.
             }
           });

        });
      });
      
    </script>
  </body>

</html>