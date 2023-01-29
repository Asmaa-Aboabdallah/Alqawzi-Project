<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

@if (request()->session()->has('error-msg'))
<div class="alert alert-danger">
    <strong><i class="fa-solid fa-circle-xmark"></i> {{ request()->session()->get('error-msg') }}</strong><br>
</div>
@endif

@if (request()->session()->has('msg'))
    <div class="alert alert-success">
        <strong>{{ request()->session()->get('msg') }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <strong> <i class="fa-solid fa-circle-xmark"></i>{{ $error }}</strong><br>
        @endforeach
    </div>
@endif