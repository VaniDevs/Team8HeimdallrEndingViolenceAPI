@extends('layouts.dashboard')
@section('page_heading','Add User Profile')
@section('section')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <br /><br /><br />
                @section ('login_panel_title','Dummy Form')
                @section ('login_panel_body')
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" type="name" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <a href="{{ url ('') }}" class="btn btn-lg btn-success btn-block">Submit</a>
                        </fieldset>
                    </form>

                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>

@stop