<div class="Search">
  <form
    action="{{ esc_url(home_url('/')) }}"
    class="Search_form"
  >
    <input
      type="text"
      name="s"
      class="Search_input"
      placeholder="{{ __('Search', 'woocommerce') }}"
    >
    @include('partials.button', [
      'as' => 'button',
      'modifiers' => ['secondary', 'fullWidth'],
      'data' => [
          'type' => 'submit',
          'title' => __('Search', 'woocommerce'),
       ]
    ])
  </form>
</div>
