<div class="PageHeader">
  @if(is_cart() || is_checkout())<div class="container">@endif
    <h1>{!! title() !!}</h1>
  @if(is_cart())</div>@endif
</div>
