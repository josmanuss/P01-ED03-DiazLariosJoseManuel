<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["titulo"]; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-sidebar {
            background-color: #1E3A8A;
        }
        .sidebar-dark-primary .nav-link {
            color: #FFFFFF;
        }
        .sidebar-dark-primary .nav-link.active {
            background-color: #1D4ED8;
        }
        .brand-link {
            background-color: #1E3A8A;
            color: #FFFFFF;
        }
        .btn-agregar {
            margin-left: auto; 
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Municipio</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>Denuncias</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Gestión de Denuncias</h1>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid d-flex">
                    <button class="btn btn-primary btn-agregar" data-toggle="modal" data-target="#modal-denuncia">Agregar Denuncia</button>
                </div>
                <div class="container-fluid">
                    <table id="denuncias-table" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Ubicación</th>
                                <th>Estado</th>
                                <th>Ciudadano</th>
                                <th>Teléfono</th>
                            </tr>
                        </thead>
                        <tbody id="denuncias-table-body">
                            <?php foreach ($data["categorias"] as $i => $denuncia): ?>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm editar-denuncia" data-index="<?php echo $i; ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm eliminar-denuncia" data-toggle="modal" data-target="#modal-confirmar-eliminar" data-indice="<?php echo $denuncia["id"]; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <td><?php echo $denuncia["id"]; ?></td>
                                    <td><?php echo $denuncia["titulo"]; ?></td>
                                    <td><?php echo $denuncia["descripcion"]; ?></td>
                                    <td><?php echo $denuncia["ubicacion"]; ?></td>
                                    <td><?php echo $denuncia["estado"]; ?></td>
                                    <td><?php echo $denuncia["ciudadano"]; ?></td>
                                    <td><?php echo $denuncia["telefono_ciudadano"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal para agregar denuncia -->
        <div class="modal fade" id="modal-denuncia" tabindex="-1" role="dialog" aria-labelledby="modal-denuncia-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-denuncia-label">Registrar Denuncia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?c=DenunciaController&a=registrarDenuncia" method="POST">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <input type="text" class="form-control" name="ubicacion" id="ubicacion" required>
                            </div>
                            <div class="form-group">
                                <label for="actualizar-estado">Estado</label>
                                <select class="form-control" name="estado" id="registrar-estado" required>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="en_proceso">En proceso</option>
                                    <option value="resuelto">Resuelto</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ciudadano">Ciudadano</label>
                                <input type="text" class="form-control" name="ciudadano" id="ciudadano" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono_ciudadano">Teléfono</label>
                                <input type="text" class="form-control" name="telefono_ciudadano" id="telefono_ciudadano" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Denuncia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para actualizar denuncia -->
        <div class="modal fade" id="modal-actualizar-denuncia" tabindex="-1" role="dialog" aria-labelledby="modal-actualizar-denuncia-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-actualizar-denuncia-label">Actualizar Denuncia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?c=DenunciaController&a=actualizarDenuncia" method="POST" id="actualizar-denuncia-form">
                            <input type="hidden" name="id" id="actualizar-id">
                            <div class="form-group">
                                <label for="actualizar-titulo">Título</label>
                                <input type="text" class="form-control" name="titulo" id="actualizar-titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="actualizar-descripcion">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="actualizar-descripcion" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="actualizar-ubicacion">Ubicación</label>
                                <input type="text" class="form-control" name="ubicacion" id="actualizar-ubicacion" required>
                            </div>
                            <div class="form-group">
                                <label for="actualizar-estado">Estado</label>
                                <input type="text" class="form-control" name="estado" id="actualizar-estado" required>
                            </div>
                            <div class="form-group">
                                <label for="actualizar-ciudadano">Ciudadano</label>
                                <input type="text" class="form-control" name="ciudadano" id="actualizar-ciudadano" required>
                            </div>
                            <div class="form-group">
                                <label for="actualizar-telefono_ciudadano">Teléfono</label>
                                <input type="text" class="form-control" name="telefono_ciudadano" id="actualizar-telefono_ciudadano" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Denuncia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para confirmar eliminación -->
        <div class="modal fade" id="modal-confirmar-eliminar" tabindex="-1" role="dialog" aria-labelledby="modal-confirmar-eliminar-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-confirmar-eliminar-label">Confirmar Eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro de que desea eliminar esta denuncia?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a href="" class="btn btn-danger" id="confirmar-eliminar-btn">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="#">Municipalidad</a>.</strong> Todos los derechos reservados.
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#denuncias-table').DataTable();


            $(document).on('click', '.editar-denuncia', function() {
                const index = $(this).data('index');
                const denuncia = <?php echo json_encode($data["categorias"]); ?>[index];
                $('#actualizar-id').val(denuncia.id);
                $('#actualizar-titulo').val(denuncia.titulo);
                $('#actualizar-descripcion').val(denuncia.descripcion);
                $('#actualizar-ubicacion').val(denuncia.ubicacion);
                $('#actualizar-estado').val(denuncia.ubicacion);
                
                $('#actualizar-ciudadano').val(denuncia.ciudadano);
                $('#actualizar-telefono_ciudadano').val(denuncia.telefono_ciudadano);
                $('#modal-actualizar-denuncia').modal('show');
            });


            $(document).on('click', ".eliminar-denuncia", function(){
                var id_eliminar = $(this).data("indice");
                var deleteUrl = "index.php?c=DenunciaController&a=eliminarDenuncia&id="+id_eliminar;
                $("#confirmar-eliminar-btn").attr("href",deleteUrl)

            });





        });
    </script>
</body>
</html>
