@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">식당등록</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('restaurants') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">식당종류</label>

                                <div class="col-md-6">
                                    {{ $restaurant->category()->first()->name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">식당이름</label>

                                <div class="col-md-6">
                                    {{ $restaurant->name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="walk_time" class="col-md-4 col-form-label text-md-right">이동시간</label>

                                <div class="col-md-6">
                                    {{ $restaurant->walk_time }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">관련링크</label>

                                <div class="col-md-6">
                                    @isset($restaurant->url)
                                    <a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->url }}</a>
                                    @endisset
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="memo" class="col-md-4 col-form-label text-md-right">설명</label>

                                <div class="col-md-6">
                                    {{ $restaurant->memo }}
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="" type="button" class="btn btn-primary btn-sm">
                                        오늘 점심으로 등록!
                                    </a>
                                    <a href="{{ route('restaurant_edit', $restaurant->id) }}" class="btn btn-secondary btn-sm">수정</a>
                                    <a href="{{ route('restaurants') }}" class="btn btn-secondary btn-sm">목록</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
