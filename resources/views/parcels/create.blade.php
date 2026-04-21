<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Create Parcel</h1>

        @if ($errors->any())
            <div style="background-color:#fecaca; color:#991b1b; padding: 10px; border-radius: 6px; margin-bottom: 12px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('parcels.store') }}">
            @csrf

            <input name="sender_name" value="{{ old('sender_name') }}" placeholder="Sender Name" class="border p-2 w-full mb-2">

            <input name="recipient_name" value="{{ old('recipient_name') }}" placeholder="Recipient Name" class="border p-2 w-full mb-2">

            <textarea name="address" placeholder="Delivery Address" class="border p-2 w-full mb-2">{{ old('address') }}</textarea>

            <textarea name="return_address" placeholder="Return Address" class="border p-2 w-full mb-2">{{ old('return_address') }}</textarea>

            <button type="submit" style="background-color: #374151; color: white;" class="px-4 py-2 rounded">
                Save Parcel
            </button>
        </form>

    </div>
</x-app-layout>