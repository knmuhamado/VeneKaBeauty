{{-- Breadcrumbs Navigation Component --}}
@if(!empty($breadcrumbs) && count($breadcrumbs) > 0)
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb mb-0">
        @foreach($breadcrumbs as $index => $breadcrumb)
            @if($index === count($breadcrumbs) - 1)
                {{-- Last breadcrumb (current page) --}}
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $breadcrumb['label'] }}
                </li>
            @else
                {{-- Navigation breadcrumbs --}}
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb['url'] }}" class="text-decoration-none">
                        {{ $breadcrumb['label'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
@endif
