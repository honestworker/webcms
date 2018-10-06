<header>
<div id="headerInnertop">

<nav class="topMenuRight">
      
<ul>
@if (Auth::check())
<li class="page_item page-item-37">
	<a class="private-input" href="/private"></a>
</li>
@if (Auth::user()->isAdmin())
<li class="page_item page-item-37"><a href="/admin/posts">{{ Auth::user()->email }}</a></li>
@else
<li class="page_item page-item-37"><a href="/private">{{ Auth::user()->email }}</a></li>
@endif
<li class="page_item page-item-37"><a href="/logout">Выйти</a></li>
@else
<li class="page_item page-item-37"><a href="/login">Войти</a></li>
<li class="page_item page-item-2"><a href="/registration">Регистрация</a></li>
@endif
</ul>
 
    
</nav>

<div class="sharenew">

<a class="icon-Google" href="https://accounts.google.com/ServiceLogin?service=oz&passive=1209600&continue=https://plus.google.com/share?url%3Dhttp://test/test.html%26gpsrc%3Dframeless&btmpl=popup" title="Я в Google+" target="_blank"></a>

<a class="icon-twitter" href="https://twitter.com/intent/tweet?status=%20http%3A%2F%2Ftest%2Ftest.html" title="Следить в Twitter!" target="_blank"></a>

<a class="icon-vk" href="http://vk.com/share.php?url=http%3A%2F%2Ftest%2Ftest.html&title=&description=&image=" title="Я вКонтакте" target="_blank"></a>

<a class="icon-facebook" href="https://www.facebook.com/login.php?next=https%3A%2F%2Fwww.facebook.com%2Fsharer%2Fsharer.php%3Fsrc%3Dsp%26u%3Dhttp%253A%252F%252Ftest%252Ftest.html%26t%26description%26picture%26ret%3Dlogin&display=popup" title="Я на facebook" target="_blank"></a>

</div>
</div><!-- Конец верхнего блока -->

<!-- Блок с логотипом -->
<div id="headerInnerdown">

<!-- Начало логотипа -->

<div class="logo">
<a href="/"><img src="/images/logo.png" alt=""/></a>

</div>
<!-- Конец логотипа -->

</div><!-- Конец блока с логотипом -->

<!-- Begin #bottomMenu -->

<div class="bottomMenubg">
<div id="bottomMenublock">
<div class="bottomMenuhomelink">
<a  href="/"></a>
</div>

<nav>
<div id="dropdown_nav" class="bottomMenu"><ul id="menu-%d0%bc%d0%b5%d0%bd%d1%8e-1" class="menu"><li id="menu-item-29" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-29"><a class="@if(isset($active) && $active === 'main') current @endif" href="/">Главная</a></li>
<li id="menu-item-30" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30"><a class="@if(isset($active) && $active === 'about') current @endif" href="/about">О проекте</a></li>
<li id="menu-item-30" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30"><a class="@if(isset($active) && $active === 'rules') current @endif" href="/rules">Правила</a></li>
<li id="menu-item-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-42"><a class="@if(isset($active) && $active === 'contacts') current @endif" href="/contact">Контакты</a></li>
</ul></div>           <!-- Конец #bottomMenu -->
</nav>
</div></div>
</header>