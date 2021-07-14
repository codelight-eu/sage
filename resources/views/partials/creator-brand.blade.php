@php $creatorBrandLink = 'https://codelight.eu'; @endphp
<div class="CreatorBrand">
  @if($creatorBrandLink) <a href="{{ $creatorBrandLink }}" target="_blank" class="CreatorBrand_link"> @endif
    <div class="CreatorBrand_icon">
      @include("partials.icon", ["name" => 'creator-logo'])
    </div>
  @if($creatorBrandLink) </a> @endif
</div>
