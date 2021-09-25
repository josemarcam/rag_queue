<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Principal</div>
                <a class="nav-link" href="<?= $_SESSION['ROOT_PATH']; ?>/pages/index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Pagina inicial
                </a>
                <?php if (isset($_SESSION['us_id'])): ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Filas
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= $_SESSION['ROOT_PATH']; ?>/pages/filas/filas-disponiveis.php">Filas Disponiveis</a>
                            <a class="nav-link" href="<?= $_SESSION['ROOT_PATH']; ?>/pages/filas/minhas-filas.php">Minhas Filas</a>
                            <?php if (isset($_SESSION['us_rule']) && $_SESSION['us_rule'] == 1 ): ?>
                                <a class="nav-link" href="<?= $_SESSION['ROOT_PATH']; ?>/pages/filas/cadastro-filas.php">Cadastro de Filas</a>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <?php if (isset($_SESSION['us_rule']) && $_SESSION['us_rule'] == 1 ): ?>
                        <a class="nav-link" href="<?= $_SESSION['ROOT_PATH']; ?>/pages/filas/instancias.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Instâncias
                            <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                        </a>
                    <?php endif; ?>
                
                <?php endif; ?>
            </div>
        </div>
        <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div> -->
    </nav>
</div>