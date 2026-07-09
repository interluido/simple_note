<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Note;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $is_search = '0';
        if (!empty($keyword)) {
            $notes = Note::where('user_id', Auth::user()->id)->where('note', 'LIKE', "%{$keyword}%")->orderBy('date', 'desc')->paginate(5);
            $is_search = '1';
        } else {
            $notes = Note::where('user_id', Auth::user()->id)->orderBy('date', 'desc')->paginate(5);
        }
        return view('note.index', compact('notes', 'is_search'));
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
            'image_input' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ]);

        // 日付重複判定
        if (Note::where('user_id', Auth::user()->id)->where('date', $request->date)->exists()) {
            return back()->withInput()->withErrors(['date' => 'その日の日記はすでに投稿済みです。']);
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

        $dateObj = Carbon::parse($request->date);
        $date_with_weekday = $dateObj->translatedFormat('Y年n月j日(D)');

        $request->session()->flash('message', $date_with_weekday . 'の日記を投稿しました。');
        return redirect()->route('note.index');
    }

    public function edit(Note $note)
    {
        return view('note.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $request->merge([
            'has_image' => $request->hasFile('image_input') ? '1' : ($request->old('has_image') ?? '0')
        ]);

        // バリデーションチェック
        $request->validate([
            'date' => 'required|date',
            'note' => 'required|string|max:256',
            'image_input' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ]);

        // カラー取得
        if ($request->color_option == "custom") {
            $color_code = $request->color_code;
        }

        // 画像有無チェック
        if ($request->has('remove_image_checkbox')) {
            // storage から実ファイルを削除
            if ($note->image_path) {
                Storage::disk('public')->delete($note->image_path);
            }
            $note->image_path = null;
        } else {
            $path = $note->image_path;
        }

        // 画像保存
        if ($request->hasFile('image_input')) {
            $path = $request->file('image_input')->store('images', 'public');
        }

        $note->update([
            'note' => $request->note,
            'color_code' => $color_code ?? null,
            'image_path' => $path ?? null,
        ]);

        $dateObj = Carbon::parse($request->date);
        $date_with_weekday = $dateObj->translatedFormat('Y年n月j日(D)');

        $request->session()->flash('message', $date_with_weekday . 'の日記を更新しました。');
        return redirect()->route('note.index');
    }

    public function destroy(Request $request, Note $note)
    {
        if ($note->image_path) {
            Storage::disk('public')->delete($note->image_path);
        }

        $dateObj = Carbon::parse($note->date);
        $date_with_weekday = $dateObj->translatedFormat('Y年n月j日(D)');

        $note->delete();
        $request->session()->flash('message', $date_with_weekday . 'の日記を削除しました。');
        return redirect()->route('note.index');
    }
}
