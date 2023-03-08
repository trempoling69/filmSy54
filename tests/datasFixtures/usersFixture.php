<?php

return [
    ['email' => 'user_0@ort.fr', 'nom' => 'User Zero', 'password' => 'azerty', 'comment' => 'pas de role...'],
    ['email' => 'user_1@ort.fr', 'nom' => 'User Animateur', 'password' => 'azerty', 'comment' => 'animateur', 'roles' => ['ROLE_ANIM']],
    ['email' => 'user_2@ort.fr', 'nom' => 'User Assistant', 'password' => 'azerty', 'comment' => 'assistant', 'roles' => ['ROLE_ASSIST']],
    ['email' => 'user_3@ort.fr', 'nom' => 'User AnimAssist', 'password' => 'azerty', 'comment' => 'animateur & assistant', 'roles' => ['ROLE_ASSIST', 'ROLE_ANIM']],
    ['email' => 'user_4@ort.fr', 'nom' => 'User Réalisateur', 'password' => 'azerty', 'comment' => 'réalisateur donc assistant', 'roles' => ['ROLE_REAL']],
    ['email' => 'user_5@ort.fr', 'nom' => 'User Producteur', 'password' => 'azerty', 'comment' => 'producteur = réalisateur & animateur', 'roles' => ['ROLE_PROD']],
];
