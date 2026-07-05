<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            一行日記
        </h1>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if ($errors->any())
            <div class="text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @else
            <form action="{{ route('note.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                <div class="w-full flex flex-col">
                    <label for="text" class="font-semibold mt-4">きょうのできごと</label>
                    <textarea name="text" class="w-auto py-2 border border-gray-300 rounded-md" id="text" cols="30" rows="1"></textarea>
                </div>

                <div class="mb-3">
                    <label for="color_code" class="form-label">カラー選択</label>
                    <input type="color" 
                        class="form-control form-control-color w-100" 
                        id="color_code" 
                        name="color_code" 
                        title="色を選択してください">
                </div>

                <div class="w-full flex flex-col">
                    <label for="image_path" class="font-semibold mt-4">画像</label>
                    <input type="file" id="image_path" name="image_path" accept="image/*">
                </div>

                <x-primary-button class="mt-4">
                    送信
                </x-primary-button>
            </form>
        @endif
    </div>
</x-app-layout>
