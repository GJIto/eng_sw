<x-layout>
    <x-slot:heading>
      New Expense
    </x-slot:heading>

  <form method="POST" action="/expense">
    @csrf

    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

          <x-form-field>
            <x-form-label for="value">Value</x-form-label>
            <div class="mt-2">
              <x-form-input type="number" name="value" id="value" step="0.01" min="0" required/>

              <x-form-error name="value" />
            </div>
          </x-form-field>

          <x-form-field>
            <x-form-label for="description">Description</x-form-label>
            <div class="mt-2">
              <x-form-input name="description" id="description" required/>

              <x-form-error name="description" />
            </div>
          </x-form-field>

        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a href="/groups/" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
      <x-form-button>Add</x-form-button>
    </div>
  </form>


</x-layout>