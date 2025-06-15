<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/radhikasonar/includes/db.inc.php';

try {
    $sql = 'SELECT joke.id, joketext, name, email
      FROM joke INNER JOIN author
        ON authorid = author.id';
    $result = $pdo->query($sql);
   
} catch (PDOException $e) {
    $error = 'Error fetching jokes: ' . $e->getMessage();
    echo $error;
    exit();
}



foreach ($result as $row) {
    $jokes[] = array(
        'id' => $row['id'],
        'text' => $row['joketext'],
        'name' => $row['name'],
        'email' => $row['email']
    );
}

// Quick test output — skip the HTML file for now


include 'jokes.html.php';
