SELECT places.gPlusPlaceId, places.name, COUNT(reviews.id) AS reviews_count
FROM places
JOIN reviews ON places.gPlusPlaceId = reviews.gPlusPlaceId
GROUP BY places.gPlusPlaceId, places.name
HAVING reviews_count >= 4
ORDER BY reviews_count DESC;
