@extends('template.template')
@section('content')
<div class="h-screen bg-gray-100 flex justify-center">
    <div class="py-6 px-8 mt-20 bg-white rounded-md shadow-xl w-1/3 h-max block text-gray-800 font-bold">
        Perkiraan cuaca di {{ $city }} pada bulan {{ $month }} adalah : {{ $message }}
    </div>
</div>
@endsection
