<?php
require_once("./lib/api.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $original = $_FILES['upfile'];
    if(!isset($original)){
        die("<script>alert('file empty!'); history.go(-1); </script>");
    }
    upload($original);
}
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simpleweb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body><br>
    <center>
      <form method="POST" enctype="multipart/form-data">
        <input type="file" class="form-control" name="upfile" />
        <br>
        <button type="submit" class="btn btn-outline-success"> Upload </button>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>