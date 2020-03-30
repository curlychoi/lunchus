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
                                <th>이름</th>
                                <th>이동시간</th>
{{--                                <th>설명</th>--}}
                                <th>-</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($restaurants as $restaurant)
                            <tr>
                                <td>
                                    <a href="{{ route('restaurant_show', $restaurant->id) }}">
                                        [{{ $restaurant->category->name }}]
                                        {{ $restaurant->name }}
                                    </a>
                                    @if ($restaurant->comments->count())
                                    <span class="small">
                                        <i class="fa fa-comments-o"></i>
                                        {{ $restaurant->comments->count() }}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $restaurant->walk_time }}
                                    @if($restaurant->url)
                                    <a href="{{ $restaurant->url }}" target="_blank"><i class="fa fa-link"></i></a>
                                    @endif
                                </td>
{{--                                <td style="width: 200px; text-overflow: ellipsis; overflow: hidden">{{ $restaurant->memo }}</td>--}}
                                <td style="width: 100px;">
                                    <button data-url="{{ route('to_lunch', $restaurant->id) }}" class="btn btn-danger btn-sm btn-to-lunch">오늘점심</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding:50px 0 50px 0; text-align: center;">
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

@push('script')
    <script>
        $(function () {
            $('.btn-to-lunch').on('click', function () {
                if (!confirm('오늘 점심메뉴로 등록하시겠습니까?')) {
                    return;
                }

                location.href = $(this).attr('data-url');
            });
        })
    </script>
@endpush
