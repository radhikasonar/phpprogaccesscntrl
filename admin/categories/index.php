<?php

include $_SERVER['DOCUMENT_ROOT'] . '/radhikasonar/includes/db.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/radhikasonar/includes/access.inc.php';

/*************************************************************
//Don't forget to change server path
/*************************************************************/

if (!userIsLoggedIn())
{
  include '../login.html.php';
  exit();
}

if (!userHasRole('Site Administrator'))
{
  $error = 'Only Site Administrators may access this page.';
  include '../accessdenied.html.php';
  exit();
}

if (isset($_GET['add']))
{
  $pageTitle = 'New Category';
  $action = 'addform';
  $name = '';
  $id = '';
  $button = 'Add category';

  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
  try
  {
    $sql = 'INSERT INTO category SET
        name = :name';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $_POST['name']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error adding submitted category.';
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
  try
  {
    $sql = 'SELECT id, name FROM category WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching category details.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  $pageTitle = 'Edit Category';
  $action = 'editform';
  $name = $row['name'];
  $id = $row['id'];
  $button = 'Update category';

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
  try
  {
    $sql = 'UPDATE category SET
        name = :name
        WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->bindValue(':name', $_POST['name']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error updating submitted category.';
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{

  // Delete joke associations with this category
  try
  {
    $sql = 'DELETE FROM jokecategory WHERE categoryid = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error removing jokes from category.';
    include 'error.html.php';
    exit();
  }

  // Delete the category
  try
  {
    $sql = 'DELETE FROM category WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error deleting category.';
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

// Display category list

try
{
  $result = $pdo->query('SELECT id, name FROM category');
}
catch (PDOException $e)
{
  $error = 'Error fetching categories from database!';
  include 'error.html.php';
  exit();
}

foreach ($result as $row)
{
  $categories[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'categories.html.php';
