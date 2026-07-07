<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::user()->id)->orderBy('date', 'desc')->paginate(5);
        return view('note.index', compact('notes'));
    }

    public function create()
    {
        return view('note.create');
    }


    public function store(Request $request)
    {
        // 画像有無チェック
        $request->merge([
            'has_image' => $request->hasFile('image_input') ? '1' : ($request->old('has_image') ?? '0')
        ]);

        // バリデーションチェック
        $request->validate([
            'date' => 'required|date',
            'note' => 'required|string|max:256',
            'image_input' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // 日付重複判定
        if (Note::where('date', $request->date)->exists()) {
            return back()->withErrors(['date' => 'その日の日記はすでに投稿済みです。']);
        }

        // カラー取得
        if ($request->color_option == "custom") {
            $color_code = $request->color_code;
        }

        // 画像保存
        if ($request->hasFile('image_input')) {
            $path = $request->file('image_input')->store('images', 'public');
        }

        $note = Note::create([
            'user_id' => Auth::user()->id,
            'date' => $request->date,
            'note' => $request->note,
            'color_code' => $color_code ?? null,
            'image_path' => $path ?? null,
        ]);

        $request->session()->flash('message', '投稿しました。');
        return redirect()->route('note.index');
    }
}
