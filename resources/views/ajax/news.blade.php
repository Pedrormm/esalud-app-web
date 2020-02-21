   <div>
        @foreach ($news as $piecenew)
        <div class="box">
            <h4>{{ $piecenew->title }}</h4>
            <p>{{ $piecenew->content }}</p>
            <h6 style="text-align: right">{{ $piecenew->date }}</h6>
        </div>
        @endforeach
    </div>