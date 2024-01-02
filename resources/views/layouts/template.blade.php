<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{csrf_token() }}"> --}}
    <title>Data Keterlambatan</title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK"crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-fb8F+ejTtC0m1Tl1d7CTvZ9tm+cd+KGr9GO4lSd6brfsSAVME9V12tMWI5ZbM+ga" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
      li {
        list-style: none;
        margin: 20px 0 20px 0;
      }

      a {
        text-decoration: none;
      }

      .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        margin-left: -400px;
        transition: 0.4s;
        background-color: transparent;
      }

      .active-main-content {
        margin-left: 290px;
      }

      .active-sidebar {
        margin-left: 0;
      }

      .submenu {
        display: none;
        margin-left: 20px;
      }

      .active-submenu {
        display: block;
      }

      #main-content {
        transition: 0.4s;
      }

      #admin-logo {
        position: fixed;
        top: 20px;
        right: 20px;
        cursor: pointer;
      }
      .submenu li a:hover{
        color: aqua
      }
      
    </style>
  </head>

 <body>

   @if (Auth::check())
        <!-- Bagian Sidebar -->
         <!-- Bagian Sidebar Guru -->
         @if (Auth::user()->role == 'guru')
         <div class="sidebar p-4 bg-info" id="sidebar">
          <h4 class="mb-5 text-white">Rekam Keterlambatan</h4>
          <li>
            <a class="text-white" href="/index">
              <i class="bi bi-house mr-2"></i>
              Dashboard
            </a>
          </li>
          <li>
            <a class="text-white" href="{{ route('ps.student.data','[id]') }}">
              <i class="bi bi-person mr-2"></i>
              Data Siswa
          </a>
          

          </li>
          <li>
            <a class="text-white" href="{{route('ps.lates.rekap')}}">
              <i class="bi bi-newspaper mr-2"></i>
              Data Keterlambatan
            </a>
          </li>
        </div>
    
        <div class="p-4" id="main-content">
          <button class="btn btn-info" id="button-toggle">
            <i class="bi bi-list"></i>
          </button>
          <div class="judul-page mt-4">
              <h3>Dashboard</h3>
              <h6 style="color: grey;">
                Home / Dashboard
              </h6>
          </div>
          <a href="{{ route('logout') }}" id="admin-logo">
              <i class="bi bi-person"></i> Logout
          </a>
          
        @endif
        @if (Auth::user()->role == 'admin')
        <div class="sidebar p-4 bg-info" id="sidebar">
          <h4 class="mb-5 text-white">Rekam Keterlambatan</h4>
          <li>
            <a class="text-white" href="/index">
              <i class="bi bi-house mr-2"></i>
              Dashboard
            </a>
          </li>
          <li>
            <a class="text-white" href="#" id="data-master">
                <i class="bi bi-fire mr-2"></i>
                Data Master
            </a>
            <ul class="submenu" id="submenu-master"> 
                <li><a class="dropdown-item" href="{{ route('rombel.index') }}" style="background: transparent">Data Rombel</a></li>
                <li><a class="dropdown-item" href="{{ route('rayon.index') }}" style="background: transparent">Data Rayon</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.student.index') }}" style="background: transparent">Data Siswa</a></li>
                <li><a class="dropdown-item" href="{{ route('user.index') }}" style="background: transparent">Data User</a></li>
            </ul>
          </li>
        
          <li>
            <a class="text-white" href="{{route('admin.lates.index')}}">
              <i class="bi bi-newspaper mr-2"></i>
              Data Keterlambatan
            </a>
          </li>
        </div>
    <div class="p-4" id="main-content">
        <button class="btn btn-info" id="button-toggle">
          <i class="bi bi-list"></i>
        </button>
        <div class="judul-page mt-4">
            <h3>Dashboard</h3>
            <h6 style="color: grey;">
              Home / Dashboard
            </h6>
        </div>
        <a href="{{ route('logout') }}" id="admin-logo">
            <i class="bi bi-person"></i> Logout
        </a>
        @endif
        @endif
       
        <div class="container">
          {{-- Konten dinamis yang akan berubah di setiap halaman --}}
          @yield('content')
        </div>
</div>

    </div>
    
    
      <script>
        const dataMasterLink = document.getElementById("data-master");
        const submenuMaster = document.getElementById("submenu-master");

        // event will be executed when the toggle-button is clicked
        document.getElementById("button-toggle").addEventListener("click", () => {

          // when the button-toggle is clicked, it will add/remove the active-sidebar class
          document.getElementById("sidebar").classList.toggle("active-sidebar");

          // when the button-toggle is clicked, it will add/remove the active-main-content class
          document.getElementById("main-content").classList.toggle("active-main-content");
        });

        // event will be executed when Data Master is clicked
        dataMasterLink.addEventListener("click", () => {
          // toggle the active-submenu class to show/hide the submenu
          submenuMaster.classList.toggle("active-submenu");
        });
     
    var myTabs = new bootstrap.Tab(document.getElementById('tab'));
    myTabs.show();

      </script>
      

  </body>
</html>