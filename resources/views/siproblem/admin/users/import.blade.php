@extends('siproblem.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <div class="page-title-box">
                <h4 class="page-title">IMPORT DATA USER</h4>
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
    <form action="{{ route('siproblem.admin.user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-sm-12">
                <input type="file" class="form-control" name="data_user" id="data_user" placeholder="DATA USER" required>
            </div>

        <div class="my-4 text-center">
            <button class="btn btn-primary btn-lg" type="submit">SUBMIT</button>
        </div>
    </form>
@endsection
