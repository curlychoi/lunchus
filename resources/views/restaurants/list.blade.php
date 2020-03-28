<?php /** @var \App\Restaurant $restaurant */?>
<?php /** @var \App\Restaurant $restaurant */?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('restaurants') }}">식당목록</a>
                        <div class="float-right">
                            <a href="{{ route('restaurant_register') }}" class="btn btn-primary btn-sm">등록</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="get">
                            <label>
                                <input type="text" class="form-control form-control-sm" name="query" value="{{ request()->query('query') }}"/>
                            </label>
                            <button type="submit" class="btn btn-secondary btn-sm">검색</button>
                        </form>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>종류</th>
                                <th>이름</th>
                                <th>이동시간</th>
                                <th>설명</th>
                                <th>-</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($restaurants as $restaurant)
                            <tr>
                                <td>{{ $restaurant->category()->first()->name }}</td>
                                <td>
                                    <a href="{{ route('restaurant_show', $restaurant->id) }}">{{ $restaurant->name }}</a>
                                </td>
                                <td>
                                    {{ $restaurant->walk_time }}
                                    <a href="{{ $restaurant->url }}" target="_blank"><i class="fa fa-link"></i></a>
                                </td>
                                <td style="width: 200px; text-overflow: ellipsis; overflow: hidden">{{ $restaurant->memo }}</td>
                                <td style="width: 100px;">
                                    <a href="{{ route('to_lunch', $restaurant->id) }}" class="btn btn-danger btn-sm">오늘점심</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding:50px 0 50px 0; text-align: center;">
                                    식당등록 부탁해요 (づ｡◕‿‿◕｡)づ
                                </td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
