@extends('layouts.app')

@section('title', 'Daftar Komoditas')
@section('description', 'Halaman daftar komoditas')

@section('content')
<section class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
      </div>
      <div class="card-body">

        <!-- Use component x-button-group-flex -->
        <x-button-group-flex>
          <button type="button" class="btn btn-primary" id="createCommodityButton" data-bs-toggle="modal"
          data-bs-target="#createCommodityModal">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Komoditas
          </button>
        </x-button-group-flex>

        <!-- Table displaying commodities data-->
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
              @foreach ($commodities as $commodity)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $commodity->name }}</td>
                <td>
                  <div class="btn-group gap-1">
                    <!-- Button for edit data commodity-->
                    <button type="button" class="btn btn-sm btn-success editCommodityButton" data-bs-toggle="modal"
                      data-id="{{ $commodity->id }}" data-bs-target="#editCommodityModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- Button for delete data commodity-->
                    <form action="{{ route('administrators.commodities.destroy', $commodity) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger btn-delete"><i
                          class="bi bi-trash-fill"></i></button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('modal')
@include('administrator.commodity.modal.create')
@include('administrator.commodity.modal.edit')
@endpush

@push('script')
@include('administrator.commodity.script')
@endpush
