@extends('siproblem.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <div class="page-title-box">
                <h4 class="page-title">SPR BARU</h4>
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
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <input type="hidden" name="sender_id" value="{{ auth()->user()->id }}">
            <div class="col-sm-12">
                <label for="add_spr_title" class="form-label fw-bolder">Judul SPR *</label>
                <input type="text" class="form-control" name="spr_title" id="add_spr_title" placeholder="Judul SPR" required>
            </div>

            <div class="col-sm-6">
                <label for="add_dp_id" class="form-label fw-bolder">Tujuan Department SPR *</label>
                <select class="form-select" name="dp_id" id="add_dp_id" required>
                    <option value="" selected disabled>Pilih Nama Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->dp_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <label for="add_pr_id" class="form-label fw-bolder">Kategori SPR *</label>
                <select class="form-select" name="pr_id" id="add_pr_id" required>
                    <option value="" selected disabled>Pilih Nama Kategori</option>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>

            <div class="col-sm-12">
                <label for="add_spr_st_description" class="form-label fw-bolder">Isi SPR *</label>
                <textarea class="form-control ckeditor" name="spr_st_description" id="add_spr_st_description"></textarea>
            </div>

            <div class="col-sm-12">
                <label for="add_spr_st_attachment" class="form-label fw-bolder">Attachments</label>
                <input type="file" class="form-control" name="spr_st_attachment[]" id="add_spr_st_attachment" multiple>
            </div>
        </div>

        <div class="my-4 text-center">
            <button class="btn btn-primary btn-lg" type="submit">SUBMIT</button>
        </div>
    </form>
@endsection
