<h1 class="text-2xl font-bold mb-4">Anuncios</h1>
<?php if (empty($ads)): ?>
<p>No hay anuncios disponibles.</p>
<?php else: ?>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <?php foreach ($ads as $ad): ?>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($ad['titulo']); ?></h2>
        <p class="text-gray-700 mt-2"><?php echo htmlspecialchars($ad['descripcion']); ?></p>
        <p class="mt-2"><strong>Precio:</strong> $<?php echo $ad['precio']; ?></p>
        <p class="text-sm text-gray-500">Publicado por <?php echo htmlspecialchars($ad['nombre']); ?></p>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
