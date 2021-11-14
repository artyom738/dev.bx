USE dev;

# 1. Вывести список фильмов, в которых снимались одновременно Арнольд Шварценеггер* (id = 1) и Линда Хэмилтон* (id = 3).

SELECT m.id,
       mt.title AS Movie_Name,
       d.name   as Director_Name
FROM (
	     SELECT *
	     FROM movie m
		          left join movie_actor ma on m.ID = ma.MOVIE_ID
	     WHERE ma.actor_id = 1
     ) m
	     INNER join movie_title mt on m.ID = mt.MOVIE_ID
	     left join director d on d.ID = m.DIRECTOR_ID
	     left join movie_actor ma on m.ID = ma.MOVIE_ID
WHERE ma.ACTOR_ID = 3
  AND mt.LANGUAGE_ID = 'ru'
GROUP BY 1;

# 2. Вывести список названий фильмов на англйском языке с "откатом" на русский, в случае если название на английском не задано.

SELECT m.ID,
       mt.TITLE
FROM movie m
	     INNER join movie_title mt on m.ID = mt.MOVIE_ID
where LANGUAGE_ID = 'en'
union
SELECT m.ID, mt.TITLE
FROM (SELECT m.ID, mt.TITLE
      FROM movie m
	           LEFT join movie_title mt on m.ID = mt.MOVIE_ID and mt.LANGUAGE_ID = 'en'
      where mt.TITLE is null
     ) m
	     LEFT join movie_title mt on m.ID = mt.MOVIE_ID
where mt.LANGUAGE_ID = 'ru';

# 3. Вывести самый длительный фильм Джеймса Кэмерона*. (Бонус – без использования подзапросов)

SELECT m.id, mt.title, MAX(LENGTH) AS LENGHT
FROM movie m
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE DIRECTOR_ID = 1
  AND mt.LANGUAGE_ID = 'ru'
GROUP BY 2
LIMIT 1;

# 4. ** Вывести список фильмов с названием, сокращённым до 10 символов. Если название короче 10 символов – оставляем как есть. Если длиннее – сокращаем до 10 символов и добавляем многоточие.

SELECT m.id, mt.title AS Title
FROM movie m
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
where char_length(mt.TITLE) <= 10
  AND mt.LANGUAGE_ID = 'ru'
UNION
SELECT m.id, CONCAT(LEFT(mt.TITLE, 10), '...')
FROM movie m
	     LEFT JOIN movie_title mt on m.ID = mt.MOVIE_ID
where char_length(mt.TITLE) > 10
  AND mt.LANGUAGE_ID = 'ru';

# 5. Вывести количество фильмов, в которых снимался каждый актёр.

SELECT a.ID, a.NAME, COUNT(m.ID) NUM_MOVIES
FROM movie_actor ma
	     INNER JOIN actor a on ma.ACTOR_ID = a.ID
	     INNER JOIN movie m on ma.MOVIE_ID = m.ID
GROUP BY 1;

# 6. Вывести жанры, в которых никогда не снимался Арнольд Шварценеггер*.

SELECT g.id, g.name
FROM genre g
WHERE (g.id, g.name) NOT IN
      (SELECT g.ID, G.NAME FROM genre g
LEFT JOIN movie_genre mg on g.ID = mg.GENRE_ID
LEFT OUTER JOIN movie m on m.ID = mg.MOVIE_ID
LEFT JOIN movie_actor ma on m.ID = ma.MOVIE_ID
WHERE ma.ACTOR_ID = 1);

# 7. Вывести список фильмов, у которых больше 3-х жанров.

SELECT movie.ID, mt.TITLE FROM movie
LEFT JOIN movie_genre mg on movie.ID = mg.MOVIE_ID
LEFT JOIN movie_title mt on movie.ID = mt.MOVIE_ID WHERE mt.LANGUAGE_ID = 'ru'
GROUP BY 1
HAVING COUNT(mg.GENRE_ID) > 3;

# 8. Вывести самый популярный жанр для каждого актёра.

SELECT ACT.NAME, (

SELECT g.NAME FROM actor A
	LEFT JOIN movie_actor ma on A.ID = ma.ACTOR_ID
	LEFT JOIN movie m on m.ID = ma.MOVIE_ID
	LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	LEFT JOIN genre g on g.ID = mg.GENRE_ID
WHERE MA.ACTOR_ID = ACT.ID
GROUP BY A.ID, G.NAME
ORDER BY COUNT(G.NAME) DESC
LIMIT 1)
    AS MOST_POPULAR_GENRE FROM actor ACT


