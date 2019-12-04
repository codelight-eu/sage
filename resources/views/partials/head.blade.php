<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @if(WP_ENV === 'production')
	  @include('partials.production-scripts')
  @endif
  @php wp_head() @endphp
</head>
