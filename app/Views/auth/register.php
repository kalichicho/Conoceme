<h1 class="text-xl font-bold mb-4">Registro</h1>
<form method="POST" action="/register" class="bg-white p-6 rounded-lg shadow max-w-md mx-auto">
    <div class="mb-2">
        <label class="block">Nombre</label>
        <input type="text" name="nombre" class="border p-2 w-full" required>
    </div>
    <div class="mb-2">
        <label class="block">Apellido</label>
        <input type="text" name="apellido" class="border p-2 w-full" required>
    </div>
    <div class="mb-2">
        <label class="block">Email</label>
        <input type="email" name="email" class="border p-2 w-full" required>
    </div>
    <div class="mb-2">
        <label class="block">Contraseña</label>
        <input type="password" name="password" class="border p-2 w-full" required>
    </div>
    <div class="mb-2">
        <label class="block">Teléfono (opcional)</label>
        <input type="text" name="telefono" class="border p-2 w-full" placeholder="Ej: 555-1234">
    </div>
    <div class="mb-2">
        <label class="block">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="border p-2 w-full" required>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2">Registrarse</button>
</form>
