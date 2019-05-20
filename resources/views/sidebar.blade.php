@extends('dashboard')
@section('sidebar_left')
<div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li class="@yield('admin/home')">
                        <a href="{{ url('admin/home') }}">
                    <i class='fa fa-edit'></i>
                        <span>Home</span>
                        </a>
                    </li>
                    <li class="@yield('admin/data_tarif')">
                        <a href="{{ url('admin/data_tarif') }}">
                    <i class='fa fa-edit'></i>
                        <span>Data Tarif</span>
                        </a>
                    </li>
                    <li class="@yield('admin/dataPelanggan')">
                        <a href="{{ url('admin/dataPelanggan') }}">
                    <i class='fa fa-edit'></i>
                        <span>Data Pelanggan</span>
                        </a>
                    </li>
                    <li class="@yield('admin/dataPenggunaan')">
                        <a href="{{ url('admin/dataPenggunaan') }}">
                    <i class='fa fa-edit'></i>
                        <span>Data Penggunaan</span>
                        </a>
                    </li>
                    <li class="@yield('admin/paymenVerification')">
                        <a href="{{ url('admin/paymenVerification') }}">
                    <i class='fa fa-edit'></i>
                        <span>Payment Verification</span>
                        </a>
                    </li>
                    <li class="@yield('admin/history')">
                        <a href="{{ url('admin/history') }}">
                    <i class='fa fa-edit'></i>
                        <span>Histori Pembayaran</span>
                        </a>
                    </li>
                    <li class="@yield('admin/logout')">
                        <a href="{{ url('admin/logout') }}">
                    <i class='fa fa-edit'></i>
                        <span>Logout</span>
                        </a>
                    </li>							
                </ul>
            </nav>
        </div>
    </div>
  @endsection