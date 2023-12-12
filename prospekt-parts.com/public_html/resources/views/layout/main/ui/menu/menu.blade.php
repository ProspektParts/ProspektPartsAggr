{{-- if ($_SERVER['REQUEST_URI'] === '/')
<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link" href="/about">
            О компании
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#bestsellers">
            Хиты продаж
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/products/mersedes-benz">
            Запасные части
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#brand">
            Бренды
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#advantages">
            Преимущества
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/contact">
            Контакты
        </a>
    </li>
</ul>                        
else
endif --}}

<ul class="navbar-nav mx-auto mb-2 mb-lg-0 mt-4 mt-lg-0 text-center">
    
    <li class="nav-item">
        <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/production') ? ' active' : '';?>" href="/production">
            Производство
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/about') ? ' active' : '';?>" href="/about">
            О компании
        </a>
    </li>
    
<!--    <li class="nav-item">
     <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/products/mercedes-benz') ? ' active' : '';?>" href="/products/mercedes-benz">
         Запасные части
     </a>
      <ul class="dropdown-menu">
 <li><a href="#">AYKU КОЛЕНВАЛЫ</a></li>
 <li><a href="#">GMS Водяные насосы</a></li>
 <li><a href="#">MVS Маховики</a></li>
 <li><a href="#">POWERHUB</a></li>
 <li><a href="#">SUNEX клапана ДВС</a></li>
 <li><a href="#">TURBO SuotePower</a></li>
 <li><a href="#">MERCEDES-BENZ</a></li>
 <li><a href="#">Запасные части СКЛАД 2</a></li>
 
</ul> 
 </li> -->
    <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Запасные части
    </a>
    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
        <li><a class="dropdown-item" href="/products/mercedes-benz">MERCEDES-BENZ</a></li>
        <li><a class="dropdown-item" href="/stock/81cf7449-727a-11ee-0a80-130600173515">POWERHUB</a></li>
        <li><a class="dropdown-item" href="/stock/d295833c-8399-11ee-0a80-0fb9000b7477">POWERHUB фильтры</a></li>
        <li><a class="dropdown-item" href="/stock/e3295a56-770c-11ee-0a80-096e0020d4ec">AYKU КОЛЕНВАЛЫ</a></li>
        <li><a class="dropdown-item" href="/stock/a2a12edf-1642-11ee-0a80-13ab00041ab9">GMS Водяные насосы</a></li>
        <li><a class="dropdown-item" href="/stock/ef56740b-77e0-11ee-0a80-0cfa001004ff">MVS Маховики</a></li>
        <li><a class="dropdown-item" href="/stock/6f6ad146-794c-11ee-0a80-0290001d2dad">SUNEX клапана ДВС</a></li>
        <li><a class="dropdown-item" href="/stock/c07653f3-5d3d-11ee-0a80-0418001257ed">TURBO SuotePower</a></li>
        <li><a class="dropdown-item" href="/stock/e0cb6ca7-7a53-11ee-0a80-02dc001281c2">DONGFA Коленвалы</a></li>
        <li><a class="dropdown-item" href="/stock/416a3aff-0f66-11ee-0a80-0d9c00124798">ЗАПАСНЫЕ части СКЛАД 2</a></li>
    </ul>
</div>

    
    
    
    
    {{-- <li class="nav-item">
        <a class="nav-link<?php // =($_SERVER['REQUEST_URI'] === '/customers') ? ' active' : '';?>" href="/customers">
            Клиентам
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php // =($_SERVER['REQUEST_URI'] === '/doc') ? ' active' : '';?>" href="/doc">
            Документы
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/contact') ? ' active' : '';?>" href="/contact">
            Контакты
        </a>
    </li>
    <li class="nav-item">
        {!! $contact::getPhone(config('app.phone'), ['nav-link', 'fw-bold']) !!}
    </li>
</ul> 

<style>

ul.navbar-nav {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

ul.navbar-nav li {
    position: relative;
    transition: transform 0.2s ease-in;
}

ul.navbar-nav li a {
    text-decoration: none;
    color: #333; /* Чуть темнее черного */
    padding: 10px 20px;
    display: inline-block;
    transition: color 0.2s ease-in;
}

ul.navbar-nav li a:hover {
    color: #3ca0e7;
}

ul.navbar-nav .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    min-width: 150px;
    box-shadow: 0px 3px 5px -1px #ccc;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.2s ease-in, transform 0.2s ease-in;
}

ul.navbar-nav li:hover .dropdown-menu {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

ul.navbar-nav .dropdown-menu li {
    margin: 0;
    padding: 0;
    transition: background-color 0.2s ease-in;
}

ul.navbar-nav .dropdown-menu li a {
    display: block;
    padding: 10px 20px;
    text-decoration: none;
    color: #333;
}

ul.navbar-nav .dropdown-menu li a:hover {
    color: #3ca0e7;
    background-color: #f0f0f0; /* Чуть светлее фона */
}

/* Добавим анимацию для улучшения визуального стиля */
ul.navbar-nav li:hover {
    transform: translateY(-5px);
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var dropdownToggle = document.querySelector('.nav-item.dropdown');
    var dropdownMenu = dropdownToggle.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('mouseenter', function () {
        dropdownMenu.style.display = 'block';
    });

    dropdownToggle.addEventListener('mouseleave', function () {
        dropdownMenu.style.display = 'none';
    });
});
</script>


