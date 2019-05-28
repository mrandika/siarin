@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <img src="{{ asset('image/no_photo.png') }}" class="rounded w-25">
        <h1>{{ Auth::user()->name }}
            @if (Auth::user()->isVerified == 1)
            <i class="fas fa-check-circle"></i>
            @endif </h1>
        <p>Bergabung dengan Siarin pada {{ \Carbon\Carbon::parse(Auth::user()->id)->format('d F Y') }}</p>
    </div>
    @if (App\Channel::select('id')->where('userId', Auth::user()->id)->first() == null)
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Kamu belum punya kanal...</h4>
        <p>Buat kanal agar anda dapat membuat video yang keren untuk orang lain! Lorem ipsum dolor sit amet consectetur,
            adipisicing elit. Voluptas ex adipisci at facilis enim hic non corrupti sapiente quasi? Officia sit rem id
            nam dicta numquam nulla? Aut, perferendis facere.</p>
        <hr>
        <p class="mb-0">Mari <a href="{{ route('channel.create') }}">Mulai.</a></p>
    </div>
    @else

    @endif
</div>
@endsection
