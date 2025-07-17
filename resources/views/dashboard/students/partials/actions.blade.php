<div>
    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
