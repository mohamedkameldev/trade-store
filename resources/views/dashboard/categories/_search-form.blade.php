{{-- this file is not to be composed to controllers, we just create it to use it
so, we put the _ before it's name --}}

<div class="container-fluid d-flex justify-content-center align-items-center mb-4">
    <form class="form-inline" action="{{ URL::current() }}" method="GET">
        <input type="text" class="form-control mr-sm-2" name="name" value="{{ request()->query('name') }}"
            placeholder="Name">
        <select class="form-control mr-sm-2" name="status">
            <option value="">All</option>
            <option value="active" @selected(request()->query('status') == 'active')> Active </option>
            <option value="archived" @selected(request()->query('status') == 'archived')> Archived </option>
        </select>
        <button type="submit" class="btn btn-outline-secondary"> Search </button>
    </form>
</div>