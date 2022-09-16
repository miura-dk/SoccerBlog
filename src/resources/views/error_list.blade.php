@if($errors->any())
    <div style="background: rgb(245, 105, 215); border: 1px solid orange; margin-top:1em; margin-bottom:1em;">
        <ul style="text-align:center">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif