@extends('Dashboard.template.template')
@section('content')
    @if(session('pesan'))
        <div class="row">
            <div class="col col-12">
                <div class="alert alert-info" role="alert">
                    {{session('pesan')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
@endsection
