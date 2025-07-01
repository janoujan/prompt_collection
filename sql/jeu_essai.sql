-- Insertion des types de prompts
 INSERT INTO types (nom) VALUES 
('Text-To-Text'),
 ('Text-To-Image'),
 ('Text-To-Audio'),
 ('Image-To-Text');-- Insertion des outils
 INSERT INTO outils (nom) VALUES 
('ChatGPT'),
 ('MidJourney'),
 ('DALL·E'),
 ('Bing Create');-- Insertion de quelques prompts d’exemple
 INSERT INTO prompts (titre, contenu, id_type, id_outil, observation, favori)
VALUES 
('Résumé automatique', 'Fais un résumé en 5 lignes d’un texte de 500 mots.', 1, 1, 
'Fonctionne bien avec GPT-3.5 et GPT-4', TRUE),
 ('Portrait surréaliste', 'Créer une image d’un chat en tenue d’astronaute sur Mars.', 2, 
2, 'À ajuster selon la version de MidJourney', FALSE),
 ('Étiquette produit', 'Génère un slogan original pour un savon bio français.', 1, NULL, 
NULL, FALSE);