async function loaded() {
  let values = {
    tblName: 'usuario'
  };

  let data = await getRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);
  console.log(data);
}

async function verifyUser(){
  let values = {
    tblName: 'usuario'
  };

  let data = await getRequest('http://localhost/Dist/Krusty_Work/Backend/get.php', values);
  console.log(data);

  /*
  Verificar IF correo en document.getElementByID('uname').value existe en la BD
  Ocupas un FOR para revisar todos los registros de data->contiene todos usuarios en tabla "usuario"
  */
}

async function clickeado() {
  let values = {
    nombre: document.getElementById('nombre').value
  };

  let data = await postRequest('http://localhost/Dist/Krusty_Work/Backend/post.php', values)
  console.log(data);
}