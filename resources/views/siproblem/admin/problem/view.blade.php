@extends('siproblem.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ route('siproblem.admin.problem.create') }}" class="btn btn-primary">
                        ✙ Tambah Data
                    </a>
                </div>
                <h4 class="page-title">DATA PROBLEM</h4>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>SUCCESS - </strong>{{ session('success') }}
                </div>
            @endif
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
    <table id="requestTable" class="table table-hover mt-3">
        <thead>
        <tr>
            <th>No</th>
            <th>Department</th>
            <th>Nama</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($problems as $problem)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $problem->department->dp_name }}</td>
                <td>{{ $problem->pr_name }}</td>
                <td>{{ $problem->created_at }}</td>
                <td>{{ $problem->updated_at }}</td>
                <td style="max-width: 6px;">
                    <div class="d-flex align-content-center">
                        <a href="{{ route('siproblem.admin.problem.edit', $problem->pr_ucode) }}" class="btn btn-sm btn-warning cl-edit" title="EDIT DATA">✎</a>
                        <form method="POST" action="{{ route('siproblem.admin.problem.delete', $problem->pr_ucode) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger ms-1" title="DELETE DATA" onclick="return confirm('Yakin Ingin Menghapus Data?')">🗙</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
