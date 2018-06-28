<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Examen</title>
  <link rel="stylesheet" href="bootstrap/bootstrap-4.1.1-dist/css/bootstrap.css">
  <script type="text/javascript" src="bootstrap/bootstrap-4.1.1-dist/js/bootstrap.js">
  </script>
</head>
  <body>
    <div class="container">
      <div class="jumbotron">
        <h1>Examen Segundo parcial</h1>
        <p></p>
      </div>
    </div>
    <div class="container">
      <?php
      $servername="localhost";
      $username="root";
      $pass="";
      $db="bdusuarios";
      $conexion=mysqli_connect($servername,$username,$pass,$db);
      if(isset($_POST["submit"])){
        $nombre=$_POST["nombre"];
        $salario=$_POST["salario"];
        $archivoOrigen=$_FILES["fileToUpload"]["tmp_name"];
        $archivoDestino="img/".$_FILES["fileToUpload"]["name"];
        //echo "<h4>El archivo a subir es: ".$archivoDestino."</h4>";
        //Parte 2
        $imageFileType=pathinfo($archivoDestino,PATHINFO_EXTENSION);
        //$check=getimagesize($archivoOrigen);
        //echo "Extensión del archivo: ".$imageFileType."<p></p>";
        if($imageFileType=="PNG"||$imageFileType=="png"){
          echo "El archivo es una imagen png </br>";
          $salario=((float)$salario);
          $query="INSERT INTO usuarios (nombre_usuario,salario,foto) values ('$nombre',$salario,'$archivoDestino')";
          //echo "Query a ejecutar: ".$query."</br>";
          //EJECUTANDO Query
          if($query_a_ejecutar=mysqli_query($conexion,$query)){
            //echo "Query ejecutado correctamente </br>";
            move_uploaded_file($archivoOrigen,$archivoDestino);
          }else{
            echo "Query no ejecutado</br>";
            //var_dump(mysqli_query($conexion,$query));
          }
          $consulta="SELECT * FROM usuarios";
          if($result=mysqli_query($conexion,$consulta)){
            echo "<div class='table-responsive'>";
            echo "<table class='table'>
            <tr>
              <td>Id</td>
              <td>Nombre</td>
              <td>Salario</td>
              <td>Foto</td>
            </tr>";
            while ($row = mysqli_fetch_array($result)) {
              // code...
              echo "<tr>";
              echo "<td>".$row['id_usuario']."</td>";
              echo "<td>".$row['nombre_usuario']."</td>";
              echo "<td>".$row['salario']."</td>";
              echo"<td><img class='img-rounded' style='width:25%'src=".$row['foto']." alt=''>";
              echo"</tr>";
            }
            echo "</table>";
            echo "</div>";


          }
        }else{
          echo "No es un PNG";
        }
      }

      ?>
      <a class="btn btn-primary" href="index.html">Subir otra imagen</a>
    </div>
  </body>
</html>
