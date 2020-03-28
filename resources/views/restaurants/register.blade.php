@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">식당등록</div>

                <div class="card-body">
                    <form method="POST" action="{{ $restaurant->id ? route('restaurant_update', $restaurant->id) : route('restaurants') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">식당종류</label>

                            <div class="col-md-6">
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" >
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('category_id') ?? $restaurant->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">식당이름</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') ?? $restaurant->name }}"  autocomplete="off" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="walk_time" class="col-md-4 col-form-label text-md-right">이동시간</label>

                            <div class="col-md-6">
                                <input id="walk_time" type="text" class="form-control @error('walk_time') is-invalid @enderror" name="walk_time"
                                       value="{{ old('walk_time') ?? $restaurant->walk_time }}"  autocomplete="off" autofocus>

                                @error('walk_time')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label text-md-right">관련링크</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                                       value="{{ old('url') ?? $restaurant->url }}" autocomplete="off" autofocus>

                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="memo" class="col-md-4 col-form-label text-md-right">설명</label>

                            <div class="col-md-6">
                                <textarea id="memo" type="text" class="form-control @error('memo') is-invalid @enderror"
                                          name="memo" autocomplete="off" autofocus>{{ old('memo') ?? $restaurant->memo }}</textarea>

                                @error('memo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ $restaurant->id ? '수정' : '등록' }}
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="history.back()" style="margin-left:10px;">
                                    취소
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
