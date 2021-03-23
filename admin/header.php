<?php
echo '
<!--header-start-->
<header>
<div class="header">
  <nav class="navbar fixed-top w-100 navbar-expand-xl navbar-dark bg-black">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="../index.php"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="panel.php">Головна</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="testdrive.php">Тест-драйви
            <span class="notify">'; 
            
            require '../app/functions.php';
            
            $res = getStats();
            if ($res) {
              if ($res['requests'] != 0)
               echo $res['requests'];
               else
               echo '0';
            } 
            else
             echo '0'; 
          echo '</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="showncars.php">Налаштування відображення</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Таблиці
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="users.php">Користувачі</a></li>
              <li><a class="dropdown-item" href="testdrives.php">Тест-драйви</a></li>
              <li><a class="dropdown-item" href="cars.php">Автівки</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link logout" onclick="return false" href="">Вийти з аккаунту</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
</header>
<section></section>
<!--header-end-->'; ?>