<h1 class="text-xl font-bold mb-4">Ingreso</h1>
<form method="POST" action="/login" class="bg-white p-6 rounded-lg shadow max-w-md mx-auto">
    <div class="mb-2">
        <label class="block">Email</label>
        <input type="email" name="email" class="border p-2 w-full" required>
    </div>
    <div class="mb-2">
        <label class="block">Contraseña</label>
        <input type="password" name="password" class="border p-2 w-full" required>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2">Entrar</button>
</form>
