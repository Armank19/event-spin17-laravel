@extends('dashboard.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-red-700">Daftar Peserta</h1>

<form method="POST" action="{{ route('participant.deleteSelected') }}">
    @csrf
    @method('DELETE')

    <div class="flex justify-end gap-3 mb-4">
        <button type="button" onclick="toggleCheckboxes()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Pilih
        </button>
        <button type="submit" onclick="return confirm('Yakin ingin menghapus data yang dipilih?')" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            Hapus Terpilih
        </button>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-red-700 text-white">
                <tr>
                    <th class="px-4 py-3">
                        <input type="checkbox" id="checkAll" class="hidden" onclick="checkAll(this)">
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">ID Karyawan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase">No WhatsApp</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold uppercase">Check-in</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold uppercase">Nomor Undian</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($peserta as $index => $data)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-2 text-center">
                            <input type="checkbox" name="ids[]" value="{{ $data->id }}" class="checkbox-row hidden">
                        </td>
                        <td class="px-4 py-2 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-sm font-medium text-gray-800">{{ $data->nama }}</td>
                        <td class="px-4 py-2 text-sm">{{ $data->id_karyawan }}</td>
                        <td class="px-4 py-2 text-sm">{{ $data->email }}</td>
                        <td class="px-4 py-2 text-sm">{{ $data->no_wa }}</td>
                        <td class="px-4 py-2 text-center">
                            @if ($data->status_checkin)
                                <span class="inline-flex items-center px-2 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">✅</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">❌</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center text-sm">
                            {{ $data->nomor_undian ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-500">Belum ada peserta terdaftar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>

{{-- Script --}}
<script>
    function toggleCheckboxes() {
        document.querySelectorAll('.checkbox-row, #checkAll').forEach(cb => {
            cb.classList.toggle('hidden');
        });
    }

    function checkAll(source) {
        const checkboxes = document.querySelectorAll('.checkbox-row');
        checkboxes.forEach(cb => cb.checked = source.checked);
    }
</script>
@endsection
