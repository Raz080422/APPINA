<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
	<link rel="stylesheet" href="{{ asset('assets/login/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/login/css/roboto.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    <link href="{{ asset('css/alert.css') }}" rel="stylesheet"> 

    <title>APPINA Dashboard</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        
        <div class="col-md-5 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
				<div class="mb-3">
					<img src="{{ asset('assets/login/images/logo_ina.png') }}" alt="Image" class="img-fluid">		  
				</div>
				<div class="mb-3">
					<h2>Sign In to INA Project</h2>		  
				</div>
				<form action="{{ url('do-login') }}" method="post">
          @csrf
				  <div class="form-group first">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" autocomplete="off">

				  </div>
				  <div class="form-group last mb-4">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" autocomplete="off">
					
				  </div>              

				  <input type="submit" value="Log In" class="btn btn-block btn-primary">
				</form>
            </div>
          </div>
          
        </div>
		
        <div class="col-md-6">
          <img src="{{ asset('assets/login/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
        </div>
		
      </div>
    </div>
  </div>

  <div id="flash_msg" style="display: none;">
      <div class="alert alert-dismissible alert-success" role="alert">
          <button type="button" class="close" aria-label="Close" onclick="closeFlashAlert()">
              <span aria-hidden="true">×</span>
          </button>
          <span class="alert-inner--text">
              <strong id="alert-title">Success</strong><br>
              <span id="alert-message">Data Berhasil Disimpan</span>
          </span>
      </div>
  </div>
  
    <script src="{{ asset('assets/login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/main.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>

    <script>
      $(function(){
        @if(Session::has('message'))
            @php
                $flashmsg = explode('|', Session::get("message"));
                $type = $flashmsg[0];
                $msg = $flashmsg[1];
                if ($errors->any())
                    $error_msg = '<br>'.implode('<br>', $errors->all());
                else
                    $error_msg = '';
            @endphp

            var type = '@php echo $type @endphp';
            var msg = '@php echo $msg . $error_msg @endphp';
            

        @endif

        setTimeout(function() {
            window.location.reload();
        }, 1800000);
      });
    </script>
  </body>
</html>