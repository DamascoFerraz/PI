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
),
(
    "usuario2",
    "2438b7fac2087827a1f3a17972575ad9a37bd12c", -- senha: user1234
    "user"
),
(
    "usuario3",
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
('2','15','4'),
('3','18','5'),
('4','19','4'),
('5','16','5'),
('3','17','4'),
('4','13','5'),
('5','18','4'),
('1','13','5'),
('2','15','4'),
('3','18','5'),
('4','19','4'),
('5','16','5'),
('3','17','4'),
('4','13','5'),
('5','18','4');


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
('Método Pomodoro: como aumentar sua produtividade','Dicas para aumentar a produtividade.','texto exemplo',4),
('A importância de uma boa noite de sono para os estudos','Dicas para melhorar o sono.','texto exemplo',5),
('Como organizar seu tempo de estudo','Dicas para organizar o tempo.','texto exemplo',4),
('Técnicas de leitura rápida','Dicas para melhorar a leitura.','texto exemplo',1),
('Como fazer anotações eficientes','Dicas para melhorar as anotações.','texto exemplo',2),
('A importância da revisão para a fixação do conteúdo','Dicas para melhorar a revisão.','texto exemplo',3),
('Como manter a motivação nos estudos','Dicas para manter a motivação.','texto exemplo',5),
('Estratégias para resolver questões de múltipla escolha','Dicas para melhorar a resolução de questões.','texto exemplo',1),
('Como lidar com a ansiedade antes das provas','Dicas para controlar a ansiedade.','texto exemplo',2),
('A importância da alimentação saudável para o desempenho acadêmico','Dicas para melhorar a alimentação.','texto exemplo',3),
('Como criar um ambiente de estudo produtivo','Dicas para melhorar o ambiente de estudo.','texto exemplo',4),
('Técnicas de concentração para melhorar o foco nos estudos','Dicas para melhorar a concentração.','texto exemplo',5);

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
('1','2'),
('1','3'),
('2','4'),
('2','5'),
('2','1'),
('3','2'),
('3','3'),
('3','4'),
('4','5'),
('5','1'),
('6','2'),
('7','3'),
('8','4'),
('9','5'),
('10','1'),
('1','2'),
('2','3'),
('3','4'),
('4','5'),
('5','1'),
('6','2'),
('7','3'),
('8','4'),
('9','5'),
('10','1');

DELIMITER $$

CREATE TRIGGER trg_add_view
AFTER INSERT ON views
FOR EACH ROW
BEGIN
    UPDATE articles
    SET views = views + 1
    WHERE id = NEW.article_id;
END$$

DELIMITER ;

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
('10','13'),
('1','14'),
('2','14'),
('3','14'),
('4','14'),
('5','14'),
('6','14'),
('7','14'),
('8','14'),
('9','14'),
('10','14');


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
('3','1','4'),
('4','1','5'),
('4','1','4'),
('4','1','5'),
('5','1','4'),
('5','1','5'),
('5','1','4'),
('6','1','5'),
('6','1','5'),
('6','1','4'),
('7','1','5'),
('7','1','4'),
('7','1','5'),
('8','1','4'),
('8','1','5'),
('8','1','4'),
('9','1','5'),
('9','1','5'),
('9','1','4'),
('10','1','5'),
('10','1','4'),
('10','1','5'),
('1','2','5'),
('1','2','4'),
('1','2','5'),
('2','2','4'),
('2','2','5'),
('2','2','4'),
('3','2','5'),
('3','2','5'),
('3','2','4'),
('4','2','5'),
('4','2','4'),
('4','2','5'),
('5','2','4'),
('5','2','5'),
('5','2','4'),
('6','2','5'),
('6','2','5'),
('6','2','4'),
('7','2','5'),
('7','2','4'),
('7','2','5'),
('8','2','4'),
('8','2','5'),
('8','2','4'),
('9','2','5'),
('9','2','5'),
('9','2','4'),
('10','2','5'),
('10','2','4'),
('10','2','5');

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    article_id INT NOT NULL,
    rating INT DEFAULT 0,
    creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active boolean not null DEFAULT 1,

    FOREIGN KEY (author_id) REFERENCES users(id),
    FOREIGN KEY (article_id) REFERENCES articles(id)
);

INSERT INTO comments(content,author_id,article_id) VALUES 
('Ótimo artigo, muito útil!','1','1'),
('Gostei das dicas, vou aplicar nos meus estudos.','2','2'),
('Excelente explicação sobre mapas mentais.','3','3'),
('Muito bom, ajudou bastante!','4','1'),
('Artigo interessante, mas poderia ter mais exemplos.','5','2'),
('Adorei as técnicas de memorização!','1','3'),
('Conteúdo claro e objetivo.','2','1'),
('Vou compartilhar com meus amigos.','3','2'),
('Artigo bem estruturado, parabéns!','4','3'),
('Dicas práticas e fáceis de seguir.','5','1'),
('Gostei muito, obrigado por compartilhar!','1','2'),
('Artigo muito informativo.','2','3'),
('As dicas de organização são ótimas.','3','1'),
('Conteúdo relevante para estudantes.','4','2'),
('Muito bom, recomendo a leitura!','5','3'),
('Artigo útil para quem quer melhorar nos estudos.','1','1'),
('Gostei das sugestões de técnicas de estudo.','2','2'),
('Conteúdo bem explicado e fácil de entender.','3','3'),
('Artigo interessante, vou aplicar as dicas.','4','1'),
('Muito bom, ajudou a esclarecer minhas dúvidas.','5','2'),
('Adorei as dicas de memorização!','1','3'),
('Conteúdo claro e objetivo.','2','1'),
('Vou compartilhar com meus amigos.','3','2'),
('Artigo bem estruturado, parabéns!','4','3'),
('Dicas práticas e fáceis de seguir.','5','1'),
('Gostei muito, obrigado por compartilhar!','1','2'),
('Artigo muito informativo.','2','3'),
('As dicas de organização são ótimas.','3','1'),
('Conteúdo relevante para estudantes.','4','2'),
('Muito bom, recomendo a leitura!','5','3'),
('Artigo útil para quem quer melhorar nos estudos.','1','1'),
('Gostei das sugestões de técnicas de estudo.','2','2'),
('Conteúdo bem explicado e fácil de entender.','3','3'),
('Artigo interessante, vou aplicar as dicas.','4','1'),
('Muito bom, ajudou a esclarecer minhas dúvidas.','5','2');

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
('3','1','4'),
('4','1','5'),
('4','1','4'),
('4','1','5'),
('5','1','4'),
('5','1','5'),
('5','1','4'),
('6','1','5'),
('6','1','5'),
('6','1','4'),
('7','1','5'),
('7','1','4'),
('7','1','5'),
('8','1','4'),
('8','1','5'),
('8','1','4'),
('9','1','5'),
('9','1','5'),
('9','1','4'),
('10','1','5'),
('10','1','4'),
('10','1','5'),
('1','2','5'),
('1','2','4'),
('1','2','5'),
('2','2','4'),
('2','2','5'),
('2','2','4'),
('3','2','5'),
('3','2','5'),
('3','2','4'),
('4','2','5'),
('4','2','4'),
('4','2','5'),
('5','2','4'),
('5','2','5'),
('5','2','4'),
('6','2','5'),
('6','2','5'),
('6','2','4'),
('7','2','5'),
('7','2','4'),
('7','2','5'),
('8','2','4'),
('8','2','5'),
('8','2','4'),
('9','2','5'),
('9','2','5'),
('9','2','4'),
('10','2','5'),
('10','2','4'),
('10','2','5'),
('1','3','5'),
('1','3','4'),
('1','3','5'),
('2','3','4'),
('2','3','5'),
('2','3','4'),
('3','3','5'),
('3','3','5'),
('3','3','4'),
('4','3','5'),
('4','3','4'),
('4','3','5'),
('5','3','4'),
('5','3','5'),
('5','3','4'),
('6','3','5'),
('6','3','5'),
('6','3','4'),
('7','3','5'),
('7','3','4'),
('7','3','5'),
('8','3','4'),
('8','3','5'),
('8','3','4'),
('9','3','5'),
('9','3','5'),
('9','3','4'),
('10','3','5'),
('10','3','4'),
('10','3','5');

DELIMITER $$
CREATE TRIGGER trg_update_article_rating
AFTER INSERT ON ratings_article
FOR EACH ROW
BEGIN
    DECLARE avg_rating FLOAT;

    SELECT AVG(rating) INTO avg_rating
    FROM ratings_article
    WHERE article_id = NEW.article_id;

    UPDATE articles
    SET views = ROUND(avg_rating)
    WHERE id = NEW.article_id;
END$$

DELIMITER ;
-- Atualiza a contagem de views em articles e a contagem de ratings em comments
SET SQL_SAFE_UPDATES = 0;

use postit;
UPDATE articles a
JOIN (
    SELECT article_id, COUNT(*) AS total_views
    FROM views
    GROUP BY article_id
) v ON a.id = v.article_id
SET a.views = v.total_views;

UPDATE comments c
JOIN (
    SELECT comment_id, COUNT(*) AS total_ratings
    FROM ratings_comment
    GROUP BY comment_id
) rc ON c.id = rc.comment_id
SET c.rating = rc.total_ratings;

SET SQL_SAFE_UPDATES = 1;