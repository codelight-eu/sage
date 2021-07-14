@extends('layouts.app')

@section('content')

  @php
    do_action('get_header', 'shop');
  @endphp

  {{--
    * woocommerce_before_main_content hook.
    *
    * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
    * @hooked woocommerce_breadcrumb - 20
  --}}
  @php
    do_action('woocommerce_before_main_content');
  @endphp

  @while (have_posts())
    @php
      the_post();
      wc_get_template_part('content', 'single-product');
    @endphp
  @endwhile

  {{--
    * woocommerce_after_main_content hook.
    *
    * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
  --}}
  @php
    do_action('woocommerce_after_main_content');
  @endphp

  @php
    do_action('get_footer', 'shop');
  @endphp

@endsection
