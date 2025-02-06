<?php

namespace App\Http\Controllers\Siproblem;

use App\Http\Controllers\Controller;
use App\Models\Siproblem\Department;
use App\Models\Siproblem\Problem;
use App\Models\Siproblem\Spr;
use App\Models\Siproblem\SprMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index(Spr $spr)
    {
        $messages = SprMessage::where('spr_id', $spr->id)->get();

        return view('siproblem.spr.report', compact('spr', 'messages'));
    }

    public function viewList()
    {
        return view('siproblem.spr.list-spr', [
            'bagian' => Spr::where('dp_id', auth()->user()->department->id)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function create()
    {
        return view('siproblem.spr.new-spr', [
            'departments' => Department::where('dp_spr', true)->orderBy('dp_name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'spr_title' => 'required',
            'dp_id' => 'required|exists:departments,id',
            'pr_id' => 'required|exists:problems,id',
            'spr_st_description' => 'nullable|string',
            'spr_st_attachment' => 'nullable|array',
            'spr_st_attachment.*' => 'file|max:2048', // 2MB max per file
        ], [
            'spr_title.required' => 'Judul SPR harus diisi.',
            'dp_id.required' => 'Tujuan Departemen SPR harus dipilih.',
            'dp_id.exists' => 'Tujuan Departemen SPR yang dipilih tidak valid.',
            'pr_id.required' => 'Kategori SPR harus dipilih.',
            'pr_id.exists' => 'Kategori SPR yang dipilih tidak valid.',
            'spr_st_description.string' => 'Isi SPR harus berupa teks.',
            'spr_st_attachment.array' => 'Attachments harus berupa kumpulan file.',
            'spr_st_attachment.*.file' => 'Setiap Attachments harus berupa file yang valid.',
            'spr_st_attachment.*.max' => 'Ukuran setiap Attachments tidak boleh lebih dari 2MB.',
        ]);

        $uploadedFiles = [];

        if ($request->hasFile('spr_st_attachment')) {
            foreach ($request->file('spr_st_attachment') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/uploads', $filename, 'public');
                $uploadedFiles[] = asset('storage/public/uploads/' . $filename);
            }
        }

        do {
            $ucode = Str::random(20);
            $ucodeCheck = Spr::where('spr_ucode', $ucode)->exists();
        } while ($ucodeCheck);

        $spr = Spr::create([
            'dp_id' => $request->dp_id,
            'pr_id' => $request->pr_id,
            'sender_id' => $request->sender_id,
            'spr_ucode' => $ucode,
            'spr_title' => $request->spr_title,
            'spr_status' => 'Terkirim'
        ]);

        do {
            $ucode2 = Str::random(20);
            $ucodeCheck2 = SprMessage::where('spr_st_ucode', $ucode2)->exists();
        } while ($ucodeCheck2);

        $sprMessage = SprMessage::create([
            'spr_id' => $spr->id,
            'user_id' => $request->sender_id,
            'spr_st_ucode' => $ucode2,
            'spr_st_description' => $request->spr_st_description,
            'spr_st_attachment' => json_encode($uploadedFiles),
        ]);

        return redirect()->route('siproblem.report.view', $spr->spr_ucode);
    }

    public function createNewMessage(Request $request, Spr $spr)
    {
        $request->validate([
            'spr_st_description' => 'nullable|string',
            'spr_st_attachment' => 'nullable|array',
            'spr_st_attachment.*' => 'file|max:2048', // 2MB max per file
        ], [
            'spr_st_description.string' => 'Isi Pesan harus berupa teks.',
            'spr_st_attachment.array' => 'Attachments harus berupa kumpulan file.',
            'spr_st_attachment.*.file' => 'Setiap Attachments harus berupa file yang valid.',
            'spr_st_attachment.*.max' => 'Ukuran setiap Attachments tidak boleh lebih dari 2MB.',
        ]);

        $uploadedFiles = [];

        if ($request->hasFile('spr_st_attachment')) {
            foreach ($request->file('spr_st_attachment') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/uploads', $filename, 'public');
                $uploadedFiles[] = asset('storage/public/uploads/' . $filename);
            }
        }

        do {
            $ucode = Str::random(20);
            $ucodeCheck = SprMessage::where('spr_st_ucode', $ucode)->exists();
        } while ($ucodeCheck);

        // Cek User Yang Login | Ambil Department
        $user = auth()->user()->department;

        // Jika User Department sama dengan User SPR Aktif
        if($user->dp_spr) {
            // User Department sama dengan User Tujuan SPR
            if($user->dp_code == $spr->department->dp_code) {
                // Dia User Petugas
                // Jika Assigned SPR Ada
                if($spr->assigned_id) {
                    $spr->update([
                        'updated_at' => now()
                    ]);
                    SprMessage::create([
                        'spr_id' => $spr->id,
                        'user_id' => auth()->user()->id,
                        'spr_st_ucode' => $ucode,
                        'spr_st_description' => $request->spr_st_description,
                        'spr_st_attachment' => json_encode($uploadedFiles),
                    ]);
                } else {
                    $spr->update([
                        'assigned_id' => auth()->user()->id,
                        'spr_status' => 'Diproses',
                        'updated_at' => now()
                    ]);
                    SprMessage::create([
                        'spr_id' => $spr->id,
                        'user_id' => auth()->user()->id,
                        'spr_st_ucode' => $ucode,
                        'spr_st_description' => $request->spr_st_description,
                        'spr_st_attachment' => json_encode($uploadedFiles),
                    ]);
                }
            } else {
                // Dia User Biasa
                $spr->update([
                    'updated_at' => now()
                ]);
                SprMessage::create([
                    'spr_id' => $spr->id,
                    'user_id' => auth()->user()->id,
                    'spr_st_ucode' => $ucode,
                    'spr_st_description' => $request->spr_st_description,
                    'spr_st_attachment' => json_encode($uploadedFiles),
                ]);
            }
        } else {
            // Dia User Biasa
            $spr->update([
                'updated_at' => now()
            ]);
            SprMessage::create([
                'spr_id' => $spr->id,
                'user_id' => auth()->user()->id,
                'spr_st_ucode' => $ucode,
                'spr_st_description' => $request->spr_st_description,
                'spr_st_attachment' => json_encode($uploadedFiles),
            ]);
        }

        return redirect()->route('siproblem.report.view', $spr->spr_ucode);
    }

    public function statusDiproses (Request $request, Spr $spr)
    {
        $spr->update([
            'spr_status' => 'Diproses',
            'updated_at' => now()
        ]);
        return redirect()->route('siproblem.report.view', $spr->spr_ucode);
    }

    public function statusDibatalkan (Request $request, Spr $spr)
    {
        $spr->update([
            'spr_status' => 'Dibatalkan',
            'updated_at' => now()
        ]);
        return redirect()->route('siproblem.report.view', $spr->spr_ucode);
    }

    public function statusSelesai (Request $request, Spr $spr)
    {
        $spr->update([
            'spr_status' => 'Selesai',
            'updated_at' => now()
        ]);
        return redirect()->route('siproblem.report.view', $spr->spr_ucode);
    }

    public function getProblemsByDepartment($departmentId)
    {
        $problems = Problem::where('dp_id', $departmentId)->orderBy('pr_name')->get();
        return response()->json($problems);
    }
}
