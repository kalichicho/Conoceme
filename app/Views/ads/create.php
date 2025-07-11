<h1 class="text-xl font-bold mb-4">Publicar Anuncio</h1>
<form method="POST" action="ads" class="bg-white p-4 rounded shadow" enctype="multipart/form-data">
    <div class="mb-2">
        <label class="block">Título</label>
        <input type="text" name="titulo" class="border p-2 w-full" required>
    </div>
    <div class="mb-2">
        <label class="block">Descripción</label>
        <textarea name="descripcion" class="border p-2 w-full" required></textarea>
    </div>
    <div class="mb-2">
        <label class="block">Precio</label>
        <input type="number" name="precio" step="0.01" class="border p-2 w-full" required>
    </div>
    <div class="mb-2">
        <label class="block">Ubicación</label>
        <input type="text" name="ubicacion" class="border p-2 w-full">
    </div>
    <div class="mb-2">
        <label class="block">Categoría</label>
        <select name="categoria_id" class="border p-2 w-full">
            <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-2">
        <label class="block">Fotos (máximo 10)</label>
        <input type="file" name="fotos[]" multiple accept="image/*" required>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2">Publicar</button>
</form>
