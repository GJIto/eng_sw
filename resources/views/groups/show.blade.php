<x-layout>

    <x-slot:heading>
        {{ $group->group_name }} 
        <h1 class="font-bold text-lg"></h1>
        {{-- {{ dd($group['user']) }} --}}
        
        <x-button href="/groups/{{ $group->id }}/expense">Add expense</x-button>
        
    </x-slot:heading>
{{-- {{ dd($group->user[0]->first_name) }} --}}
    Members:
        @foreach ($group->user as $user)
            <p class="block px-2 py-2 border border-gray-50 rounded-lg">{{ $user->first_name }}  </p>
        @endforeach

        @foreach ($group['expenses'] as $desp)
        
                <div class="block px-4 py-6 border border-gray-200 rounded-lg"> 
                    
                        <div class="font-bold text-blue-500 text-sm"> {{ $desp->description }}</div>
                        <div>
                            R$ <strong>{{ $desp->amount }}</strong> 
                        </div>
                        Created: {{ $desp -> created_at }}
                </div>       
        @endforeach
        {{-- <p class="">{{ dd($desp) }}</p> --}}

</x-layout>