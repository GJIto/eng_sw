<x-layout>
    <x-slot:heading>
        Your Groups
    </x-slot:heading>
    <div class="space-y-4">
        @foreach ($groups as $group)
            {{-- {{ dd(dump($group->toArray())) }} --}}
            <a>
                <a href="/groups/{{ $group->id }}" class="block px-4 py-6 border border-gray-200 rounded-lg"> 
                    <div class="font-bold text-blue-500 text-sm">Group creator: {{ $group->user[0]->email }}</div>
                    <div>
                        <strong>{{ $group->group_name }}:</strong> {{ $group->description }}
                    </div>
                </a>
            </a>
        @endforeach

        <div>
            {{ $groups->links() }}
        </div>

    </div>
</x-layout>