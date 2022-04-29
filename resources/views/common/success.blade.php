@if (Session::has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    {{Session::forget("message")}}
@endif