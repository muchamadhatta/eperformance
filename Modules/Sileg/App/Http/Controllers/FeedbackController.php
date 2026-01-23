<?php

namespace Modules\Sileg\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sileg\Feedback;
use App\Models\Sileg\Ruu;
use App\Models\Sileg\Akd;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $feedbacks = Feedback::where('status', 1);

        if ($request->has('periode')) {
            $periode = $request->input('periode');

            // Jika bukan "seluruh", gunakan nilai periode untuk menyaring data
            if ($periode !== 'seluruh') {
                $feedbacks->whereYear('tanggal_input', $periode);

                // Simpan tahun periode ke dalam sesi
                session(['periode' => $periode]);
            } else {
                // Jika "seluruh", hapus sesi periode
                session()->forget('periode');
            }
        } else {
            // Ambil tahun periode dari sesi jika ada
            $periode = session('periode');
            if ($periode && $periode !== 'seluruh') {
                $feedbacks->whereYear('tanggal_input', $periode);
            }
        }

        $feedbacks = $feedbacks->orderBy('id', 'desc')->get();
        return view('sileg::feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        $akds = Akd::where('status', 1)->get();
        $ruus = Ruu::where('status', 1)->get();
        return view('sileg::feedback.create', compact('akds', 'ruus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $feedback = Feedback::create($data);

        return redirect()->route('feedback.edit', ['id' => $feedback->id])
            ->with('success', 'Daftar Feedback berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        $akds = Akd::where('status', 1)->get();
        $ruus = Ruu::where('status', 1)->get();
        return view('sileg::feedback.edit', compact('feedback','akds', 'ruus'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();


        $feedback = Feedback::findOrFail($id);
        $feedback->update($data);

        return redirect()->route('feedback.index')
            ->with('success', 'Daftar Feedback berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->status = 9;
        $feedback->save();

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }

}
