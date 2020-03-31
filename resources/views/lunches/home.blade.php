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
                            <div class="card mb-3">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary btn-sm btn-join float-right"
                                            data-url="{{ route('lunch_join', $lunch->id) }}">
                                        참여
                                        ({{ $lunch->users()->count() }})
                                    </button>

                                    <h5 class="card-title">
                                        <a href="{{ route('restaurant_show', $lunch->restaurant->id) }}">
                                            {{ $lunch->restaurant->name }}
                                        </a>
                                        <span class="small" style="font-size:0.7em">(이동시간  {{ $lunch->restaurant->walk_time }})</span>
                                    </h5>
                                    <p class="card-text">
                                        {{ $lunch->restaurant->memo }}
                                    </p>

                                    @if ($lunch->user_id === auth()->id())
                                        <form method="post" id="form-delete-{{ $lunch->id }}" action="{{ route('lunch_delete', [$lunch->id]) }}" onsubmit="return confirm('정말?')">
                                            @csrf
                                            @method('delete')
                                            <i class="fa fa-trash float-right mt-2 btn-delete" style="cursor:pointer" data-id="{{ $lunch->id }}"></i>
                                        </form>
                                    @endif

                                    <div class="small mt-3">
                                         제안 : {{ $lunch->user->name }}
                                    </div>

                                </div>
                                <div class="card-footer">

                                    <button class="btn btn-light btn-sm">
                                        참여자:
                                    </button>
                                    @foreach ($lunch->users()->get() as $index => $user)
                                        <button class="btn btn-sm {{ ($user->id === auth()->id()) ? 'btn-warning btn-me' : 'btn-light' }}">
                                            @if (!$index) <i class="fa fa-credit-card"></i> @endif
                                            {{ $user->name }}
                                        </button>
                                    @endforeach


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
        $(function () {
            $('.btn-join').on('click', function () {
                if (!confirm('참여 하시겠습니까?')) {
                    return;
                }

                location.href = $(this).attr('data-url');
            });

            $('.btn-me').on('click', function () {
                if (!confirm('취소 하시겠습니까?')) {
                    return;
                }

                location.href = '{{ route('lunch_user_delete') }}';
            });

            $('.btn-delete').on('click', function () {
                $('#form-delete-' + $(this).attr('data-id')).submit();
            });
        });

    </script>
@endpush


