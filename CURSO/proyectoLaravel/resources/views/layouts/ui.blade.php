@extends('layouts.app')

@section('nav')
    <div class="row appear-md align-items-center mb-3 pb-3">
        <h3 class="py-4 col-4">
            {{ config('app.name') }}
        </h3>
        <form class="d-flex my-3 col" role="search">
            <div class="input-group">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><img src="../resources/img/search.svg"
                        alt="Search"></button>
            </div>
        </form>
    </div>
    <div class="col-md-3 border-end border-secondary aside">
        <div class="disappear-md">
            <h3 class="aside-title-font py-4">
                {{ config('app.name') }}
            </h3>
        </div>
        <form class="d-flex my-3 disappear-md" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <ul class="navbar-nav justify-content-end-md flex-grow-1 pe-3 my-1 mx-4 m-3-md">
            <li class="nav-item">
                <h3><a class="nav-link active button-primary d-inline-block" aria-current="page" href="#"><img
                            src="../resources/img/home.svg" alt="" height="35" class="pb-2 me-3">Home</a>
                </h3>
            </li>
            <li class="nav-item">
                <h3><a class="nav-link active button-primary d-inline-block" aria-current="page" href="#"><img
                            src="../resources/img/explore.svg" alt="" height="35" class="pb-2 me-3">Explorar</a>
                </h3>
            </li>
            <li class="nav-item dropup-md position-relative bottom-0">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <h3 class="d-inline-block"><img src="../resources/img/more.svg" alt="" height="35"
                            class="pb-2 me-3">Más</h3>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="{{ route('config') }}">Configuración</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
@endsection

@section('footer')
    <footer class="row text-center position-relative bottom-0 left-0 w-100">
        <hr>
        <div class="col">
            &copy;Jose Luis Vallejo del Pozo
        </div>
    </footer>
@endsection
