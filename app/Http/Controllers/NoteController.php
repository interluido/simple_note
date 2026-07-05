<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function create()
    {
        return view('note.create');
    }

    public function store(Request $request)
    {
        if (Note::where('date', $request->date)->exists()) {
            return back()->withErrors(['date' => 'その日の日記はすでに投稿済みです。']);
        }

        $request->validate([
            'text' => 'required|string|max:255',
            'color_code' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            // storage/app/public/images に保存
            $path = $request->file('image_path')->store('images', 'public');
            $data['image_path'] = $path;
        }

        // return redirect()->route('note.index')->with('success', '日記を投稿しました！');

        $note = Note::create([
            'date' => $request->date,
            'text' => $request->text,
            'color_code' => $request->color_code,
            'image_path' => $path ?? null, // 画像がある場合のみ保存
        ]);

        $request->session()->flash('message', '投稿しました。');
        return back();
    }
}
