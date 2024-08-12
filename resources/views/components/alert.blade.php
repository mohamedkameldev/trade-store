@session('created')
<div class="alert alert-success" role="alert" style=" text-align: center">
    {{ session('created') }}
</div>
@endsession

@session('updated')
<div class="alert alert-info" role="alert" style=" text-align: center">
    {{ session('updated') }}
</div>
@endsession

@session('deleted')
<div class="alert alert-danger" role="alert" style=" text-align: center">
    {{ session('deleted') }}
</div>
@endsession