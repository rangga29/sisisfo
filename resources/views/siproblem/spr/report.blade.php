@extends('siproblem.layouts.main')
@section('content')
    <h2 class="mb-4">{{ $spr->spr_title }}</h2>
    <div class="row">
        <!-- Main Conversation Section -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="conversation mb-4 pt-2">
                        @foreach ($messages as $message)
                            <div class="mb-4 px-2 pb-2 rounded border-bottom">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        @if($message->user->department->dp_name == $spr->department->dp_name)
                                            <div class="rounded-circle bg-info text-dark d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <strong>{{ strtoupper(substr($message->user->name, 0, 1)) }}</strong>
                                            </div>
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <strong>{{ strtoupper(substr($message->user->name, 0, 1)) }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <strong>{{ $message->user->name }}</strong>
                                        <span class="text-muted small d-block">{{ $message->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    {!! $message->spr_st_description !!}
                                </div>
                                <div class="mt-3">
                                    @if($message->spr_st_attachment)
                                        @php
                                            $attachments = json_decode($message->spr_st_attachment, true);
                                        @endphp
                                        <ul>
                                            @foreach($attachments as $file)
                                                <li>
                                                    <a href="{{ $file }}" target="_blank">{{ basename($file) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if($spr->spr_status == 'Terkirim' || $spr->spr_status == 'Diproses')
                            <form action="{{ route('siproblem.report.create-new-message', $spr->spr_ucode) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <textarea class="form-control ckeditor" name="spr_st_description" id="add_spr_st_description"></textarea>
                                </div>

                                <div class="mb-2">
                                    <label for="add_spr_st_attachment" class="form-label fw-bolder">Attachments</label>
                                    <input type="file" class="form-control" name="spr_st_attachment[]" id="add_spr_st_attachment" multiple>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm" type="submit">SUBMIT</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-6"><strong>Pengirim</strong></div>
                        <div class="col-6">{{ $spr->sender->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Bagian Pengirim</strong></div>
                        <div class="col-6">{{ $spr->sender->department->dp_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Tanggal Dibuat</strong></div>
                        <div class="col-6">{{ $spr->created_at->format('d M Y H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Update Terakhir</strong></div>
                        <div class="col-6">{{ $spr->updated_at->format('d M Y H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Dikerjakan Oleh</strong></div>
                        <div class="col-6">{{ $spr->assigned_id ? $spr->assigned->name : '' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-6"><strong>ID</strong></div>
                        <div class="col-6">#{{ $spr->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Status</strong></div>
                        <div class="col-6">
                            @if($spr->spr_status == 'Terkirim')
                                <span class="badge bg-primary">Terkirim</span>
                            @elseif($spr->spr_status == 'Diproses')
                                <span class="badge bg-success">Diproses</span>
                            @elseif($spr->spr_status == 'Dibatalkan')
                                <span class="badge bg-danger">Dibatalkan</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Tujuan SPR</strong></div>
                        <div class="col-6">{{ $spr->department->dp_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Kategori SPR</strong></div>
                        <div class="col-6">{{ $spr->problem->pr_name }}</div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                @if(auth()->user()->department->dp_name == $spr->department->dp_name)
                    @if($spr->spr_status == 'Terkirim' || $spr->spr_status == 'Diproses')
                        <form action="{{ route('siproblem.report.status-selesai', $spr->spr_ucode) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Selesai</button>
                        </form>
                        <form action="{{ route('siproblem.report.status-dibatalkan', $spr->spr_ucode) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Dibatalkan</button>
                        </form>
                    @elseif($spr->spr_status == 'Dibatalkan')
                        <form action="{{ route('siproblem.report.status-diproses', $spr->spr_ucode) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Diproses</button>
                        </form>
                        <form action="{{ route('siproblem.report.status-selesai', $spr->spr_ucode) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Selesai</button>
                        </form>
                    @else
                        <form action="{{ route('siproblem.report.status-diproses', $spr->spr_ucode) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Diproses</button>
                        </form>
                        <form action="{{ route('siproblem.report.status-dibatalkan', $spr->spr_ucode) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Dibatalkan</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
