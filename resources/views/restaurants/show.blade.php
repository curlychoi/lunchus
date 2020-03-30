@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        식당등록
                        <button data-url="{{ route('to_lunch', $restaurant->id) }}" type="button"
                                class="btn btn-primary btn-sm btn-to-lunch float-right">
                            오늘 점심으로 등록!
                        </button>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('restaurants') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">식당종류</label>

                                <div class="col-md-6 col-form-label">
                                    {{ $restaurant->category->name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">식당이름</label>

                                <div class="col-md-6 col-form-label">
                                    {{ $restaurant->name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="walk_time" class="col-md-4 col-form-label text-md-right">이동시간</label>

                                <div class="col-md-6 col-form-label">
                                    {{ $restaurant->walk_time }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">관련링크</label>

                                <div class="col-md-6 col-form-label">
                                    @isset($restaurant->url)
                                    <a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->url }}</a>
                                    @endisset
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="memo" class="col-md-4 col-form-label text-md-right">설명</label>

                                <div class="col-md-6 col-form-label">
                                    {{ $restaurant->memo }}
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="memo" class="col-md-4 col-form-label text-md-right">최초 등록자</label>

                                <div class="col-md-6 col-form-label">
                                    {{ $restaurant->user->name }}
                                </div>
                            </div>

                            <!--
                            <div class="form-group row">
                                <label for="memo" class="col-md-4 col-form-label text-md-right">최초 등록일</label>

                                <div class="col-md-6 col-form-label">
                                    {{ $restaurant->created_at }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="memo" class="col-md-4 col-form-label text-md-right">최근 수정일</label>

                                <div class="col-md-6 col-form-label">
                                    {{ $restaurant->updated_at }}
                                </div>
                            </div>
                            -->
                        </form>
                    </div>
                </div>
                <div class="mt-1 text-right">
                    <a href="{{ route('restaurant_edit', $restaurant->id) }}" class="btn btn-secondary btn-sm">수정</a>
                    <a href="{{ route('restaurants') }}" class="btn btn-secondary btn-sm">목록</a>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="card-title small">
                            댓글등록
                        </div>
                        <form method="post" action="{{ route('comments', $restaurant->id) }}">
                            @csrf
                            <div class="input-group">
                                <textarea class="form-control @error('memo') is-invalid @enderror" name="memo"></textarea>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">등록</button>
                                </div>
                                @error('memo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>

                @foreach($restaurant->comments()->get() as $comment)
                <div class="mt-3">
                    <div class="clearfix">
                        <a name="comment-{{ $comment->id }}"></a>
                        <div class="float-left">{{ $comment->user->name }}</div>
                        <div class="float-right small">{{ $comment->created_at->format('Y.m.d H:i') }}</div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            {{ $comment->memo }}
                        </div>
                    </div>
                    @if ($comment->user_id === auth()->id())
                        <div class="text-right mr-1">
                            <form method="post"
                                  name="comment-delete-{{ $comment->id }}"
                                  id="comment-delete-{{ $comment->id }}"
                                  action="{{ route('comments_delete', [$restaurant->id, $comment->id]) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('comments_edit', [$restaurant->id, $comment->id]) }}" class="small" style="text-decoration: none; color:#444;">수정</a>
                                <span class="small btn-comment-delete" style="cursor:pointer" data-id="{{ $comment->id }}">삭제</span>
                            </form>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <div style="height:200px;"></div>
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

            $('.btn-comment-delete').on('click', function () {
                if (!confirm('댓글을 정말 삭제하시겠습니까?')) {
                    return;
                }

                $('#comment-delete-' + $(this).attr('data-id')).submit();
            });

            $('.btn-comment-update').on('click', function () {
                $('#comment-update-' + $(this).attr('data-id')).removeClass('d-none');
                $('#comment-' + $(this).attr('data-id')).addClass('d-none');
            });
        })
    </script>
@endpush
