<!-- resources/views/common/errors.blade.php -->
@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <div><strong>入力を修正してください。</strong></div> 
        <div>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    {{Session::forget("error")}}
@endif