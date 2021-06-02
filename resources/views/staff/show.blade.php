@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            @lang('messages.staff_type')
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('staff.show_fields')
                    <a href="{{ route('staff.index') }}" class="btn btn-default">@lang('messages.back_stat')</a>
                </div>
            </div>
        </div>
    </div>
@endsection
