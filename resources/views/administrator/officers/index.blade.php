@extends('layouts.app')

@section('title', 'Daftar Officers')
@section('description', 'Halaman daftar officer')

@section('content')
<section class="row">
  <div class="col-12">
    @include('utilities.alert')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
      </div>
      <div class="card-body">
        <!-- Use component x-button-group-flex -->
        <x-button-group-flex>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOfficerModal">
            <i class="bi bi-plus-circle-fill" ></i>
            Tambah Officer
          </button>
        </x-button-group-flex>
        <!-- Table displaying officer data-->
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($officers as $officer)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $officer->name }}</td>
                <td>{{ $officer->email }}</td>
                <td>{{ $officer->phone_number }}</td>
                <td>
                  <div class="btn-group gap-1">
                    <!-- Button for edit data officer-->
                    <button type="button" class="btn btn-sm btn-success editOfficerButton" data-bs-toggle="modal"
                      data-id="{{ $officer->id }}" data-bs-target="#editOfficerModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- Button for delete data officer-->
                    <form action="{{ route('administrators.officers.destroy', $officer) }}" method="POST">
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
@include('administrator.officers.modal.create')
@include('administrator.officers.modal.edit')
@endpush

@push('script')
@include('administrator.officers.script')
@endpush