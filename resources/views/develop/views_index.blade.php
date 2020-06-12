@foreach($files as $file)

    <div>
        <a href="{{route('dev_views_show', [$file['id']])}}">
            <p>{{$file['pathName']}}</p>
        </a>
    </div>
@endforeach
