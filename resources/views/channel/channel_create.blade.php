@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Kanal</h1>
    <p>Isi data dibawah</p>
    <br>

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <div class="alert alert-danger alert-has-icon">
            <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></i></div>
            <div class="alert-body">
                <div class="alert-title">Error</div>
                <ol>
                    @foreach ($errors->all() as $error)
                    <li>
                        <p class="mb-0">{{ $error }}</p>
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>

    </div>

    @endif

    <form action="{{ route('channel.store') }}" method="post">
        @csrf
        <div class="input-group mb-3">
                <input type="file" name="channel_image">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nama-kanal">Nama Kanal</span>
            </div>
            <input type="text" name="channel_name" class="form-control" aria-describedby="nama-kanal">
        </div>

        <button type="submit" class="btn btn-success">Buat!</button>
    </form>
</div>
@endsection
