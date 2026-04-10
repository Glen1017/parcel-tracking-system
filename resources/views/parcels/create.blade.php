<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Create Parcel</h1>

        <form method="POST" action="{{ route('parcels.store') }}">
            @csrf

            <input name="sender_name" placeholder="Sender Name" class="border p-2 w-full mb-2">

            <input name="recipient_name" placeholder="Recipient Name" class="border p-2 w-full mb-2">

            <textarea name="address" placeholder="Delivery Address" class="border p-2 w-full mb-2"></textarea>

            <textarea name="return_address" placeholder="Return Address" class="border p-2 w-full mb-2"></textarea>

            <button class="bg-green-600 text-black px-4 py-2 rounded">
                Save Parcel
            </button>
        </form>
    </div>
</x-app-layout>