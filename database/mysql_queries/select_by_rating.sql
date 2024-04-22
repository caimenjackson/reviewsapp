USE reviewsapp;

SELECT * 
FROM reviews
INNER JOIN places ON reviews.gPlusPlaceId=places.gPlusPlaceId
WHERE price = '$$$';