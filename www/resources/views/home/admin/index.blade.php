@extends('layouts.secured')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger text-center">
                <h4 class="">This page contains patient identifiable data, do NOT show to unauthorised people</h4>
                {{route('users.create')}}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card card-body border-light shadow-sm pt-0">
                <br/>
                <table id="infotable" class="table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Randomisation #</th>
                            <th>Current Week</th>
                            <th># Plans</th>
                            <th>Completion Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user["randonum"]}}</td>
                                <td>{{$user["currentweek"]}}</td>
                                <td>{{$user["numplans"]}}</td>
                                <td>{{$user["completed"]}} / {{$user["expected"]}} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('pagejs')
    <script language="JavaScript">
        $(document).ready(function() {
            //-- Setup csrf token for valid form posts
            $('#infotable').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
            });
        });

    </script>
@endsection
