<br><br>
<center>
    <?php
        if(isset($_GET['editar'])){
            echo"EDITAR PRODUCTOS";
            $editar_id = $_GET['editar'];

            $consulta = "SELECT * FROM productos WHERE id='$editar_id'";
            $ejecutar = mysql_query($con,$consulta);

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

    <form id="" enctype="multipart/form-data" action="" method="post">
    <label for="Nnombre">Nuevo Nombre:</label>
    <input type="text" id="Nnombre" name="Nnombre" required><br>

    <label for="Ndescripcion">Nueva Descripción:</label>
    <textarea id="Ndescripcion" name="Ndescripcion" required></textarea><br>

    <label for="Nprecio">Nuevo Precio:</label>
    <input type="number" id="Nprecio" name="Nprecio" step="0.01" required><br>

    <label for="Nstock">Nuevo Stock:</label>
    <input type="number" id="Nstock" name="Nstock" step="1" required><br>

    <label for="Nimagen">Nueva Imagen:</label>
    <input type="file" id="Nimagen" name="Nimagen" accept="image/*" onchange="previewImage()"><br>
    <img id="imagenPreview" alt="Imagen previa" style="max-width: 200px; display: none;"><br>

    <label for="Nmodelo3d">Nuevo Modelo 3D (.glb):</label>
    <input type="file" id="Nmodelo3d" name="Nmodelo3d" accept=".glb" onchange="previewModel()"><br>
    <model-viewer id="modelo3dPreview" style="width: 200px; height: 200px;"></model-viewer><br>

    <button type="submit">Actualizar Producto</button>
</form>
</center>
