<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            日記一覧
        </h1>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 mb-4">
        @foreach($notes as $note)
        <div class="mt-4 p-4 bg-[#FDFDFD] w-full rounded-sm border-l-8 shadow-lg" 
            style="{{ $note->color_code ? 'border-color: ' . $note->color_code . ';' : 'border-color: transparent;' }}">
            <p class=" text-sm font-bold">
                @php
                $weekday = $note->date->translatedFormat('D')
                @endphp
                {{ $note->date->format('Y年n月j日') }} ({{ $weekday }})
            </p>
            <hr class="w-full">
            <div class="flex justify-between items-center">
                <p class="mt-4 p-4 text-md min-w-0 break-words">
                    {{ $note->note }}
                </p>
                @if($note->image_path)
                <div class="w-24 h-24 flex-shrink-0 mt-4">
                    <button type="button" onclick="openModal('{{ asset('storage/' . $note->image_path) }}')">
                        <img src="{{ asset('storage/' . $note->image_path) }}" alt="note_image" class="w-24 h-24 object-cover rounded shadow">
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endforeach
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