@extends('siproblem.layouts.main')
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pribadi-tab" data-bs-toggle="tab" href="#pribadi" role="tab" aria-controls="pribadi" aria-selected="true">Permintaan SPR Pribadi</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bagian-tab" data-bs-toggle="tab" href="#bagian" role="tab" aria-controls="bagian" aria-selected="false">Permintaan SPR Bagian</a>
        </li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="pribadi" role="tabpanel" aria-labelledby="pribadi-tab">
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
                    @foreach($pribadi as $p)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('siproblem.report.view', $p->spr_ucode) }}" class="link-offset-2 link-underline link-underline-opacity-0" title="{{ $p->spr_title }}">
                                    {{ strlen($p->spr_title) > 30 ? substr($p->spr_title, 0, 30) . '...' : $p->spr_title }}
                                </a>
                            </td>
                            <td>#{{ $p->id }}</td>
                            <td>{{ $p->department->dp_name }} - {{ $p->problem->pr_name }}</td>
                            <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $p->updated_at->format('d M Y H:i') }}</td>
                            <td>
                                @if($p->spr_status == 'Terkirim')
                                    <span class="badge bg-primary">Terkirim</span>
                                @elseif($p->spr_status == 'Diproses')
                                    <span class="badge bg-success">Diproses</span>
                                @elseif($p->spr_status == 'Dibatalkan')
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @else
                                    <span class="badge bg-secondary">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="bagian" role="tabpanel" aria-labelledby="bagian-tab">
            <table id="requestTable2" class="table table-hover mt-3">
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
                                <a href="{{ route('siproblem.report.view', $b->spr_ucode) }}" class="link-offset-2 link-underline link-underline-opacity-0" title="{{ $p->spr_title }}">
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
        </div>
    </div>
@endsection
