<br><br>
<center>
    <?php
        if(isset($_GET['editar'])){
            echo"EDITAR PRODUCTOS";
            $editar_id = $_GET['editar'];

            $consulta = "SELECT * FROM productos WHERE id='$editar_id'";
            $ejecutar = mysqli_query($con,$consulta);

            $fila=mysqli_fetch_array($ejecutar);

            $nombre=$fila['nombre'];
            $descripcion=$fila['descripcion'];
            $precio=$fila['precio'];
            $stock=$fila['stock'];
            $imagen=$fila['imagen'];
            $modelo3d=$fila['modelo3d'];
        }

    ?>
    
    <br>

    <form id="" enctype="multipart/form-data" action="" method="post" style="text-align: center; background-color: lightgrey; padding: 15px; border-radius: 15px; width: 30%; margin-top: 1cm; border: 2px solid transparent; transition: background-color 0.3s ease; position: relative; z-index: 1; margin-left: 3%;">
        <label for="Nnombre">Nuevo Nombre:</label>
        <input type="text" id="Nnombre" name="Nnombre" value="<?php echo $nombre;?>" required><br>

        <label for="Ndescripcion">Nueva Descripción:</label>
        <textarea id="Ndescripcion" name="Ndescripcion" required><?php echo $descripcion;?></textarea><br>

        <label for="Nprecio">Nuevo Precio:</label>
        <input type="number" id="Nprecio" name="Nprecio" step="0.01" value="<?php echo $precio;?>" required><br>

        <label for="Nstock">Nuevo Stock:</label>
        <input type="number" id="Nstock" name="Nstock" step="1" value="<?php echo $stock;?>" required><br>

        <label for="Nimagen">Nueva Imagen:</label>
        <input type="file" id="Nimagen" name="Nimagen" accept="image/*"><br>
        <img id="imagenPreview" alt="Imagen previa" style="width: 200px; display: none;"><br>

        <label for="Nmodelo3d">Nuevo Modelo 3D (.glb):</label>
        <input type="file" id="Nmodelo3d" name="Nmodelo3d" accept=".glb"><br>
        <model-viewer id="modelo3dPreview" style="width: 200px; height: 200px;"></model-viewer><br>

        <button type="submit" name="act">Actualizar Producto</button>
    </form>

    <?php
    if(isset($_POST['act'])){

        $actualizar_nombre = $_POST['Nnombre'];
        $actualizar_descripcion = $_POST['Ndescripcion'];
        $actualizar_precio = $_POST['Nprecio'];
        $actualizar_stock = $_POST['Nstock'];

        // Procesar nuevas imágenes y modelos 3D solo si se seleccionan archivos nuevos
        if ($_FILES["Nimagen"]["size"] > 0) {
            $imagen_path = "img/" . basename($_FILES["Nimagen"]["name"]);
            move_uploaded_file($_FILES["Nimagen"]["tmp_name"], $imagen_path);
            $actualizar_imagen = $imagen_path;
        } else {
            $actualizar_imagen = $imagen;
        }

        if ($_FILES["Nmodelo3d"]["size"] > 0) {
            $modelo3d_path = "modelos3d/" . basename($_FILES["Nmodelo3d"]["name"]);
            move_uploaded_file($_FILES["Nmodelo3d"]["tmp_name"], $modelo3d_path);
            $actualizar_modelo3d = $modelo3d_path;
        } else {
            $actualizar_modelo3d = $modelo3d;
        }

        $actualizar = "UPDATE productos SET nombre='$actualizar_nombre', descripcion='$actualizar_descripcion', precio='$actualizar_precio', stock='$actualizar_stock', imagen='$actualizar_imagen', modelo3d='$actualizar_modelo3d' WHERE id='$editar_id'";

        $ejecutar = mysqli_query($con,$actualizar);

        if($ejecutar){
            echo "<script>alert('PRODUCTO ACTUALIZADO CORRECTAMENTE!')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
        }
    }
    ?>
</center>
