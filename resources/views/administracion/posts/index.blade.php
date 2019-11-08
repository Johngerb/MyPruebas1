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
  <h2>Pruebas Web Service</h2>
  <div class="panel-group">

    @foreach ($posts as $post)
       <div class="panel panel-primary">
       <div class="panel-heading"><a style="color:white" href="{{route('detalle', $post->id) }}" > {{$post->title}} </a></div>
            <div class="panel-body">{{$post->body}}</div>
       </div>
    @endforeach
  
  </div>
</div>

</body>
</html>
