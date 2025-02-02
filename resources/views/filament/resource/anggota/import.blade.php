<form action="{{ route('anggota.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xlsx, .xls" class="block w-full px-4 py-2 mb-4 border border-gray-300 rounded-md" required>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Import</button>
</form>
