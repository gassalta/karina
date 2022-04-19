<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
require_once 'array.php';  //aqui se incrusta toooodo el contenido de este script

require_once 'funciones.php';  //  aqui se incrusta toooodo el contenido de este script
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Index</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" href="listado.html">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Orden de compra</span>
              </a>
            </li>

          </ul>
          <!-- Divider -->
          <hr class="my-3">

          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="#" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">link 1</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">

    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Listados</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Orden de compra</li>
                </ol>
              </nav>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Detalle de Orden de Compra - Proveedor: Neyra Center - Estado: Solicitada</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Insumo Solicitado</th>
                    <th scope="col">Cant. Pedida</th>
                    <th scope="col">Precio Unit.</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Dto. por Cant.</th>
                    <th scope="col">Monto Dto.</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php 
                  $total_orden_pedido = 0;
                  $total_productos = count($Desempenio);
                  for ($i = 0; $i < $total_productos; ++$i){?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-2">
                          <img alt="Image placeholder" src="assets/img/products/<?php echo $Desempenio[$i]['Imagen']; ?>">
                        </a>
                        <div class="media-body">
                          <span class="name mb-0 text-sm"><?php echo $Desempenio[$i]['Insumo']; ?></span>
                        </div>
                      </div>
                    </th>
                    <td class="budget"><?php echo $Desempenio[$i]['Cant_Pedida']; ?></td>
                    <td><?php echo $Desempenio[$i]['Precio_Unitario']; ?></td>
                    <td class="text-right">
                      <?php $Subtotalresu = Subtotal($Desempenio[$i]['Cant_Pedida'], $Desempenio[$i]['Precio_Unitario']); ?>
                      <?php echo $Subtotalresu; ?>
                    </td>
                    <td class="budget">
                      <span class="badge badge-dot mr-4">
                        <i class="bg-info"></i>
                          <?php $ResuDesc = DesCantidad($Subtotalresu, $Desempenio[$i]['Cant_Pedida'], $Desempenio[$i]['Cantidad_minima'], $Desempenio[$i]['Descuento_Porcentaje']); ?>
                          <span class="<?php print_r($ResuDesc['clase']); ?> font-weight-400">
                          <?php print_r($ResuDesc['resultado']); ?>
                        </span>
                      </span>
                    </td>
                    <td class="budget">
                    <?php print_r($ResuDesc['descuento']); ?>
                    </td>

                    <td class="budget">
                      <?php $ResuTotal1 = Total($Subtotalresu, $ResuDesc['descuento']); ?>
                      <?php echo $ResuTotal1; ?>
                    </td>
                  </tr>
                  <? 
                // SUMA DE LA ORDEN DEL PEDIDO
                $total_orden_pedido = $total_orden_pedido + $ResuTotal1;
                }?>

                </tbody>


              </table>
            </div>
            <!-- Card footer -->
            <div class="row">
              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Cantidad productos solicitados</h5>
                        <span class="h2 font-weight-bold mb-0">
                          <?php echo count($Desempenio); ?>
                        </span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                          <i class="ni ni-chart-pie-35"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total de productos solicitados</h5>
                        <span class="h2 font-weight-bold mb-0">

                          <?php echo TotalProductosSolicitados($Desempenio); ?>

                        </span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-active-40"></i>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Total de la orden de pedido</h5>
                        <span class="h2 font-weight-bold mb-0"> $
                          <?php echo $total_orden_pedido ?>
                        </span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-money-coins"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2021 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
</body>

</html>