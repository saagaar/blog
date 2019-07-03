@if (! empty($breadcrumbs))
<ol class="breadcrumb">
  
  @foreach ($breadcrumbs as $label => $link)
  <li  class="active">
    @if (is_int($label) && ! is_int($link))
    <a>
      {{ $link }}
    </a>
    @else
    <a href="{{ $link }}">
      <i class="fa fa-dashboard"></i>
      {{ $label }}
    </a>
    @endif
  </li>
  @endforeach
</ol>
@endif