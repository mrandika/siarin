@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Siarin Channel</h1>
    <table class="table table-borderless">
        <tbody>
            @foreach ($list as $item)
            <tr>
                <th style="width: 25%"><img class="mb-5 rounded" src="{{url('uploads/'.$item->imagePath)}}" alt=""
                        style="width: 100%"></th>
                <td>{{($item->name)}}</td>
                <td>
                    @if (\App\UsersSubscribeData::where([['userId', Auth::user()->id],['channelId', $item->id]]))
                    <form action="{{ route('channel.subscribe', $item->id) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <button type="submit" class="btn btn-success">Subscribe</button>
                        </form>
                    @else
                    <form action="{{ route('channel.unsubscribe', $item->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <button type="submit" class="btn btn-danger">Unsubscribe</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
