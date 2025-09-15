CREATE DATABASE IF NOT EXISTS postit;
USE postit;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    pwd TEXT NOT NULL,
    position ENUM('user', 'professor', 'administrador') NOT NULL,
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active boolean not null DEFAULT 1
);

INSERT INTO users(username,pwd,position) VALUES 
(
    "admin",
    "a96e553dc87e478da122e8027e269d412dac1766", -- senha: admin123
    "administrador"
),
(
    "professor1",
    "d6be16ea6b1d48838cd9723f31fbf47fb5ce4f66", -- senha: prof1234
    "professor"
),
(
    "usuario1",
    "2438b7fac2087827a1f3a17972575ad9a37bd12c", -- senha: user1234
    "user"
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

INSERT INTO tags(name) VALUES 
('materia_Matemática'),
('materia_Física'),
('materia_Química'),
('materia_Biologia'),
('materia_História'),
('materia_Geografia'),
('materia_Português'),
('materia_Inglês'),
('materia_Espanhol'),
('materia_Artes'),
('materia_Educação Física'),
('materia_Filosofia'),
('materia_Sociologia'),
('metodo_Estudo'),
('metodo_Redação'),
('metodo_Resumos'),
('metodo_Mapas Mentais'),
('metodo_Flashcards'),
('metodo_Exercícios'),
('dica_Técnicas de Memorização');

-- favoritismo das tags por pessoa
-- ajuda a definir qual as tags favoritas dos users
CREATE TABLE user_tag_ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tag_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

INSERT INTO user_tag_ratings(user_id,tag_id,rating) VALUES 
('1','13','5'),
('1','15','4'),
('2','18','5'),
('2','19','4'),
('3','16','5'),
('3','17','4');


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

INSERT INTO articles(title,descr,content,author_id) VALUES 
('Como fazer um bom resumo?','Dicas para fazer um bom resumo.','texto exemplo',1),
('Técnicas de memorização','Dicas para melhorar a memorização.','texto exemplo',2),
('Mapas mentais: o que são e como fazer?','Dicas para fazer mapas mentais.','texto exemplo',3),
('Método Pomodoro: como aumentar sua produtividade','Dicas para aumentar a produtividade.','texto exemplo',1),
('A importância de uma boa noite de sono para os estudos','Dicas para melhorar o sono.','texto exemplo',2),
('Como organizar seu tempo de estudo','Dicas para organizar o tempo.','texto exemplo',3),
('Técnicas de leitura rápida','Dicas para melhorar a leitura.','texto exemplo',1),
('Como fazer anotações eficientes','Dicas para melhorar as anotações.','texto exemplo',2),
('A importância da revisão para a fixação do conteúdo','Dicas para melhorar a revisão.','texto exemplo',3),
('Como manter a motivação nos estudos','Dicas para manter a motivação.','texto exemplo',1);

CREATE TABLE views(
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    user_id INT NOT NULL,
    view_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO views(article_id,user_id) VALUES 
('1','1'),
('1','1'),
('1','1'),
('2','1'),
('2','1'),
('2','1'),
('3','1'),
('3','1'),
('3','1');

CREATE TABLE article_tags (
    article_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

INSERT INTO article_tags(article_id,tag_id) VALUES 
('1','13'),
('1','15'),
('2','18'),
('2','19'),
('3','16'),
('3','17'),
('4','13'),
('4','18'),
('5','13'),
('5','18'),
('6','13'),
('7','13'),
('7','18'),
('8','13'),
('9','13'),
('10','13');


CREATE TABLE ratings_article (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO ratings_article(article_id,user_id,rating) VALUES 
('1','1','5'),
('1','1','4'),
('1','1','5'),
('2','1','4'),
('2','1','5'),
('2','1','4'),
('3','1','5'),
('3','1','5'),
('3','1','4');

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    article_id INT NOT NULL,
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active boolean not null DEFAULT 1,

    FOREIGN KEY (author_id) REFERENCES users(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
);

INSERT INTO comments(content,author_id,article_id) VALUES 
('Ótimo artigo, muito útil!','1','1'),
('Gostei das dicas, vou aplicar nos meus estudos.','1','2'),
('Excelente explicação sobre mapas mentais.','1','3'),
('Muito bom, ajudou bastante!','1','1'),
('Artigo interessante, mas poderia ter mais exemplos.','1','2'),
('Adorei as técnicas de memorização!','1','3'),
('Conteúdo claro e objetivo.','1','1'),
('Vou compartilhar com meus amigos.','1','2'),
('Artigo bem estruturado, parabéns!','1','3'),
('Dicas práticas e fáceis de seguir.','1','1');

CREATE TABLE ratings_comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (comment_id) REFERENCES comments(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO ratings_comment(comment_id,user_id,rating) VALUES 
('1','1','5'),
('1','1','4'),
('1','1','5'),
('2','1','4'),
('2','1','5'),
('2','1','4'),
('3','1','5'),
('3','1','5'),
('3','1','4');