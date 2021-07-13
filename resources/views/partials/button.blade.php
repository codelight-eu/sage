<?php

if (!isset($as)) {
  $as = 'a';
}


if (!isset($modifiers)) {
  $modifiers = [];
}
if (!isset($classNames)) {
  $classNames = [];
}

$classNamesString = '';
foreach ($modifiers as $modifier) {
  $classNamesString = $classNamesString . ' Button-' . $modifier;
}

foreach ($classNames as $className) {
  $classNamesString = $classNamesString . ' ' . $className;
}
?>

@if ($as === 'button')
  <button
    class="Button {{$classNamesString}}"
    type="{{ $data['type'] }}"
  >
@else
  <a
    href="{{ $data['url'] or '' }}"
    class="Button {{$classNamesString}}"
    @if (isset($data['title']))
      title="{{ $data['title'] }}"
    @endif
    @if (isset($data['target']))
      target="{{ $data['target'] }}"
    @endif
  >
@endif

@if(isset($data['icon']))@include('partials.icon', ['name' => $data['icon']])@endif
{{ $data['title'] }}

@if ($as === 'button')
  </button>
@else
  </a>
@endif
