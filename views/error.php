<?php $this->layout('layout', ['title' => $status . ' ' . $message]) ?>

<h1><?= $this->e((string) $status) ?></h1>
<p><?= $this->e($message) ?></p>