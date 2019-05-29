@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Unggah Video</h1>

    <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <input type="file" name="video_file">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nama-video">Nama Video</span>
            </div>
            <input type="text" name="video_name" class="form-control" aria-describedby="nama-video">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Description</span>
            </div>
            <textarea class="form-control" name="video_description" aria-label="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Unggah</button>
    </form>
</div>
@endsection
