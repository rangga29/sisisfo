@extends('siproblem.layouts.main')
@section('content')
    <table id="requestTable" class="table table-hover mt-3">
        <thead>
        <tr>
            <th>No</th>
            <th>Judul SPR</th>
            <th>ID</th>
            <th>Kategori</th>
            <th>Created</th>
            <th>Last Updated</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bagian as $b)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    <a href="{{ route('siproblem.report.view', $b->spr_ucode) }}" class="link-offset-2 link-underline link-underline-opacity-0" title="{{ $b->spr_title }}">
                        {{ strlen($b->spr_title) > 30 ? substr($b->spr_title, 0, 30) . '...' : $b->spr_title }}
                    </a>
                </td>
                <td>#{{ $b->id }}</td>
                <td>{{ $b->department->dp_name }} - {{ $b->problem->pr_name }}</td>
                <td>{{ $b->created_at->format('d M Y H:i') }}</td>
                <td>{{ $b->updated_at->format('d M Y H:i') }}</td>
                <td>
                    @if($b->spr_status == 'Terkirim')
                        <span class="badge bg-primary">Terkirim</span>
                    @elseif($b->spr_status == 'Diproses')
                        <span class="badge bg-success">Diproses</span>
                    @elseif($b->spr_status == 'Dibatalkan')
                        <span class="badge bg-danger">Dibatalkan</span>
                    @else
                        <span class="badge bg-secondary">Selesai</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
