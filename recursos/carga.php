<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Registra aqui tu incidencia</h1>
          <p>Detalla lo mas que puedas el problema que se presenta</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Inicio</li>
          <li class="breadcrumb-item"><a href="#">Registro</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Ingresa los datos solicitados</h3>
            <div class="bs-component">
                <div class="alert alert-dismissible alert-danger" style="display: none;">
                  
                </div>
              </div>
              <div class="bs-component">
                <div class="alert alert-dismissible alert-success" style="display: none;">
                  <strong>Registro almacenado!</strong>
                </div>
              </div>
              <div class="bs-component">
                <div class="alert alert-dismissible alert-info">
                  <strong>Los campos con <i class="fa fa-asterisk" aria-hidden="true"></i> son obligatorios</strong>
                </div>
              </div>
            <div class="tile-body">
              <form id="incidencia">
                <div class="form-group">
                  <label class="control-label">Título</label> <i class="fa fa-asterisk" aria-hidden="true"></i>
                  <input class="form-control" type="text" id="titulo" >
                </div>
                
                <div class="form-group">
                  <label class="control-label">Descripción del problema <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                  <textarea class="form-control" id="detalles" rows="4" placeholder="Ingresa los detalles..."></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Prioridad</label> <i class="fa fa-asterisk" aria-hidden="true"></i>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" name="prioridad" value="1" type="radio" >Alta
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" name="prioridad" value="2" type="radio" >Media
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" name="prioridad" value="3" type="radio" >Baja
                    </label>
                  </div>
                </div>
                <!--
                <div class="form-group">
                  <label class="control-label">Puedes subir una captura de pantalla</label>
                  <input class="form-control" type="file">
                </div>
                -->
                <div class="tile-footer">
              <button class="btn btn-primary" id="grabar" type="button" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="index.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
            </div>
            </div>
            
            </form>
          </div>
        </div>
        
      </div>
    </main>