@extends('siproblem.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <div class="page-title-box">
                <h4 class="page-title">UBAH DATA DEPARTMENT</h4>
            </div>
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>ERROR : </strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <form action="{{ route('siproblem.admin.department.update', $department->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="edit_dp_code" class="form-label fw-bolder">Kode Department *</label>
                <input type="text" class="form-control" name="dp_code" id="edit_dp_code" placeholder="Kode Department" value="{{ $department->dp_code }}" required>
            </div>

            <div class="col-sm-6">
                <label for="edit_dp_name" class="form-label fw-bolder">Nama Department *</label>
                <input type="text" class="form-control" name="dp_name" id="edit_dp_name" placeholder="Nama Department" value="{{ $department->dp_name }}" required>
            </div>

            <div class="col-sm-6">
                <label for="add_dp_group" class="form-label fw-bolder">Grup Department *</label>
                <select class="form-select" name="dp_group" id="add_dp_group" required>
                    <option value="TIDAK ADA" {{ $department->dp_group == '' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="NON DIREKTORAT" {{ $department->dp_group == 'NON DIREKTORAT' ? 'selected' : '' }}>Non Direktorat</option>
                    <option value="DIREKTORAT MEDIS" {{ $department->dp_group == 'DIREKTORAT MEDIS' ? 'selected' : '' }}>Direktorat Medis</option>
                    <option value="DIREKTORAT KEPERAWATAN" {{ $department->dp_group == 'DIREKTORAT KEPERAWATAN' ? 'selected' : '' }}>Direktorat Keperawatan</option>
                    <option value="DIREKTORAT UMUM" {{ $department->dp_group == 'DIREKTORAT UMUM' ? 'selected' : '' }}>Direktorat Umum</option>
                </select>
            </div>

            <div class="col-sm-6">
                <label for="add_dp_spr" class="form-label fw-bolder">SPR Department *</label>
                <select class="form-select" name="dp_spr" id="add_dp_spr" required>
                    <option value="0" {{ $department->dp_spr == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="1" {{ $department->dp_spr == 1 ? 'selected' : '' }}>Aktif</option>
                </select>
            </div>
        </div>

        <div class="my-4 text-center">
            <button class="btn btn-primary btn-lg" type="submit">SUBMIT</button>
        </div>
    </form>
@endsection
