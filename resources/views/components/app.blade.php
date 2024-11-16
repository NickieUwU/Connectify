@php
  $disabled = 'disabled';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .navbar-nav 
        {
            margin-left: auto;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand ms-4 fs-2" href="{{url('/home')}}">𝕮</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav text-center mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active {{request()->is('home') ? $disabled : ''}}" aria-current="page" href="{{url('/home')}}">
                <span class="bi bi-house-fill">
                  <div class="d-inline-block d-sm-inline-block d-md-inline-block d-lg-none">
                    Home
                  </div>
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{request()->is('create') ? $disabled : ''}}" href="{{url('create')}}">
                <span class="bi bi-plus-circle-fill">
                  <div class="d-inline-block d-sm-inline-block d-md-inline-block d-lg-none">
                    Create
                  </div>
                </span>              
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{request()->is('search/*') ? $disabled : ''}}" href="{{url('search/users')}}">
                <span class="bi bi-search">
                  <div class="d-inline-block d-sm-inline-block d-md-inline-block d-lg-none">
                    Search
                  </div>
                </span>
              </a>
            </li>
            <li class="d-lg-none d-sm-inline-block nav-item">
              <a href="{{url('/profile/'.$username)}}" class="nav-link {{request()->is('profile/'.$username) ? $disabled : ''}}">
                <span class="bi bi-person-fill border border-white">
                  View Profile
                </span>
              </a>
            </li>
            @if($username == "Connectify")
              <li class="d-lg-none d-sm-inline-block nav-item">
                <a href="{{ url('/reports') }}">
                  Reports
                </a>
              </li>
            @endif
            <li class="d-lg-none d-sm-inline-block nav-item">
              <a class="dropdown-item" href="{{ url('/logout') }}">
                <span class="r w-100 border border-white bi bi-door-open-fill">Logout</span>
              </a>
            </li>
            
          </ul>
          
          
          <ul class="navbar-nav ms-auto me-5">
            <li class="nav-item dropdown d-lg-block d-md-none d-none d-sm-none">
                <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{$username}}
                </span>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item {{request()->is('profile/'.$username) ? $disabled : ''}}" href="{{ url('/profile/' . $username) }}">
                      <span class="bi bi-person-fill border border-white">View Profile</span>
                    </a>
                    </li>
                    <li>
                    @if($username == 'Connectify')
                      <li>
                        <a class="dropdown-item {{request()->is('reports') ? $disabled : ''}}" href="{{ url('/reports') }}">
                          <span>Reports</span>
                        </a>
                      </li>
                    @endif
                      <a class="dropdown-item" href="{{ url('/logout') }}">
                        <span class="r w-100 border border-white bi bi-door-open-fill">Logout</span>
                      </a>
                    </li>
                    
                </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container-fluid">
        {{$slot}}
    </div>
</body>
</html>
