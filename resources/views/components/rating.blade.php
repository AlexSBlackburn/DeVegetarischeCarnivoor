<div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating" class="rating-stars">
    <span itemprop="ratingValue" content="{{ $rating }}"></span>
    <span itemprop="ratingCount" content="{{ $ratingCount }}"></span>
    @for($i = 1; $i <= 5; $i++)
        @if($i <= $rating)
            <i class="fa fa-star"></i>
        @else
            <i class="fa fa-star-o"></i>
        @endif
    @endfor
</div>
