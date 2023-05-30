CREATE DATABASE IF NOT EXISTS laragram;

USE laragram;

DROP TABLE IF EXISTS posts_tags;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS follows;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS tags;

CREATE TABLE users(
    id int(255) auto_increment not null,
    role varchar(20),
    name varchar(255),
    surname varchar(255),
    nick varchar(100),
    email varchar(255),
    password varchar(255),
    image varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
) ENGINE = InnoDb;

INSERT INTO
    users
VALUES
(
        NULL,
        'admin',
        'Admin',
        'Admin',
        'Admin',
        'admin@admin.com',
        '$2y$08$82sGne25qbgGYn8vKTB0QOuobF6wBCHMwKhV5zWZU.1z15l57AzPu',
        null,
        CURTIME(),
        CURTIME(),
        NULL
    );

CREATE TABLE posts(
    id int(255) auto_increment not null,
    user_id int(255),
    image_path varchar(255),
    description text,
    location varchar(255),
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_posts PRIMARY KEY(id),
    CONSTRAINT fk_posts_users FOREIGN KEY(user_id) REFERENCES users(id)
) ENGINE = InnoDb;

INSERT INTO
    posts
VALUES
(
        NULL,
        1,
        'default.jpg',
        'descripción de prueba',
        'sample location',
        CURTIME(),
        CURTIME()
    );

CREATE TABLE comments(
    id int(255) auto_increment not null,
    user_id int(255),
    post_id int(255),
    content text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_posts FOREIGN KEY(post_id) REFERENCES posts(id)
) ENGINE = InnoDb;

CREATE TABLE likes(
    user_id int(255),
    post_id int(255),
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_likes PRIMARY KEY(user_id, post_id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_posts FOREIGN KEY(post_id) REFERENCES posts(id)
) ENGINE = InnoDb;

CREATE TABLE follows (
    followed_id int(255) not null,
    follower_id int(255) not null,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_follows PRIMARY KEY(followed_id, follower_id),
    CONSTRAINT fk_followeds_followers FOREIGN KEY(followed_id) REFERENCES users(id),
    CONSTRAINT fk_followers_followeds FOREIGN KEY(follower_id) REFERENCES users(id)
) ENGINE = InnoDb;

CREATE TABLE tags (
    id int(255) auto_increment not null,
    tag_name varchar(255) not null,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_tags PRIMARY KEY (id)
) ENGINE = InnoDb;

CREATE TABLE posts_tags (
    post_id int(255) not null,
    tag_id int(255) not null,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_posts_tags PRIMARY KEY (post_id, tag_id),
    CONSTRAINT fk_posts_tags_posts FOREIGN KEY(post_id) REFERENCES posts(id),
    CONSTRAINT fk_posts_tags_tags FOREIGN KEY(tag_id) REFERENCES tags(id)
) ENGINE = InnoDb;
