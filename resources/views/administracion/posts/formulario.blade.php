<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
    <body>
    
        <div class="container">

                <h2>Formulario de Registro</h2>
                <br>

                <form class="form-horizontal" id="form" method="post" action="{{ route('guardar_post')}}"> 
                    @csrf <!-- para hacer Proteger   -->
                    
                    <p>Ingrese el Id</p>
                    <input class="form-control" type="text" id="id" name="id" placeholder="Ingrese el Id" required="">
                    
                    <p>Ingrese el User Id</p>
                    <input class="form-control" type="text" id="userId" name="userId" placeholder="Ingrese el Id" required="">
                    
                    <p>Ingrese el title</p>
                    <input class="form-control" type="text" id="title" name="title" placeholder="Ingrese el Id" required="">
                    
                    <p>Ingrese el Body</p>
                    <input class="form-control" type="text" id="body" name="body" placeholder="Ingrese el Id" required="">
                    
                    <br>
                    <input type="submit" class="btn btn-primary" value="Guardar">
                                     
                </form>        
        </div>

    </body>
</html>
