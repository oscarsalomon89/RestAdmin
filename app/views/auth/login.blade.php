<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  

    {{HTML::style('http://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300')}}  
    {{HTML::style('css/bootstrap.css')}}
    {{HTML::style('css/style.css')}}
    {{HTML::style('font-awesome/css/font-awesome.min.css')}}

  <link href="assets/favicon.ico" rel="shortcut icon" />
  <link href="assets/apple-touch-icon.png" rel="apple-touch-icon" />
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    @javascript html5shiv respond.min
  <![endif]-->

  <title>Login</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

<div class="all-wrapper no-menu-wrapper">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <div class="content-wrapper bold-shadow">
        <div class="content-inner">
          <div class="main-content main-content-grey-gradient no-page-header">
            @if(isset($error))
       <p> <strong> {{ $error }} </strong> </p>
    @endif 
    {{ Form::open(array('url' => 'auth/login')) }} 
    <h3 class="form-title form-title-first"><i class="icon-lock"></i> Inicio de sesion</h3>
    <div class="form-group">
       {{ Form::label('name', 'Usuario') }}
       {{ Form::text('name', '',array('class'=>'form-control','placeholder'=>'nombre', 'autocomplete'=>'of')) }}
    </div>
    <div class="form-group">
       {{ Form::label('password', 'Contraseña') }}
       <input class="form-control" placeholder="Password" autocomplete="of" name="password" type="password" value="" id="password">
    </div>
       {{ Form::submit('Log me',array('class'=>'btn btn-primary')) }} 
       <a href="index.html" class="btn btn-link">Cancel</a>
    {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>