@extends('admin.layouts.master')

@section('title', 'Laporan')

@section('style')
@endsection

@section('windowTitle')
    Laporan Keuangan Periode {{$periode}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($laporan->getPendapatan())}}</h3>
                        <p>Pemesanan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp. {{$laporan->getTotalPendapatan()}}</h3>
                        <p>Total Pendapatan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner text-white">
                        <h3>{{count($laporan->getPengeluaran())}}</h3>
                        <p>Jumlah Restock</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pallet"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Rp. {{$laporan->getTotalPengeluaran()}}</h3>
                        <p>Total Pengeluaran</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    @include('admin.laporans.tab_header', ['tab_id'=>"pendapatan-tab", 'tab_href'=>"#tab-pendapatan", 'tab_title'=>'Pendapatan'])
                    @include('admin.laporans.tab_header', ['tab_id'=>"pengeluaran-tab", 'tab_href'=>"#tab-pengeluaran", 'tab_title'=>'Pengeluaran'])
                    @include('admin.laporans.tab_header', ['tab_id'=>"pencarian-tab", 'tab_href'=>"#tab-pencarian", 'tab_title'=>'Cari Laporan'])
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    @include('admin.laporans.tab_pendapatan')
                    @include('admin.laporans.tab_pengeluaran')
                    @include('admin.laporans.tab_pencarian')
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            //data tables
            $('#pendapatan_table').DataTable();
            $('#pengeluaran_table').DataTable();
        });
    </script>
@endsection
