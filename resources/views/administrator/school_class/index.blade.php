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
        <!-- Use component x-button-group-flex -->
        <x-button-group-flex>
          <button type="button" class="btn btn-primary" id="createCommodityButton" data-bs-toggle="modal"
          data-bs-target="#createSchoolClassModal">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Kelas
          </button>
        </x-button-group-flex>
        <!-- Table displaying data-->
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
              @foreach ($schoolClasses as $schoolClass)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $schoolClass->name }}</td>
                <td>
                  <div class="btn-group gap-1">
                    <!-- Button for edit data-->
                    <button type="button" class="btn btn-sm btn-success editSchoolClassButton" data-bs-toggle="modal"
                      data-id="{{ $schoolClass->id }}" data-bs-target="#editSchoolClassModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- Button for delete data-->
                    <form action="{{ route('administrators.school-classes.destroy', $schoolClass) }}" method="POST">
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
@include('administrator.school_class.modal.create')
@include('administrator.school_class.modal.edit')
@endpush

@push('script')
@include('administrator.school_class.script')
@endpush

