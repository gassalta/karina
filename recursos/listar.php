<main class="app-content">
    <div class="app-title">
      <div>
        <?php
        switch ($_SESSION['nivel']) {
          case 'Administrador':
              $Titulo = 'Listado total de incidencias';
              break;
          case 'Usuario normal':
            $Titulo = 'Listado de mis incidencias cargadas';
              break;
          case 'Tecnico':
            $Titulo = 'Listado de incidencias no finalizada';
              break;
      };?>
        <h1><i class="fa fa-th-list"></i> Listados</h1>
        <!-- si es administrador vera este titulo-->
        <p><?=$Titulo?></p>


      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Listado</li>
        <li class="breadcrumb-item active"><a href="#">Listado de Incidencias</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Incidencias (Nro Total)</h3>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Título</th>
                  <th>Descripción</th>
                  <th>Prioridad</th>
                  <th>Registro</th>
                  <th>Estado</th>
                  <th>Solicitante</th>
                  <th>Area</th>
                  <th>Opciones</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $control = (new Incidencias($bd, NULL))->mostrarIncidencias();
                foreach ($control as $r) {
                  $prioridad = $r['prioridad'];
                  switch ($prioridad) {
                    case 'Alta':
                        $class = 'table-danger';
                        break;
                    case 'Media':
                      $class = 'table-warning';
                        break;
                    case 'Baja':
                      $class = 'table-info';
                        break;
                };
                
                  echo "<tr class=\"{$class}\">";
                  echo "<td>{$r['id']}</td>";
                  echo "<td>{$r['titulo']}</td>";
                  echo "<td>{$r['descripcion']}</td>";
                  echo "<td>{$r['prioridad']}</td>";
                  echo "<td>{$r['fechas']}</td>";
                  echo "<td>{$r['estado']}</td>";
                  echo "<td>{$r['nombre']} {$r['apellido']}</td>";
                  echo "<td>{$r['area']}</td>";
                         
                 echo ' <td><a href="#">Ver detalles...</a></td></tr>';
                }

                ?>
    
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

    </div>
  </main>