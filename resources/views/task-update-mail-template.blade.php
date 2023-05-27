<h3>Updated attributes</h3>
@foreach($changes as $attribute => $value)
    @if($attribute != 'updated_at')
        <div>
            <h4>{{ucfirst($attribute)}}</h4>
            <p style="background-color: red; text-align: justify">{{$oldValue = $oldAttributes[$attribute] ?? null}}</p>
            <p style="background-color: lawngreen; text-align: justify">{{$value}}</p>
        </div>
    @endif
@endforeach
