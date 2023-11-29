@extends('template.template')
@section('content')

<div class="h-screen bg-gray-100 flex justify-center">
    <div class="py-6 px-8 mt-20 bg-white rounded-md shadow-xl w-1/3 h-max">
      <form action="/calculate" method="POST">
        @csrf
        <div class="mb-6">
          <label for="kota" class="block text-gray-800 font-bold">Kota</label>
            <select id="countries" name="kota" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option selected>Pilih Kota</option>
            @foreach ($data as $d)
                <option value="{{ $d }}">{{ $d }}</option>
            @endforeach
            </select>
        </div>
        <div>
          <label for="bulan" class="block text-gray-800 font-bold">Bulan</label>
          <select id="countries" name="bulan" class="bg-gray-50 border border-gray-300 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option selected>Pilih Bulan</option>
            <option value="januari">Januari</option>
            <option value="februari">Februari</option>
            <option value="maret">Maret</option>
            <option value="april">April</option>
            <option value="mei">Mei</option>
            <option value="juni">Juni</option>
            <option value="juli">Juli</option>
            <option value="agustus">Agustus</option>
            <option value="september">September</option>
            <option value="oktober">Oktober</option>
            <option value="november">November</option>
            <option value="desember">Desember</option>
          </select>

        </div>
        <button name="submit" class="cursor-pointer py-2 px-4 block mt-6 bg-indigo-500 text-white font-bold w-full text-center rounded">Kalkulasi</button>
      </form>
    </div>
  </div>
@endsection
