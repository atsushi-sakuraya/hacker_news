@if ($errors->any())
    <div class="message">
        <ul class="flash_message alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
