@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')
@section('description', 'Halaman daftar mahasiswa')

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
          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
          data-bs-target="#createStudentModal">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Siswa
          </button>
        </x-button-group-flex>
        <!-- Table displaying data-->
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                  <span class="badge rounded-pill text-bg-primary">{{ $student->identification_number }}</span>
                </td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->programStudy->name }}</td>
                <td>{{ $student->schoolClass->name }}</td>
                <td>
                  <div class="btn-group gap-1">
                    <!-- Button for showing data-->
                    <button type="button" class="btn btn-sm btn-primary showStudentButton" data-bs-toggle="modal"
                      data-id="{{ $student->id }}" data-bs-target="#detailStudentModal">
                      <i class="bi bi-eye-fill"></i>
                    </button>

                    <!-- Button for edit data-->
                    <button type="button" class="btn btn-sm btn-success editStudentButton" data-bs-toggle="modal"
                      data-id="{{ $student->id }}" data-bs-target="#editStudentModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- Button for delete data-->
                    <form action="{{ route('administrators.students.destroy', $student) }}" method="POST">
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
@include('administrator.student.modal.create')
@include('administrator.student.modal.show')
@include('administrator.student.modal.edit')
@endpush

@push('script')
@include('administrator.student.script')
@endpush