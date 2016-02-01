SELECT COUNT(*) AS nb, categorie.cat_id, categorie.cat_nom
FROM film
INNER JOIN categorie ON categorie.cat_id = film.cat_id
GROUP BY categorie.cat_id, categorie.cat_nom
ORDER BY nb DESC