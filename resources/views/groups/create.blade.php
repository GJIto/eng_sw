<x-layout>
    <x-slot:heading>
      Create Group 
    </x-slot:heading>

  <form method="POST" action="/groups">
    @csrf

    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">

        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <x-form-field>
            <x-form-label for="group_name">Group Name</x-form-label>
            <div class="mt-2">
              <x-form-input name="group_name" id="group_name" placeholder="My New Group" required/>

              <x-form-error name="group_name" />
            </div>
          </x-form-field>

          <x-form-field>
            <x-form-label for="description">Description</x-form-label>
            <div class="mt-2">
              <x-form-input name="description" id="description" placeholder="Description of your new group" required/>

              <x-form-error name="description" />
            </div>
          </x-form-field>

        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a  href="/groups" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
      <x-form-button>Create</x-form-button>
    </div>
  </form>


</x-layout>