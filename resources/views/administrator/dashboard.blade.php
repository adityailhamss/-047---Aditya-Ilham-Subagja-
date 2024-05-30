@extends('layouts.app')

@section('title', 'Beranda')
@section('description', 'Halaman Beranda')

@section('content')
<section class="row">
  <div class="col-12 col-lg-9">
    <div class="row">
      <!-- Card for Total Administrators -->
      <div class="col-6 col-lg-4 col-md-6">
        <div class="card">
          <a href="{{ route('administrators.users.index') }}">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon blue mb-2">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <!-- Data for Administrator Card -->
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Administrator</h6>
                  <h6 class="font-extrabold mb-0">{{ $counts['administrator'] }}</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- Card for Total Siswa -->
      <div class="col-6 col-lg-4 col-md-6">
        <div class="card">
          <a href="{{ route('administrators.students.index') }}">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon green mb-2">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <!-- Data for Siswa Card -->
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Siswa</h6>
                  <h6 class="font-extrabold mb-0">{{ $counts['student'] }}</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- Card for Total Komoditas -->
      <div class="col-6 col-lg-4 col-md-6">
        <div class="card">
          <a href="{{ route('administrators.commodities.index') }}">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon red mb-2">
                    <i class="iconly-boldBookmark"></i>
                  </div>
                </div>
                <!-- Data for Komoditas Card -->
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Komoditas</h6>
                  <h6 class="font-extrabold mb-0">{{ $counts['commodity'] }}</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <!-- Start of the second row with borrowing chart -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 id="card-chart-borrowing-title">Peminjaman Tahun Ini</h4>
            <div class="mb-3">
              <label for="year" class="form-label">Isi Tahun:</label>
              <input type="number" id="year" placeholder="Masukan tahun.." value="{{ date('Y') }}" class="form-control">
              <div class="form-text">Tekan tombol `Enter` untuk menampilkan grafik berdasarkan tahun yang dipilih.</div>
            </div>
          </div>
          <div class="card-body">
            <!-- Placeholder for the borrowing chart -->
            <div id="chart-borrowing-by-year" style="height: 200px"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Start of the third row with not returned commodities -->
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="card">
          <div class="card-header">
            <h4>Komoditas Yang Belum Dikembalikan</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-lg datatable">
                <thead>
                  <tr>
                    <th>Nama Siswa</th>
                    <th>Komoditas</th>
                    <th>Tanggal Peminjaman</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($borrowingsNotReturned as $borrowing)
                  @if ($borrowing->student)
                  <tr>
                    <td>
                      <!-- Display student information with tooltip -->
                      <span class="badge text-bg-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="{{ $borrowing->student->identification_number }} - {{ $borrowing->student->phone_number }}">{{
                        $borrowing->student->name }}</span>
                    </td>
                    <td>{{ $borrowing->commodity->name }}</td>
                    <td>{{ $borrowing->date }}</td>
                  </tr>
                  @else
                  
                @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Start of the right-side column for additional info -->
  <div class="col-12 col-lg-3">
    <!-- Card for displaying administrator's profile -->
    <div class="card">
      <div class="card-body py-4 px-4">
        <div class="d-flex align-items-center">
          <div class=" ms-3 name">
            <h5 class="font-bold">{{ auth('administrator')->user()->name }}</h5>
            <h6 class="text-muted mb-0">{{ auth('administrator')->user()->email }}</h6>
          </div>
        </div>
      </div>
    </div>
    <!-- Card for displaying most borrowed commodities -->
    <div class="card">
      <div class="card-header">
        <h4>Komoditas Terbanyak Dipinjam</h4>
      </div>
      <div class="card-content pb-4">
        <div class="card-body">
          <!-- Placeholder for pie chart of most borrowed commodities -->
          <div id="chart-borrowing-pie" style="height: 300px"></div>
        </div>
      </div>
    </div>

    <!-- Card for displaying recently registered students -->
    <div class="card">
      <div class="card-header">
        <h4>Siswa Yang Baru Terdaftar</h4>
      </div>
      <div class="card-content pb-4">
        @foreach ($latestRegisteredStudents as $student)
        <div class="recent-message d-flex px-4 py-3">
          <div class="name ms-4">
            <h5 class="mb-1">{{ $student->name }}</h5>
            <h6 class="text-muted mb-0">{{ $student->email }}</h6>
          </div>
        </div>
        @endforeach
        <div class="px-4">
          <a href="{{ route('administrators.students.index') }}"
            class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
            Daftar Siswa
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
@include('administrator.script')
@endpush