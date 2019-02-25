
SELECT p.id AS id_pregunta, p.pregunta, 
	if(p.categoria IS NULL, '0', p.categoria) AS id_categoria, p.orden AS orden_pregunta, 
	if(p.categoria IS NULL, '', c.categoria) AS categoria, 
	if(c.orden IS NULL, '0', c.orden) AS orden_categoria 
	FROM test_preguntas p 
	LEFT JOIN test_categorias c ON p.categoria = c.id 
	ORDER BY p.pregunta ASC;

SELECT * FROM test_categorias ORDER BY categoria ASC;
SELECT * FROM test_preguntas ORDER BY pregunta ASC;

UPDATE test_preguntas SET categoria = NULL, orden = 0 ORDER BY pregunta ASC;

TRUNCATE TABLE test_preguntas;
TRUNCATE TABLE test_categorias;
INSERT INTO test_categorias (id, categoria, orden) VALUES (1, 'Categoría 01', 1);
INSERT INTO test_categorias (id, categoria, orden) VALUES (2, 'Categoría 02', 2);
INSERT INTO test_categorias (id, categoria, orden) VALUES (3, 'Categoría 03', 3);
INSERT INTO test_categorias (id, categoria, orden) VALUES (4, 'Categoría 04', 4);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (1, 'Pregunta 01', NULL, 0);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (2, 'Pregunta 02', NULL, 0);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (3, 'Pregunta 03', NULL, 0);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (4, 'Pregunta 04', NULL, 0);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (5, 'Pregunta 05', NULL, 0);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (6, 'Pregunta 06', NULL, 0);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (7, 'Pregunta 07', NULL, 0);
INSERT INTO test_preguntas (id, pregunta, categoria, orden) VALUES (8, 'Pregunta 08', NULL, 0);


