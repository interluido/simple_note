<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            日記一覧
        </h1>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 mb-4">
        @foreach($notes as $note)
        <div class="mt-4 p-4 bg-white w-full rounded-2xl">
            <p class=" text-sm ">
                {{ $note->date }}
            </p>
            <hr class="w-full" style="border-color: {{ $note->color_code }};">
            <p class="mt-4 p-4">
                {{ $note->note }}
            </p>

        </div>
        @endforeach
        <div class="my-4">
            {{ $notes->links() }}
        </div>

    </div>
</x-app-layout>
