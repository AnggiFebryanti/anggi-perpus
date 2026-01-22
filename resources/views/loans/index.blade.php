@extends('layouts.app')

@section('title', 'Peminjaman - Sistem Perpustakaan')

@section('content')
<div class="min-h-screen bg-gray-50">
  <!-- Page Header -->
  <div class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">Kelola Peminjaman</h1>
          <p class="mt-1 text-sm text-gray-600">Riwayat peminjaman buku perpustakaan</p>
        </div>
        <a href="{{ route('loans.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
          <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Pinjam Buku
        </a>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                #
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Buku
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Peminjam
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tanggal Pinjam
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Tanggal Kembali
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
              </th>
              <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($loans as $loan)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $loop->iteration }}
              </td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">{{ $loan->book->title }}</div>
                <div class="text-sm text-gray-500">{{ $loan->book->author }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $loan->borrower_name }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                @if($loan->return_date)
                {{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') }}
                @else
                <span class="text-gray-400">-</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if($loan->status === 'dipinjam')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                  Dipinjam
                </span>
                @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Dikembalikan
                </span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                @if($loan->status === 'dipinjam')
                <a href="{{ route('loans.edit', $loan) }}" class="text-green-600 hover:text-green-900 mr-3">
                  Kembalikan
                </a>
                @else
                <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900">
                    Hapus
                  </button>
                </form>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-6 py-10 text-center">
                <div class="flex flex-col items-center">
                  <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  <p class="text-gray-500 text-lg">Belum ada riwayat peminjaman</p>
                  <a href="{{ route('loans.create') }}" class="mt-2 text-indigo-600 hover:text-indigo-900 font-medium">
                    Pinjam buku sekarang
                  </a>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($loans->hasPages())
      <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $loans->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection