<!-- Botón o enlace para abrir el modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalHabitaciones">Mostrar Habitaciones</button>

<!-- Modal -->
<div class="modal fade" id="modalHabitaciones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-4">
          <div class="row">
            <?php
              foreach ($habitaciones as $row) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Habitación #" . $row['nro_habitacion'] . "</h5>";
                echo "<p class='card-text'>Tipo: " . $row['nombre_categoria'] . "</p>";
                echo "<p class='card-text'>Disponibilidad: " . $row['estado_habitacion'] . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
