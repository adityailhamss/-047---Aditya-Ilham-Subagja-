@extends('layouts.app')

@section('title', 'Daftar Administrator')
@section('description', 'Halaman daftar administrator')

@section('content')
<section class="row">
  <div class="col-12">
    {{-- @include('utilities.alert') --}}
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
      </div>
      <div class="card-body">
        <x-button-group-flex>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            >
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Administrator
          </button>
        </x-button-group-flex>
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Nomor Handphone</th>
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


