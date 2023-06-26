<?php session_start(); ?>

<nav class="nav">
    <div>
        <div class="nav_logo">
            <i class='bx bx-moon nav_logo-icon'></i>
            <span class="nav_logo-name">MOONSTORE</span>
        </div>
        <div class="nav_list">
            <a href="admin_categorias" class="nav_link">
                <i class='bx bx-category nav_icon'></i>
                <span class="nav_name">CATEGORIAS</span>
            </a>
            <a href="admin_productos" class="nav_link">
                <i class='bx bx-box nav_icon'></i>
                <span class="nav_name">PRODUCTOS</span>
            </a>
            <a href="admin_estadisticas" class="nav_link"> 
                <i class='bx bx-bar-chart-alt-2 nav_icon'></i> 
                <span class="nav_name">ESTADISTICAS</span> 
            </a>  
	        <a href="admin_noticias" class="nav_link"> 
                <i class='bx bx-news nav_icon'></i> 
                <span class="nav_name">NOTICIAS</span> 
            </a> 
            <a href="admin_usuarios" class="nav_link"> 
                <i class='bx bx-user-pin nav_icon'></i> 
                <span class="nav_name">USUARIOS</span> 
            </a>
            <a href="admin_compras" class="nav_link"> 
                <i class='bx bx-package nav_icon'></i> 
                <span class="nav_name">COMPRAS</span> 
            </a>

            <a class="nav_link">
                <i class='bx bx-user nav_icon'></i> <span class="nav_name"><?php echo $_SESSION['user'] ?></span>
            </a>
        </div>
    </div>
    <a href="/Proyecto/Controllers/CloseSessionController.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Salir</span></a>
</nav>