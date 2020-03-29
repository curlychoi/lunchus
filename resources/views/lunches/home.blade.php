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
                        @forelse($lunches as $lunch)
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('restaurant_show', $lunch->restaurant->id) }}">
                                            {{ $lunch->restaurant->name }}
                                        </a>
                                        <small class="text-sm-left">({{ $lunch->restaurant->walk_time }})</small>
                                    </h5>
                                    <p class="card-text">
                                        {{ $lunch->restaurant->memo }}
                                    </p>
                                    <button type="button" class="btn btn-primary btn-sm" id="btn-join"
                                       data-url="{{ route('lunch_join', $lunch->id) }}">
                                        참여
                                    </button>
                                </div>
                            </div>
                        @empty
                        <div class="text-center">
                            오늘 뭐먹을래? 식당목록에서 찾아보자 (づ｡◕‿‿◕｡)づ
                            <a href="{{ route('restaurants') }}" class="btn btn-primary btn-sm">식당보기</a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#btn-join').on('click', function () {
            if (!confirm('참여하시겠습니까?')) {
                return;
            }

            location.href = $(this).attr('data-url');
        })

    </script>
@endpush
