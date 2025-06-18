<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>
    @auth
        <p class="text-lg font-semibold">
        Welcome, {{ Auth::user()->first_name }}!
    </p>
    @endauth
    
</x-layout>