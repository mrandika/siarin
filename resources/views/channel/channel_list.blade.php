@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Siarin Channel</h1>

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
    <table class="table table-borderless">
        <tbody>
            @foreach ($list as $item)
            <tr>
                <th style="width: 25%"><img class="mb-5 rounded" src="{{url('uploads/'.$item->imagePath)}}" alt=""
                        style="width: 100%"></th>
                <td><h3>{{($item->name)}}</h3> <br> <p>{{($item->subscriber)}} Langganan.</p> <br> <p class="mr-5">{{($item->description)}}</p></td>
                <td>
                    @if (Auth::user()->id != App\Channel::select('userId')->where('id', $item->id)->first()->userId)

                    @if (\App\UsersSubscribeData::where([['userId', Auth::user()->id],['channelId',
                    $item->id]])->exists())
                    <form action="{{ route('channel.unsubscribe', $item->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <button type="submit" class="btn btn-danger">Unsubscribe</button>
                    </form>
                    @else
                    <form action="{{ route('channel.subscribe', $item->id) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <button type="submit" class="btn btn-success">Subscribe</button>
                    </form>
                    @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
