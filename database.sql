CREATE DATABASE IF NOT EXISTS videos;
USE videos;

CREATE TABLE users(
id      int(255) auto_increment not null,
role    varchar(20),
name    varchar(255),
surname varchar(255),
email   varchar(255),
password    varchar(255),
image   varchar(255),
created_at  datetime,
updated_at  datetime,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE videos(
id      int(255) auto_increment not null,
user_id int(255) not null,
title    varchar(255),
description text,
status   varchar(20),
image   varchar(255),
video_path   varchar(255),
created_at  datetime,
updated_at  datetime,
CONSTRAINT pk_videos PRIMARY KEY(id),
CONSTRAINT fk_videos_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;


CREATE TABLE comments(
id      int(255) auto_increment not null,
user_id int(255) not null,
video_id int(255) not null,
body text,
created_at  datetime,
updated_at  datetime,
CONSTRAINT pk_comment PRIMARY KEY(id),
CONSTRAINT fk_comment_video FOREIGN KEY(video_id) REFERENCES videos(id),
CONSTRAINT fk_comment_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;




INSERT INTO users (role, name, surname, email, password)
VALUES ('ADMIN', 'John', 'Peters', 'john@gmail.com', 'john');


INSERT INTO videos (user_id, title, description)
VALUES (1, 'video 2', 'video 2');

INSERT INTO comments (user_id, video_id, body)
VALUES (1, 2, 'comment 1');





