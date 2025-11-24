@extends('layouts.admin.app')
@section('content')
        <div class="flex flex-wrap my-6 -mx-3">
            <!-- card Kejadian Bencana -->
            <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">

                    <!-- Header Card -->
                    <div
                        class="border-black/12.5 mb-0 rounded-t-2xl border-b border-solid bg-white p-6 pb-3 flex justify-between items-center">
                        <h6 class="text-lg font-semibold">➕Tambah Kejadian Bencana</h6>
                        <a href="{{ route('kejadian.index') }}"
                            class="px-4 py-2 text-sm rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                            Kembali
                        </a>
                    </div>

                    <!-- Body Form -->
                    <div class="flex-auto p-6">
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kejadian.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <!-- Jenis Bencana -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Jenis Bencana</label>
                                    <input type="text" name="jenis_bencana" class="w-full p-2 border rounded-lg"
                                        placeholder="Contoh: Banjir, Gempa" required>
                                </div>

                                <!-- Tanggal -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Tanggal Kejadian</label>
                                    <input type="date" name="tanggal" class="w-full p-2 border rounded-lg"
                                        required>
                                </div>

                                <!-- Lokasi -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Lokasi (Deskripsi)</label>
                                    <input type="text" name="lokasi_text" class="w-full p-2 border rounded-lg"
                                        placeholder="Contoh: Desa Sukamaju">
                                </div>

                                <!-- RT -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">RT</label>
                                    <input type="number" name="rt" class="w-full p-2 border rounded-lg"
                                        placeholder="RT">
                                </div>

                                <!-- RW -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">RW</label>
                                    <input type="number" name="rw" class="w-full p-2 border rounded-lg"
                                        placeholder="RW">
                                </div>

                                <!-- Dampak -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Dampak</label>
                                    <input type="text" name="dampak" class="w-full p-2 border rounded-lg"
                                        placeholder="Contoh: Rumah Rusak 20 Unit" required>
                                </div>

                                <!-- Status Kejadian -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Status Kejadian</label>
                                    <select name="status_kejadian" class="w-full p-2 border rounded-lg" required>
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Sedang Ditangani">Sedang Ditangani</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>

                                <!-- Keterangan -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-1">Keterangan</label>
                                    <textarea name="keterangan" rows="3" class="w-full p-2 border rounded-lg"
                                        placeholder="Tambahkan keterangan tambahan jika ada"></textarea>

                                </div>
                                <div class="mt-4">
                                    <label for="media" class="block text-sm font-medium text-gray-700">💾Upload
                                        </label>
                                    <input type="file" name="media" class="mt-1 block w-full border rounded-lg">
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="mt-6 flex justify-end">
                                <button type="submit"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">Simpan
                                    Data </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
