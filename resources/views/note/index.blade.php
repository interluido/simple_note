<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            日記一覧
        </h1>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 mb-4">
        @if (session('message'))
            <p class="text-center text-sm font-bold mt-4 p-2 text-blue-600 bg-[#FDFDFD] w-full rounded-sm border-l-8 shadow-lg">
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
                <div class="flex items-center gap-2">
                    <a href="{{ (route('note.edit', $note))}}" class="text-xs px-2 py-1 rounded border-2 hover:bg-gray-200">
                            編集
                    </a>
                    <form action="{{ route('note.destroy', $note) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-xs px-2 py-1 rounded border-2 hover:bg-red-100 text-red-600">
                            削除
                        </button>
                    </form>
                </div>
            </div>
            <hr class="w-full">
            <div class="flex justify-between items-center h-28 my-2">
                <p class="my-4 p-4 text-md min-w-0 break-words">
                    {{ $note->note }}
                </p>
                @if($note->image_path)
                <div class="w-24 h-24 flex-shrink-0 my-2">
                    <button type="button" onclick="openModal('{{ asset('storage/' . $note->image_path) }}')">
                        <img src="{{ asset('storage/' . $note->image_path) }}" alt="note_image" class="w-24 h-24 object-cover rounded shadow">
                    </button>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="mt-4 p-4 bg-[#FDFDFD] w-full rounded-sm border-l-8 shadow-lg" >
            <p>まだ日記がありません</p>
        </div>
        @endforelse
        <div class="my-4">
            {{ $notes->links() }}
        </div>

        <dialog id="imageModal" class="p-0 bg-transparent backdrop:bg-gray-800/80 ">
            <div id="relative">
                <img id="modalImage" src="" class="max-w-[90vw] max-h-[80vh] rounded-lg">
                <button onclick="closeModal()" 
                    class="absolute top-2 right-2 w-8 h-8 flex items-center justify-center text-lg bg-gray-600 text-white font-bold shadow-lg hover:bg-gray-700 transition">
                    ✕
                </button>
            </div>
        </dialog>

        <script>
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');

            function openModal(src) {
                modalImg.src = src;
                modal.showModal();
            }

            function closeModal() {
                modal.close();
            }

            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        </script>
    </div>
</x-app-layout>