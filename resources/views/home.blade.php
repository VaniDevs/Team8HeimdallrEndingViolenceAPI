@extends('layouts.dashboard')
@section('page_heading','Incidents')
@section('section')

    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                @section ('table_panel_body')
                    @include('widgets.table', array('class'=>''))
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'table'))
            </div>
        </div>
    </div>
@stop
