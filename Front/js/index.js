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
  
  for(i=0; i<=data.lenght; i++){

    if (document.getElementById('uname').value != data[i][usuario_correo]){
     
      console.log("El correo no se envio!");
 
    } else{
      console.log('El correo se ha enviado de manera exitosa.');
      document.action="e-mail/email.php"
  
    }
  }

  console.log(data);

  /* ALMOST
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