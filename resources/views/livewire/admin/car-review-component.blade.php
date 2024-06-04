<div>
    <div class="car-review-container">
        <h3 class="car-review-title">Car Reviews</h3>
        <div class="reviews">


            @forelse ($car_reviews as $review)
                <div class="review-item">
                    <div class="review-user-image">
                        <img src="https://placehold.co/100" alt="User Iamge">
                    </div>
                    <div class="review-content">
                        <h4>{{ $review->rental->user->name }}</h4>
                        <p id="review-date">{{ $review->created_at }}</p>
                        <p id="review-comment">{{ $review->comment }}</p>
                        <div class="review-stars">
                            @php
                                $active_stars = $review->stars;
                                $unactive_stars = 5 - $active_stars;
                            @endphp
                            <div class="car-review-stars">
                                @for ($i = 1; $i <= $active_stars; $i++)
                                    <i class="fa-solid fa-star active-stars"></i>
                                @endfor

                                @for ($i = 1; $i <= $unactive_stars; $i++)
                                    <i class="fa-solid fa-star uncolored-stars"></i>
                                @endfor
                            </div>
                            <div class="car-review-rating">
                                <p>{{ $review->stars }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2 style="width: 100%; text-align:center;">No Review Found</h2>
            @endforelse


        </div>

    </div>
</div>
