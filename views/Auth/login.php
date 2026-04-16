<?php $this->layout('layout', ['title' => 'Login']) ?> 
<h1>Iniciar sesión</h1> 
<?php if (!empty($error)): ?><p><?= $this->e($error) ?></p><?php endif; ?> 
<form method="POST" action="/login"> 
    <input type="email" name="email" placeholder="Email" required> 
    <input type="password" name="password" placeholder="Password" required> 
    <button type="submit">Entrar</button> 
</form>