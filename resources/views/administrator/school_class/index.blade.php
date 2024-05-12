@extends('layouts.app')

@section('title', 'Daftar Kelas')
@section('description', 'Halaman daftar kelas')

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
            Tambah Kelas
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
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

