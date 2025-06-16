<x-layout>
    <x-slot:heading>
        Expense Listings
    </x-slot:heading>
    <div class="space-y-4">
        @foreach ($expenses as $expense)
            <a>
                <a href="/expenses/{{ $expense['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg"> 
                    <div class="font-bold text-blue-500 text-sm">{{ $expense->employer->name }}</div>
                    <div>
                        <strong>{{ $expense['title'] }}:</strong> Pays {{ $expense['salary'] }} per year.
                    </div>
                </a>
            </a>
        @endforeach

        <div>
            {{ $expenses->links() }}
        </div>

    </div>
</x-layout>