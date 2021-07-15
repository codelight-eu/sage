@extends('layouts.app')

@section('content')

  @php
    do_action('get_header', 'shop');
  @endphp

  {{--
    * Hook: woocommerce_before_main_content.
    *
    * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
    * @hooked woocommerce_breadcrumb - 20
    * @hooked WC_Structured_Data::generate_website_data() - 30
  --}}
  @php
    do_action('woocommerce_before_main_content');
  @endphp

  <header class="woocommerce-products-header">
    <div class="container">
      @if(apply_filters('woocommerce_show_page_title', true))
        <h1 class="woocommerce-products-header__title page-title">
          {!! woocommerce_page_title() !!}
        </h1>
      @endif

      {{--
        * Hook: woocommerce_archive_description.
        *
        * @hooked woocommerce_taxonomy_archive_description - 10
        * @hooked woocommerce_product_archive_description - 10
      --}}
      @php
        do_action('woocommerce_archive_description');
      @endphp
    </div>
  </header>
  <div class="container">
    @if (woocommerce_product_loop())
      {{--
        * Hook: woocommerce_before_shop_loop.
        *
        * @hooked woocommerce_output_all_notices - 10
        * @hooked woocommerce_result_count - 20
        * @hooked woocommerce_catalog_ordering - 30
      --}}
      @php
        do_action('woocommerce_before_shop_loop');
      @endphp


      {{-- Start the loop --}}

      @php
        woocommerce_product_loop_start();
      @endphp

      @if (wc_get_loop_prop('total'))
        @while (have_posts())
          @php
            the_post();
            do_action('woocommerce_shop_loop');
            wc_get_template_part('content', 'product');
          @endphp
        @endwhile
      @endif

      @php
        woocommerce_product_loop_end();
      @endphp

      {{-- End the loop --}}


      {{--
        * Hook: woocommerce_after_shop_loop.
        *
        * @hooked woocommerce_pagination - 10
      --}}
      @php
        do_action('woocommerce_after_shop_loop');
      @endphp
    @else
      {{--
        * Hook: woocommerce_no_products_found.
        *
        * @hooked wc_no_products_found - 10
      --}}
      @php
        do_action('woocommerce_no_products_found');
      @endphp
    @endif

    {{--
      * Hook: woocommerce_after_main_content.
      *
      * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
    --}}
    @php
      do_action('woocommerce_after_main_content');
    @endphp

    @php
      do_action('get_footer', 'shop');
    @endphp
  </div>
@endsection
