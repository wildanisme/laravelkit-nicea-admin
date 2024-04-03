<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
        <ol class="breadcrumb">
            @foreach ($items as $item)
                @if ($loop->last)
                    <li class="breadcrumb-item active">{{ $item['label'] }}</li>
                @else
                    <li class="breadcrumb-item"> <a href="{{ $item['href'] }}">{{ $item['label'] }} </a></li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
