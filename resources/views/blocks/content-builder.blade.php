@if (isset($data['blocks']) && count($data['blocks']))
  @foreach ($data['blocks'] as $block)
    {!! $block !!}
  @endforeach
@endif
