@extends('layouts.admin.app')

@section('content')
<div class="flex flex-wrap my-6 -mx-3">
    <!-- card Kejadian Bencana -->
    <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
        <div
            class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <div class="flex flex-wrap mt-0 -mx-3 justify-between items-center">
                    <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                        <h6>Kejadian Bencana</h6>
                        <p class="mb-0 text-sm leading-normal">
                            <i class="fa fa-check text-cyan-500"></i>
                            Kejadian Bencana di Indonesia
                            <span class="ml-1 font-semibold">TERBARU!</span>
                        </p>
                    </div>

                    <!-- Tombol Tambah -->
                    <div class="flex-none w-5/12 max-w-full px-3 text-right">
                        <a href="{{ route('kejadian.create') }}"
                            class="inline-block px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-cyan-400 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition">
                            <i class="fa fa-plus mr-1"></i> Tambah Kejadian

                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-auto p-6 px-0 pb-2">
                <div class="overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">
                                    Jenis Bencana</th>
                                <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">
                                    Tanggal</th>
                                <th class="px-6 py-3 font-bold text-left uppercase text-xxs text-slate-600">
                                    Lokasi</th>
                                <th class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-600">
                                    Dampak</th>
                                <th class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-600">
                                    Status</th>
                                <th class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-600">
                                    Keterangan</th>
                                <th class="px-6 py-3 font-bold text-center uppercase text-xxs text-slate-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($kejadian as $item)
                                <tr>
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <h6 class="mb-0 text-sm">{{ $item->jenis_bencana }}</h6>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <span
                                            class="text-xs font-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                        <span class="text-xs font-semibold">
                                            {{ $item->lokasi_text }} (RT {{ $item->rt }}/RW
                                            {{ $item->rw }})
                                        </span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                        <span class="text-xs font-semibold">{{ $item->dampak }}</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                        <span
                                            class="text-xs font-bold
                                            @if ($item->status_kejadian == 'Selesai') text-green-600
                                            @elseif($item->status_kejadian == 'Sedang Ditangani') text-yellow-600
                                            @else text-red-600 @endif">
                                            {{ $item->status_kejadian }}
                                        </span>
                                    </td>
                                    <td
                                        class="p-2 text-xs text-center align-middle bg-transparent border-b whitespace-nowrap">
                                        {{ $item->keterangan ?? '-' }}
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td class="p-2 text-center align-middle border-b whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('kejadian.edit', $item->kejadian_id) }}"
                                                class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700">
                                                <i class="fa fa-edit mr-1"></i> Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('kejadian.destroy', $item->kejadian_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text">
                                                    <i class="fa fa-trash mr-1"></i> Hapus
                                                </button>
                                                @foreach ($kejadian as $data)
                                                @endforeach

                                    <td class="text-center">
                                        <a href="{{ route('kejadian.show', $item->kejadian_id) }}"
                                            class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text">
                                            Lihat Detail
                                        </a>
                                    </td>
                                    </form>
                </div>
                </td>

                </tr>
                @endforeach
                </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
</html>
@endsection
