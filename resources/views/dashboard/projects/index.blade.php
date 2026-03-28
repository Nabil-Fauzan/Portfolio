<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
                            <h2 class="font-semibold text-xl text-white leading-tight">
                Manajemen Project
            </h2>
            <a href="{{ route('dashboard.projects.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                Tambah Project
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 rounded-md bg-emerald-100 text-emerald-800 px-4 py-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Desktop/tablet: tabel tetap seperti sebelumnya --}}
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse text-white">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-3 pr-4">Judul</th>
                                    <th class="py-3 pr-4">Tech Stack</th>
                                    <th class="py-3 pr-4">Link</th>
                                    <th class="py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr class="border-b border-gray-100 dark:border-gray-700">
                                        <td class="py-3 pr-4">{{ $project->title }}</td>
                                        <td class="py-3 pr-4">
                                            {{ collect($project->tech)->implode(', ') }}
                                        </td>
                                        <td class="py-3 pr-4">
                                            @if ($project->link)
                                                <a href="{{ $project->link }}"
                                                   target="_blank"
                                                   rel="noopener noreferrer"
                                                   class="text-indigo-600 hover:underline">
                                                    Buka
                                                </a>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-right">
                                            <a href="{{ route('dashboard.projects.edit', $project) }}"
                                               class="inline-block px-3 py-1.5 bg-amber-500 text-white rounded hover:bg-amber-600 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('dashboard.projects.destroy', $project) }}"
                                                  method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1.5 bg-rose-600 text-white rounded hover:bg-rose-700 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 text-center text-white">Belum ada data project.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile: card layout agar lebih mudah dibaca di layar kecil --}}
                    <div class="md:hidden space-y-4">
                        @forelse ($projects as $project)
                            <div class="rounded-lg border border-gray-700 bg-gray-900 p-4 text-white">
                                <div class="space-y-1">
                                    <h3 class="text-base font-semibold">{{ $project->title }}</h3>
                                    <p class="text-sm text-gray-300">
                                        {{ collect($project->tech)->implode(', ') }}
                                    </p>
                                </div>

                                <div class="mt-4 flex flex-wrap items-center gap-3">
                                    @if ($project->link)
                                        <a href="{{ $project->link }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-sm text-indigo-400 hover:underline">
                                            Buka
                                        </a>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif

                                    <a href="{{ route('dashboard.projects.edit', $project) }}"
                                       class="inline-block rounded bg-amber-500 px-3 py-1.5 text-sm text-white hover:bg-amber-600 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('dashboard.projects.destroy', $project) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded bg-rose-600 px-3 py-1.5 text-sm text-white hover:bg-rose-700 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="py-4 text-center text-white">Belum ada data project.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
