CREATE DATABASE IF NOT EXISTS postit;
USE postit;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    pwd TEXT NOT NULL,
    position ENUM('user', 'professor', 'administrador') NOT NULL,
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active boolean not null DEFAULT 1,

    FOREIGN KEY (team_id) REFERENCES teams(id)
);

INSERT INTO users(username,pwd,position,team_id) VALUES (
    "admin",
    "$2y$10$e0NRG7k1b8m8r9H6r5HkUuJ8Fz8eFz8eFz8eFz8eFz8eFz8eFz8eFz8e", -- senha: admin123
    "administrador",
    1
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE user_tag_ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tag_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    descr TEXT NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    views INT DEFAULT 0,

    is_active boolean not null DEFAULT 1,

    FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE article_tags (
    article_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE ratings_article (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    article_id INT NOT NULL,
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active boolean not null DEFAULT 1,

    FOREIGN KEY (author_id) REFERENCES users(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
)

CREATE TABLE ratings_comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (comment_id) REFERENCES comments(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
