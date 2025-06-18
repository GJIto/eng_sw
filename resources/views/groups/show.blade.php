<x-layout>

    <x-slot:heading>
        {{ $group->group_name }} 
        <h1 class="font-bold text-lg"></h1>
        
        {{-- <x-button href="/groups/{{ $group->id }}/expenses">Add expense</x-button> --}}
        <x-button :href="route('expenses.create', $group)">Add expense</x-button>
    </x-slot:heading>

    <strong>Members:</strong>

    @foreach ($group->user as $user)
        <p class="block px-2 py-2 border border-gray-50 rounded-lg">{{ $user->first_name }}  </p>
    @endforeach

    <form method="POST" action="{{ route('groups.addMember', $group) }}">
        @csrf
        
        <x-form-label for="email">Add member by email:</x-form-label>
        <x-form-input type="email" name="email" id="email" required placeholder="user@example.com" />
        <div class="mt-2">
            <x-form-button type="submit">Add Member</x-form-button>
        </div>

    </form>

    @foreach ($group as $item)
    @endforeach

    @foreach ($group->expenses as $expense)
            
            <div class="block px-4 py-6 border border-gray-200 rounded-lg"> 
                
                    <div class="font-bold text-blue-500 text-sm"> {{ $expense->description }}</div>
                    <div>
                        <strong>R${{ number_format($expense->amount, 2) }}</strong> 
                    </div>
                    Owner: <strong>{{ $expense->user->first_name}}</strong> <br>Data: {{ $expense->created_at->format('d M Y, H:i') }}
            </div>       
    @endforeach

</x-layout>