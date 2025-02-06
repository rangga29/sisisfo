@extends('siproblem.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <div class="page-title-box">
                <h4 class="page-title">UBAH DATA PROBLEM</h4>
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
    <form action="{{ route('siproblem.admin.problem.update', $problem->pr_ucode) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="edit_dp_id" class="form-label fw-bolder">Nama Department *</label>
                <select class="form-select" name="dp_id" id="edit_dp_id" required>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $problem->department->id == $department->id ? 'selected' : '' }}>{{ $department->dp_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <label for="edit_pr_name" class="form-label fw-bolder">Nama Problem *</label>
                <input type="text" class="form-control" name="pr_name" id="edit_pr_name" placeholder="Nama Problem" value="{{ $problem->pr_name }}" required>
            </div>
        </div>

        <div class="my-4 text-center">
            <button class="btn btn-primary btn-lg" type="submit">SUBMIT</button>
        </div>
    </form>
@endsection
