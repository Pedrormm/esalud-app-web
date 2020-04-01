<div class="table-responsive">
    <table class="table" id="notes-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Text</th>
        <th>Event</th>
        <th>Visible</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)
            <tr>
                <td>{{ $note->user_id }}</td>
            <td>{{ $note->text }}</td>
            <td>{{ $note->event }}</td>
            <td>{{ $note->visible }}</td>
                <td>
                    {!! Form::open(['route' => ['notes.destroy', $note->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('notes.show', [$note->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('notes.edit', [$note->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
