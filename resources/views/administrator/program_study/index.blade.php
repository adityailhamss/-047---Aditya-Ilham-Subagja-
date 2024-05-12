@extends('layouts.app')

@section('title', 'Daftar Program Studi')
@section('description', 'Halaman daftar program studi')

@section('content')
<section class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
      </div>
      <div class="card-body">
        <x-button-group-flex>
          <button type="button" class="btn btn-primary" id="createCommodityButton" data-bs-toggle="modal"
            >
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Program Studi
          </button>
        </x-button-group-flex>
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

