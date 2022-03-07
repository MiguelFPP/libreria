<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) : ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Prestamo/carrito" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="hide-menu">
                                Carrito Prestamo
                                <span class="badge badge-pill badge-info">
                                    <!-- Numero informativo de la cantidad de libros agregado al carrito -->
                                    <?= count($_SESSION['carrito']) ?>
                                </span>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                <!-- prestamos -->
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="far fa-handshake"></i><span class="hide-menu">Prestamos </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="Prestamo/gestion" class="sidebar-link"><i class="far fa-calendar-alt"></i><span class="hide-menu"> Gestion </span></a></li>
                        <li class="sidebar-item"><a href="Prestamo/usuarios" class="sidebar-link"><i class="fas fa-user"></i><span class="hide-menu"> Usuarios </span></a></li>
                    </ul>
                </li>
                <!-- libros -->
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-book"></i><span class="hide-menu">Libros </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="Libro/gestion" class="sidebar-link"><i class="fas fa-book"></i><span class="hide-menu"> Libros </span></a></li>
                        <li class="sidebar-item"><a href="Categoria/gestion" class="sidebar-link"><i class="fas fa-bookmark"></i><span class="hide-menu"> Categorias </span></a></li>
                        <li class="sidebar-item"><a href="Autor/gestion" class="sidebar-link"><i class="fas fa-user"></i><span class="hide-menu"> Autores </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Usuario/gestion" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Usuarios</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->