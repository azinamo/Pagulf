@extends('app')

@section('content')
<div class="container">
    <a href="{{ URL::to('stokvels/create') }}" class="btn btn-primary">Add New</a>
    <br /><br />
    <table width="100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Members</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($stokvels) > 0)
                <tr>
                    @foreach($stokvels as $stokvel)
                        <td>{{ $stokvel->name  }}</td>
                        <td>{{ date('d M Y', strtotime($stokvel->start_date))  }}</td>
                        <td>{{ date('d M Y', strtotime($stokvel->end_date))  }}</td>
                        <td>
                            @if($stokvel->is_active)
                                <span class="label label-success">Active</span>
                            @else
                                <span class="label label-danger">Closed</span>
                            @endif
                        </td>
                        <td>{{ $stokvel->users()->count() }}</td>
                        <td>
                            <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                            <!-- we will add this later since its a little more complicated than the other two buttons -->

                            @if($stokvel->userIsMember($stokvel->id, Auth::user()->id))
                                <a class="btn btn-small btn-danger" href="{{ URL::to('stokvels/exit/' . $stokvel->id ) }}">Exit</a>
                            @else
                                <a class="btn btn-small btn-success" href="{{ URL::to('stokvels/join/' . $stokvel->id) }}">Join</a>
                            @endif


                            <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                            <a class="btn btn-small btn-default" href="{{ URL::to('stokvels/invite/' . $stokvel->id) }}">Invite</a>

                            <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('stokvels/' . $stokvel->id . '/edit') }}">Edit</a>

                            @if(!$stokvel->has_payment_order)
                                <a class="btn btn-small btn-warning" href="{{ URL::to('stokvels/users/' . $stokvel->id . '') }}">Generate Payment Order</a>
                            @endif

                        </td>
                    @endforeach
                </tr>
           @else
                <tr>
                    <td colspan="6">There are no stokvels available</td>
                </tr>
           @endif
        </tbody>
    </table>
</div>
@endsection
