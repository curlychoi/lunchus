<?php /** @var \App\Restaurant $restaurant */?>
<?php /** @var \App\Restaurant $restaurant */?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ now()->format('Y년 m월 d일') }}
                        ({{ $week[now()->format('w')] }})
                    </div>

                    <div class="card-body">
                        <div class="text-center">
                            오늘 뭐먹을래? 식당목록에서 찾아보자 (づ｡◕‿‿◕｡)づ
                            <a href="{{ route('restaurants') }}" class="btn btn-primary btn-sm">식당보기</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
