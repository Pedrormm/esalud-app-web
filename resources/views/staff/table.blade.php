<div class="table-responsive">
    <table class="table" id="staff-table">
        <thead>
            <tr>
                <th>Historic</th>
        <th>User Id</th>
        <th>Branch</th>
        <th>Shift</th>
        <th>Office</th>
        <th>Room</th>
        <th>H Phone</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($staff as $staff)
            <tr>
                <td>{{ $staff->historic }}</td>
            <td>{{ $staff->user_id }}</td>
            <td>{{ $staff->branch }}</td>
            <td>{{ $staff->shift }}</td>
            <td>{{ $staff->office }}</td>
            <td>{{ $staff->room }}</td>
            <td>{{ $staff->h_phone }}</td>
                <td>
                    {!! Form::open(['route' => ['staff.destroy', $staff->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('staff.show', [$staff->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('staff.edit', [$staff->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
