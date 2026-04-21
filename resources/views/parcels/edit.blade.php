<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Update Parcel Status </h1>

        @if ($errors->any())
            <div style="background-color:#fecaca; color:#991b1b; padding: 10px; border-radius: 6px; margin-bottom: 12px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('parcels.update', $parcel) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2">Tracking Number</label>
                <input type="text" value="{{ $parcel->tracking_number }}" class="border p-2 2-full mb-2" disabled>
            </div>

            <div class="mb-4">
                <label class="block mb-2">Status</label>
                <select name="status" class="border p-2 w-full">
                    <option value="Registered" {{ old('status', $parcel->status) == 'Registered' ? 'selected' : '' }}>Registered</option>
                    <option value="In Transit" {{ old('status', $parcel->status) == 'In Transit' ? 'selected' : '' }}>In Transit</option>
                    <option value="Out for Delivery" {{ old('status', $parcel->status) =='Out for Delivery' ? 'selected' : '' }}>Out for Delivery</option>
                    <option value="Delivered" {{ old('status', $parcel->status) == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>

            <button type="submit" style="background-color: #374151; color: white;" class="px-4 py-2 rounded">
                Update Status
            </button>
        </form>
    </div>
</x-app-layout>