<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            日記を編集する
        </h1>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <form class="mt-4 max-w-lg mx-auto p-6 bg-white rounded-xl shadow-sm border border-gray-100" action="{{ route('note.update', $note) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            @php
            $weekday = $note->date->translatedFormat('D')
            @endphp                
            <div class="mb-2">
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">日付</label>
                <input type="hidden" name="date" value="{{ $note->date }}">
                <label name="date">{{ $note->date->format('Y年n月j日') }} ({{ $weekday }})</label>
            </div>

            <div class="mb-2">
                <label for="note" class="block text-sm font-medium text-gray-700 mb-1">きょうのできごと</label>
                <textarea id="text" name="note" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                maxlength="256" rows="1">{{ old('note', $note->note) }}</textarea>
            </div>

            @php
            $color_option = $note->color_code === '' ? 'none' : 'custom'
            @endphp
            <div class="mb-2">
                <label for="color_code" class="block text-sm font-medium text-gray-700 mb-2">今のあなたらしいと感じる色</label>
                <div class="flex items-center gap-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="color_option" value="none" class="block text-sm text-gray-700 mr-2" onchange="toggleColorPicker()" 
                        {{ old('color_option', $color_option) == 'none' ? 'checked' : '' }}> 指定しない
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="color_option" value="custom" class="mr-2" onchange="toggleColorPicker()" 
                        {{ old('color_option', $color_option) == 'custom' ? 'checked' : '' }}>
                        <input type="color" id="color_picker" name="color_code" value="{{ old('color_code', $note->color_code) }}"
                        class="h-8 w-16 cursor-pointer rounded border border-gray-300 disabled:opacity-50 duration-200">
                    </label>
                </div>
            </div>

            <div class="mb-2">
                <label for="image_input" class="block text-sm font-medium text-gray-700 mb-1">画像</label>
                <input type="file" id="image_input" name="image_input" accept="image/*"
                class="mb-3 block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
                
                <div id="preview_area" class="hidden">
                    <img id="image_preview" src="#" alt="プレビュー" class="max-h-40 rounded-lg shadow-sm">
                </div>
                @if($note->image_path)
                <div id="preview_area_old">
                    <img id="image_preview" src="{{ asset('storage/' . $note->image_path) }}" alt="プレビュー" class="max-h-40 max-w-full object-contain rounded-lg shadow-sm">
                </div>
                @endif

                <input type="hidden" name="has_image" value="{{ old('has_image', '0') }}">
            </div>

            <div class="flex mt-4 items-center justify-between">
                <div class="flex-1 text-left">
                    @if ($errors->any())
                        <div class="text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                @if (old('has_image') == '1')
                                    <li>画像ファイルは再度選択してください。</li>
                                @endif

                            </ul>
                        </div>
                    @endif
                </div>
                <a href="{{ route('note.index') }}" >
                <x-secondary-button type="button">
                    キャンセル
                </x-secondary-button>
                </a>
                <x-primary-button class="ml-4">
                    送信する
                </x-primary-button>
            </div>
        </form>

        <script>
            // 色選択
            document.addEventListener('DOMContentLoaded', toggleColorPicker);

            function toggleColorPicker() {
                const isCustom = document.querySelector('input[name="color_option"][value="custom"]').checked;
                const picker = document.getElementById('color_picker');
                
                // disabledの代わりにポインター操作を禁止し、透過度を変える
                if (isCustom) {
                    picker.style.pointerEvents = 'auto';
                    picker.style.opacity = '1';
                } else {
                    picker.style.pointerEvents = 'none';
                    picker.style.opacity = '0.5';
                }
            }

            // 画像プレビュー
            document.getElementById('image_input').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('image_preview');
                const area = document.getElementById('preview_area');
                const area_old = document.getElementById('preview_area_old');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        area.classList.remove('hidden');
                        area_old.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </div>
</x-app-layout>
