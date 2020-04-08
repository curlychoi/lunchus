@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <ul>
                            <li>
                                <dt>참여 취소 방법?</dt>
                                <dd>
                                    노란색의 내 이름을 클릭하면 취소할 수 있어
                                    <div>
                                        <img src="{{ asset('/img/faq/cancel-party.png') }}" class="img-thumbnail">
                                    </div>
                                </dd>
                            </li>
                            <li>
                                <dt>다른 식당으로 옮기고 싶어?</dt>
                                <dd>
                                    그냥 다른 식당 참여 버튼 누르면 되!
                                    <div>
                                        <img src="{{ asset('/img/faq/move-party.png') }}" class="img-thumbnail col-md-10">
                                    </div>
                                </dd>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
