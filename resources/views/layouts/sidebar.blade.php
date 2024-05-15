<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>{{ config('app.name', 'Laravel') }}</h3>
            <strong>GA</strong>
        </div>

        <ul class="list-unstyled components">
            <li class="{{'Inicio'==Request()->path()?'active':''}}">
                <a href="{{ url('/home') }}">
                    <i class="fas fa-home"></i>
                    Inicio
                </a>

            </li>

            

            <li class="{{'acceso'==Request::is('acceso*')?'active':''}}">
                <a href="{{route('sistemas.index')}}">
                    <i class="fa fa-sitemap"></i>
                    Sistemas/
                    <br>
                    <i class="fa fa-user"></i>
                    usuarios</a>
            </li>
            <li class="{{'acceso'==Request::is('acceso*')?'active':''}}">
                <a href="{{route('vista.index')}}">
                <i class="fa fa-user"></i><i class="fas fa-eye"></i>
                    Vista Usuario</a>
            </li>

            
            <li class="{{'acceso'==Request::is('acceso*')?'active':''}}">
                <a href="{{route('acceso.index')}}">
                    <i class="fa fa-sitemap"></i>
                    sistemas</a>
            </li>

            <li class="{{'acceso'==Request::is('acceso*')?'active':''}}">
                <a href="{{route('personal.index')}}">
                    <i class="fa fa-user"></i>
                    Usuarios</a>
            </li>

            <li class="{{'acceso'==Request::is('acceso*')?'active':''}}">
                <a href="{{route('vicepresidencia.index')}}"><i class="fa fa-user-tie"></i>
                    Vicepresidencia</a>
            </li>

        </ul>


    </nav>



</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
});
</script>