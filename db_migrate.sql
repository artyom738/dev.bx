CREATE TABLE language
(
	ID varchar(10) not null,
	NAME varchar(500) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE movie_title
(
	MOVIE_ID int not null,
	LANGUAGE_ID varchar(10) not null,
	TITLE varchar(500) not null,

	FOREIGN KEY FK_LANGUAGE (LANGUAGE_ID)
		REFERENCES language(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_MOVIE(MOVIE_ID)
		REFERENCES movie(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

# Заполнение справочника языков
INSERT INTO language (ID, NAME)
VALUES ('ru', 'Русский'),
       ('en', 'Английский'),
       ('de', 'Немецкий'),
       ('no', 'Норвежский');

# Перенос русских названий
INSERT INTO movie_title (MOVIE_ID, LANGUAGE_ID, TITLE)
	SELECT ID, 'ru', TITLE FROM movie;

ALTER TABLE movie DROP COLUMN TITLE;