@session('success')
<div class="alert alert-success" role="alert" style=" text-align: center">
    {{ session('success') }}
</div>
@endsession

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

@session('restored')
<div class="alert alert-secondary" role="alert" style=" text-align: center">
    {{ session('restored') }}
</div>
@endsession

@session('forced')
<div class="alert alert-danger" role="alert" style=" text-align: center">
    {{ session('forced') }}
</div>
@endsession