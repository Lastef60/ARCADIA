<?php
require_once(__DIR__ . '/../models/Avis.php');

class AvisController
{
  private $avisModel;

  public function __construct($db)
  {
    $this->avisModel = new Avis($db);
  }

  public function create($pseudo, $message)
  {
    return $this->avisModel->create($pseudo, $message);
  }

  public function list()
  {
    return $this->avisModel->readAll();
  }

  public function listUnvalidated()
  {
    return $this->avisModel->readUnvalidated();
  }

  public function show($id)
  {
    return $this->avisModel->readById($id);
  }

  public function update($id, $pseudo, $message)
  {
    return $this->avisModel->update($id, $pseudo, $message);
  }

  public function delete($id)
  {
    return $this->avisModel->delete($id);
  }

  public function validate($id)
  {
    $this->avisModel->validate($id);
    header('Location: index.php?controller=employe&action=avis'); // Redirection après validation
    exit;
  }
}
