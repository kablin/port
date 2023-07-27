@extends('layouts.products')

@section('content')

@include('modals.create-product')
@include('modals.view-product')
@include('modals.edit-product')


<div class="container-fluid">
  <div class="row flex-nowrap">
    <div class="col-auto col-md-3 col-xl-2 px-0  bg-dark">
      <div class="d-flex">
        <div class=" bg-white p-3 logo-radius">

          <a href="/" class="d-flex align-items-center pb-3 mb-md-0 mx-md-auto mt-3 text-white text-decoration-none">
            <img src="/images/logo.png">
          </a>
        </div>
        <div class="text-center mx-auto ">
          <p class='text-white ' >Enterprise <br>Resource<br> Planning<p>
          </div>
        </div>
        <div class="d-flex flex-column align-items-center align-items-sm-start px-2 pt-2 text-white min-vh-100">

          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
              <a   href="{{ route('products') }}" role="button" class="nav-link  text-white-50  menu-link"    >
                Продукты
              </a>
            </li>
            <li class="nav-item">
              <a   href="{{ route('available') }}" role="button" class="nav-link  text-white-50  menu-link"    >
                Доступные продукты
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col px-0">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
          <div class="container">
            <a class="navbar-brand text-danger d-inline-block products-title"   href="{{ route('products') }}">Продукты</a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="d-flex mt-5">
        <x-product-table :products="$products"/>
        <div class=" mx-5">

          <button class="btn btn-info text-white px-4" data-bs-toggle="modal" data-bs-target="#createProduct"> Добавить</button>

        </div>
      </div>

    </div>
  </div>
</div>





@endsection
