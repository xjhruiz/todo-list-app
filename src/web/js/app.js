const $id = (selectorById) => document.getElementById(selectorById);
$name = (selectorByName) => document.getElementsByName(selectorByName);

$id("btnNewTask").addEventListener("click", () => {
  $id("msmerror").innerHTML = "";
});

$id("formCreateTask").addEventListener("submit", (event) => {
  event.preventDefault();
  let myDataForm = new FormData($id("formCreateTask"));
  let nombreTarea = myDataForm.get("nombreTarea");
  let descTarea = myDataForm.get("descTarea");
  let estadoTarea = myDataForm.get("estadoTarea");
  //TODO: hacer token en cliente y servidor

  if (
    nombreTarea.length == 0 ||
    descTarea.length == 0 ||
    estadoTarea.length == 0
  ) {
    $id("msmerror").innerHTML = "Error!! Compruebe los campos";
    console.log("errore");
    return null;
  }
  $id("msmerror").innerHTML = "";
  fetch("/task", {
    method: "POST",
    mode: "cors",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      nombreTarea: nombreTarea,
      descTarea: descTarea,
      estadoTarea: estadoTarea,
    }),
  })
    .then((response) => response.json())
    .then((res) => {
      console.log(res.mensaje);
      if (res.mensaje == "Created") {
        location.href = "/";
      } else {
        $id("msmerror").innerHTML = "Error!! No se pudo crear la tarea";
      }
    })
    .catch((error) => console.error({ error }));
});

function deleteTask(idTask) {
  swal({
    title: "¿Quiere eliminar esta tarea? ",
    text: "Una vez eliminada no podrá recuperarla",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    showDenyButton: true,
    confirmButtonText: `Asignar`,
    denyButtonText: `Cancelar`,
  }).then((willDelete) => {
    if (willDelete) {
      fetch("/deleteTask", {
        method: "POST",
        mode: "cors",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          idTask: idTask,
        }),
      })
        .then((response) => response.json())
        .then((res) => {
          if (res.mensaje == "Deleted") {
            location.href = "/";
          } else {
            $id("msmerror").innerHTML = "Error!! No se pudo eliminar la tarea";
          }
        })
        .catch((error) => {
          console.error({ error });
          $id("msmerror").innerHTML = "Error!! No se pudo eliminar la tarea";
        });
      swal("Eliminado", {
        icon: "success",
      });
    } else {
      swal("Su tarea está a salvo!");
    }
  });
}
function changeStatus(idTask, idElement) {
  let valorSelect = $id(idElement).value;
  fetch("/changeStatus", {
    method: "POST",
    mode: "cors",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      idTask: idTask,
      statusTask: valorSelect,
    }),
  })
    .then((response) => response.json())
    .then((res) => {
      if (res.mensaje == "Changed") {
        location.href = "/";
      } else {
        $id("msmerror").innerHTML =
          "Error!! No se pudo Cambiar el estado de la tarea";
      }
    })
    .catch((error) => {
      console.error({ error });
    });
}
