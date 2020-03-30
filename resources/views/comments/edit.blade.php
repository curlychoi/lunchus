@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        댓글 수정
                    </div>

                    <div class="card-body">
                        <div class="card-title">
                            {{ $restaurant->name }}
                        </div>

                        <form method="POST" action="{{ route('comments_update', [$restaurant->id, $comment->id]) }}">
                            @csrf
                            @method('patch')
                            <div class="input-group">
                                <textarea class="form-control @error('memo') is-invalid @enderror" name="memo">{{ old('memo') ?? $comment->memo }}</textarea>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">수정</button>
                                </div>
                                @error('memo')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </form>


                        <div class="text-center">
                            <button class="btn btn-secondary btn-sm mt-3" onclick="history.back()">취소</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
