<?php

namespace App\Observers;

// app/Observers/PublicationRatingObserver.php

use App\Models\Publication;
use App\Models\PublicationRating;

class PublicationRatingObserver
{
    public function saved(PublicationRating $rating)
    {
        $this->recalculate($rating->publication);
    }

    public function deleted(PublicationRating $rating)
    {
        $this->recalculate($rating->publication);
    }

    private function recalculate(Publication $publication)
    {
        $publication->number_of_ratings = $publication->ratings()->count();
        $publication->rating_avg = $publication->ratings()->avg('rating');
        $publication->save();
    }
}
