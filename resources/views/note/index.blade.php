<x-app-layout>
    <x-slot name="header">
        <div class="lg:flex items-center justify-between">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                日記一覧
            </h1>
            <div class="max-w-md">
                <form class="flex items-center" action="{{ route('note.index') }}" method="GET">
                    @csrf
                    <input name="keyword" class="w-40 h-[34px] text-gray-700 border-1 rounded "
                    value="{{ request('keyword') }}" 
                    placeholder="日記を検索" >
                    <x-primary-button class="ml-4">
                        検索
                    </x-primary-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 mb-4">
        @if (session('message'))
            <p class="text-center text-sm font-bold mt-4 p-2 bg-[#FDFDFD] w-full rounded-sm border-l-8 shadow-lg">
                {{ session('message') }}
            </p>
        @endif
        @forelse($notes as $note)
        <div class="mt-4 p-2 bg-[#FDFDFD] w-full rounded-sm border-l-8 shadow-lg" 
            style="{{ $note->color_code ? 'border-color: ' . $note->color_code . ';' : 'border-color: transparent;' }}">
            <div class="flex items-center justify-between mb-1">
                <p class="text-sm font-bold">
                    @php
                    $weekday = $note->date->translatedFormat('D')
                    @endphp
                    {{ $note->date->format('Y年n月j日') }} ({{ $weekday }})
                </p>
                <div class="flex items-center gap-2 rounded-lg">
                    <a href="{{ (route('note.edit', $note))}}" class="text-xs px-2 py-1 rounded border-2 hover:bg-gray-200">
                            編集
                    </a>
                    {{-- <form action="{{ route('note.destroy', $note) }}" method="POST"> --}}
                        <button type="button" 
                                onclick="openConfirmModal('{{ $note->date->format('Y年n月j日') }} ({{ $weekday }})', '{{ route('note.destroy', $note) }}')"
                                class="text-xs px-2 py-1 rounded border-2 text-red-600 hover:bg-red-300">
                            削除
                        </button>
                    {{-- </form> --}}
                </div>
            </div>
            <hr class="w-full">
            <div class="flex justify-between items-center h-28 my-2">
                <p class="my-4 p-4 text-md min-w-0 break-words">
                    {{ $note->note }}
                </p>
                @if($note->image_path)
                <div class="w-24 h-24 flex-shrink-0 my-2">
                    <button type="button" onclick="openImageModal('{{ asset('storage/' . $note->image_path) }}')">
                        <img src="{{ asset('storage/' . $note->image_path) }}" alt="note_image" class="w-24 h-24 object-cover rounded shadow">
                    </button>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="mt-4 p-4 bg-[#FDFDFD] w-full rounded-sm border-l-8 shadow-lg" >
            @if ($is_search)
                <p>検索結果がありません。</p>
            @else
                <p>まだ日記がありません。</p>
            @endif
        </div>
        @endforelse
        <div class="my-4">
            {{ $notes->links() }}
        </div>
        {{-- モーダル --}}
        <dialog id="imageModal" class="p-0 rounded-lg shadow-xl backdrop:bg-gray-800/80">
            <div id="relative">
                <img id="image" src="" class="max-w-[90vw] max-h-[80vh]">
                <button onclick="closeImageModal()" 
                    class="absolute top-2 right-2 w-8 h-8 flex items-center justify-center text-lg bg-gray-600 text-white font-bold shadow-lg hover:bg-gray-700 transition">
                    ✕
                </button>
            </div>
        </dialog>
        <dialog id="confirmModal" class="p-0 rounded-lg shadow-xl backdrop:bg-gray-800/50">
            <div class="p-6">
                <h5 class="text-lg font-bold mb-4">確認</h5>
                <div id="modalBody" class="mb-6 text-gray-700"></div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeConfirmModal()" class="px-4 py-2 rounded-lg text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 transition">
                        キャンセル
                    </button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 rounded-lg text-xs bg-red-600 hover:bg-red-700 text-white transition" type="submit">
                            削除
                        </button>
                    </form>
                </div>
            </div>
        </dialog>

        <script>
            const imageModal = document.getElementById('imageModal');
            const Image = document.getElementById('image');

            function openImageModal(src) {
                Image.src = src;
                imageModal.showModal();
            }

            function closeImageModal() {
                imageModal.close();
            }

            imageModal.addEventListener('click', (e) => {
                if (e.target === imageModal) closeImageModal();
            });


            const confirmModal = document.getElementById('confirmModal');
            const form = document.getElementById('deleteForm');
            const modalBody = document.getElementById('modalBody');

            function openConfirmModal(date, action) {
                modalBody.textContent =  date + 'の日記を削除してもよろしいですか。';
                form.action = action;
                confirmModal.showModal();
            }

            function closeConfirmModal() {
                confirmModal.close();
            }

            confirmModal.addEventListener('click', (e) => {
                if (e.target === confirmModal) closeConfirmModal();
            });
        </script>
    </div>
</x-app-layout>