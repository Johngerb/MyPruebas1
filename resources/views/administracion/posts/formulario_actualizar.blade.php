
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
       
            <h2>Formulario de Actualizar</h2>
            <br>
            <form class="form-horizontal"  method="post" action="{{ route('actualizar')}}"  enctype="multipart/form-data"> 
                {{ method_field('PUT') }}
                @csrf

                <input class="form-control" readonly type="text" id="userId" name="userId" value="1" required>
                <br>
                <p> Ingrese el ID </p>
                <input class="form-control"  type="text" id="id" name="id"  required>
                <p> Ingrese el title </p>
                <input class="form-control"  type="text" id="title" name="title"  required>
                <p> Ingrese el body </p>
                <input class="form-control"  type="text" id="body" name="body"  required>

                 <br>
    
                <input type="submit" class="btn btn-primary" value="Guardar">
    
    
            </form>
    </div>


</body>
</html>
